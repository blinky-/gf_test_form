<?php

namespace App\Src\Clients\Interfaces;

use App\Src\Phones\Interfaces\Phone;

interface ClientData
{
    public function getID(): int;
    public function getName(): string;
    public function getPhone(): Phone;
}