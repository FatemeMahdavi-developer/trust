<?php
namespace App\Http\Controllers\admin;

use App\Base\class\admin_controller;
use App\Base\Entities\Enums\BoxState;
use App\Base\Entities\Enums\OrderType;
use App\Base\Entities\Enums\PaymentType;
use App\Http\Controllers\Controller;
use App\Http\Requests\admin\order_request;
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

        return view($this->view."edit",[
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
    public function update(order_request $request,order $order)
    {
        $inputs=$request->validated();
        $order->payment->update($inputs);
        return back()->with('success','وضیعت سفارش تغییر کرد');
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
