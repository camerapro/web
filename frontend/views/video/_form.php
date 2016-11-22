<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\_base\TmpVideoPeriodBase */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tmp-video-period-base-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'period_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'subject_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'class_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'teacher_name')->textInput(['maxlength' => true]) ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
