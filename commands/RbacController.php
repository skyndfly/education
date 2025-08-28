<?php
declare(strict_types=1);

namespace app\commands;

use app\config\EnvRegistry;
use app\repositories\User\dto\UserInfoDto;
use app\repositories\User\dto\UserStoreDto;
use app\services\User\UserCreateService;
use yii\console\Controller;

class RbacController extends Controller
{
    private UserCreateService $userCreateService;

    public function __construct(
        $id,
        $module,
        UserCreateService $userCreateService,
        $config = []
    ) {
        parent::__construct($id, $module, $config);
        $this->userCreateService = $userCreateService;
    }

    public function actionInit(): void
    {
        $userInfo = new UserInfoDto(
            firstName: EnvRegistry::getOwnerFirstName(),
            name: EnvRegistry::getOwnerName(),
            lastName: EnvRegistry::getOwnerLastName(),
            birthDate: '27-11-1996',
            numberPhone: EnvRegistry::getOwnerPhoneNumber()
        );
        $userDto = new UserStoreDto(
            username: EnvRegistry::getOwnerLogin(),
            password: EnvRegistry::getOwnerPassword(),
            userInfo: $userInfo
        );
        $this->userCreateService->execute($userDto);
    }
}