<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap\Modal;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\search\TatSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Quản lý máy chấm công';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tat-frontend-index">

    <h4><?= Html::encode($this->title) ?></h4>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>


    <?php
    Modal::begin([
        'toggleButton' => [
            'label' => '<i class="glyphicon glyphicon-plus"></i> Tạo mới',
            'class' => 'btn btn-success'
        ],
        'header' => '<span id="modalHeaderTitle">Thêm mới nhân viên</span>',
        'headerOptions' => ['id' => 'modalHeader'],
        'id' => 'modal',
        'closeButton' => [
            'label' => 'x',
            'class' => 'btn pull-right',
        ],
        'size' => '300',

    ]);
    $myModel = new \frontend\models\TatFrontend();
    echo $this->render('/tat/create', ['model' => $myModel]);
    Modal::end();
    ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

           // 'id',
            'name',
           // 'category_id',
            'ip',
            'port',
            // 'protocol',
             'created_time',
            // 'updated_time',
            // 'description',
            // 'order',
            // 'camera_main_id',
            // 'camera_secondary_id',
            // 'user_id',
            // 'agency_id',
            // 'status',
             'camera_ip',
             'camera_port',
             'camera_channel',
            // 'camera_username',
            // 'camera_password',
            // 'camera_model',
            // 'expired_time',
            // 'company',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
