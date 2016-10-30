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
