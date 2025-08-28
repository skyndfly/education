<?php

namespace app\repositories\User\dto;

class UserStoreDto
{
    public function __construct(
        public string $username,
        public string $password,
        public UserInfoDto $userInfo
    )
    {
    }
}