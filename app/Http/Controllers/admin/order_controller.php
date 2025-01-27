<?php
namespace App\Http\Controllers\admin;

use App\base\class\admin_controller;
use App\base\Entities\Enums\BoxState;
use App\base\Entities\Enums\OrderType;
use App\base\Entities\Enums\PaymentType;
use App\Http\Controllers\Controller;
use App\Http\Requests\admin\product_request;
use App\Models\basket;
use App\Models\order;
use App\Models\payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

use function App\Helpers\admin\enumAsOptions;

class order_controller extends Controller
{
    public function __construct(private string $view='',private string $module ='',private string $module_title ='')
    {
        $this->module = "order";
        $this->view = "admin.module.".$this->module.".";
        $this->module_title = __("modules.module_name." . $this->module);

        foreach (trans("modules.crud_authorize") as $key => $value) {
            $authorize_name=sprintf("authorize:%s_%s",$key,$this->module);
            $this->middleware($authorize_name)->only($value);
        }
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //filter($request->all())
        $order = order::orderBy('id','DESC')->paginate(4);
        $status=collect(enumAsOptions(BoxState::cases(),app(basket::class)->enumsLang()))->pluck('label','value')->toArray();
        // $order_cats_search = order_cat::with(['sub_cats'])->where('catid', '0')->get();
        return view($this->view . "list", [
            'module_title' => $this->module_title,
            'order' => $order,
            'status'=>$status
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(order $order)
    {
        $status=collect(enumAsOptions(BoxState::cases(),app(basket::class)->enumsLang()))->pluck('label','value')->toArray();

        $kind_payment=collect(enumAsOptions(OrderType::cases(),app(order::class)->enumsLang()))->pluck('label','value')->toArray();

        $state_payment=collect(enumAsOptions(PaymentType::cases(),app(payment::class)->enumsLang()))->pluck('label','value')->toArray();

        return view($this->view . "edit", [
            'module_title' => $this->module_title,
            'order' => $order,
            'status' => $status,
            'kind_payment' => $kind_payment,
            'state_payment'=> $state_payment,
            'module' => $this->module,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(product_request $request, order $order)
    {
        DB::beginTransaction();
        $pic=$this->upload_file($this->module,'pic');
        $pic_banner = $this->upload_file($this->module,'pic_banner');
        $inputs=$request->validated();
        $inputs['pic']=$pic;
        $inputs['pic_banner']=$pic_banner;
        $inputs['status']=$request->status ?? '2';
        if(empty($request->price)){
            $inputs['price']=0;
        }
        $order->update($inputs);
        DB::commit();
        return back()->with('success', __('common.messages.success_edit', [
            'module' => $this->module_title
        ]));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        order::where('id', $id)->delete();
        return true;
    }

    public function action_all(Request $request)
    {
        $filed_validation = ['item' => 'required'];
        $validator = Validator::make($request->all(), $filed_validation);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        }
        return (new admin_controller())->action($request, order::class);
    }
}
