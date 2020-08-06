<?php

namespace App\Src\Clients;

use App\Src\Clients\Interfaces\ClientData;
use App\Src\Clients\Interfaces\ClientDataRepository;
use App\Src\Clients\Models\Client;
use App\Src\Phones\Interfaces\Phone;
use App\Src\Phones\Interfaces\PhoneFactory;
use App\Src\Clients\Interfaces\ClientDataFactory;

class ClientDataDBRepository implements ClientDataRepository
{
    private $clientModel;
    private $phoneFactory;
    private $clientDataFactory;

    public function __construct(
        Client $clientModel,
        PhoneFactory $phoneFactory,
        ClientDataFactory $clientDataFactory
    )
    {
        $this->clientModel = $clientModel;
        $this->phoneFactory = $phoneFactory;
        $this->clientDataFactory = $clientDataFactory;
    }

    public function getByPhone(Phone $phone): ?ClientData
    {
        $client = $this->clientModel->where('phone', $phone->toString())->first();
        if (empty($client)) {
            return null;
        }

        return $this->makeClientData($client);
    }

    public function save(ClientData $client): ClientData
    {
        if ($client->getID() === 0) {
            $newModel = $this->clientModel->create([
                'phone' => $client->getPhone()->toString(),
                'name' => $client->getName(),
            ]);

            $client = $this->makeClientData($newModel);
        } else {
            $this->clientModel->where('phone', $client->getPhone()->toString())
                              ->update(['name' => $client->getName()]);
        }

        return $client;
    }

    private function makeClientData(Client $client): ClientData
    {
        return $this->clientDataFactory->make(
            $client->id,
            $this->phoneFactory->makeFromString($client->phone),
            $client->name
        );
    }
}