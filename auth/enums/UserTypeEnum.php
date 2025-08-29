<?php

namespace app\auth\enums;

enum UserTypeEnum: string
{
    case OWNER = 'owner';
    case MANGER = 'manager';
}
