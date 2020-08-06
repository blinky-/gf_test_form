<?php

namespace App\Src\Phones;

use App\Src\Phones\Exceptions\IncorrectPhoneException;
use App\Src\Phones\Interfaces\PhoneFactory;
use App\Src\Phones\Interfaces\Phone;
use libphonenumber\PhoneNumberFormat;
use libphonenumber\PhoneNumberUtil;

class FormattedPhoneFactoryDecorator implements PhoneFactory
{
    private $phoneNumUtil;
    private $phoneFactory;

    public function __construct(
        PhoneNumberUtil $phoneNumUtil,
        PhoneFactory $phoneFactory
    )
    {
        $this->phoneNumUtil = $phoneNumUtil;
        $this->phoneFactory = $phoneFactory;
    }

    /**
     * @param string $phone
     * @return Phone
     * @throws IncorrectPhoneException
     */
    public function makeFromString(string $phone): Phone {
        try {
            $phoneProto = $this->phoneNumUtil->parse($phone);
            $phone = $this->phoneNumUtil->format($phoneProto, PhoneNumberFormat::E164);
        } catch (\Exception $e) {
            throw new IncorrectPhoneException();
        }

        return $this->phoneFactory->makeFromString($phone);
    }
}