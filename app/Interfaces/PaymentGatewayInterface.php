<?php

namespace App\Interfaces;

interface PaymentGatewayInterface
{
    public function createPayment(array $data, string $payWayItem): array;

    public function verifyPayment(string $code, $price);

    public function getGatewayName(): string;

    public function getOnlinePaymentUrl(): string;
}

