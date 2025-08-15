<?php

namespace App\Repositories;

use App\Base\Entities\Enums\TransactionStatusEnum;
use App\Interfaces\TransactionRepositoryInterface;
use App\Models\Transaction;
use Carbon\Carbon;

class TransactionRepository implements TransactionRepositoryInterface
{
    public function getTransactionByMorph($model, $transactionId)
    {
        return Transaction::query()->whereHasMorph('transactionable', $model)->with('transactionable', 'transactionable.user')->find($transactionId);
    }

    public function getFirstTransactionByMorph($model, array $where)
    {
        return Transaction::query()->where('transactionable_type', $model)->with('transactionable', 'transactionable.user')->where($where)->first();
    }

    public function createTransaction($transactionData)
    {
        return Transaction::create($transactionData);
    }

    public function getTransactionById($transactionId)
    {
        return Transaction::with('transactionable')->find($transactionId);
    }

    public function getWhereTransaction(array $where)
    {
        return Transaction::with('transactionable')->where($where)->get();
    }

    public function getFirstTransaction(array $where)
    {
        return Transaction::with('transactionable')->where($where)->first();
    }

    public function storeOnlineTransactionWallet($transactionData, $wallet, $gateway)
    {
        if ($gateway == cache()->get('setting')['gateway']) {

            $wallet->transaction()->create([
                'gateway' => $gateway,
                'payment_type' => 'online',
                'code' => null,
                'price' => $transactionData['price'],
            ]);
        }

        return $wallet;
    }

    public function storeOnlineTransactionPayment($order, $code, $gateway, $payment_type, $comment = '')
    {
        if ($order->transaction) {
            return $order->transaction()->update([
                // 'payment_type' => $payment_type,
                'gateway' => $gateway,
                'code' => $code,
                'price' => $order->price,
                'comment' => $comment,
            ]);
        } else {
            return $order->transaction()->create([
                // 'payment_type' => $payment_type,
                'gateway' => $gateway,
                'code' => $code,
                'price' => $order->price,
                'comment' => $comment,
            ]);
        }
    }

    public function createTransactionFromManualOrder($order, $comment, $payment_at, $status, $gateway)
    {
        return $order->transaction()->create([
            'status' => $status,
            'payment_type' => $gateway,
            'gateway' => $gateway,
            'comment' => $comment,
            'payment_at' => $payment_at,
            'price' => $order->price,
        ]);
    }

    public function createTransactionForReturnOrder($returnOrder, $returnOrderData)
    {
        return $returnOrder->transaction()->create($returnOrderData);
    }

    public function updateOfflineTransactionPayment($order, $orderUpdatePayWay, $gateway)
    {
        return $order->transaction()->update([
            'gateway' => $gateway,
            // 'card_number' => $orderUpdatePayWay->card_number ?? '',
            'ref_number' => $orderUpdatePayWay->ref_number,
            'payment_at' => $orderUpdatePayWay->payment_at,
            'price' => $order->price,
        ]);
    }

    public function updateExpiredOrder($order)
    {
        return $order->transaction()->update([
            'status' => TransactionStatusEnum::FAILED->value,
            'comment' => __('translate.order_expired_online'),
        ]);
    }

    public function updateOnlineTransactionAfterPayment($translate, $status, $data, $comment, $gateWay, $paymentType, $user)
    {
        // dd($data);
        // dd($data['ref_number']);
        // fee_type => "Merchant"
        // نوع کارمزد.
        // "Merchant" یعنی کارمزد از سمت پذیرنده (صاحب فروشگاه) کسر شده.
        // حالت‌های دیگه می‌تونه "Payer" باشه که یعنی از مشتری کم شده.

        return $translate->update([
            'payment_type' => $paymentType,
            'gateway' => $gateWay,
            'status' => $status,
            'payment_at' => $status === TransactionStatusEnum::SUCCESS->value ? Carbon::now() : null,
            // 'ref_number' => $data['refid'] ?: $data['ref_number'],
            // 'card_number' => $data['card_number'] ?: $data['card_pan'],
            'params' => $data,
        ]);
    }

    public function updateOfflineTransactionAfterAdminSubmit($translate, $status)
    {
        return $translate->update([
            'status' => $status,
        ]);
    }

    public function failedOrderTransaction($order)
    {
        return $order->transaction()->update([
            'status' => TransactionStatusEnum::FAILED->value,
            'comment' => __('translate.order_failed_by_admin'),
        ]);
    }

    public function storeCryptoTransactionPayment($order, $code, $gateway, $payment_type, $comment = '')
    {
        if ($order->transaction) {
            return $order->transaction()->update([
                'payment_type' => $payment_type,
                'gateway' => $gateway,
                'code' => $code,
                'price' => $order->price,
            ]);
        } else {
            return $order->transaction()->create([
                'payment_type' => $payment_type,
                'gateway' => $gateway,
                'code' => $code,
                'price' => $order->price,
            ]);
        }
    }




}
