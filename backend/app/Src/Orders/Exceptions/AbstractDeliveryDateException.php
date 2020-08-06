<?php

namespace App\Src\Orders\Exceptions;

use Throwable;

abstract class AbstractDeliveryDateException extends \Exception
{
    public function __construct(string $msg, Throwable $previous = null)
    {
        parent::__construct($msg, 400, $previous);
    }
}