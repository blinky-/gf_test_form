<?php

namespace App\Src\Orders\Interfaces;

use App\Src\Orders\Exceptions\AbstractDeliveryDateException;
use App\Src\Phones\Interfaces\Phone;
use App\Src\Tariffs\Exceptions\TariffNotFoundException;
use Carbon\Carbon;

interface SubmitOrderService
{
    /**
     * @param Phone $phone
     * @param string $clientName
     * @param int $tariffId
     * @param Carbon $deliveryDate
     * @param array $address
     * @throws TariffNotFoundException|AbstractDeliveryDateException
     */
    public function submit(Phone $phone, string $clientName, int $tariffId, Carbon $deliveryDate, array $address);
}