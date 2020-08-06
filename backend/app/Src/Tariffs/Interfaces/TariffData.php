<?php

namespace App\Src\Tariffs\Interfaces;

interface TariffData
{
    public function getID(): int;
    public function getName(): string;
    public function getPrice(): float;
    public function getDeliveryDays(): array;
}