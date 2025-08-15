<?php

namespace App\Services\Payment;

use App\Interfaces\PaymentGatewayInterface;
use App\Base\Entities\Enums\UrlEnum;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ZarinpalGatewayService implements PaymentGatewayInterface
{
    private string $merchandName;

    private string $baseUrl;

    public function __construct()
    {
        $this->baseUrl = UrlEnum::ZARIN_PAL_GATEWAY;
        $this->merchandName = UrlEnum::ZARIN_PAL_TOKEN();
    }


    public function createPayment(array $data, string $payWayItem): array
    {
        try {

            $response = Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ])->post($this->baseUrl.'/pg/v4/payment/request.json', [
                'merchant_id' => $this->merchandName,
                'amount' => $data['transaction']['price'] * 10,
                'callback_url' => UrlEnum::CALL_BACK().$payWayItem,
                'description' => 'رزرو کمد هوشمند روش پرداخت '.$payWayItem.' مبلغ '.$data['transaction']['price'] * 10,
                'metadata' => [
                    'mobile' =>$data['user']['mobile'],
                    'email' => $data['user']['email'],
                ],
            ]);

            $result = $response->json();

            if ($response->successful()) {

                return [
                    'success' => true,
                    'authority' => $result['data']['authority'],
                    'payment_url' => UrlEnum::ZARIN_PAL_ACCEPT.$result['data']['authority'],
                    'gateway_response' => $result,
                ];
            }

            return [
                'success' => false,
                'message' => $result['errors']['message'] ?? 'خطا در ایجاد تراکنش',
                'gateway_response' => $result,
            ];

        } catch (\Exception $e) {
            Log::error('Zarinpal payment creation failed: '.$e->getMessage());

            return [
                'success' => false,
                'message' => 'خطا در اتصال به درگاه پرداخت زرین پال',
                'gateway_response' => ['error' => $e->getMessage()],
            ];
        }
    }

    public function verifyPayment(string $authority, $price)
    {
        return Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->post($this->baseUrl.'/pg/v4/payment/verify.json', [
            'merchant_id' => $this->merchandName,
            'authority' => $authority,
            'amount' => $price * 10,
        ]);
    }

    public function getGatewayName(): string
    {
        return 'zarinpal';
    }

    public function getOnlinePaymentUrl(): string
    {
        return UrlEnum::ZARIN_PAL_ACCEPT;
    }
}
