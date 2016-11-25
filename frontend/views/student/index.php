<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap\Modal;
/* @var $this yii\web\View */
/* @var $searchModel frontend\models\search\StudentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Danh sách học viên';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="student-frontend-index">

    <h4><?= Html::encode($this->title) ?></h4>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php
    Modal::begin([
        'toggleButton' => [
            'label' => '<i class="glyphicon glyphicon-plus"></i> Tạo mới',
            'class' => 'btn btn-success'
        ],
        'header' => '<span id="modalHeaderTitle">Thêm mới học viên</span>',
        'headerOptions' => ['id' => 'modalHeader'],
        'id' => 'modal',
        'closeButton' => [
            'label' => 'x',
            'class' => 'btn pull-right',
        ],
        'size' => '300',

    ]);
    $myModel = new \frontend\models\StudentFrontend();
    echo $this->render('/student/create', ['model' => $myModel]);
    Modal::end();
    ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'phone',
            'card_code',
            'card_id',
            // 'class_id',
            // 'class_name',
            // 'image:ntext',
            // 'created_time',
            // 'created_by',
            // 'updated_time',
            // 'updated_by',
            // 'status',
            // 'description',
            // 'company_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
