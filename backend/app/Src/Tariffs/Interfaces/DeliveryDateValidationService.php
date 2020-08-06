<?php

namespace App\Src\Tariffs\Interfaces;

use App\Src\Tariffs\Exceptions\TariffNotFoundException;
use Carbon\Carbon;

/**
 * @param int $tariffId
 * @param Carbon $date
 * @return bool
 * @throws TariffNotFoundException
 */
interface DeliveryDateValidationService
{
    public function validate(int $tariffId, Carbon $date): bool;
}