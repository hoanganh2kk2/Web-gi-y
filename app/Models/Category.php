<?php

namespace App\Models;


class Category extends BaseModel
{
    public $timestamps = false;
    protected $table = 'categories';

    const TYPE_PRODUCT = 2;
    const TYPE_TAG = 1;
    const TYPE_SIZE = 3;
    const TYPE_COLOR = 4;


    function parent(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Category::class, 'id', 'parent_id');
    }

    public function getTypeAttribute()
    {
        if (isset($this->attributes['type']) && $this->attributes['type']) {
            return $this->getType($this->attributes['type'], true);
        }
    }


    static function get_type_product(): int
    {
        return self::TYPE_PRODUCT;
    }
    static function get_type_tag(): int
    {
        return self::TYPE_TAG;
    }
    static function get_type_size(): int
    {
        return self::TYPE_SIZE;
    }
    static function get_type_color(): int
    {
        return self::TYPE_COLOR;
    }


    static function listType($groupAction = true): array
    {
        return [
            self::get_type_product() => [
                'id' => self::get_type_product(),
                'style' => 'secondary',
                'icon' => 'ri-alert-fill',
                'name' => 'Sản phẩm',
            ],
            self::get_type_tag() => [
                'id' => self::get_type_tag(),
                'style' => 'secondary',
                'icon' => 'ri-alert-fill',
                'name' => 'Tag',
            ],
            self::get_type_size() => [
                'id' => self::get_type_size(),
                'style' => 'secondary',
                'icon' => 'ri-alert-fill',
                'name' => 'Kích thước',
            ],
            self::get_type_color() => [
                'id' => self::get_type_color(),
                'style' => 'secondary',
                'icon' => 'ri-alert-fill',
                'name' => 'Màu sắc',
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

    function scopeTypeProduct($query) {
        return $query->where('type', self::get_type_product());
    }
}