<?php

namespace App\Src\Orders;

use Carbon\Carbon;
use App\Src\Orders\Interfaces\OrderData as IOrderData;

class OrderData implements IOrderData
{
    private $id;
    private $clientId;
    private $tariffId;
    private $firstDeliveryDate;
    private $address;

    public function __construct(
        int $id,
        int $clientId,
        int $tariffId,
        Carbon $firstDeliveryDate,
        array $address
    ) {
        $this->id = $id;
        $this->clientId = $clientId;
        $this->tariffId = $tariffId;
        $this->firstDeliveryDate = $firstDeliveryDate;
        $this->address = $address;
    }

    public function getID(): int {
        return $this->id;
    }

    public function getClientID(): int {
        return $this->clientId;
    }

    public function getTariffID(): int {
        return $this->tariffId;
    }

    public function getFirstDeliveryDate(): Carbon {
        return $this->firstDeliveryDate;
    }

    public function getDeliveryAddress(): array
    {
        return $this->address;
    }
}