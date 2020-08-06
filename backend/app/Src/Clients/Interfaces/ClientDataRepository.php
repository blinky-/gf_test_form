<?php

namespace App\Src\Clients\Interfaces;

use App\Src\Phones\Interfaces\Phone;

interface ClientDataRepository
{
    public function getByPhone(Phone $phone): ?ClientData;
    public function save(ClientData $client): ClientData;
}