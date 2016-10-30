<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\search\PermissionGroupSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Danh sách quyền';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="permission-group-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Tạo mới', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
//        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
//            'id',
            'name',
//            'permission_ids:ntext',
            [
                'label'=>'Danh sách quyền',
                'format' => 'raw',
//                'value' => \frontend\models\Permission::getPermissionName($model->permission_ids),
                'value' => function ($model) {
                    return \frontend\models\Permission::getPermissionName($model->permission_ids);
                },
            ],
            'created_time',
            'status',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
