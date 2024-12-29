<?php

namespace App\Http\Controllers\site\auth;

use App\Http\Controllers\Controller;
use App\Mail\confirmActive;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\ValidationException;

class ActiveController extends Controller
{
    public function active()
    {
        // $pageWasRefreshed = isset($_SERVER['HTTP_CACHE_CONTROL']) && $_SERVER['HTTP_CACHE_CONTROL'] === 'max-age=0';
        // if($pageWasRefreshed ) {
        //     if(!Session::has('errors')){
        //         return redirect()->route('auth.login');
        //     }
        // } 
        $module="active";
        $module_title=app('setting')->get($module."_title") ? app('setting')->get($module."_title") : trans("modules.module_name_site.".$module);
        $module_pic=app('setting')->get($module."_pic");
        return view('site.auth.active',compact(['module_title','module_pic']));
    }

    public function confirm(Request $request)
    {
        $request->validate([
            'confirm_code' => 'required|min:5|max:5'
        ], ['confirm_code' => __('common.request_validation.confirm_active')]);
        $user = User::where('username', decode_string(request()->get('username')))->where('confirm_code', request()->get('confirm_code'))->where('expire_confirm_at','>=',Carbon::now())->where('state', '0')->first();
        if (!is_null($user)) {

            $user->update(['state'=>'1']);
            Auth::login($user);
            return redirect(RouteServiceProvider::HOME);
        }else{
            throw ValidationException::withMessages([
                'confirm_code' => trans('common.request_validation.confirm_active'),
            ]);
        }
    }

    public function resend_code(Request $request){
        $user=User::where('username',decode_string($request->username))->where('state','0')->first();
        $user->update(['confirm_code'=>rand(10000, 99999),'expire_confirm_at'=>Carbon::now()->addSeconds(env('EXPIRE_DATE_CONFIRM_CODE'))]);
        $fullname = $user['name'] . " " . $user['lastname'];
        Mail::to($user['username'])->send(new confirmActive($fullname, $user['confirm_code']));
        return response()->json($user);
    }


}
