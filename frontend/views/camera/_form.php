<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\Camera */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="camera-form">

    <?php $form = ActiveForm::begin(); ?>
    <p class="show_error"></p>
    <?php
    $data = [];
    $recoder = \frontend\models\FrontendRecorder::getRecorderById();
    foreach ($recoder as $item):
        $data[$item['id']] = $item['name'];
    endforeach;
    echo $form->field($model, 'recorder_id')->dropDownList($data,['prompt'=>'Chọn đâu ghi']);
    ?>
    <?= $form->field($model, 'encoder_name')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'ip_address')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'port')->textInput() ?>
    <?= $form->field($model, 'encoder_port')->textInput() ?>
    <?= $form->field($model, 'channel')->textInput() ?>
    <?= $form->field($model, 'encoder_username')->textInput() ?>
    <?= $form->field($model, 'encoder_password')->textInput() ?>

    <?php
    echo $form->field($model, 'protocol')->dropDownList(['http' => 'http', 'rtsp' => 'rtsp']);
    ?>
    <?php
    echo $form->field($model, 'encoder_model')->dropDownList(['H264DVR' => 'H264DVR', 'HikVision' => 'HikVision', 'DAHUA' => 'DAHUA', 'Camera IP' => 'Camera IP', 'other' => 'Loại khác'],['prompt'=>'Chọn loại thiết bị']);
    ?>
    <?php $list = [0 => 'Không hiển thị', 1 => 'Hiển thị'];
    $model->isNewRecord ? $model->status = 1 : '';
    echo $form->field($model, 'status')->radioList($list);
    ?>
    <?php $list = [1 => 'SD', 0 => 'HD'];
    $model->isNewRecord ? $model->quality = 0 : '';
    echo $form->field($model, 'quality')->radioList($list);
    ?>
    <div class="form-group">
        <?php if($model->isNewRecord ):?>
            <button id="btn_save_and_create" class="btn btn-success">Lưu và thêm mới</button>
        <?php endif;?>
        <?= Html::submitButton($model->isNewRecord ? 'Lưu và đóng' : 'Cập nhật', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?php if($model->isNewRecord ):?>
            <button id="btn_close" class="btn btn-primary">Đóng</button>
        <?php endif;?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
<script>
    $(document).ready(function() {
        $("#frontendcamera-encoder_port").val('34567');
        $("#frontendcamera-port").val('554');
        $("#frontendcamera-protocol").val('rtsp');
    });
    $( "#frontendcamera-recorder_id" ).change(function () {
            $( "#frontendcamera-recorder_id option:selected" ).each(function() {
                var id_recoder = $( this ).val();
                if(id_recoder != ''){
                    $.ajax({
                        url: '/ajax/encorder_info',
                        type: "POST",
                        data: {
                            'id_recoder':id_recoder,
                        } ,
                        success: function (response) {
                            data_res = JSON.parse(response);
                            if(data_res['return_code'] == 0){
                                $('#frontendcamera-encoder_name').prop('readonly', 'readonly').val(data_res['data']['name']);
                                $('#frontendcamera-ip_address').prop('readonly', 'readonly').val(data_res['data']['ip']);
                                $('#frontendcamera-port').prop('readonly', 'readonly').val(data_res['data']['port']);
                                $('#frontendcamera-encoder_port').prop('readonly', 'readonly').val(data_res['data']['media_port']);
                                $('#frontendcamera-encoder_username').prop('readonly', 'readonly').val(data_res['data']['username']);
                                $('#frontendcamera-encoder_password').prop('readonly', 'readonly').val(data_res['data']['password']);
                                $('#frontendcamera-protocol').prop('readonly', 'readonly').val(data_res['data']['protocol']);
                                $('#frontendcamera-encoder_port').prop('readonly', 'readonly').val(data_res['data']['media_port']);
                                $('#frontendcamera-encoder_model').prop('readonly', 'readonly').val(data_res['data']['model']);
                            }
                        },
                    });
                }else{
                    $('#frontendcamera-encoder_name').prop('readonly', false).val('');
                    $('#frontendcamera-ip_address').prop('readonly', false).val('');
                    $('#frontendcamera-port').prop('readonly', false).val('554');
                    $('#frontendcamera-encoder_port').prop('readonly', false).val('34567');
                    $('#frontendcamera-encoder_username').prop('readonly', false).val('');
                    $('#frontendcamera-encoder_password').prop('readonly', false).val('');
                    $('#frontendcamera-protocol').prop('readonly', false).val('rtsp');
                    $('#frontendcamera-encoder_port').prop('readonly', false).val('');
                    $('#frontendcamera-encoder_model').prop('readonly', false).val('');
                }
            });
        }) .change();
    $("#btn_save_and_create").on('click', function() {
        var title_encoder = $('#frontendcamera-encoder_name').val();
        var title_camera = $('#frontendcamera-name').val();
        var protocol = $('#frontendcamera-protocol').val();
        var channel = $('#frontendcamera-channel').val();
        var ip_address = $('#frontendcamera-ip_address').val();
        var port = $('#frontendcamera-port').val();
        var port_http = $('#frontendcamera-encoder_port').val();
        var username = $('#frontendcamera-encoder_username').val();
        var password = $('#frontendcamera-encoder_password').val() ;
        var encoder_model = $('#frontendcamera-encoder_model').val() ;
        var recoder_id = $('#frontendcamera-recorder_id').val() ;
        if(title_encoder == ''){
            $('#frontendcamera-encoder_name').focus();
            $('.show_error').html('Tên đầu ghi không được để trống');
            return false;
        }else if(title_camera == ''){
            $('#frontendcamera-name').focus();
            $('.show_error').html('Tên camera không được để trống');
            return false;
        }else if(protocol == ''){
            $('#frontendcamera-protocol').focus();
            $('.show_error').html('Protocol không được để trống');
            return false;
        }else if(channel == ''){
            $('#frontendcamera-channel').focus();
            $('.show_error').html('Tên kênh không được để trống');
            return false;
        }else if(ip_address == ''){
            $('#frontendcamera-ip_address').focus();
            $('.show_error').html('Địa chỉ IP không được để trống');
            return false;
        }else if(port == ''){
            $('#frontendcamera-port').focus();
            $('.show_error').html('Cổng media không được để trống');
            return false;
        }else if(username == ''){
            $('#frontendcamera-encoder_username').focus();
            $('.show_error').html('Username không được để trống');
            return false;
        }else if(port_http == ''){
            $('#frontendcamera-encoder_port').focus();
            $('.show_error').html('Cổng đầu ghi không được để trống');
            return false;
        }
        else {
            $.ajax({
                url: '/ajax/create',
                type: "GET",
                data: {
                    'title_encoder':title_encoder,
                    'title_camera':title_camera,
                    'protocol':protocol,
                    'channel':channel,
                    'ip_address':ip_address,
                    'port':port,
                    'username':username,
                    'password':password,
                    'port_http':port_http,
                    'encoder_model':encoder_model,
                    'recoder_id':recoder_id
                } ,
                success: function (response) {
                    data_res = JSON.parse(response);
                    if(data_res['return_code'] == 0){
                        alert(data_res['message']);
                        $('#frontendcamera-name').val('');
                        $('#frontendcamera-channel').val('');
                    }
                },
            });
            return false;
        }
    });
    $("#btn_close").on('click',function () {
        window.location = 'http://cam.thietbianninh.com/camera/index';
        return false
    })
</script>