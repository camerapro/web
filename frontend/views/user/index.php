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
                'label'=>'Phân quyền quyền',
                'format' => 'raw',
                'value' => function ($model) {
                    $permission_gr = \frontend\models\RelationsUserPermissionGroup::findOne(['user_id'=>$model->id]);
                    if($permission_gr){
                        return \frontend\models\PermissionGroup::findOne(\frontend\models\RelationsUserPermissionGroup::findOne(['user_id'=>$model->id])->permission_group_id)->name;
                    }
                    return '';
                },
            ],
            [
                'label'=>'Thời gian tạo',
                'format' => 'raw',
                'value' => function ($model) {
                    return date('H:i d/m/Y', strtotime($model->created_time));
                },
            ],
            // 'birthday',
            // 'gender',
//             'address',
            // 'city',
            // 'country',
            // 'status',
            // 'facebook_id',
            // 'google_id',
            // 'created_time',
            // 'updated_time',
            // 'login_time',
            // 'language',
            // 'thumb_version',
            // 'avatar',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
