<?php

namespace App\Models;

class CartItem extends BaseModel
{
    protected $table = 'cart_item';
    public $timestamps = false;

    function color(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Category::class, 'id', 'color_id');
    }
    function size(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Category::class, 'id', 'size_id');
    }
}