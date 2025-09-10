<?php

namespace app\ui\gridTable\User;

use app\auth\dto\UserIdentityDto;
use app\ui\gridTable\ColumnDto;

class ManagerGridTable
{
    public const string USERNAME = 'username';
    public const string FIO = 'name';
    public const string TYPE = 'type';
    public const string CREATED_AT = 'createdAt';
    public const string ID = 'id';

    public static function get(string $column): array
    {
        return match ($column) {
            self::USERNAME => new ColumnDto(
                attribute: self::USERNAME,
                label: 'Логин',
                callback: function (UserIdentityDto $model) {
                    return $model->username;
                }
            )->toArray(),
            self::FIO => new ColumnDto(
                attribute: self::FIO,
                label: 'ФИО',
                callback: function (UserIdentityDto $model) {
                    return sprintf(
                        '%s %s %s',
                        $model->userInfoDto->firstName,
                        $model->userInfoDto->name,
                        $model->userInfoDto->lastName
                    );
                }
            )->toArray(),
            self::TYPE => new ColumnDto(
                attribute: self::TYPE,
                label: 'Тип',
                callback: function (UserIdentityDto $model) {
                    return $model->type->value;
                }
            )->toArray(),
            self::CREATED_AT => new ColumnDto(
                attribute: self::CREATED_AT,
                label: 'Дата создания',
                callback: function (UserIdentityDto $model) {
                    return $model->createdAt;
                }
            )->toArray(),
            self::ID => new ColumnDto(
                attribute: self::ID,
                label: 'ID',
                callback: function (UserIdentityDto $model) {
                    return $model->id;
                }
            )->toArray(),
        };
    }

    public static function getColumns(): array
    {
        return [
          self::get(self::USERNAME),
          self::get(self::FIO),
          self::get(self::TYPE),
          self::get(self::CREATED_AT),
          self::get(self::ID),
        ];
    }
}