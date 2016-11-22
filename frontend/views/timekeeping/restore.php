<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap\ButtonGroup;
use yii\widgets\Pjax;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\search\TimekeepingSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Khôi phục dữ liệu chấm công';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="timekeeping-frontend-index">

    <h4><?= Html::encode($this->title) ?></h4>
	<?php \yii\widgets\Pjax::begin(); ?>
    <?php  echo $this->render('_search_restore', ['model' => $searchModel]); ?>
	
	<div class ="action-restore">
	
	<span class="btn-restore-confirm"><img src="/images/btn-restore.png"  width="80"></span>
		</div>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
		
        'columns' => [
             ['class' => 'yii\grid\CheckboxColumn'],

            //'id',
            'staff_name',
			 [
                'header' => 'Điện thoại',
                'format' => 'raw',
                'options' => ['width' => '20px'],
                'headerOptions' => ['style'=>'text-align: center;'],
                'contentOptions'=>['style'=>'text-align: center; vertical-align:middle;'],
                'value' => function($data) {
					
                    return "09047933668";
                }
            ],
			
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
            [
                'header' => 'Phòng',
                'format' => 'raw',
                'options' => ['width' => '100px'],
                'headerOptions' => ['style'=>'text-align: center;'],
                'contentOptions'=>['style'=>'text-align: center; vertical-align:middle;'],
                'value' => function($data) {
                    return ($data->staff) ?$data->staff->{'department_id'} : null;
                }
            ],
			 'created_time',
           
             'type',
            [
                'header' => 'Trạng thái',
                'format' => 'raw',
                'options' => ['width' => '20px'],
                'headerOptions' => ['style'=>'text-align: center;'],
                'contentOptions'=>['style'=>'text-align: center; vertical-align:middle;'],
                'value' => function($data) {
					if($data->status ==1 )
					$status ='Đúng';
					if($data->status ==0 )
					$status ='Chưa xác nhận';
					if($data->status ==3 )
					$status ='Sai';
                    return $status;
                }
            ],
			
            // 'image:ntext',
			[
                'header' => 'Ảnh camera',
                'format' => 'raw',
                'options' => ['width' => '100px'],
                'headerOptions' => ['style'=>'text-align: center;'],
                'contentOptions'=>['style'=>'text-align: center; vertical-align:middle;'],
                'value' => function($data) {
                    return ($data->staff) ?
                       
                        Html::img(\common\components\Common::getImage($data->staff,'staff'),['width'=>'100%', 'title' => $data->staff->{'name'}]) : null;
                }
            ],
			[
                'header' => 'Ảnh gốc',
                'format' => 'raw',
                'options' => ['width' => '100px'],
                'headerOptions' => ['style'=>'text-align: center;'],
                'contentOptions'=>['style'=>'text-align: center; vertical-align:middle;'],
                'value' => function($data) {
                    return ($data->staff) ?
                       
                        Html::img(\common\components\Common::getImage($data->staff,'staff'),['width'=>'100%', 'title' => $data->staff->{'name'}]) : null;
                }
            ],
			
            //'staff_id',
			
 
        ],
    ]); ?>
	<?php \yii\widgets\Pjax::end(); ?>
</div>
<script>
		$('.btn-restore-confirm').click(function(){
		
		var status = 0;
		var ids = [];
        $("input[type=checkbox]:checked").each ( function() {
            ids.push($(this).val());
        });
        $.ajax({
            url: '/timekeeping/restore-confirm',
            type: "POST",
            data: {
                'ids':ids,'_csrf':YII_CSRF_TOKEN,'status':status
            } ,
            success: function (response) {
                data_res = JSON.parse(response);
                if(data_res['error'] == 0){
                    alert(data_res['message']);
                    window.location.reload();
                }else{
                    alert(data_res['message']);
                }
            },
        });

    });
</script>
