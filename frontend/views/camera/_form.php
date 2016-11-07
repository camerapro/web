<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\Camera */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="camera-form">

    <?php $form = ActiveForm::begin(); ?>
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
        <?= Html::submitButton($model->isNewRecord ? 'Tạo mới' : 'Cập nhật', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<script>
    $( "#frontendcamera-recorder_id" )
        .change(function () {
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
                    $('#frontendcamera-port').prop('readonly', false).val('');
                    $('#frontendcamera-encoder_port').prop('readonly', false).val('');
                    $('#frontendcamera-encoder_username').prop('readonly', false).val('');
                    $('#frontendcamera-encoder_password').prop('readonly', false).val('');
                    $('#frontendcamera-protocol').prop('readonly', false).val('');
                    $('#frontendcamera-encoder_port').prop('readonly', false).val('');
                    $('#frontendcamera-encoder_model').prop('readonly', false).val('');
                }
            });
        })
        .change();
</script>