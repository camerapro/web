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

            //'id',
            'name',
            'card_code',
            'card_id',
            'department',
            [
                'header' => 'Hình ảnh',
                'format' => 'raw',
                'options' => ['width' => '90px'],
                'headerOptions' => ['style'=>'text-align: center;'],
                'contentOptions'=>['style'=>'text-align: center; vertical-align:middle;'],
                'value' => function($data) {
                    return ($data) ?
                        '<a href="'.\yii\helpers\Url::toRoute(['staff/update', 'id' => $data->id]).'">'.
                        Html::img(\common\components\Common::getImage($data,'staff'),['width'=>'100%', 'title' => $data->{'name'}]).'</a>' : null;
                }
            ],
			 ['attribute' => 'company_id',
                'format' => 'raw',
                'filter' =>  yii\helpers\ArrayHelper::map(\frontend\models\CompanyFrontend::findAll(['status' => 1]), 'id', 'name'),
                'options' => ['width' => '90px'],
                'value' => function ($data) {
                   $company = \frontend\models\CompanyFrontend::find()->where(['id' => $data->company_id])->one();
                    if (!empty($company)) {
                        return $company->name;
                    }
                },
                'headerOptions' => ['style' => 'text-align: center; vertical-align: middle;'],
                'contentOptions' => ['style' => 'text-align: center; vertical-align: middle;']
            ],
		
			
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
