<?php

use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\StaffFrontend */
/* @var $form yii\widgets\ActiveForm */
?>
<link href="/css/fileinput.min.css" media="all" rel="stylesheet" type="text/css" />
<script src="/js/fileinput.min.js"></script>
<script src="/js/jquery.min.js"></script>
<script type="text/javascript">
    $("#stafffrontend-image").fileinput({
        'uploadUrl': '/site/upload-avatar',
        showUpload: false,
        maxFileCount: 1,
        dropZoneEnabled: false,
        allowedFileExtensions: ['png', 'jpg', 'jpeg'],
        overwriteInitial: true,
        maxFileSize: 1500,
        showClose: false,
        showCaption: false,
        browseLabel: '',
        removeLabel: '',
        browseIcon: '<i class="glyphicon glyphicon-folder-open"></i>',
        removeIcon: '<i class="glyphicon glyphicon-remove"></i>',
        removeTitle: 'Cancel or reset changes',
        elErrorContainer: '#kv-avatar-errors-1',
        msgErrorClass: 'alert alert-block alert-danger'
    });
    //trigger upload complete
   /* $('#avatar_img').on('filebatchuploadsuccess', function (event, data, previewId, index) {
        var response = data.response;
        console.log(response);
        if (response.status == 1) {
            window.location.reload();
            window.location.href = '/clip/update/'+response.id;
        }
    });*/
</script>
<div class="staff-frontend-form">
	
    <?php $form = ActiveForm::begin([
        'layout' => 'horizontal',
        'action'=>'/staff/create',
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
	<?php
	 $where = ['status'=>1,'id'=>Yii::$app->user->identity->company_id];
	 if(Yii::$app->user->identity->level >2){
           $where = ['status'=>1];
        }
	?>
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
            \yii\helpers\ArrayHelper::map(\frontend\models\CompanyFrontend::findAll($where), 'id', 'name')
        ) ?>
    <div class="form-group pull-right">
        <?= Html::submitButton($model->isNewRecord ? 'Thêm ' : 'Cập nhật', ['class' => $model->isNewRecord ? 'btn btn-success text-right' : 'btn btn-primary']) ?>
    </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
