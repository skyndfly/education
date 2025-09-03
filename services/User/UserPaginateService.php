<?php

namespace app\services\User;

use app\repositories\User\dto\UserSearchDto;
use app\repositories\User\UserRepository;
use yii\data\ArrayDataProvider;

class UserPaginateService
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function execute(UserSearchDto $dto): ArrayDataProvider {
        return new ArrayDataProvider([
            'allModels' => $this->userRepository->getAllAndSearch($dto),
            'pagination' => [
                'pageSize' => 20,
            ],
            'sort' => [
                'attributes' => [
                    'id',
                    'createdAt',
                ],
                'defaultOrder' => [
                    'id' => SORT_DESC,
                ]
            ]
        ]);

    }
}