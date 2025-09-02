<?php

namespace app\controllers;

use app\controllers\abstracts\BaseOwnerController;
use app\forms\Manager\CreateManagerForm;
use app\services\User\UserCreateService;
use Exception;
use Yii;
use yii\web\Response;

class OperationsOnManagerController extends BaseOwnerController
{
    private UserCreateService $userCreateService;
    public function __construct(
        $id,
        $module,
        UserCreateService $userCreateService,
        $config = []
    )
    {
        parent::__construct($id, $module, $config);
        $this->userCreateService = $userCreateService;
    }

    public function actionIndex(): string
    {
        return $this->render('index');
    }

    public function actionCreate():string
    {
        $createForm = new CreateManagerForm();
        return $this->render('create', [
            'formModel' => $createForm,
        ]);
    }
    public function actionStore(): Response
    {
        try {
            $form = new CreateManagerForm();
            $post  = Yii::$app->request->post();
            if ($form->load($post) & $form->validate()){
                $this->userCreateService->execute($form->toDto());
            }
            Yii::$app->session->setFlash('success', 'Менеджер по продажам создан');
        }catch (Exception $e){
            Yii::$app->session->setFlash('error', $e->getMessage());
        }
        return $this->redirect(Yii::$app->request->getReferrer());
    }
}