<?php

namespace App\Src\Phones;

use App\Src\Phones\Interfaces\Phone as IPhone;

class Phone implements IPhone
{
    private $phoneStr;

    public function __construct(string $phoneStr)
    {
        $this->phoneStr = $phoneStr;
    }

    public function toString(): string
    {
        return $this->phoneStr;
    }
}