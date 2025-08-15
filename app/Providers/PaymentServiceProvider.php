<?php

namespace App\Providers;

use App\Base\Entities\Enums\PaymentOnlineGetwayEnum;
use App\Interfaces\TransactionRepositoryInterface;
use App\Repositories\TransactionRepository;
use App\Services\Payment\PaymentService;
use App\Services\Payment\ZarinpalGatewayService;
use Illuminate\Support\ServiceProvider;

class PaymentServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(TransactionRepositoryInterface::class, TransactionRepository::class);

        $this->app->singleton(PaymentService::class, function ($app) {
            $paymentService = new PaymentService($app->make(TransactionRepositoryInterface::class));

            $paymentService->addGateway(PaymentOnlineGetwayEnum::ZARINPAL->value, new ZarinpalGatewayService);
            // $paymentService->addGateway(PaymentOnlineGetwayEnum::ZIFY->value, new ZifyGatewayService);

            return $paymentService;
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
