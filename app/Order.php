<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Order extends Model
{
    protected $casts = [
        'delivery_dt' => 'datetime',
    ];

    protected $with = ['partner', 'products'];

    public function partner(): BelongsTo
    {
        return $this->belongsTo(Partner::class);
    }

    public function products(): BelongsToMany
    {
        return $this
            ->belongsToMany(Product::class, 'order_products')
            ->withPivot('quantity', 'price');
    }
}
