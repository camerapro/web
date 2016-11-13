<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap\Modal;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\search\CompanySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Company';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="company-frontend-index">

    <h4><?php echo  Html::encode($this->title) ?></h4>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php
    Modal::begin([
        'toggleButton' => [
            'label' => '<i class="glyphicon glyphicon-plus"></i> Tạo mới',
            'class' => 'btn btn-success'
        ],
        'header' => '<span id="modalHeaderTitle">Thêm mới công ty</span>',
        'headerOptions' => ['id' => 'modalHeader'],
        'id' => 'modal',
        'closeButton' => [
            'label' => 'X',
            'class' => 'btn pull-right',
        ],
        'size' => '280',

    ]);
    $myModel = new \frontend\models\CompanyFrontend();
    echo $this->render('/company/create', ['model' => $myModel]);
    Modal::end();
    ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

           // 'id',
            'name',
            'contact_name',
            'address',
            'email:email',
             'phone',
            // 'city',
            // 'country',
            // 'status',
            // 'balance',
             'created_time',
             'expired_time',
            // 'updated_time',
             'website',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
