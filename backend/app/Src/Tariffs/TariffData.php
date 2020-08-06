<?php

namespace App\Src\Tariffs;

use App\Src\Tariffs\Interfaces\TariffData as ITariffData;

class TariffData implements ITariffData
{
    private $id;
    private $name;
    private $price;
    private $delivery_days;

    public function __construct(int $id, string $name, float $price, array $delivery_days) {
        $this->id = $id;
        $this->name = $name;
        $this->price = $price;
        $this->delivery_days = $delivery_days;
    }

    public function getID(): int {
        return $this->id;
    }

    public function getName(): string {
        return $this->name;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function getDeliveryDays(): array {
        return $this->delivery_days;
    }
}