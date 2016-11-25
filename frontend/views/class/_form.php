<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\ClassFrontend */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="modal-body">
<div class="class-frontend-form">

    <?php $form = ActiveForm::begin([
            'layout' => 'horizontal',
            'action'=>$model->isNewRecord ? '/department/create' : '/department/update?id='.$model->id,
            'method'=>'POST',
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
        ]
    ); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'parent_id')->dropDownList(
        \yii\helpers\ArrayHelper::map(\frontend\models\StaffFrontend::findAll(['status' => 1]), 'id', 'name'))->label('Giáo viên');?>
    <?= $form->field($model, 'parent_id')->dropDownList(
        \yii\helpers\ArrayHelper::map(\frontend\models\StaffFrontend::findAll(['status' => 1]), 'id', 'name')
    )->label('Trợ giảng');?>

    <?= $form->field($model, 'start_time')->textInput() ?>
    <?= $form->field($model, 'end_time')->textInput() ?>
    <?= $form->field($model, 'end_time')->textInput()->label('Lịch học') ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>
    <div class="clearfix" style="padding-top: 10px;"></div>
    <p>Thông tin quản trị:</p>
    <div class="pull-center" >
        <?= $form->field($model, 'company_id')->dropDownList(
            \yii\helpers\ArrayHelper::map(\frontend\models\CompanyFrontend::findAll(['status' => 1]), 'id', 'name')
        ) ?>
        <div class="form-group pull-right">
            <?= Html::submitButton($model->isNewRecord ? 'Thêm ' : 'Cập nhật', ['class' => $model->isNewRecord ? 'btn btn-success text-right' : 'btn btn-primary']) ?>
        </div>
    </div>



    <?php ActiveForm::end(); ?>

</div>
</div>
