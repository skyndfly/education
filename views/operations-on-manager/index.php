<?php
/** @var ArrayDataProvider $dataProvider */
/** @var ManagerFilter $filterModel */

/** @var UserIdentityDto[] $model */


use app\auth\dto\UserIdentityDto;
use app\filters\User\ManagerFilter;
use yii\data\ArrayDataProvider;
use yii\grid\GridView;

$this->title = 'Менеджеры по продажам';
?>

<section>
    <h2>Менеджеры по продажам</h2>
    <a href="/operations-on-manager/create" class="btn btn-outline-success mb-2">Добавить менеджера</a>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            [
                'header' => 'Логин',
                'value' => function ($model) {
                    /** @var UserIdentityDto $model */
                    return $model->username;
                }
                ],
            [
                'attribute' => 'ФИО',
                'value' => function ($model) {
                    /** @var UserIdentityDto $model */
                    return sprintf(
                        '%s %s %s',
                        $model->userInfoDto->firstName,
                        $model->userInfoDto->name,
                        $model->userInfoDto->lastName
                    );
                }
            ],
            [
                'attribute' => 'Тип',
                'value' => function ($model) {
                    /** @var UserIdentityDto $model */
                    return $model->type->value;
                }
            ],
            [
                'attribute' => 'createdAt',
                'label' => 'Дата создания',
                'value' => function ($model) {
                    /** @var UserIdentityDto $model */
                    return $model->createdAt;
                }
            ],
            [
                'attribute' => 'id',
                'label' => 'ID',
                'value' => function ($model) {
                    /** @var UserIdentityDto $model */
                    return $model->id;
                }
            ]

        ]
    ]) ?>
    <?= $this->render('_search', ['model' => $filterModel]) ?>

</section>