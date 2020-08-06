<?php

namespace App\Src\Orders\Interfaces;

use Carbon\Carbon;

interface OrderData
{
    public function getID(): int;
    public function getClientID(): int;
    public function getTariffID(): int;
    public function getFirstDeliveryDate(): Carbon;
    public function getDeliveryAddress(): array;
}