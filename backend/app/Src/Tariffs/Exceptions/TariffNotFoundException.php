<?php

namespace App\Src\Tariffs\Exceptions;

class TariffNotFoundException extends \Exception
{
    public function __construct(\Throwable $previous = null)
    {
        parent::__construct('Tariff not found.', 400, $previous);
    }
}