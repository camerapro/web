<?php

use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\StaffFrontend */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="staff-frontend-form">

    <?php $form = ActiveForm::begin([
        'layout' => 'horizontal',
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
    <div class="container">
        <div class="row" style="border: 1px solid #dddddd;padding: 10px;border-radius: 10px">
            <div class="col-xs-8" >
                <p>Thông tin nhân viên:</p>

                <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'phone')->textInput(['maxlength' => true,
                    'type' => 'number'
                ]) ?>
                <?= $form->field($model, 'card_code')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'card_id')->textInput() ?>

                <?= $form->field($model, 'department')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-xs-4">
                <div class="row">
                    <div class=" col-md-push-4" >
                        <img src="http://static.thietbianninh.com/staff/staff.jpg" width="180"></img>
                        <?= $form->field($model, 'image')->fileInput()->label(false) ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

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
