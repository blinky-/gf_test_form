<?php

namespace App\Src\Phones\Exceptions;

use Throwable;

class IncorrectPhoneException extends \Exception
{
    public function __construct(Throwable $previous = null) {
        parent::__construct('Wrong phone format.' ,400, $previous);
    }
}