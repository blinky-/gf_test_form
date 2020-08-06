<?php

namespace App\Src\Tariffs\Interfaces;

interface TariffDataRepository
{
    /**
     * @return TariffData[]
     */
    public function all(): array;

    public function getByID(int $id): ?TariffData;
}