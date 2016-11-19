<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\search\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Quản lý tài khoản';
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Tạo tài khoản', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
//            ['class' => 'yii\grid\SerialColumn'],

            'username',
//            'level',
             'fullname',
             'email:email',
             'phone',
            [
                'label'=>'Nhóm quyền',
                'format' => 'raw',
                'value' => function ($model) {
                    return \frontend\models\Level::findOne($model->level)->level_name;
                },
            ],
            [
                'label'=>'Phân quyền',
                'format' => 'raw',
                'value' => function ($model) {
                    $permission = \frontend\models\PermissionGroup::findOne($model->permission_group_id);
                        return isset($permission) ? $permission->name : '';
                },
            ],
            [
                'label'=>'Thời gian tạo',
                'format' => 'raw',
                'value' => function ($model) {
                    return date('H:i d/m/Y', strtotime($model->created_time));
                },
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
