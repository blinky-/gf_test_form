<?php

namespace App\Src\Clients;

use App\Src\Clients\Interfaces\ClientDataRepository;
use App\Src\Phones\Interfaces\Phone;
use App\Src\Clients\Interfaces\ClientService as IClientService;
use App\Src\Clients\Interfaces\ClientData;
use App\Src\Clients\Interfaces\ClientDataFactory;

class ClientService implements IClientService
{
    private $clientFactory;
    private $clientRepository;

    public function __construct(
        ClientDataFactory $clientFactory,
        ClientDataRepository $clientRepository
    ) {
        $this->clientFactory = $clientFactory;
        $this->clientRepository = $clientRepository;
    }

    public function getOrCreateClientData(Phone $phone, string $name): ClientData {
        $clientData = $this->clientRepository->getByPhone($phone);
        if (empty($clientData)) {
            $clientData = $this->clientFactory->make(0, $phone, $name);
            $clientData = $this->clientRepository->save($clientData);
        } elseif ($clientData->getName() !== $name) {
            $clientData = $this->clientFactory->make($clientData->getID(), $phone, $name);
            $this->clientRepository->save($clientData);
        }

        return $clientData;
    }
}