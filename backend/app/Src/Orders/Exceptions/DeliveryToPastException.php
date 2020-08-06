<?php

namespace App\Src\Orders\Exceptions;

use Throwable;

class DeliveryToPastException extends AbstractDeliveryDateException
{
    public function __construct(Throwable $previous = null)
    {
        parent::__construct('Delivery date should be in future.', $previous);
    }
}