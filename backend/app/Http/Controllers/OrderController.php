<?php

namespace App\Http\Controllers;

use App\Src\Orders\Exceptions\AbstractDeliveryDateException;
use App\Src\Orders\Interfaces\SubmitOrderService;
use App\Src\Phones\Exceptions\IncorrectPhoneException;
use App\Src\Phones\Interfaces\PhoneFactory;
use App\Src\Tariffs\Exceptions\TariffNotFoundException;
use Carbon\Carbon;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    private $phoneFactory;
    private $submitOrderService;

    public function __construct(
        PhoneFactory $phoneFactory,
        SubmitOrderService $submitOrderService
    ) {
        $this->phoneFactory = $phoneFactory;
        $this->submitOrderService = $submitOrderService;
    }

    public function store(Request $request) {
        $request->validate([
            'client.phone' => 'required|min:7|max:20',
            'client.name' => 'required|min:2|max:32',
            'order.tariff_id' => 'required',
            'order.date' => 'required|date',
            'order.address.street' => 'required'
        ]);

        try {
            $phone = $this->phoneFactory->makeFromString($request->input('client.phone'));
            $name = $request->input('client.name');
            $tariffId = (int)$request->input('order.tariff_id');
            $deliveryDate = Carbon::parse($request->input('order.date'));
            $deliveryAddress = $request->input('order.address');

            $this->submitOrderService->submit($phone, $name, $tariffId, $deliveryDate, $deliveryAddress);

            return response()->json(null, 200);

        } catch (TariffNotFoundException $e) {
            return $this->errorResponse('order.tariff_id', $e);
        } catch (AbstractDeliveryDateException $e) {
            return $this->errorResponse('order.date', $e);
        } catch (IncorrectPhoneException $e) {
            return $this->errorResponse('client.phone', $e);
        } catch (\Exception $e) {
            return $this->errorResponse('unknown', $e);
        }
    }

    private function errorResponse(string $field, \Exception $e) {
        return response()->json([
            'errors' => [
                $field => [$e->getMessage()],
            ],
        ], 400);
    }
}