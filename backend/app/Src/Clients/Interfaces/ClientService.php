<?php

namespace App\Src\Clients\Interfaces;

use App\Src\Phones\Interfaces\Phone;

interface ClientService
{
    public function getOrCreateClientData(Phone $phone, string $name): ClientData;
}