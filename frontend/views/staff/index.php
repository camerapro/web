<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap\Modal;


/* @var $this yii\web\View */
/* @var $searchModel frontend\models\search\StaffSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Quản lý nhân viên';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="staff-frontend-index">

    <h3><?= Html::encode($this->title) ?></h3>
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
    $myModel = new \frontend\models\StaffFrontend();
    echo $this->render('/staff/create', ['model' => $myModel]);
    Modal::end();
    ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'card_code',
            'card_id',
            'department',
            // 'image:ntext',
            // 'created_time',
            // 'created_by',
            // 'updated_time',
            // 'updated_by',
            // 'status',
            // 'description',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>