<?php

use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use yii\bootstrap\ActiveForm;
use kartik\daterange\DateRangePicker;

/* @var $this yii\web\View */
/* @var $model frontend\models\search\TimekeepingSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="timekeeping-frontend-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
		'layout' => 'horizontal',
        'method' => 'get',
    ]); ?>

   

    <?php // echo $form->field($model, 'type')' ?>
     <?php
		//echo $form->field($model, 'status')->dropDownList(['1' => 'Thành công', '0' => 'Thất bại', '' => 'Tất cả']);
    ?>

	<?php echo $form->field($model,'from_time')->textInput(['value' =>isset($_GET['TimekeepingSearch']['from_time'])?$_GET['TimekeepingSearch']['from_time']:date('00:00 d-m-Y',time()-86400),'id'=>'from_time'])->label('Từ ngày'); ?>
	<?php echo $form->field($model,'to_time')->textInput(['value' => isset($_GET['TimekeepingSearch']['to_time'])?$_GET['TimekeepingSearch']['to_time']:date('23:59 d-m-Y'),'id'=>'to_time'])->label('Đến ngày'); ?>

    <?php // echo $form->field($model, 'image') ?>

    <?php // echo $form->field($model, 'staff_id') ?>

    <div class="form-group">
        <?= Html::submitButton('Tìm kiếm', ['class' => 'btn btn-primary']) ?>
        <?php // Html::resetButton('Reset', ['class' => 'btn btn-default']); ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<script>
    $('#from_time').daterangepicker({
        singleDatePicker: true,
        timePicker: true,
		timePicker24Hour: true,
        calender_style: "picker_4",
        locale: {
            format: 'mm:h DD-MM-YYYY'
        },
    }, function(start, end, label) {
        console.log(start.toISOString(), end.toISOString(), label);
    });
	$('#to_time').daterangepicker({
        singleDatePicker: true,
        timePicker: true,
		timePicker24Hour: true,
        calender_style: "picker_4",
        locale: {
            format: 'mm:h DD-MM-YYYY'
        },
    }, function(start, end, label) {
        console.log(start.toISOString(), end.toISOString(), label);
    });
</script>
