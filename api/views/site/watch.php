<?php
$cams = \frontend\models\Camera::getListCam();
?>
<div class="camera_view">
    <?php foreach ($cams as $cam):?>
        <video class="col-md-12 col-sm-12 col-la-12 camera_video <?php  echo $cam->status == 1 ? 'cam_enable' : 'cam_visible'?>" id=camera_video_<?= $cam->id;?> >
            <source src="<?= $cam->streaming_url;?>"  type="application/x-mpegURL">
        </video>
    <?php endforeach;?>
    <script>
        var player<?= $cams[0]->id;?> = videojs('camera_video_<?= $cams[0]->id;?>');
        player<?= $cams[0]->id;?>.play();
    </script>
</div>

<div id="CalenderModalNew" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="myModalLabel">Thêm mới camera</h4>
            </div>
            <p class="show_error"></p>
            <div class="modal-body">
                <div id="testmodal" style="width: 75%;float: left;">
                    <form id="antoform" class="form-horizontal calender" role="form">
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Tên đầu ghi</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="title_encoder" name="title_encoder">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Tên camera</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="title_camera" name="title_camera">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Giao thức</label>
                            <div class="col-sm-9">
                                <select name="datatable-responsive_length" aria-controls="datatable-responsive" class="form-control input-sm" id="protocol" name="protocol">
                                    <option value="http">http</option>
                                    <option value="rtsp">rtsp</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Kênh</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="channel" name="channel">
                            </div>
                        </div> <div class="form-group">
                            <label class="col-sm-3 control-label">Ip Address</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="ip_address" name="ip_address">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Port</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="port" name="port">
                            </div>
                        </div> <div class="form-group">
                            <label class="col-sm-3 control-label">Tên người dùng</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="username" name="username">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Mật khẩu</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="password" name="password">
                            </div>
                        </div>
                    </form>

                </div>
                <div id="cammodal" style="width: 25%; float: left;">
                    <img src="../images/picture.jpg">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" id="save_and_create" class="btn btn-primary antosubmit">Lưu và thêm mới</button>
                <button type="button" id="save_and_close" class="btn btn-primary antoclose">Lưu và đóng</button>
                <button type="button" class="btn btn-default antoclose" data-dismiss="modal">Đóng</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#save_and_create').on('click', function() {
            var validate = 1;
            var title_encoder = $('#title_encoder').val();
            var title_camera = $('#title_camera').val();
            var protocol = $('#protocol').val();
            var channel = $('#channel').val();
            var ip_address = $('#ip_address').val();
            var port = $('#port').val();
            var username = $('#username').val();
            var password = $('#password').val();
            if(title_encoder == ''){
                $('#title_encoder').focus();
                $('.show_error').html('Tên đầu ghi không được để trống');
            }else if(title_camera == ''){
                $('#title_camera').focus();
                $('.show_error').html('Tên camera không được để trống');
            }else if(protocol == ''){
                $('#protocol').focus();
                $('.show_error').html('Protocol không được để trống');
            }else if(channel == ''){
                $('#channel').focus();
                $('.show_error').html('Tên kênh không được để trống');
            }else if(ip_address == ''){
                $('#ip_address').focus();
                $('.show_error').html('Địa chỉ IP không được để trống');
            }else if(port == ''){
                $('#port').focus();
                $('.show_error').html('Port không được để trống');
            }else if(username == ''){
                $('#username').focus();
                $('.show_error').html('Username không được để trống');
            }else if(password == ''){
                $('#password').focus();
                $('.show_error').html('Mật khẩu không được để trống');
            }else {
                $.ajax({
                    url: '/watch/create',
                    type: "POST",
                    data: {
                        'title_encoder':title_encoder,
                        'title_camera':title_camera,
                        'protocol':protocol,
                        'channel':channel,
                        'ip_address':ip_address,
                        'port':port,
                        'username':username,
                        'password':password
                    } ,
                    success: function (response) {
                        data = JSON.parse(response);
                        if(data['return_code'] == 0){
                            alert(data['message']);
                            $('#title_encoder').val('');
                            $('#title_camera').val('');
                            $('#channel').val('');
                            $('#ip_address').val('');
                            $('#port').val('');
                            $('#username').val('');
                            $('#password').val('');
                        }
                    },


                });
            }

        });

        $('#save_and_close').on('click', function() {

                var validate = 1;
                var title_encoder = $('#title_encoder').val();
                var title_camera = $('#title_camera').val();
                var protocol = $('#protocol').val();
                var channel = $('#channel').val();
                var ip_address = $('#ip_address').val();
                var port = $('#port').val();
                var username = $('#username').val();
                var password = $('#password').val();
                if(title_encoder == ''){
                    $('#title_encoder').focus();
                    $('.show_error').html('Tên đầu ghi không được để trống');
                }else if(title_camera == ''){
                    $('#title_camera').focus();
                    $('.show_error').html('Tên camera không được để trống');
                }else if(protocol == ''){
                    $('#protocol').focus();
                    $('.show_error').html('Protocol không được để trống');
                }else if(channel == ''){
                    $('#channel').focus();
                    $('.show_error').html('Tên kênh không được để trống');
                }else if(ip_address == ''){
                    $('#ip_address').focus();
                    $('.show_error').html('Địa chỉ IP không được để trống');
                }else if(port == ''){
                    $('#port').focus();
                    $('.show_error').html('Port không được để trống');
                }else if(username == ''){
                    $('#username').focus();
                    $('.show_error').html('Username không được để trống');
                }else if(password == ''){
                    $('#password').focus();
                    $('.show_error').html('Mật khẩu không được để trống');
                }else {
                    $.ajax({
                        url: '/ajax/create',
                        type: "POST",
                        data: {
                            'title_encoder':title_encoder,
                            'title_camera':title_camera,
                            'protocol':protocol,
                            'channel':channel,
                            'ip_address':ip_address,
                            'port':port,
                            'username':username,
                            'password':password
                        } ,
                        success: function (response) {
                            data = JSON.parse(response);
                            if(data['return_code'] == 0){
                                alert(data['message']);
                                $('#CalenderModalNew').modal('hide');
                            }
                        },


                    });
                }
            }
        );

    });
</script>