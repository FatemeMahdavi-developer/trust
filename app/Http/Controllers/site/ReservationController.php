<?php

namespace App\Http\Controllers\site;

use App\Base\Entities\Enums\BasketState;
use App\Http\Controllers\Controller;
use App\Http\Requests\site\ContacRequest;
use App\Models\basket;
use App\Models\order;
use App\Models\size;
use Illuminate\Support\Facades\Auth;
use Morilog\Jalali\CalendarUtils;

class ReservationController extends Controller
{
    public function __construct(public string $module='',public string $module_title='',public string $module_pic=''){
        $this->module='reservation';
        $this->module_title=app("setting")[$this->module."_title"] ?? __("modules.module_name_site.".$this->module);
        $this->module_pic=app("setting")[$this->module."_pic"] ?? '';
    }

    public function basket(){
        return basket::where(['user_id'=>Auth::user()->id,'state'=>BasketState::REGISTRATION])->get('id')->first() ?? [];
    }
    public function reservation()
    {
        $sizes = size::where('state','1');
        $prices=$sizes->get(['title','price','note']);
        $sizes=$sizes->get(['id','title']);
        return view('site.reservation',[
            'module_title'=>$this->module_title,
            'module_pic'=>$this->module_pic,
            'sizes'=>$sizes,
            'prices'=>$prices
        ]);
    }

    public function store(ContacRequest $request){
        $inputs=$request->validated();
        if(Auth::user()->have_box==1){
            return back()->with('order_error','شما درحال حاضر کمد دارید');
        }
       $expired_date=CalendarUtils::createCarbonFromFormat('Y/m/d',$request->expired_at[0])->format('Y-m-d');
       $inputs["expired_at"]=$expired_date.' '.$request->expired_at[1].':'.$request->expired_at[2].':00';
        if(!empty($this->basket())){
            $basket_id=$this->basket()->id;
            basket::find($basket_id)->update($inputs);
        }else{
            $inputs["ip"]=$request->ip();
            $inputs['user_id']=Auth::user()->id;
            $inputs['state']=BasketState::REGISTRATION->value;
            $basket=basket::create($inputs);
            $basket_id=$basket->id;
        }
        return redirect()->route('order')->with('basket_id',$basket_id);
    }
}
