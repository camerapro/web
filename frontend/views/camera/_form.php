<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\Camera */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="camera-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'encoder_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ip_address')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'port')->textInput() ?>
    <?= $form->field($model, 'encoder_port')->textInput() ?>

    <?= $form->field($model, 'channel')->textInput() ?>

    <?= $form->field($model, 'encoder_username')->textInput() ?>
    <?= $form->field($model, 'encoder_password')->textInput() ?>

    <?php
    echo $form->field($model, 'protocol')->dropDownList(['http' => 'http', 'rtsp' => 'rtsp']);
    ?>
    <?php
    echo $form->field($model, 'encoder_model')->dropDownList(['H264DVR' => 'H264DVR', 'HikVision' => 'HikVision', 'Dahua' => 'Dahua', 'Camera IP' => 'Camera IP', 'other' => 'Loại khác'],['prompt'=>'Chọn loại thiết bị']);
    ?>
    <?php $list = [0 => 'Không hiển thị', 1 => 'Hiển thị'];
    $model->status = '1';
    echo $form->field($model, 'status')->radioList($list);
    ?>
    <?php $list = [0 => 'SD', 1 => 'HD'];
    $model->quality = 0;
    echo $form->field($model, 'quality')->radioList($list);
    ?>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Tạo mới' : 'Cập nhật', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
