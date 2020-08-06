<?php

namespace App\Src\Orders\Interfaces;

interface OrderDataRepository
{
    public function save(OrderData $order);
}