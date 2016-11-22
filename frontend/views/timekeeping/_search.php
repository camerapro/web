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

    <?php
    $now = date('Y-m-d');
    $days = 1;
    if (!isset($startDate)) $startDate = date("d/m/Y", strtotime("$now - $days day"));
    if (!isset($endDate)) $endDate = date('d/m/Y');
    echo DateRangePicker::widget([
        'name' => 'date',
        'value' => "$startDate - $endDate",
        'language' => 'vi',
        'presetDropdown' => true,
        'hideInput' => true,
        'convertFormat' => true,
        'pluginOptions' => [
            'locale' => [
                'format' => 'd/m/Y'
            ],

        ]
    ]);
    ?>
	<?php echo $form->field($model,'created_time11')->textInput(['value' => '2016-11-10 00:00:00'])->label('Từ ngày'); ?>
	<?php echo $form->field($model,'created_time1')->textInput(['value' => '2016-11-11 00:00:00'])->label('Đến ngày'); ?>

    <?php // echo $form->field($model, 'image') ?>

    <?php // echo $form->field($model, 'staff_id') ?>

    <div class="form-group">
        <?= Html::submitButton('Tìm kiếm', ['class' => 'btn btn-primary']) ?>
        <?php // Html::resetButton('Reset', ['class' => 'btn btn-default']); ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
