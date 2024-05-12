<?php


namespace App\Models;


class City extends BaseModel
{
    public $timestamps = false;

    protected $table = '__cities';


    function parent(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Category::class, 'id', 'parent_id');
    }
}