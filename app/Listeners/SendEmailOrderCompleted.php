<?php

namespace App\Listeners;

use App\Events\OrderUpdated;
use App\Mail\OrderCompleted;
use Illuminate\Support\Facades\Mail;

class SendEmailOrderCompleted
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param OrderUpdated $event
     * @return void
     */
    public function handle(OrderUpdated $event)
    {
        if ($event->order->status == 20) {
            $vendors = $event->order->products->map(function ($product) {
                return $product->vendor->email;
            })->unique()->toArray();

            Mail::to($event->order->partner->email)
                ->cc($vendors)
                ->send(new OrderCompleted($event->order));
        }

    }
}
