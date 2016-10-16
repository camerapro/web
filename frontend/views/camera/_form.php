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

    <?= $form->field($model, 'streaming_url')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'port')->textInput() ?>

    <?php
    echo $form->field($model, 'channel')->dropDownList(['web' => 'web', 'wap' => 'wap', 'desktop' => 'desktop', 'mobile' => 'mobile'],['prompt'=>'Chọn kênh']);
    ?>
    <?php
        echo $form->field($model, 'protocol')->dropDownList(['http' => 'http', 'rtsp' => 'rtsp'],['prompt'=>'Chọn giao thức']);
    ?>

    <?php $list = [0 => 'Không hiển thị', 1 => 'Hiển thị'];
        echo $form->field($model, 'status')->radioList($list);
    ?>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Tạo mới' : 'Cập nhật', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
