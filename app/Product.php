<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $with = ['vendor'];

    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }
}
