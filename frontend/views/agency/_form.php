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
                <form class="form-horizontal form-label-left" method="get">
                   <input type="hidden" name="id" value="<?= $user->id?>"/>
                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Tên đăng nhập</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input id="name" class="form-control col-md-7 col-xs-12 has-feedback-left"  name="username" placeholder="Tên đăng nhập" required="required" type="text" value="<?= $user->username;?>">
                            <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
                        </div>
                    </div>
                    <div class="item form-group">
                        <label for="password" class="control-label col-md-3">Mật khẩu</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input id="password" type="password" name="password" data-validate-length="6,11" class="form-control col-md-7 col-xs-12 has-feedback-left" placeholder="Mật khẩu">
                            <span class="fa fa-key form-control-feedback left" aria-hidden="true"></span>
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Tên đầy đủ</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input id="name" class="form-control col-md-7 col-xs-12 has-feedback-left" data-validate-length-range="6" data-validate-words="2" name="name" placeholder="Tên đầy đủ" type="text" value="<?= $user->fullname;?>">
                            <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Email</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="email" id="email" name="email" required="required" class="form-control col-md-7 col-xs-12 has-feedback-left" placeholder="Email" value="<?= $user->email;?>">
                            <span class="fa fa-envelope form-control-feedback left" aria-hidden="true"></span>
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Số điện thoại</label>

                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="tel" id="telephone" name="phone" required="required" data-validate-length-range="8,20" class="form-control col-md-7 col-xs-12 has-feedback-left" placeholder="Số điện thoại" value="<?= $user->phone;?>">
                            <span class="fa fa-phone form-control-feedback left" aria-hidden="true"></span>
                        </div>
                    </div>

                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="occupation">Đia chỉ</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input id="occupation" type="text" name="occupation" data-validate-length-range="5,200" class="optional form-control col-md-7 col-xs-12 has-feedback-left" placeholder="Đia chỉ" value="<?= $user->address;?>">
                            <span class="fa fa-map-marker form-control-feedback left" aria-hidden="true"></span>

                        </div>
                    </div>
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

                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Nhóm quyền</span>
                        </label>
                        <div class="col-md-3 col-sm-3 col-xs-12">
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
                            <a data-ignore-state="1" id="notify-id"  data-target="#show_create_per" data-toggle="modal" class="title pull-left btn btn-success" href="/ajax/show_create_per">Tạo nhóm quyền</a>
                        </div>
                        <?php endif;?>
                    </div>

                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Công ty</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <select id="heard" class="form-control" required  name="company_id">
                                <?php
                                $company = \frontend\models\FrontendCompany::findAll(['status'=>1]);
                                if(Yii::$app->user->identity->level <4){
                                    $company = \frontend\models\FrontendCompany::findAll(['id'=>Yii::$app->user->identity->company_id, 'status'=>1]);
                                }
                                ?>
                                <?php foreach ($company as $item):?>
                                    <option <?= ($item->id == $user->company_id) ? 'selected' : ''?> value="<?= $item->id?>"><?= $item->name?></option>
                                <?php endforeach;?>
                            </select>
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Thời gian hết hạn</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input id="expired_time" name="expired_time" class="date-picker form-control col-md-7 col-xs-12" required="required" type="text" value="<?= isset($user->expired_time) ? date('d-m-Y', strtotime($user->expired_time)) :date('d-m-Y' , strtotime('+3 months', time())) ;?>">
                        </div>
                    </div>

                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Khóa</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input tabindex="1" type="checkbox" id="lock_user" name="lock_user" <?php echo ($model->status == 0) ? 'checked="checked"' : ''?>/>
                        </div>
                    </div>


                    <div class="ln_solid"></div>
                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-3">
                            <button type="cancel" onclick="javascript:window.location='<?=\yii\helpers\Url::base()?>/user/index';" class="btn btn-primary">&nbsp;&nbsp;&nbsp;&nbsp;  Hủy&nbsp;&nbsp; &nbsp;&nbsp; </button>
                            <button id="send" type="submit" class="btn btn-success"><?= $model->isNewRecord ? 'Lưu' : 'Chỉnh sửa'?></button>
                        </div>
                    </div>
                </form>
            </div>
    </div>

    <?php ActiveForm::end(); ?>
</div>
