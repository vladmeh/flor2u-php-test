@component('mail::message')
# Заказ № {{ $order->id }}, завершен!

Состав заказа.

@component('mail::table')
| Продукт  | Количество | Цена за шт. |
| -------- | ---------- | ----------- |
@foreach($order->products as $product)
| {{ $product->name }} | {{ $product->pivot->quantity }} шт. | {{ $product->price }} руб. |
@endforeach
@endcomponent

Стоимость заказа: {{ $order->products->map(function ($item) {
    return $item->price * $item->pivot->quantity;
})->reduce(function ($a, $b){
    return $a + $b;
}, 0) }} руб.

Спасибо,<br>
{{ config('app.name') }}
@endcomponent
