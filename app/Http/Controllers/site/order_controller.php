<?php

namespace App\Http\Controllers\site;

use App\base\Entities\Enums\BasketState;
use App\base\Entities\Enums\BoxState;
use App\base\Entities\Enums\OrderType;
use App\Http\Controllers\Controller;
use App\Http\Requests\site\OrderRequest;
use App\Models\account_number;
use App\Models\basket;
use App\Models\box;
use App\Models\order;
use App\Models\payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use function App\Helpers\admin\enumAsOptions;

class order_controller extends Controller
{
    public function __construct(public string $module='',public string $module_title='',public string $module_pic=''){
        $this->module='order';
        $this->module_title=app("setting")[$this->module."_title"] ?? __("modules.module_name_site.".$this->module);
        $this->module_pic=app("setting")[$this->module."_pic"] ?? '';
    }


    public function order()
    {
        $basket=basket::where(['user_id'=>Auth::user()->id,'state'=>BasketState::REGISTRATION])->first();
        if(!is_null($basket)){
            $kind_payment=collect(enumAsOptions(OrderType::cases(),app(order::class)->enumsLang()))->pluck('label','value');
            $account_numbers=account_number::pluck('name','id')->toArray();
            return view('site.order',[
                'module_title'=>$this->module_title,
                'module_pic'=>$this->module_pic,
                'kind_payment'=>$kind_payment,
                'price'=>$basket->size->price,
                'account_numbers'=>$account_numbers
            ]);
        }else{
            return redirect()->route('reservation');
        }
    }

    function randomDigits(int $length, string $prefix ='TRUST-'): string
    {
        $result = '';
        for ($i = 0; $i < $length; $i++) {
            $result .= random_int(0, 9);
        }
        return $prefix . $result;
    }

    //TODO: check should box empty
    public function store(OrderRequest $request){
        $basket=basket::where(['user_id'=>Auth::user()->id,'state'=>BasketState::REGISTRATION])->first();
        $inputs=$request->validated();
        $payment=payment::create($inputs);
        $inputs['type']='new';
        $inputs['basket_id']=$basket->id;
        $inputs['size_id']=$basket->size_id;
        $inputs['user_id']=$basket->user_id;
        $inputs['payment_id']=$payment->id;
        $inputs['size_title']=$basket->size->title;
        $inputs['price']=$basket->size->price;
        $inputs['number_box']=$basket->box->number_box;
        $inputs['state']=OrderType::BANK_FISH;
        $inputs['ref_number'] =$this->randomDigits(6);
        if (order::where('ref_number',$inputs['ref_number'])->getQuery()->exists()) {
            $inputs['ref_number']=$this->randomDigits(6);
        }
        $box=box::where(['id'=>$basket->box_id,'state'=>BoxState::EMPTY])->first();
        if($box==null){
            return redirect()->route('reservation')->with(['order_error'=>__('common.order_error')]);
        }
        order::create($inputs);
        $basket->update(['state'=>BasketState::PREPARATION]);
        box::find($basket->box_id)->update(['state'=>BoxState::RESERVED]);
        return redirect()->route('order_success')->with(['success'=>__('common.order_success'),'ref_number'=>$inputs['ref_number']]);
    }
}
