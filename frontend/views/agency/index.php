<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap\Modal;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\search\AgencySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Đại lý';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="agency-index">

    <h1><?= Html::encode($this->title) ?></h1>
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
    $myModel = new \common\models\Agency();
    echo $this->render('/agency/create', ['model' => $myModel]);
    Modal::end();
    ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

           // 'id',
            'name',
            'address',
            'email:email',
            'phone',
            // 'city',
            // 'country',
            // 'status',
            // 'balance',
             'created_time',
            // 'updated_time',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
