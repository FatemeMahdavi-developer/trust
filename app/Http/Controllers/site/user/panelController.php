<?php

namespace App\Http\Controllers\site\user;

use App\Base\Entities\Enums\OrderType;
use App\Base\Entities\Enums\PaymentType;
use App\Base\Entities\Enums\PricingType;
use App\Base\Entities\Enums\SettlementStatusOfOrder;
use App\Base\Entities\Enums\SizeLocker;
use App\Http\Controllers\Controller;
use App\Http\Requests\openluckRequest;
use App\Http\Requests\site\change_profile_user_request;
use App\Http\Requests\Site\StoreUserBankAccountRequest;
use App\Http\Requests\site\updatePriceOfLockerBank;
use App\Models\BankAccount;
use App\Models\box;
use App\Models\LockerBank;
use App\Models\OpenLock;
use App\Models\order;
use App\Trait\seo_site;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

use function App\Helpers\admin\enumAsOptions;

class panelController extends Controller
{
    use seo_site;

    public function index()
    {
        $module = "panel";
        $module_title = app("setting")->get($module . "_title") ?: trans("modules.module_name_site." . $module);
        $module_pic = app('setting')->get($module . "_pic");
        return view('site.auth.user.panel', compact('module_title', 'module_pic'));
    }

    public function change_profile()
    {
        $module = "change_prchange_profileofile";
        $module_title = app("setting")->get($module . "_title") ?: trans("modules.module_name_site." . $module);
        $module_pic = app('setting')->get($module . "_pic");

        return view("site.auth.user.change_profile", compact('module_title', 'module_pic'));
    }

    public function change_profile_store(change_profile_user_request $request)
    {
        $inputs = $request->validated();
        $inputs['date_birth'] = convert_to_timestamp($request->date_birth);

        if(@$inputs['legal_information_check']!=1){
            $inputs['legal_information_check']=0;

            $inputs['company']='';
            $inputs['economic_code']='';
            $inputs['national_id']='';
            $inputs['tell2']='';
            $inputs['registration_number']='';
            $inputs['province2']=null;
            $inputs['city2']=null;
        }


        auth()->user()->update($inputs);
        return back()->with("success", trans("common.msg.success"));
    }

    public function comment(Request $request)
    {
        $comment = auth()->user()->comment()->paginate(2);
        if ($request->ajax()) {
            return view("site.layout.partials.comment", compact('comment'));
        } else {
            return view('site.auth.user.comment', compact('comment'));
        }
    }

    public function change_pass(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'before_password' => ['required', 'min:0', 'max:255'],
            'new_password' => ['required', 'min:8', 'max:255', 'confirmed'],
        ]);
        if ($validation->fails()) {
            return response()->json(['errors' => $validation->errors()]);
        }
        if (Hash::check($request->before_password, auth()->user()->password)) {
            auth()->user()->update([
                'password' => Hash::make($request->get("new_password"))
            ]);
            Auth::logout();
            return response()->json("ok");

        } else {
            return response()->json(['errors' => ['before_password' => ['رمز عبور قبلی معتبر نیست']]]);
        }
    }

    public function like()
    {
        $module = "like";
        $module_title = app("setting")->get($module . "_title") ?: trans("modules.module_name_site." . $module);
        $module_pic = app('setting')->get($module . "_pic");
        return view("site.auth.user.like", compact('module_title', 'module_pic'));

    }


    public function invoice(Request $request)
    {
        $orders = order::where(['user_id'=> auth::user()->id,'state'=>'success'])->orderBy('id', 'desc')->get();
        $kind_payment = collect(enumAsOptions(OrderType::cases(), app(order::class)->enumsLang()))->pluck('label', 'value')->toArray();

        return view('site.auth.user.invoice', compact(['orders', 'kind_payment']));
    }

    public function unlocker()
    {
        $module = "unlocker";
        $orders = order::where('user_id', auth::user()->id)->whereHas("transaction", function ($pay) {
            $pay->where("state", PaymentType::SUCCESS);
        })->orderBy('id', 'desc')->get();
        $module_title = app("setting")->get($module . "_title") ?: trans("modules.module_name_site." . $module);
        $module_pic = app('setting')->get($module . "_pic");
        session()->put("refresh", false);
        return view('site.auth.user.unlocker', compact("module_title", "module_pic", "orders"));
    }


    public function unlocker_info(box $box)
    {
//        if (!session()->get("validationerror") === true) {
//            if (session()->get('refresh') === false) {
//                session()->put("refresh", true);
//            } else {
//                session()->put("refresh", false);
//            }
//            if (session()->get('refresh') === false) {
//                return redirect()->route("user.unlocker");
//            }
//        }
        $module = "unlocker_info";
        $module_title = app("setting")->get($module . "_title") ?: trans("modules.module_name_site." . $module);
        $module_pic = app('setting')->get($module . "_pic");
        OpenLock::updateOrCreate([
            "mobile" => auth()->user()->username,
        ], [
            "mobile" => auth()->user()->username,
            "attempt" => "1",
            "code" => rand(1000, 9999),
            "expired_at" => Carbon::now()->addSecond(env("EXPIRE_DATE_CONFIRM_CODE"))
        ]);
        return view("site.auth.user.unlocker_info", compact('module_pic', 'module_title', 'box'));
    }

    public function opendoor(openluckRequest $request)
    {
        if(OpenLock::where("expired_at",">=",Carbon::now())->where("code",$request->confirm_code)->count()){
            $msg=sprintf("%s باز شود",$request->title);
            return response()->json(["msg"=>$msg]);
        }else{
            return response()->json(["error"=>"خطا در انجام عملیات"]);
        }
    }

    public function lockerBankPrice()
    {
        $lockerBanks = LockerBank::whereHas('branch',function ($query) {
            $query->where('user_id',auth()->id());
        })
        ->with(['branch' => function ($query) {
            $query->select('id', 'name', 'user_id');
        }])
        ->get();

        $size=collect(enumAsOptions(SizeLocker::cases(),app(LockerBank::class)->enumsLang()))->pluck('label','value');
        $pricingType=collect(enumAsOptions(PricingType::cases(),app(LockerBank::class)->enumsLang()))->pluck('label','value');

        return view('site.auth.user.price',[
            'lockerBanks'=>$lockerBanks,
            'size'=> $size,
            'pricingType'=>$pricingType
        ]);
    }

    public function updatePriceOfLockerBank(updatePriceOfLockerBank $request)
    {
        foreach ($request->price as $lockerBankId => $price) {

            $lockerBank = LockerBank::where('id', $lockerBankId)
                ->whereHas('branch', function ($q) {
                    $q->where('user_id', auth()->id());
                })
                ->first();
            if ($lockerBank) {
                $lockerBank->update(['price' => $price,'pricing_type'=>$request->pricing_type[$lockerBankId]]);
            }
        }
        return back()->with("success", trans("common.msg.success"));
    }

    public function lockerBankRent()
    {
        $orders=order::where('state','success')
        ->whereHas('box.lockerBank.branch', function ($query) {
            $query->where('user_id', auth()->id());
        })
        ->with([
            'box.lockerBank.branch:id,name,user_id'
        ])
        ->get();

        $size=collect(enumAsOptions(SizeLocker::cases(),app(LockerBank::class)->enumsLang()))->pluck('label','value');

        $settlementStatus=collect(enumAsOptions(SettlementStatusOfOrder::cases(),app(order::class)->enumsLang()))->pluck('label','value');

        return view('site.auth.user.rent',[
            'orders'=>$orders,
            'size'=> $size,
            'settlementStatus'=>$settlementStatus
        ]);
    }

    public function bankAccount()
    {
        $module = "bank-account";
        $module_title = app("setting")->get($module . "_title") ?: trans("modules.module_name_site." . $module);
        $module_pic = app('setting')->get($module . "_pic");

        $myBankAccount=bankAccount::where('user_id',Auth()->id())->first();

        return view("site.auth.user.bank-account", compact('module_title', 'module_pic','myBankAccount'));
    }


    public function StoreBankAccount(StoreUserBankAccountRequest $request){

        $inputs=$request->validated();
        $inputs['user_id']=Auth::id();

       BankAccount::create($inputs);
       //todo: waiting for admin approval
        return back()->with("success", trans("common.msg.success"));
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('main');
    }
}
