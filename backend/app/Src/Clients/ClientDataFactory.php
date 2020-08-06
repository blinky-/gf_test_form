<?php

namespace App\Src\Clients;

use App\Src\Phones\Interfaces\Phone;
use App\Src\Clients\Interfaces\ClientDataFactory as IClientDataFactory;
use App\Src\Clients\Interfaces\ClientData;
use App\Src\Clients\ClientData as ClientDataImpl;

class ClientDataFactory implements IClientDataFactory
{
    public function make(int $id, Phone $phone, string $name): ClientData {
        return new ClientDataImpl($id, $phone, $name);
    }
}