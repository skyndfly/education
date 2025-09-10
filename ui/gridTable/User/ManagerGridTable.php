<?php

namespace app\ui\gridTable\User;

use app\auth\dto\UserIdentityDto;
use app\ui\gridTable\AbstractGridTable;
use app\ui\gridTable\GridColumn;

class ManagerGridTable extends AbstractGridTable
{
    #[GridColumn('Логин')]
    public string $username;

    #[GridColumn('ФИО', formatter: 'fullName')]
    public string $name;

    #[GridColumn('Тип', formatter: 'typeValue')]
    public string $type;

    #[GridColumn('Дата создания', sortable: true)]
    public string $createdAt;

    #[GridColumn('ID', sortable: true)]
    public int $id;

    #[GridColumn('Действия', formatter: 'actionButtons')]
    public string $actions;

    public static function fullName(UserIdentityDto $model): string
    {
        return sprintf(
            '%s %s %s',
            $model->userInfoDto->firstName,
            $model->userInfoDto->name,
            $model->userInfoDto->lastName
        );
    }

    public static function typeValue(UserIdentityDto $model): string
    {
        return $model->type->value;
    }

    public static function actionButtons(UserIdentityDto $model): string
    {
        $id = $model->id;

        return sprintf(
            '<a href="/login-as-manager?id=%s" class="btn btn-sm btn-primary">Отследить</a>',
            $id
        );
    }
}