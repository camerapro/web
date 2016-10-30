<div class="row">
        <div class="col-xs-5">
            <select name="from" id="multiselect" class="form-control" size="<?= count($list_cam);?>" multiple="multiple">
                <?php foreach ($list_cam as $cam):?>
                    <option value="<?= $cam->id?>"><?= $cam->name?></option>
                <?php endforeach;?>
            </select>
        </div>
        <div class="col-xs-2">
            <button type="button" id="multiselect_rightAll" class="btn btn-default btn-block"><i class="glyphicon glyphicon-forward"></i></button>
            <button type="button" id="multiselect_rightSelected" class="btn btn-default btn-block"><i class="glyphicon glyphicon-chevron-right"></i></button>
            <button type="button" id="multiselect_leftSelected" class="btn btn-default btn-block"><i class="glyphicon glyphicon-chevron-left"></i></button>
            <button type="button" id="multiselect_leftAll" class="btn btn-default btn-block"><i class="glyphicon glyphicon-backward"></i></button>
        </div>
        <div class="col-xs-5">
            <select name="to" id="multiselect_to" class="form-control" size="<?= count($list_cam);?>" multiple="multiple">
                <?php foreach ($list_cam_granded as $cam):?>
                    <option value="<?= $cam->id?>"><?= $cam->name?></option>
                <?php endforeach;?>
            </select>
        </div>
        <div class="form-group">
            <div class="col-md-6 col-md-offset-3">
                <button type="cancel" onclick="javascript:window.location='<?=\yii\helpers\Url::base()?>/site/index';" class="btn btn-primary">&nbsp;&nbsp;&nbsp;&nbsp;  Đóng&nbsp;&nbsp; &nbsp;&nbsp; </button>
                <button id="send" type="submit" class="btn btn-success">&nbsp;&nbsp; &nbsp;&nbsp; Lưu&nbsp;&nbsp; &nbsp;&nbsp; </button>
            </div>
        </div>
</div>
<div id="grand_cam" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-body">
                <div class="form-horizontal form-label-left" method="get" style="padding-top: 30px;">
                    <div class="item form-group w100">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name"></label>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <input id="username_login" class="form-control col-md-7 col-xs-12 has-feedback-left"  name="username" placeholder="Tên đăng nhập" required="required" type="text" >
                            <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
                        </div>
                    </div>

                    <div class="item form-group w100">
                        <label for="password" class="control-label col-md-3"></label>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <input id="password_login" type="password" name="password" data-validate-length="6,11" class="form-control col-md-7 col-xs-12 has-feedback-left" placeholder="Mật khẩu">
                            <span class="fa fa-key form-control-feedback left" aria-hidden="true"></span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
                <button type="button" id="login_require" class="btn btn-primary">Đăng nhập</button>
            </div>

        </div>
    </div>
</div>
<input id="fc_grand_cam" data-toggle="modal" data-target="#grand_cam" type="hidden" >
<?php if(!$granded):?>
    <script>
        $( document ).ready(function() {
            $('#fc_grand_cam').click();
        });
        $('#login_require').on('click', function() {
            var username_login = $('#username_login').val();
            var password_login = $('#password_login').val();
            if(username_login ==''){
                $('#username_login').focus();
                $('.show_error_login').html('Tên đăng nhập không được để trống');
            }else if(password_login == ''){
                $('#password_login').focus();
                $('.show_error_login').html('Mật khẩu không được để trống');
            }else{
                $.ajax({
                    url: '/ajax/loginajax',
                    type: "POST",
                    data: {
                        'username_login':username_login,
                        'password_login':password_login
                    } ,
                    success: function (response) {
                        data = JSON.parse(response);
                        if(data['return_code'] == 0){
                            window.location.href = '/user/grand';
                        }else{
                            alert(data['message']);
                        }
                    },


                });
            }

        });
    </script>
<?php endif;?>
<script>

    $('#multiselect').multiselect();

    $('#send').on('click',function () {
        var selectedValues = [];
        $("#multiselect_to option").each(function(){
            selectedValues.push($(this).val());
        });
        $.ajax({
            url: '/ajax/grandcam',
            type: "POST",
            data: {
                'cam_ids':selectedValues,
            } ,
            success: function (response) {
                data = JSON.parse(response);
                if(data['return_code'] == 0){
                    alert('Gán cam thành công!');
                }else {
                    alert('Có lỗi xảy ra, vui lòng liên hệ kỹ thuật!');
                }
            },


        });
    })
</script>