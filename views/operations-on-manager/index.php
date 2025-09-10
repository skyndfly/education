<?php
/** @var ArrayDataProvider $dataProvider */
/** @var ManagerFilter $filterModel */

/** @var UserIdentityDto[] $model */


use app\auth\dto\UserIdentityDto;
use app\filters\User\ManagerFilter;
use app\ui\gridTable\User\ManagerGridTable;
use yii\data\ArrayDataProvider;
use yii\grid\GridView;

$this->title = 'Менеджеры по продажам';
?>

<section>
    <h2>Менеджеры по продажам</h2>
    <a href="/operations-on-manager/create" class="btn btn-outline-success mb-2">Добавить менеджера</a>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => ManagerGridTable::getColumns(),
    ]) ?>
    <?= $this->render('_search', ['model' => $filterModel]) ?>

</section>