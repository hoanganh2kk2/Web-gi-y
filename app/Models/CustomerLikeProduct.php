<?php

namespace App\Models;

class CustomerLikeProduct extends BaseModel
{
    protected $table = 'customer_like_product';
    protected $fillable = ['customer_id','product_id'];
    public $timestamps = false;

}