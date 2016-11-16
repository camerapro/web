<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\search\TimekeepingSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Báo cáo chấm công';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="timekeeping-frontend-index">

    <h4><?= Html::encode($this->title) ?></h4>
	<?php \yii\widgets\Pjax::begin(); ?>
    <?php  echo $this->render('_search', ['model' => $searchModel]); ?>
	
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
		
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'staff_name',
			 
			[
                'header' => 'Máy chấm công',
                'format' => 'raw',
                'options' => ['width' => '90px'],
                'headerOptions' => ['style'=>'text-align: center;'],
                'contentOptions'=>['style'=>'text-align: center; vertical-align:middle;'],
                'value' => function($data) {
                    return ($data) ?
                      $data->tat->name:null; 
                }
            ],
            'card_code',
			 'created_time',
           
            // 'type',
            
            // 'image:ntext',
			[
                'header' => 'Ảnh',
                'format' => 'raw',
                'options' => ['width' => '90px'],
                'headerOptions' => ['style'=>'text-align: center;'],
                'contentOptions'=>['style'=>'text-align: center; vertical-align:middle;'],
                'value' => function($data) {
                    return ($data->staff) ?
                       
                        Html::img(\common\components\Common::getImage($data->staff,'staff'),['width'=>'100%', 'title' => $data->staff->{'name'}]) : null;
                }
            ],
            //'staff_id',
			[
                'header' => 'Trạng thái',
                'format' => 'raw',
                'options' => ['width' => '20px'],
                'headerOptions' => ['style'=>'text-align: center;'],
                'contentOptions'=>['style'=>'text-align: center; vertical-align:middle;'],
                'value' => function($data) {
                    return ($data->status==1)?'Thành công': 'Thất bại';
                }
            ],
			'status',
 
        ],
    ]); ?>
	<?php \yii\widgets\Pjax::end(); ?>
</div>
