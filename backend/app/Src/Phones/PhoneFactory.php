<?php

namespace App\Src\Phones;

use App\Src\Phones\Interfaces\PhoneFactory as IPhoneFactory;
use App\Src\Phones\Interfaces\Phone;
use App\Src\Phones\Phone as PhoneImpl;

class PhoneFactory implements IPhoneFactory
{
    public function makeFromString(string $phone): Phone {
        return new PhoneImpl($phone);
    }
}