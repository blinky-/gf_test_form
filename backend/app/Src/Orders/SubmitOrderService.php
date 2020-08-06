<?php

namespace App\Src\Orders;

use App\Src\Clients\Interfaces\ClientData;
use App\Src\Clients\Interfaces\ClientService;
use App\Src\Orders\Exceptions\AbstractDeliveryDateException;
use App\Src\Orders\Exceptions\DeliveryToPastException;
use App\Src\Orders\Exceptions\WrongDeliveryDateException;
use App\Src\Orders\Interfaces\OrderDataRepository;
use App\Src\Phones\Interfaces\Phone;
use App\Src\Tariffs\Exceptions\TariffNotFoundException;
use App\Src\Tariffs\Interfaces\DeliveryDateValidationService;
use Carbon\Carbon;
use App\Src\Orders\Interfaces\SubmitOrderService as ISubmitOrderService;
use App\Src\Orders\Interfaces\OrderData;
use App\Src\Orders\OrderData as OrderDataImpl;

class SubmitOrderService implements ISubmitOrderService
{
    private $deliveryDateValidationService;
    private $clientService;
    private $orderRep;

    public function __construct(
        DeliveryDateValidationService $deliveryDateValidationService,
        ClientService $clientService,
        OrderDataRepository $orderRep
    ) {
        $this->deliveryDateValidationService = $deliveryDateValidationService;
        $this->clientService = $clientService;
        $this->orderRep = $orderRep;
    }

    /**
     * @param Phone $phone
     * @param string $clientName
     * @param int $tariffId
     * @param Carbon $deliveryDate
     * @param array $address
     * @throws TariffNotFoundException|AbstractDeliveryDateException
     */
    public function submit(
        Phone $phone,
        string $clientName,
        int $tariffId,
        Carbon $deliveryDate,
        array $address
    ) {
        if (Carbon::now()->greaterThan($deliveryDate)) {
            throw new DeliveryToPastException();
        }
        if (!$this->deliveryDateValidationService->validate($tariffId, $deliveryDate)) {
            throw new WrongDeliveryDateException();
        }

        $clientData = $this->clientService->getOrCreateClientData($phone, $clientName);
        $orderData = $this->makeOrderData($clientData, $tariffId, $deliveryDate, $address);

        $this->orderRep->save($orderData);
    }

    private function makeOrderData(
        ClientData $clientData,
        int $tariffId,
        Carbon $deliveryDate,
        array $address
    ): OrderData {
        return new OrderDataImpl(0, $clientData->getID(), $tariffId, $deliveryDate, $address);
    }
}