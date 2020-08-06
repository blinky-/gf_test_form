<?php

namespace App\Http\Controllers;

use App\Src\Tariffs\Interfaces\TariffData;
use App\Src\Tariffs\Interfaces\TariffDataRepository;

class TariffController extends Controller
{
    public function index(TariffDataRepository $tariffRep) {
        $tariffsArr = array_map(function (TariffData $t) {
            return [
                'id' => $t->getID(),
                'name' => $t->getName(),
                'price' => $t->getPrice(),
                'delivery_days' => $t->getDeliveryDays(),
            ];
        }, $tariffRep->all());

        return response()->json($tariffsArr);
    }
}