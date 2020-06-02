<?php

namespace App\Http\Controllers;

use App\Events\OrderUpdated;
use App\Http\Requests\OrderUpdateRequest;
use App\Http\Resources\Order as OrderResource;
use App\Http\Resources\OrderCollection;
use App\Order;
use Illuminate\Http\JsonResponse;

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
     * @param OrderUpdateRequest $request
     * @param Order $order
     * @return JsonResponse
     */
    public function update(OrderUpdateRequest $request, Order $order)
    {
        $order->update($request->validated());

        event(new OrderUpdated($order));

        return response()->json(['message' => 'Заказ № ' . $order->id . ' успешно обновлен']);
    }
}
