<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap\ButtonGroup;
use yii\widgets\Pjax;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\TimeP;

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
	<div class ="action-timekeeping">
	
		<?php $form = ActiveForm::begin() ?>
			<span class="text-edit-manual">Sửa thông tin thủ công :  </span>
			<?= $form->field($searchModel, 'status')->inline()->hint('')->radioList(['1'=>'Đúng', '0'=>'Sai'])->label(false); ?>
			<span class="btn-edit-manual-confirm"><img src="/images/btn-edit-confirm.png" width="60"></span>
		<?php ActiveForm::end(); ?>
		
	

	
	</div>
	<div class ="action-timekeeping-auto">
	
		<?php $form = ActiveForm::begin() ?>
			<span class="text-edit-manual">Sửa tự động  </span>
			<span class="btn-edit-confirm"><img src="/images/btn-edit-confirm.png" width="60"></span>
		<?php ActiveForm::end(); ?>
		
	

	
	</div>
	<span class="btn-del-confirm"><img src="/images/btn-del-confirm.png"  width="65"></span>
	<span class="btn-export-confirm"><img src="/images/btn-export-file.png"  width="65"></span>
		
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
		
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],
            ['class' => 'yii\grid\CheckboxColumn'],
			[
                'header' => 'Tên nhân viên',
                'format' => 'raw',
                'options' => ['width' => '20px'],
                'headerOptions' => ['style'=>'text-align: center;'],
                'contentOptions'=>['style'=>'text-align: center; vertical-align:middle;'],
                'value' => function($data) {
	
                    return isset($data->staff) ?$data->staff->name : null;
   
                }
             ],
			 [
                'header' => 'Điện thoại',
                'format' => 'raw',
                'options' => ['width' => '20px'],
                'headerOptions' => ['style'=>'text-align: center;'],
                'contentOptions'=>['style'=>'text-align: center; vertical-align:middle;'],
                'value' => function($data) {
	
                    return isset($data->staff) ?$data->staff->phone : null;
   
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
            ['attribute' => 'department_id',
                'format' => 'raw',
                'filter' =>  yii\helpers\ArrayHelper::map(\frontend\models\DepartmentFrontend::findAll(['status' => 1]), 'id', 'name'),
                'options' => ['width' => '90px'],
                'value' => function ($data) {
                    $dep = \frontend\models\DepartmentFrontend::find()->where(['id' => $data->staff->department_id])->one();
                    if (!empty($dep)) {
                        return $dep->name;
                    }
                },
                'headerOptions' => ['style' => 'text-align: center; vertical-align: middle;'],
                'contentOptions' => ['style' => 'text-align: center; vertical-align: middle;']
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
                    return ($data->id) ?Html::img(\common\components\Common::getImage($data,'timekeeping'),['width'=>'100%']) : null;
                }
            ],
			[
                'header' => 'Ảnh gốc',
                'format' => 'raw',
                'options' => ['width' => '100px'],
                'headerOptions' => ['style'=>'text-align: center;'],
                'contentOptions'=>['style'=>'text-align: center; vertical-align:middle;'],
                'value' => function($data) {
                    return ($data->staff) ?Html::img(\common\components\Common::getImage($data->staff,'staff'),['width'=>'100%', 'title' => $data->staff->{'name'}]) : null;
                }
            ],
			
            //'staff_id',
			
 
        ],
    ]); ?>
	<?php \yii\widgets\Pjax::end(); ?>
</div>
<script>
    $('#from_time').daterangepicker({
        singleDatePicker: true,
        calender_style: "picker_4",
        locale: {
            format: 'DD-MM-YYYY'
        },
    }, function(start, end, label) {
        console.log(start.toISOString(), end.toISOString(), label);
    });
	$('#to_time').daterangepicker({
        singleDatePicker: true,
        calender_style: "picker_4",
        locale: {
            format: 'DD-MM-YYYY'
        },
    }, function(start, end, label) {
        console.log(start.toISOString(), end.toISOString(), label);
    });
</script>
<script>
    $('.btn-edit-manual-confirm').click(function(){
		var check = $('#timekeepingsearch-status input').is(':checked');
		if(!check){
			alert('Chọn thuộc tính cần xử lý');
			return false;
		}
		var status = $('#timekeepingsearch-status').find('input[type="radio"]:checked').val();
        var ids = [];
        $("input[type=checkbox]:checked").each ( function() {
            ids.push($(this).val());
        });
        $.ajax({
            url: '/timekeeping/manual-confirm',
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
	$('.btn-edit-confirm').click(function(){
		
		var status = 1;
		var ids = [];
        $("input[type=checkbox]:checked").each ( function() {
            ids.push($(this).val());
        });
        $.ajax({
            url: '/timekeeping/auto-confirm',
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
		$('.btn-del-confirm').click(function(){
		var check = $('#timekeepingsearch-status input').is(':checked');
		var status = 1;
		var ids = [];
        $("input[type=checkbox]:checked").each ( function() {
            ids.push($(this).val());
        });
        $.ajax({
            url: '/timekeeping/delete-multi',
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
