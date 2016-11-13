<div class="modal-body">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <div class="modal-title new_recoder" id="myModalLabel">Sửa thông tin mới đầu ghi</div>

    </div>
    <p class="show_error"></p>
    <div class="modal-body">
        <div style="width: 95%;float: left;">
            <form id="recorder_modal" class="form-horizontal calender" role="form">
                <div class="form-group">
                    <label class="col-sm-3 control-label">Tên đầu ghi</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="title_encoder" name="name" value="<?= $model->name ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Ip/Domain</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="ip_address" name="ip" value="<?= $model->ip ?>" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Cổng media</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="media_port" name="media_port" value="<?= $model->media_port ?>" />
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-3 control-label">Cổng rtsp</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="port_stream" name="port_stream" value="<?= $model->port_stream ?>" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Tên truy cập</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="username" name="username" value="<?= $model->username ?>"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Mật khẩu</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="password" name="password" value="<?= $model->password ?>" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Giao thức</label>
                    <div class="col-sm-9">
                        <select aria-controls="datatable-responsive" class="form-control input-sm" id="protocol" name="protocol" autocomplete="off">
                            <option value="rtsp" <?php echo ($model->protocol == 'rtsp') ? 'selected' : ''?>>rtsp</option>
                            <option value="http" <?php echo ($model->protocol == 'http') ? 'selected' : ''?>>http</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Loại thiết bị</label>
                    <div class="col-sm-9">
                        <select aria-controls="datatable-responsive" class="form-control input-sm" id="encoder_model" name="model">
                            <option value="H264DVR">H264DVR</option>
                            <option value="HikVision">HikVision</option>
                            <option value="Dahua">Dahua</option>
                            <option value="Camera IP">Camera IP</option>
                            <option value="other">Loại khác</option>
                        </select>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="modal-header">
        <div class="modal-title new_recoder" id="myModalLabel">Thông tin camera</div>
    </div>

    <div class="modal-body" id="camera_info" style="border-top: 1px solid #e5e5e5">
        <div style="width: 95%;float: left;">
            <form id="camera_modal"  class="form-horizontal calender" role="form">
                <?php if(!empty($cams)):?>
                <div class="recorder_cams">
                <?php foreach ($cams as $cam):?>
                    <div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Camera <?= $cam->channel;?></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="title_camera" name="name" value="<?= $cam->name;?>" / >
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-9">
                                <button type="button" class="btn btn-default button_remove_cam">Xóa</button>
                                <input id="number_cam_show" type="hidden" value="<?= $cam->channel;?>" name="channel"/>
                            </div>
                        </div>
                    </div>
                <?php endforeach;?>
                </div>
                <?php endif;?>
                <div class="camera_info_item">
                <div class="form-group">
                    <label class="col-sm-3 control-label">Tên camera</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="title_camera" name="name">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Kênh</label>
                    <div class="col-sm-9">
                        <select aria-controls="datatable-responsive" class="form-control" id="channel" name="channel">
                            <?php for($i=0; $i<=15;$i++):?>
                                <option value="<?= $i?>"><?= $i ?></option>
                            <?php endfor;?>
                        </select>
                    </div>
                </div>
                </div>
            </form>

            <button type="button" class="btn btn-default" id="button_add">Thêm</button>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" id="update_camera" class="btn btn-primary antosubmit">Lưu</button>
        <button type="button" id="btn_recorder_close" class="btn btn-default antoclose" data-dismiss="modal">Đóng</button>
    </div>
    <input id="number_cam_show" type="hidden" value="1"/>
    <input id="recorder_id" type="hidden" value="<?= $model->id ?>"/>

</div>


<script>
    $(document).ready(function() {
    $(".button_remove_cam").on('click',function () {
        $(this).parent().parent().parent().remove();
    });
    $("#button_add").on('click',function () {
        var number_cam_show = $("#number_cam_show").attr('value');
        $.ajax({
            url: '/ajax/add_form_cam',
            type: "POST",
            data: {
                'number_cam_show':number_cam_show,
            } ,
            success: function (response) {
                data = JSON.parse(response);
                if(data['return_code'] == 0){
                    $(".camera_info_item .form-group:last-child").parent().append(data['return_html']);
                    $("#number_cam_show").val(data['number_cam_show'] );

                }
            },
        });
    });


    $('#update_camera').on('click', function() {
            var title_encoder = $('#title_encoder').val();
            var title_camera = $('#title_camera').val();
            var protocol = $('#protocol').val();
            var channel = $('#channel').val();
            var ip_address = $('#ip_address').val();
            var port = $('#port').val();
            var port_http = $('#port_http').val();
            var username = $('#username').val();
            var password = $('#password').val() ;
            var encoder_model = $('#encoder_model').val() ;
            var recorder_id = $('#recorder_id').val() ;
            if(title_encoder == ''){
                $('#title_encoder').focus();
                $('.show_error').html('Tên đầu ghi không được để trống');
            }else if(protocol == ''){
                $('#protocol').focus();
                $('.show_error').html('Giao thức không được để trống');
            }else if(channel == ''){
                $('#channel').focus();
                $('.show_error').html('Tên kênh không được để trống');
            }else if(ip_address == ''){
                $('#ip_address').focus();
                $('.show_error').html('Địa chỉ IP không được để trống');
            }else if(port == ''){
                $('#port').focus();
                $('.show_error').html('Cổng media không được để trống');
            }else if(username == ''){
                $('#username').focus();
                $('.show_error').html('Username không được để trống');
            }else if(port_http == ''){
                $('#port_http').focus();
                $('.show_error').html('Cổng đầu ghi không được để trống');
            }
            else {
                $.ajax({
                    url: '/ajax/update_camera',
                    type: "POST",
                    data: {
                        'recorder': $("#recorder_modal").serializeArray(),
                        'camera': $("#camera_modal").serializeArray(),
                        'recorder_id': recorder_id
                    } ,
                    success: function (response) {
                        data_res = JSON.parse(response);
                        if(data_res['return_code'] == 0){
                            alert(data_res['message']);
                            window.location.reload();
                        }else{
                            alert(data_res['message']);
                        }
                    },
                });
            }
    });

    });

</script>