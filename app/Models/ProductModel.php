<?php

namespace App\Models;

class ProductModel extends BaseModel
{
    protected $table = 'products';
    public $timestamps = false;

    function category(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Category::class, 'id', 'category_id');
    }

    function like(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->HasMany(CustomerLikeProduct::class, 'product_id', 'id');
    }

    function user_like(): \Illuminate\Database\Eloquent\Relations\Hasone
    {
        return $this->Hasone(CustomerLikeProduct::class, 'product_id', 'id')->where('customer_id', auth()->id());
    }

    public function getSeoAttribute()
    {
        if (isset($this->attributes['seo']) && $this->attributes['seo']) {
            return json_decode($this->attributes['seo']);
        }
    }

    const TYPE_DRAFT = 0;
    const TYPE_OFFICIAL = 1;

    static function get_type_draft(): int
    {
        return self::TYPE_DRAFT;
    }

    static function get_type_official(): int
    {
        return self::TYPE_OFFICIAL;
    }

    public function getTypeAttribute()
    {
        if (isset($this->attributes['type']) && $this->attributes['type']) {
            return $this->getType($this->attributes['type'], true);
        }
    }

    static function listType($groupAction = true): array
    {
        return [
            self::get_type_draft() => [
                'id' => self::get_type_draft(),
                'style' => 'secondary',
                'icon' => 'ri-checkbox-circle-line',
                'name' => 'Bản nháp',
            ],
            self::get_type_official() => [
                'id' => self::get_type_official(),
                'style' => 'success',
                'icon' => 'ri-alert-fill',
                'name' => 'Bản chính thức',
            ],
        ];
    }

    static function getType($selected = false, $return = false, $groupAction = true): array
    {
        $listType = self::listType($groupAction);
        if ($selected !== false && isset($listType[$selected])) {
            $listType[$selected]['checked'] = 'checked';
            if ($return) {
                return $listType[$selected];
            }
        }

        if ($return) {
            return [
                'id' => -13, 'style' => 'danger',
                'icon' => 'mdi mdi-trash-can-outline',
                'name' => '---',
                'actions' => []
            ];
        }
        return $listType;
    }

    function scopeTypeOfficial($query) {
        return $query->where('type', self::get_type_official());
    }

}