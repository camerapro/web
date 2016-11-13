<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\search\TatSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tat-frontend-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'category_id') ?>

    <?= $form->field($model, 'ip') ?>

    <?= $form->field($model, 'port') ?>

    <?php // echo $form->field($model, 'protocol') ?>

    <?php // echo $form->field($model, 'created_time') ?>

    <?php // echo $form->field($model, 'updated_time') ?>

    <?php // echo $form->field($model, 'description') ?>

    <?php // echo $form->field($model, 'order') ?>

    <?php // echo $form->field($model, 'camera_main_id') ?>

    <?php // echo $form->field($model, 'camera_secondary_id') ?>

    <?php // echo $form->field($model, 'user_id') ?>

    <?php // echo $form->field($model, 'agency_id') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'camera_ip') ?>

    <?php // echo $form->field($model, 'camera_port') ?>

    <?php // echo $form->field($model, 'camera_channel') ?>

    <?php // echo $form->field($model, 'camera_username') ?>

    <?php // echo $form->field($model, 'camera_password') ?>

    <?php // echo $form->field($model, 'camera_model') ?>

    <?php // echo $form->field($model, 'expired_time') ?>

    <?php // echo $form->field($model, 'company') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
