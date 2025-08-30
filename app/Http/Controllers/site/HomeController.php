<?php

namespace App\Http\Controllers\site;

use App\Base\Entities\Enums\BoxState;
use App\Base\Entities\Enums\PaymentOnlineGetwayEnum;
use App\Base\Entities\Enums\PaymentPayWayEnum;
use App\Base\Entities\Enums\TransactionStatusEnum;
use App\Base\Entities\Enums\UrlEnum;
use App\Http\Controllers\Controller;
use App\Models\banner;
use App\Models\box;
use App\Models\instagram;
use App\Models\news;
use App\Models\order;
use App\Repositories\TransactionRepository;
use App\Services\Payment\PaymentService;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct(
        private PaymentService $paymentService,
        private TransactionRepository $transactionRepository,
    ){
        $this->paymentService = $paymentService;
        $this->transactionRepository = $transactionRepository;
    }

    public function main()
    {
        $banners=banner::where('state','1')->get();
        $news = news::where('state_main', '1')->where('state', '1')->where('validity_date', '<=', Carbon::now()->format('Y/m/d H:i:s'))->orderBy('order', 'desc')->with(['news_cat'])->limit('5')->get(['title','seo_url','note', 'pic', 'catid','validity_date']);
        $instagram_posts = instagram::where('state_main', '1')->where('state', '1')->orderBy('order', 'desc')->limit('10')->get();

        return view('site.main', compact('news','instagram_posts','banners'));
    }

    public function about(){
        return view('site.about');
    }

    public function callBack($payWay, Request $request)
    {
        $gateway = cache()->get('setting')['gateway'];

        if ($gateway == PaymentOnlineGetwayEnum::ZARINPAL->value) {
            $transaction = $this->transactionRepository->getFirstTransaction(['code' => $request->Authority]);
            $code = $request->Authority;
        }

        if ($transaction->status == TransactionStatusEnum::NONE->value && $transaction->transactionable->pay_way == PaymentPayWayEnum::DRAFT->value) {

            $res = $this->paymentService->verifyPayment($transaction->code);

            if ($res->status() == 200) {

                $data = $res->json()['data'];

                $order =order::find($transaction->transactionable->id);

                $order->update([
                    'state' => TransactionStatusEnum::SUCCESS->value,
                    'pay_way' => PaymentPayWayEnum::ONLINE,
                ]);

                Box::find($order->box_id)->update([
                    'state' => BoxState::FILL
                ]);

                $this->transactionRepository->updateOnlineTransactionAfterPayment($transaction, TransactionStatusEnum::SUCCESS->value, $data, '',$gateway, $payWay, false);

                $url = UrlEnum::CHECK_OUT() . $transaction->transactionable->id . '?statusPayment='.TransactionStatusEnum::SUCCESS->value;

            } else {
                // add log
                // FailedCallBackOrderEvent::dispatch($user, $transaction->refresh());
                $url = UrlEnum::CHECK_OUT() . $transaction->transactionable->id . '?statusPayment='.TransactionStatusEnum::FAILED->value;
            }

        }
        return redirect($url);
    }


    public function checkout(order $order)
    {
        $status =request()->get('statusPayment');
        $arr=[];
        $arr['status']=$status;

        if( $order->state->value==TransactionStatusEnum::SUCCESS->value && $status==TransactionStatusEnum::SUCCESS->value){

            $transaction = $this->transactionRepository->getFirstTransactionByMorph(order::class, ['transactionable_id' => $order->id]);

            $arr['ref_id']=$transaction->params['ref_id'];

            $arr['ref_number']=$order->ref_number;

        }

        return view('site.checkout',$arr);

    }

}
