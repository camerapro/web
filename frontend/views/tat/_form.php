<?php

use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\TatFrontend */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tat-frontend-form">

    <?php $form = ActiveForm::begin([
        'layout' => 'horizontal',
		'action'=>$model->isNewRecord ? '/tat/create' : '/tat/update?id='.$model->id,
        'fieldConfig' => [
            'template' => " <div class=\"form-group form-md-line-input\">{label}\n{beginWrapper}\n{input}<div class=\"form-control-focus\"> </div>\n{error}\n</div>{endWrapper}",
            'horizontalCssClasses' => [
                'label' => 'col-sm-4',
                'offset' => 'col-sm-offset-2',
                'wrapper' => 'col-sm-5',
                'error' => '',
                'hint' => '',
            ],

        ],
    ]); ?>
    <p>Thông tin máy chấm công:</p>
    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>


    <?= $form->field($model, 'ip')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'port')->textInput() ?>



    <p>Thông tin camera máy chấm công:</p>
    <?= $form->field($model, 'camera_ip')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'camera_port')->textInput() ?>

    <?= $form->field($model, 'camera_channel')->textInput() ?>

    <?= $form->field($model, 'camera_username')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'camera_password')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'camera_model')->textInput(['maxlength' => true]) ?>
<p>Thông tin quản trị:</p>
    <?= $form->field($model, 'created_time')->textInput() ?>

    <?= $form->field($model, 'expired_time')->textInput() ?>

	<?= $form->field($model, 'company')->dropDownList(
            \yii\helpers\ArrayHelper::map(\frontend\models\CompanyFrontend::findAll(['status' => 1]), 'id', 'name')
        ) ?>
    <?= $form->field($model, 'status')->checkBox(); ?> 
	
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
