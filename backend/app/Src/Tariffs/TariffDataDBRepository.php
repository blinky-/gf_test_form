<?php

namespace App\Src\Tariffs;

use App\Src\Tariffs\Interfaces\TariffDataRepository;
use App\Src\Tariffs\Models\Tariff;
use App\Src\Tariffs\Interfaces\TariffData;
use App\Src\Tariffs\TariffData as TariffDataImpl;

class TariffDataDBRepository implements TariffDataRepository
{
    private $tariffModel;

    public function __construct(
        Tariff $tariffModel
    )
    {
        $this->tariffModel = $tariffModel;
    }

    private function makeTariffData(Tariff $tariff): TariffData {
        return new TariffDataImpl(
            $tariff->id,
            $tariff->name,
            $tariff->price,
            $tariff->delivery_days
        );
    }

    public function all(): array
    {
        $tariffs = $this->tariffModel->get();

        return $tariffs->map(function (Tariff $t) {
            return $this->makeTariffData($t);
        })->toArray();
    }

    public function getByID(int $id): ?TariffData
    {
        $tariff = $this->tariffModel->find($id);
        if (empty($tariff)) {
            return null;
        }

        return $this->makeTariffData($tariff);
    }
}