<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

abstract class BaseModel extends Model
{

    // con mẹ nó dùng db::table sẽ bị tham chiếu lại query
    public static $instances = [];

    public static function &getInstance()
    {
        $cls = static::class;
        if (!isset(self::$instances[$cls])) {
            self::$instances[$cls] = new static();
        }
        return self::$instances[$cls];
    }

    public function dataDirty(): array
    {
        return [];
    }

    public static function getStatusActive(): int
    {
        return 1;
    }

    public static function getStatusInActive(): int
    {
        return 0;
    }

    public static function getStatusDeleted(): int
    {
        return -4;
    }

    protected static function getStatusDisabled(): int
    {
        return -1;
    }

    public function getOriginalStatus()
    {
        return $this->attributes['status'];
    }

    public function getStatusAttribute(): array
    {
        return self::getStatus($this->attributes['status'], true);
    }



    public function getCreatedAtAttribute(): string
    {

        if (isset($this->attributes['created_at']) && $this->attributes['created_at']) {
            return show_int_date($this->attributes['created_at'], 'd/m/Y');
        }
        return 'd/m/Y H:i:s';
    }

    public function getUpdatedAtAttribute(): string
    {
        if (isset($this->attributes['updated_at']) && $this->attributes['updated_at']) {
            return show_int_date($this->attributes['updated_at']);
        }
        return 'd/m/Y H:i:s';
    }

    static function listStatus($groupAction = true): array
    {
        return [
            self::getStatusActive() => [
                'id' => self::getStatusActive(),
                'style' => 'success',
                'icon' => 'ri-checkbox-circle-line',
                'name' => 'Hoạt động',
                'actions' => ($groupAction === true) ? [
                    self::getStatusInActive() => self::getStatus(self::getStatusInActive(), true, false),
                    self::getStatusDeleted() => self::getStatus(self::getStatusDeleted(), true, false),
                ] : []
            ],
            self::getStatusInActive() => [
                'id' => self::getStatusInActive(),
                'style' => 'secondary',
                'icon' => 'ri-alert-fill',
                'name' => 'Chờ duyệt',
                'actions' => ($groupAction === true) ? [
                    self::getStatusActive() => self::getStatus(self::getStatusActive(), true, false),
                    self::getStatusDeleted() => self::getStatus(self::getStatusDeleted(), true, false),
                ] : []
            ],
            self::getStatusDeleted() => [
                'id' => self::getStatusDeleted(),
                'style' => 'danger',
                'icon' => 'ri-delete-bin-6-line',
                'name' => 'Xoá',
                'actions' => ($groupAction === true) ? [
                    self::getStatusInActive() => self::getStatus(self::getStatusInActive(), true, false),
                    self::getStatusActive() => self::getStatus(self::getStatusActive(), true, false),
                ] : []
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

    public function scopeActive($query)
    {
        return $query->where('status', self::getStatusActive());
    }

    public function scopeInActive($query)
    {
        return $query->where('status', self::getStatusInActive());
    }

    public function scopeDeleted($query)
    {
        return $query->where('status', self::getStatusDeleted());
    }
}
