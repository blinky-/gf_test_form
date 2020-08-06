<?php

namespace App\Src\Phones\Interfaces;

use App\Src\Phones\Exceptions\IncorrectPhoneException;

interface PhoneFactory
{
    /**
     * @param string $phone
     * @return Phone
     * @throws IncorrectPhoneException
     */
    public function makeFromString(string $phone): Phone;
}