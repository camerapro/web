<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>

<div class="row">
    <p class="show_error">
        <?php
        if(isset($error) && $error != '');
        echo $error;
        ?>
    </p>
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Tạo tài khoản</h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <form class="form-horizontal form-label-left" method="get">
                   <input type="hidden" name="id" value="<?= $model->id?>"/>
                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Tên đăng nhập</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input id="name" class="form-control col-md-7 col-xs-12 has-feedback-left"  name="username" placeholder="Tên đăng nhập" required="required" type="text" value="<?= $model->username;?>">
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
                            <input id="name" class="form-control col-md-7 col-xs-12 has-feedback-left" data-validate-length-range="6" data-validate-words="2" name="name" placeholder="Tên đầy đủ" type="text" value="<?= $model->fullname;?>">
                            <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Email</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="email" id="email" name="email" required="required" class="form-control col-md-7 col-xs-12 has-feedback-left" placeholder="Email" value="<?= $model->email;?>">
                            <span class="fa fa-envelope form-control-feedback left" aria-hidden="true"></span>
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Số điện thoại</label>

                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="tel" id="telephone" name="phone" required="required" data-validate-length-range="8,20" class="form-control col-md-7 col-xs-12 has-feedback-left" placeholder="Số điện thoại" value="<?= $model->phone;?>">
                            <span class="fa fa-phone form-control-feedback left" aria-hidden="true"></span>
                        </div>
                    </div>

                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="occupation">Đia chỉ</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input id="occupation" type="text" name="occupation" data-validate-length-range="5,200" class="optional form-control col-md-7 col-xs-12 has-feedback-left" placeholder="Đia chỉ" value="<?= $model->address;?>">
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
                                    <option <?= ($model->level == $item->id) ? 'selected' : ''?> value="<?= $item->id?>"><?= $item->level_name?></option>
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
                                    <option <?= ($item->id == $model->permission_group_id) ? 'selected' : ''?> value="<?= $item->id?>"><?= $item->name?></option>
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
                                    <option <?= ($item->id == $model->company_id) ? 'selected' : ''?> value="<?= $item->id?>"><?= $item->name?></option>
                                <?php endforeach;?>
                            </select>
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Thời gian hết hạn</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input id="expired_time" name="expired_time" class="date-picker form-control col-md-7 col-xs-12" required="required" type="text" value="<?= isset($model->expired_time) ? date('d-m-Y', strtotime($model->expired_time)) :date('d-m-Y' , strtotime('+3 months', time())) ;?>">
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
                            <button id="send" type="submit" class="btn btn-success"><?= $model->isNewRecord ? 'Tạo tài khoản' : 'Chỉnh sửa'?></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div id="show_create_per" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" style="width: 980px">
        <div class="modal-content"></div>
    </div>
</div>
<script>
    $('#expired_time').daterangepicker({
        singleDatePicker: true,
        calender_style: "picker_4",
        locale: {
            format: 'DD-MM-YYYY'
        },
    }, function(start, end, label) {
        console.log(start.toISOString(), end.toISOString(), label);
    });
</script>
<script>
    // initialize the validator function
    validator.message.date = 'not a real date';

//     validate a field on "blur" event, a 'select' on 'change' event & a '.reuired' classed multifield on 'keyup':
    $('form')
        .on('blur', 'input[required], input.optional, select.required', validator.checkField)
        .on('change', 'select.required', validator.checkField)
        .on('keypress', 'input[required][pattern]', validator.keypress);

    $('.multi.required').on('keyup blur', 'input', function() {
        validator.checkField.apply($(this).siblings().last()[0]);
    });

    $('form').submit(function(e) {
        e.preventDefault();
        var submit = true;

        // evaluate the form using generic validaing
        if (!validator.checkAll($(this))) {
            submit = false;
        }
        if (submit)
            this.submit();

        return false;
    });
</script>
<script type="text/javascript">
    function do_this(id){
        var checkboxes = document.getElementsByName('permission[' + id +'][]');
        var button = document.getElementById(id + '_toggle');
        if(button.alt == 'select'){
            for (var i in checkboxes){
                checkboxes[i].checked = 'FALSE';
            }
            button.alt = 'deselect'
        }else{
            for (var i in checkboxes){
                checkboxes[i].checked = '';
            }
            button.alt = 'select';
        }
    }
</script>