<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $guarded = [];

    protected $casts = [
        'gallery' => 'array',
        'tags' => 'array',
        'options' => 'array',
        'variants' => 'array',
        'published_at' => 'datetime',
        'has_variants' => 'boolean',
        'is_digital' => 'boolean',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function cartItem()
    {
        return $this->belongsTo(CartItem::class);
    }
}
