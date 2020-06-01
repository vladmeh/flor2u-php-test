<?php

namespace App\Http\Controllers;

use App\Http\Resources\Order as OrderResource;
use App\Http\Resources\OrderCollection;
use App\Order;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return OrderCollection
     */
    public function index()
    {
        return new OrderCollection(Order::paginate(25));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param Order $order
     * @return OrderResource
     */
    public function edit(Order $order)
    {
        return new OrderResource($order);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Order $order
     * @return JsonResponse
     * @throws ValidationException
     */
    public function update(Request $request, Order $order)
    {
        $attributes = $this->validate($request, [
            'client_email' => 'required|email',
            'partner_id' => 'required',
            'status' => 'required|numeric|in:0,10,20'
        ], [
            'required' => 'поле :attribute не должно быть пустым',
            'email' => 'Некорректный email адрес',
        ], [
            'client_email' => 'Клиент',
            'partner_id' => 'Партнер',
            'status' => 'Статус'
        ]);

        $order->update($attributes);

        return response()->json(['message' => 'Заказ успешно обновлен']);
    }
}
