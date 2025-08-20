<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Coupon extends Model
{
    protected $guarded = [];

    protected function order()
    {
        return $this->BelongsTo(Order::class);
    }
}
