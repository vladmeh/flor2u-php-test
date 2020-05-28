<?php

namespace App\Http\Resources;

use App\Http\Resources\Partner as PartnerResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class Order extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'status' => $this->status,
            'client_email' => $this->client_email,
            'delivery_dt' => $this->delivery_dt,
            'partner' => PartnerResource::make($this->partner),
            'products' => OrderProductsCollection::make($this->products),
        ];
    }
}
