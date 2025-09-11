<?php

namespace app\ui\gridTable\User;

use app\auth\dto\UserIdentityDto;
use app\ui\gridTable\AbstractGridTable;
use app\ui\gridTable\GridColumn;

class UserGridTable extends AbstractGridTable
{
    #[GridColumn(label: 'Имя пользователя')]
    public string $username;

    #[GridColumn(label: 'Имя пользователя', formatter: 'idFormatter', sortable: true)]
    public string $id;

    public static function idFormatter(UserIdentityDto $dto)
    {
        return '#'.$dto->id;
    }
}