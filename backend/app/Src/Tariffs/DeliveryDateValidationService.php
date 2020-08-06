<?php

namespace App\Src\Tariffs;

use App\Src\Tariffs\Exceptions\TariffNotFoundException;
use App\Src\Tariffs\Interfaces\DeliveryDateValidationService as IDeliveryDateValidationService;
use App\Src\Tariffs\Interfaces\TariffDataRepository;
use Carbon\Carbon;

class DeliveryDateValidationService implements IDeliveryDateValidationService
{
    private $tariffRep;

    public function __construct(
        TariffDataRepository $tariffRep
    ) {
        $this->tariffRep = $tariffRep;
    }

    /**
     * @param int $tariffId
     * @param Carbon $date
     * @return bool
     * @throws TariffNotFoundException
     */
    public function validate(int $tariffId, Carbon $date): bool {
        $tariff = $this->tariffRep->getByID($tariffId);

        if (empty($tariff)) {
            throw new TariffNotFoundException();
        }

        return in_array($date->isoWeekday(), $tariff->getDeliveryDays());
    }
}