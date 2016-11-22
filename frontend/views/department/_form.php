<?php

use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\departmentFrontend */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="modal-body">
<div class="department-frontend-form">

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

    <?= $form->field($model, 'company_id')->dropDownList(
        \yii\helpers\ArrayHelper::map(\frontend\models\CompanyFrontend::findAll(['status' => 1]), 'id', 'name')
    ) ?>
    <?= $form->field($model, 'parent_id')->dropDownList(
        \yii\helpers\ArrayHelper::map(\frontend\models\DepartmentFrontend::findAll(['status' => 1]), 'id', 'name')
    ) ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
</div>
