<?php

namespace App\Src\Orders\Exceptions;

use Throwable;

class WrongDeliveryDateException extends AbstractDeliveryDateException
{
    public function __construct(Throwable $previous = null)
    {
        parent::__construct('Delivery date should match weekday of tariff.', $previous);
    }
}