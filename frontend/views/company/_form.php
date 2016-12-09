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
<p>Thông tin tài khoản quản trị: </p>
	<?php
			$user = new \common\models\User();
			
	?> 
   <div class="x_content">
    <?= $form->field($user, 'username')->textInput(['maxlength' => true]) ?>
    <?= $form->field($user, 'password')->passwordInput() ?>
    <?= $form->field($user, 'fullname')->textInput(['maxlength' => true]) ?>
    <?= $form->field($user, 'email')->textInput(['maxlength' => true]) ?>
    <?= $form->field($user, 'phone')->textInput(['maxlength' => true]) ?>
	<div class="item form-group">
		<label class="control-label col-md-3 col-sm-3 col-xs-12">Phân quyền</span>
		</label>
		<div class="col-md-6 col-sm-6 col-xs-12">

			<select id="level" class="form-control" required  name="level">
				<?php
				$lever = \frontend\models\Level::find()->where(['<=', 'id', Yii::$app->user->identity->level])->andWhere(['=', 'status', 1])->all();
				?>
				<?php foreach ($lever as $item):?>
					<option <?= ($user->level == $item->id) ? 'selected' : ''?> value="<?= $item->id?>"><?= $item->level_name?></option>
				<?php endforeach;?>
			</select>
		</div>

	</div>
	<p>Thông tin quản trị: </p>
    <?= $form->field($user, 'address')->textInput(['maxlength' => true]) ?>
    <?= $form->field($user, 'created_time')->textInput(['maxlength' => true]) ?>
    <?= $form->field($user, 'expired_time')->textInput(['maxlength' => true]) ?>
	<?= $form->field($model, "status")->checkbox(); ?>
	
	
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Lưu' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
</div>
