<?php

namespace App\Src\Clients\Interfaces;

use App\Src\Phones\Interfaces\Phone;

interface ClientDataFactory
{
    public function make(int $id, Phone $phone, string $name): ClientData;
}