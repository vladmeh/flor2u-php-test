<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $guarded = [];

    protected $with = ['vendor'];

    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }
}
