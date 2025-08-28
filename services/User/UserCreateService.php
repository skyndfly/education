<?php
declare(strict_types=1);

namespace app\services\User;

use app\repositories\User\dto\UserStoreDto;
use app\repositories\User\UserRepository;
use DateMalformedStringException;
use Yii;
use yii\db\Exception;

class UserCreateService
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @throws DateMalformedStringException
     * @throws Exception
     */
    public function execute(UserStoreDto $dto): void
    {
        try {
            $this->userRepository->store($dto);
            //TODO добавить лог таблицу для пользователей
        } catch (Exception $e) {
            Yii::error([
                'type' => 'UserCreateService',
                'message' => $e->getMessage(),
            ]);
            throw $e;
        }
    }

}