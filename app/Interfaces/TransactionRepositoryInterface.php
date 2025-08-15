<?php

namespace App\Interfaces;

interface TransactionRepositoryInterface
{
    public function updateOnlineTransactionAfterPayment($translate, $status, $data, $comment, $gateWay, $paymentType, $user);

    public function storeOnlineTransactionPayment($order, $code, $gateway, $payment_type);

    public function getTransactionByMorph($model, $transactionId);

    public function updateExpiredOrder($order);

    public function getTransactionById($transactionId);

    public function getWhereTransaction(array $where);

    public function getFirstTransaction(array $where);

    public function createTransaction($transactionData);

    public function storeOnlineTransactionWallet($transactionData, $wallet, $gateway);
}
