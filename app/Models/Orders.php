<?php

namespace App\Models;

class Orders extends BaseModel
{
    protected $table = 'orders';
    public $timestamps = false;


    function order_item(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(self::class, 'id', 'order_id');
    }

    function city(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(City::class, 'id', 'city_id');
    }

    function districts(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Districts::class, 'id', 'district_id');
    }

    function ward(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Wards::class, 'id', 'ward_id');
    }

    public function getStatusAttribute(): array
    {
        return self::getStatus($this->attributes['status'], true);
    }

    static function listStatus($groupAction = true): array
    {
        return [
            self::getStatusPending() => [
                'id' => self::getStatusPending(),
                'style' => 'warning',
                'icon' => 'ri-checkbox-circle-line',
                'name' => 'Xác nhận đơn',
                'actions' => ($groupAction === true) ? [
                    self::getStatusDelivery() => self::getStatus(self::getStatusDelivery(), true, false),
                    self::getStatusCancel() => self::getStatus(self::getStatusCancel(), true, false),
                ] : []
            ],
            self::getStatusDelivery() => [
                'id' => self::getStatusDelivery(),
                'style' => 'secondary',
                'icon' => 'ri-truck-line',
                'name' => 'Đang giao hàng',
                'actions' => ($groupAction === true) ? [
                    self::getStatusDelivered() => self::getStatus(self::getStatusDelivered(), true, false),
                    self::getStatusCancel() => self::getStatus(self::getStatusCancel(), true, false),
                ] : []
            ],
            self::getStatusDelivered() => [
                'id' => self::getStatusDelivered(),
                'style' => 'success',
                'icon' => 'ri-arrow-left-right-fill',
                'name' => 'Đã giao hàng',
                'actions' => []
            ],
            self::getStatusCancel() => [
                'id' => self::getStatusCancel(),
                'style' => 'danger',
                'icon' => 'ri-close-circle-line',
                'name' => 'Huỷ đơn',
                'actions' => []
            ],
        ];
    }

    static function getStatus($selected = false, $return = false, $groupAction = true): array
    {
        $listStatus = self::listStatus($groupAction);
        if ($selected !== false && isset($listStatus[$selected])) {
            $listStatus[$selected]['checked'] = 'checked';
            if ($return) {
                return $listStatus[$selected];
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
        return $listStatus;
    }


    public static function getStatusPending(): int
    {
        return 1;
    }

    public static function getStatusDelivery(): int
    {
        return 5;
    }

    public static function getStatusDelivered(): int
    {
        return 12;
    }

    public static function getStatusCancel(): int
    {
        return -4;
    }

}