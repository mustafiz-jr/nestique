<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    protected $guarded = [];

    protected function coupons(): HasMany
    {
        return $this->hasMany(Order::class);
    }
}
