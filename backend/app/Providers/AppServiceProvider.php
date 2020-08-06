<?php

namespace App\Providers;

use App\Http\Controllers\OrderController;
use App\Src\Clients\ClientDataDBRepository;
use App\Src\Clients\Interfaces\ClientDataFactory;
use App\Src\Clients\Interfaces\ClientDataRepository;
use App\Src\Clients\Interfaces\ClientService;
use App\Src\Orders\Interfaces\OrderDataRepository;
use App\Src\Orders\Interfaces\SubmitOrderService;
use App\Src\Orders\OrderDataDBRepository;
use App\Src\Phones\FormattedPhoneFactoryDecorator;
use App\Src\Phones\Interfaces\PhoneFactory;
use App\Src\Tariffs\Interfaces\DeliveryDateValidationService;
use App\Src\Tariffs\Interfaces\TariffDataRepository;
use App\Src\Tariffs\TariffDataDBRepository;
use Illuminate\Support\ServiceProvider;
use libphonenumber\PhoneNumberUtil;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {

    }

    public function boot()
    {
        $this->app->singleton(PhoneNumberUtil::class, function () {
            return PhoneNumberUtil::getInstance();
        });

        $this->app->when(OrderController::class)
                  ->needs(PhoneFactory::class)
                  ->give(FormattedPhoneFactoryDecorator::class);
    }

    public $bindings = [
        ClientDataRepository::class => ClientDataDBRepository::class,
        ClientService::class => \App\Src\Clients\ClientService::class,
        ClientDataFactory::class => \App\Src\Clients\ClientDataFactory::class,

        SubmitOrderService::class => \App\Src\Orders\SubmitOrderService::class,
        OrderDataRepository::class => OrderDataDBRepository::class,

        TariffDataRepository::class => TariffDataDBRepository::class,
        DeliveryDateValidationService::class => \App\Src\Tariffs\DeliveryDateValidationService::class,

        PhoneFactory::class => \App\Src\Phones\PhoneFactory::class,
    ];
}
