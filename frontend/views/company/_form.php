<?php

use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\CompanyFrontend */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="modal-body">
<?php if($ajax){?>
       
<?php }?>
<div class="company-frontend-form">

    <?php $form = ActiveForm::begin([
            'layout' => 'horizontal',
            'action'=>$model->isNewRecord ? '/company/create' : '/company/update?id='.$model->id,
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
<p>Thông tin công ty: </p>
    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'contact_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>


    <p>Thông tin quản trị:</p>
    <?= $form->field($model, 'balance')->textInput(['maxlength' => true]) ?>

     <?= $form->field($model, 'created_time')->textInput(array('value'=>isset($model->created_time)?$model->created_time:date("Y-m-d H:i:s"))) ?>

    <?= $form->field($model, 'expired_time')->textInput(array('value'=>isset($model->expired_time)?$model->expired_time:date("Y-m-d H:i:s",time()+ 365*86400)));?>

    <?= $form->field($model, 'website')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Lưu' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
</div>
