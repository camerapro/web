<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
?>
<div class="login_content_area col-md-8">
    <div class="intro col-md-12">
        <p>Khám phá Camera</p>
        <p>Những tính năng tạo sự đột phát trong hệ thống camera giám sát</p>
    </div>
    <ul class="intro_img_ct">
        <li class="col-md-4">
            <img class="login_icon1" src="../images/icon-1.png">
            <div class="intro_img">
                <p>Tương thích với bất kỳ thương hiệu camera</p>
                <p>Dễ dàng kết nối với camera của bạn với một vài cú nhấp chuột</p>
            </div>
        </li>
        <li class="col-md-4">
            <img class="login_icon2" src="../images/icon-2.png">
            <div class="intro_img">
                <p>Lưu trữ dữ liệu bằng công nghệ điện toán đám mây</p>
                <p>Phát triển các giải pháp đáp ứng mọi nhu cầu về giám sát</p>
            </div>
        </li>
        <li class="col-md-4">
            <img  class="login_icon3" src="../images/icon-3.png">
            <div class="intro_img">
                <p>Xem camera bất cứ nơi nào</p>
                <p>Ngoài sự mong đợi của bạn là xem camera từ bất kỳ thiết bị nào</p>
            </div>
        </li>
    </ul>
</div>
<div class="login_area col-md-4">
    <div class="login_wapper">
        <div class="logo_area">
            <h3 class="col-md-6">Đăng nhập hệ thống</h3>
            <img class="col-md-6" src="../images/logo_ssm.png">
        </div>
        <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
        <div>
            <?= $form->field($model, 'username')->textInput(['autofocus' => true,'class'=>'form-control', 'placeholder'=>'Tên đăng nhập']) ?>
        </div>
        <div>
            <?= $form->field($model, 'password')->passwordInput(['class'=>'form-control', 'placeholder'=>'Mật khẩu']) ?>

        </div>
        <div>
            <?= Html::submitButton('Đăng nhập', ['class' => 'btn btn-default submit button_login', 'name' => 'login-button']) ?>
                <input class="btn btn-default submit button_login" data-toggle="modal" data-target="#create_account"  value="Tạo tài khoản" type="button" >

        </div>

        <div class="clearfix"></div>

        <div class="separator">
            <p class="change_link">Tài khoản xem demo</p>
            <p class="change_link">Tên đăng nhập: demo</p>
            <p class="change_link">Mật khẩu: demo</p>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>
<div id="create_account" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="myModalLabel">Thêm mới camera</h4>
            </div>
            <p class="show_error"></p>
            <div id="wizard" class="form_wizard wizard_horizontal">
                <ul class="wizard_steps">
                    <li>
                        <a href="#step-1">
                            <span class="step_no">1</span>
                            <span class="step_descr"> Bước 1: Đăng ký</span>
                        </a>
                    </li>
                    <li>
                        <a href="#step-2">
                            <span class="step_no">2</span>
                            <span class="step_descr"> Bước 2: Xác nhận</span>
                        </a>
                    </li>

                </ul>
                <div id="step-1">
                    <form class="col-md-6 form-horizontal form-label-left">
                        <div class="form-group">
                            <label class="control-label col-md-4 col-sm-3 col-xs-12" for="first-name">Tên người dùng
                            </label>
                            <div class="col-md-8 col-sm-6 col-xs-12">
                                <input type="text" id="fullname" required="required" class="form-control col-md-7 col-xs-12">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-4 col-sm-3 col-xs-12" for="first-name">Tên truy cập
                            </label>
                            <div class="col-md-8 col-sm-6 col-xs-12">
                                <input type="text" id="user_name" required="required" class="form-control col-md-7 col-xs-12">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-4 col-sm-3 col-xs-12" for="first-name">Mật khẩu
                            </label>
                            <div class="col-md-8 col-sm-6 col-xs-12">
                                <input type="password" id="password" required="required" class="form-control col-md-7 col-xs-12">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-4 col-sm-3 col-xs-12" for="first-name">Điện thoại
                            </label>
                            <div class="col-md-8 col-sm-6 col-xs-12">
                                <input type="text" id="phone_number" required="required" class="form-control col-md-7 col-xs-12">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-4 col-sm-3 col-xs-12" for="first-name">Email
                            </label>
                            <div class="col-md-8 col-sm-6 col-xs-12">
                                <input type="text" id="email" required="required" class="form-control col-md-7 col-xs-12">
                            </div>
                        </div>
                    </form>
                    <div class="col-md-6 register_msg">
                        <p class="fs_16 fw_bold" >Tất cả bạn cần là Camera IP kết nối Internet</p>
                        <p>Dùng miễn phí 100%</p>
                        <p>Hệ thống đầy đủ chức năng</p>
                        <p>Không giới hạn số camera</p>
                        <p>Nâng cấp lên bản chính thức bất cứ khi nào bàn muốn cùng gói dịch vụ phì hợp với nhu cầu của bạn</p>
                        <p>Hệ thống đầy đủ chắc năng như xem camera trực tuyến, xem lại video trong vòng 24h, xem báo cáo theo thời gian thực</p>
                    </div>
                </div>
                <div id="step-2">
                    <form class="col-md-6 form-horizontal form-label-left form_cf_reg">
                        <p>Hãy ghi nhớ tài khoản của bạn và bắt đầu sử dụng</p>
                        <p class="mt25">Chào bạn: <span class="u_fullname"></span></p>
                        <p>Tên truy cập: <span class="u_user_name"></span></p>
                        <p>Mật khẩu: <span class="u_password"></span></p>
                    </form>
                    <div class="col-md-6 register_msg">
                        <p class="fs_16 fw_bold" >Tất cả bạn cần là Camera IP kết nối Internet</p>
                        <p>Dùng miễn phí 100%</p>
                        <p>Hệ thống đầy đủ chức năng</p>
                        <p>Không giới hạn số camera</p>
                        <p>Nâng cấp lên bản chính thức bất cứ khi nào bàn muốn cùng gói dịch vụ phì hợp với nhu cầu của bạn</p>
                        <p>Hệ thống đầy đủ chắc năng như xem camera trực tuyến, xem lại video trong vòng 24h, xem báo cáo theo thời gian thực</p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>


<div class="company_about col-md-12">
    <p> Công ty TNHH Công Nghệ Thông Minh Á Châu Việt Nam</p>
    <p>Địa chỉ: số 28, ngõ 36, Đào Tấn, Ba Đình, Hà Nội</p>
    <p>Điện thoại : 0466 857 857 - 0462 952 952</p>
    <p>Website: http://astech.com.vn - http://thietbianninh.com</p>
</div>

<script>
    $(document).ready(function() {
        $('#wizard').smartWizard();

        $('#wizard_verticle').smartWizard({
            transitionEffect: 'slide'
        });

        $('.buttonNext').addClass('btn btn-success');
        $('.buttonPrevious').addClass('btn btn-primary');
        $('.buttonFinish').addClass('btn btn-default');
    });
</script>