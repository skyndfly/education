<?php

namespace app\controllers;

use app\controllers\abstracts\BaseOwnerController;
use app\repositories\User\UserRepository;
use app\ui\gridTable\GridFactory;
use app\ui\gridTable\User\UserGridTable;

class UsersController extends BaseOwnerController
{
    private UserRepository $userRepository;
    public function __construct(
        $id,
        $module,
        UserRepository $userRepository,
        $config=[]
    )

    {
        parent::__construct($id, $module, $config);
        $this->userRepository = $userRepository;
    }

    public function actionIndex(): string
    {
        $grid = GridFactory::createGrid(
            $this->userRepository->getAll(),
            UserGridTable::class
        );
        return $this->render('index',[
            'grid' => $grid
        ]);
    }
}