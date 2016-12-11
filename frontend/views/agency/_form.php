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


                <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>
                <?= $form->field($model, 'phone')->textInput(['maxlength' => true,
                    'type' => 'number'
                ]) ?>
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
    <p>Thông tin tài khoản đại lý:</p>
    <div class="pull-center" >
		<?php
			$user = new \common\models\User();
			
	?> 
   <div class="x_content">
    <?= $form->field($user, 'username')->textInput(['maxlength' => true]) ?>
    <?= $form->field($user, 'password')->passwordInput() ?>
    <?= $form->field($user, 'fullname')->textInput(['maxlength' => true]) ?>
    <?= $form->field($user, 'email')->textInput(['maxlength' => true]) ?>
    <?= $form->field($user, 'phone')->textInput() ?>
       <div class="item form-group">
           <label class="control-label col-md-3 col-sm-3 col-xs-12">Phân quyền</span>
           </label>
           <div class="col-md-6 col-sm-6 col-xs-12">

               <select id="level" class="form-control" required  name="level">
                   <?php
                   $lever = \frontend\models\Level::find()->where(['<=', 'id', Yii::$app->user->identity->level])->andWhere(['=', 'status', 1])->all();
                   ?>
                   <?php foreach ($lever as $item):?>
                       <option <?= ($item->id ==3) ? 'selected' : ''?> value="<?= $item->id?>"><?= $item->level_name?></option>
                   <?php endforeach;?>
               </select>
           </div>

       </div>
       <div class="item form-group">
           <label class="control-label col-md-3 col-sm-3 col-xs-12">Nhóm quyền</span>
           </label>
           <div class="col-md-3 col-sm-3 col-xs-12 " id = "list-permission">
               <select id="permission" class="form-control" required  name="permission">
                   <?php
                   $lever = \frontend\models\PermissionGroup::findAll(['status'=>1]);
                   if(Yii::$app->user->identity->level <4){
//                                    $lever = \frontend\models\PermissionGroup::findAll(['id'=>Yii::$app->user->identity->permission_group_id]);
                       $lever = \frontend\models\PermissionGroup::find()->orWhere(['id'=>Yii::$app->user->identity->permission_group_id])->orWhere(['created_by_id'=>Yii::$app->user->identity->id])->all();
                   }
                   ?>
                   <?php foreach ($lever as $item):?>
                       <option <?= ($item->id == $user->permission_group_id) ? 'selected' : ''?> value="<?= $item->id?>"><?= $item->name?></option>
                   <?php endforeach;?>
               </select>
           </div>
           <?php if(Yii::$app->user->identity->level >=3): ?>
               <div class="col-md-3 col-sm-3 col-xs-12">
                   <a data-ignore-state="1" id="notify-id"  data-target="#modalPopup" data-toggle="modal" class="title pull-left btn btn-success" href="/per/create"><i class="glyphicon glyphicon-plus"></i> Tạo mới</a>

               </div>
           <?php endif;?>
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
<div id="modalPopup" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modalPopup" aria-hidden="true">
    <div class="modal-dialog modal-lg" style="width: 500px">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>

        </div>
        <div class="modal-content"></div>
    </div>
</div>

<script>
    $('#user-expired_time').daterangepicker({
        singleDatePicker: true,
        calender_style: "picker_4",
        locale: {
            format: 'DD-MM-YYYY'
        },
    }, function(start, end, label) {
        console.log(start.toISOString(), end.toISOString(), label);
    });
    $('body').on("hidden.bs.modal", function(e) {
        $(e.target).removeData("bs.modal").find(".modal-content").empty();
    });

    $('body').on("show.bs.modal", function(e) {
        var link = $(e.relatedTarget);

        $(this).find(".modal-content").load(link.attr("href"));
    });
    $("#modalPopup").draggable({
        handle: ".modal-header"
    });
</script>
