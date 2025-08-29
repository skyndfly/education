<?php

namespace app\controllers;

use app\controllers\abstracts\BaseOwnerController;
use app\forms\Manager\CreateManagerForm;

class OperationsOnManagerController extends BaseOwnerController
{

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
    public function actionStore():string
    {
        echo "<pre>";
        print_r($_POST);
        echo "</pre>";
        die;

    }
}