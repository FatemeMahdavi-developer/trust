<?php

namespace App\Services\Payment;


use App\Interfaces\PaymentGatewayInterface;
use App\Interfaces\TransactionRepositoryInterface;

class PaymentService
{
    private array $gateways = [];

    public function __construct(
        private TransactionRepositoryInterface $transactionRepository
    ) {}

    public function addGateway(string $name, PaymentGatewayInterface $gateway): void
    {
        $this->gateways[$name] = $gateway;
    }

    public function createPayment(string $gatewayName, array $data, string $payWayItem): array
    {
        $gateway = $this->getGateway($gatewayName);

        $response = $gateway->createPayment($data, $payWayItem);

        return [
            'success' => $response['success'],
            'authority' => $response['authority'] ?? '',
            'payment_url' => $response['payment_url'] ?? '',
            'message' => $response['message'] ?? '',
        ];
    }

    public function verifyPayment(string $authority)
    {
        $transaction = $this->transactionRepository->getFirstTransaction(['code' => $authority]);

        $gateway = $this->getGateway($transaction->gateway);

        // $price = $transaction->transactionable->user_id == 2121 ? 1100 : $transaction->price;
        $price =$transaction->price;

        return $gateway->verifyPayment($authority, $price);
    }

    public function getAvailableGateways(): array
    {
        return array_keys($this->gateways);
    }

    private function getGateway(string $name): PaymentGatewayInterface
    {
        return $this->gateways[$name];
    }

    public function getOnlinePaymentUrl($gatewayName): string
    {
        $gateway = $this->getGateway($gatewayName);

        return $gateway->getOnlinePaymentUrl();
    }
}
