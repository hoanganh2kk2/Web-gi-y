<?php

namespace App\Models;

class Menu extends BaseModel
{
    protected $table = 'menu';
    public $timestamps = false;

    const menu_header = 1;
    const menu_footer = 2;

    const category_post = 1;
    const category_product = 2;
    const static_page= 3;


    static function getMenuHeader(): int
    {
        return self::menu_header;
    }

    static function getMenuFooter(): int
    {
        return self::menu_footer;
    }


    static function getCategoryPost(): int
    {
        return self::category_post;
    }

    static function getCategoryProduct(): int
    {
        return self::category_product;
    }

    static function getStaticPage(): int
    {
        return self::static_page;
    }

    static function listType($groupAction = true): array
    {
        return [
            self::getMenuHeader() => [
                'id' => self::getMenuHeader(),
                'style' => 'success',
                'icon' => 'ri-checkbox-circle-line',
                'name' => 'Menu Header',
            ],
            self::getMenuFooter() => [
                'id' => self::getMenuFooter(),
                'style' => 'secondary',
                'icon' => 'ri-alert-fill',
                'name' => 'Menu Footer',
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


    static function listApply($groupAction = true): array
    {
        return [
            self::getCategoryPost() => [
                'id' => self::getCategoryPost(),
                'style' => 'success',
                'icon' => 'ri-checkbox-circle-line',
                'name' => 'Danh mục tin tức',
            ],
            self::getCategoryProduct() => [
                'id' => self::getCategoryProduct(),
                'style' => 'secondary',
                'icon' => 'ri-alert-fill',
                'name' => 'Danh mục sản phẩm',
            ],
            self::getStaticPage() => [
                'id' => self::getStaticPage(),
                'style' => 'secondary',
                'icon' => 'ri-alert-fill',
                'name' => 'Trang tĩnh',
            ],
        ];
    }

    static function getApply($selected = false, $return = false, $groupAction = true): array
    {
        $listApply = self::listApply($groupAction);
        if ($selected !== false && isset($listApply[$selected])) {
            $listApply[$selected]['checked'] = 'checked';
            if ($return) {
                return $listApply[$selected];
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
        return $listApply;
    }

    function parent(): \Illuminate\Database\Eloquent\Relations\hasMany
    {
        return $this->hasMany(Menu::class, 'id', 'parent_id');
    }

    function apply_rele(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Category::class, 'id', 'apply_detail');
    }

    function post_static(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Statics::class, 'id', 'post_static_id');
    }
}