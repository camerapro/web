<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Agency */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="agency-form">

       <?php $form = ActiveForm::begin([
        'layout' => 'horizontal',
        'action'=>$model->isNewRecord ? '/agency/create' : '/agency/update?id='.$model->id,
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
                <p>Thông tin đại lý:</p>

                <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'phone')->textInput(['maxlength' => true,
                    'type' => 'number'
                ]) ?>
                <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>
                <?= $form->field($model, 'website')->textInput(['maxlength' => true]) ?>
                <?= $form->field($model, 'skype')->textInput(['maxlength' => true]) ?>
                <?= $form->field($model, 'hotline')->textInput(['maxlength' => true]) ?>
            </div>
           <div class="col-xs-4">
		   
                <div class="row">
                    <div class=" col-md-push-4" >
                        <img src=""  onerror="this.src='<?php echo Yii::$app->params['images']['staff']['url'].'/thumb.png';?>'" width="180"></img>
                        <?= $form->field($model, 'imageFile')->fileInput()->label(false) ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="clearfix" style="padding-top: 10px;"></div>
    <p>Thông tin tài khoản quản trị:</p>
    <div class="pull-center" >
		<?php
			$user = new \common\models\User();
			
	?> 
   <div class="x_content">
    <?= $form->field($user, 'username')->textInput(['maxlength' => true]) ?>
    <?= $form->field($user, 'password')->passwordInput() ?>
    <?= $form->field($user, 'fullname')->textInput(['maxlength' => true]) ?>
    <?= $form->field($user, 'email')->textInput(['maxlength' => true]) ?>
    <?= $form->field($user, 'phone')->textInput(['maxlength' => true]) ?>
	<?= $form->field($user, 'address')->textInput(['maxlength' => true]) ?>
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
   
    <?= $form->field($user, 'created_time')->textInput(['maxlength' => true,'value'=>date('d-m-Y',time())]) ?>
    <?= $form->field($user, 'expired_time')->textInput(['maxlength' => true,'value'=>date('d-m-Y',time()+365*86400)]) ?>
	<?= $form->field($user, "status")->checkbox()->label('Khóa'); ?>
	
	
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Lưu' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
    </div>
    </div>
		

    <?php ActiveForm::end(); ?>
</div>
