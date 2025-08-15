<?php

namespace App\Http\Controllers\site;

use App\Base\Entities\Enums\BasketState;
use App\Base\Entities\Enums\BoxState;
use App\Base\Entities\Enums\OrderType;
use App\Base\Entities\Enums\PaymentPayWayEnum;
use App\Base\Entities\Enums\TransactionStatusEnum;
use App\Base\Entities\Enums\UrlEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\site\OrderRequest;
use App\Models\account_number;
use App\Models\basket;
use App\Models\box;
use App\Models\order;
use App\Models\payment;
use App\Models\Transaction;
use App\Models\User;
use App\Repositories\TransactionRepository;
use App\Services\Payment\PaymentService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

use function App\Helpers\admin\enumAsOptions;

class order_controller extends Controller
{
    public string $module;
    public string $module_title;
    public string $module_pic;
    public function __construct(
        private PaymentService $paymentService,
        private TransactionRepository $transactionRepository,
    ){
        $this->module='order';
        $this->module_title=app("setting")[$this->module."_title"] ?? __("modules.module_name_site.".$this->module);
        $this->module_pic=app("setting")[$this->module."_pic"] ?? '';

        $this->paymentService = $paymentService;
        $this->transactionRepository = $transactionRepository;
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

    function randomDigits(int $length, string $prefix =UrlEnum::CODE_OPDER): string
    {
        $result = '';
        for ($i = 0; $i < $length; $i++) {
            $result .= random_int(0, 9);
        }
        return $prefix . $result;
    }

    //TODO: check should box empty
    public function store(OrderRequest $request){
        $gateway = cache()->get('setting')['gateway'];

        $inputs=$request->validated();

        $basket=basket::where(['user_id'=>Auth::user()->id,'state'=>BasketState::REGISTRATION])->first();

        $inputs['type']='new';
        $inputs['basket_id']=$basket->id;
        $inputs['size_id']=$basket->size_id;
        $inputs['user_id']=$basket->user_id;
        $inputs['pay_way']=PaymentPayWayEnum::DRAFT->value;
        $inputs['size_title']=$basket->size->title;
        $inputs['price']=$basket->size->price;
        $inputs['box_id']=$basket->box->id;

        $inputs['state']=TransactionStatusEnum::NONE->value;

        $inputs['ref_number'] =$this->randomDigits(10);
        if (order::where('ref_number',$inputs['ref_number'])->getQuery()->exists()){
            $inputs['ref_number']=$this->randomDigits(10);
        }

        $box=box::where(['id'=>$basket->box_id,'state'=>BoxState::EMPTY])->first();
        if($box==null){
            return redirect()->route('reservation')->with(['order_error'=>__('common.order_error')]);
        }

        $order=order::create($inputs);

        $transaction=$this->transactionRepository->createTransactionForReturnOrder($order,
            [
                'gateway' => $gateway,
                'comment' => 'test', //todo: CheckOrderCryptoExpireTimeRule
                'status' => TransactionStatusEnum::NONE->value,
                'payment_at' => Carbon::now(),
                'price' => $order->price,
            ]
        );

        $order=Order::with('user','transaction')->find($order->id);


        if($inputs['kind_payment']==OrderType::ONLINE_PAYMENT->value){
            // transaction
            $token = $this->paymentService->createPayment($gateway, $order->toArray(), $request['kind_payment']);
            $this->transactionRepository->storeOnlineTransactionPayment($order, $token['authority'], $gateway, $request['kind_payment']);
            //add log

            return Redirect::away($token['payment_url']);
        }
        // $basket->update(['state'=>BasketState::PREPARATION]);
        // box::find($basket->box_id)->update(['state'=>BoxState::RESERVED]);
        // TODO:
        // User::find(Auth::user()->id)->update(['have_box'=>1]);
        // return redirect()->route('order_success')->with(['success'=>__('common.order_success'),'ref_number'=>$inputs['ref_number']]);
    }
}
