<?php


namespace App\Models;


use App\Http\Enum\LogEnum;

class Log extends BaseModel
{
    protected $table = '_log';


    public function getCreatedByAttribute()
    {
        if (isset($this->attributes['created_by']) && $this->attributes['created_by']) {
            return json_decode($this->attributes['created_by']);
        }
    }

    public function getTypeAttribute()
    {
        if (isset($this->attributes['type']) && $this->attributes['type']) {
            return $this->getStatus($this->attributes['type'], true);
        }
    }

    public function getBeforeAttribute()
    {
        if (isset($this->attributes['before']) && $this->attributes['before']) {
            return json_decode($this->attributes['before']);
        }
    }

    public function getAfterAttribute()
    {
        if (isset($this->attributes['after']) && $this->attributes['after']) {
            return json_decode($this->attributes['after']);
        }
    }


    static function getTypeLogin(): string
    {
        return LogEnum::LOGIN;
    }

    static function getTypeCreated(): string
    {
        return LogEnum::CREATED;
    }

    static function getTypeUpdate(): string
    {
        return LogEnum::UPDATED;
    }

    static function getTypeDeleted(): string
    {
        return LogEnum::DELETED;
    }
    static function getTypeRestore(): string
    {
        return LogEnum::RESTORE;
    }

    static function listStatus($groupAction = true): array
    {
        return [
            self::getTypeLogin() => [
                'id' => self::getTypeLogin(),
                'style' => 'success',
                'icon' => 'ri-checkbox-circle-line',
                'name' => 'đăng nhập hệ thống',
            ],
            self::getTypeCreated() => [
                'id' => self::getTypeCreated(),
                'style' => 'success',
                'icon' => 'ri-checkbox-circle-line',
                'name' => 'thêm mới',
            ],
            self::getTypeUpdate() => [
                'id' => self::getTypeUpdate(),
                'style' => 'secondary',
                'icon' => 'ri-alert-fill',
                'name' => 'cập nhật',
            ],
            self::getTypeDeleted() => [
                'id' => self::getTypeDeleted(),
                'style' => 'danger',
                'icon' => 'ri-delete-bin-6-line',
                'name' => 'xoá',
            ],
            self::getTypeRestore() => [
                'id' => self::getTypeRestore(),
                'style' => 'danger',
                'icon' => 'ri-delete-bin-6-line',
                'name' => 'khôi phục',
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
}
