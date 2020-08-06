<?php

namespace App\Src\Clients;

use App\Src\Clients\Interfaces\ClientData as IClientData;
use App\Src\Phones\Interfaces\Phone;

class ClientData implements IClientData
{
    private $id;
    private $name;
    private $phone;

    public function __construct(
        int $id,
        Phone $phone,
        string $name
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->phone = $phone;
    }

    public function getID(): int {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getPhone(): Phone {
        return $this->phone;
    }
}