<?php

namespace App\Src\Orders;

use App\Src\Orders\Interfaces\OrderDataRepository as IOrderDataRepository;
use App\Src\Orders\Interfaces\OrderData;
use App\Src\Orders\Models\Order;

class OrderDataDBRepository implements IOrderDataRepository
{
    private $orderModel;

    public function __construct(
        Order $orderModel
    ) {
        $this->orderModel = $orderModel;
    }

    /**
     * @param OrderData $order
     * @throws \Exception
     */
    public function save(OrderData $order) {
        if ($order->getID() === 0) {
            $this->orderModel->create([
                'client_id' => $order->getClientID(),
                'tariff_id' => $order->getTariffID(),
                'delivery_since' => $order->getFirstDeliveryDate(),
                'delivery_address' => $order->getDeliveryAddress(),
            ]);
        } else {
            throw new \Exception('Edit order is not implemented.');
        }
    }
}