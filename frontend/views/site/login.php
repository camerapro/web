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
            <?= Html::Button('Tạo tài khoản', ['class' => 'btn btn-default button_login', 'name' => 'login-button']) ?>
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
<div class="company_about col-md-12">
    <p> Công ty TNHH Công Nghệ Thông Minh Á Châu Việt Nam</p>
    <p>Địa chỉ: số 28, ngõ 36, Đào Tấn, Ba Đình, Hà Nội</p>
    <p>Điện thoại : 0466 857 857 - 0462 952 952</p>
    <p>Website: http://astech.com.vn - http://thietbianninh.com</p>
</div>