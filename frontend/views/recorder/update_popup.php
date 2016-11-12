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
        <div class="modal-title new_recoder" id="myModalLabel">Nhập thông tin mới của đầu ghi</div>
    </div>

    <div class="modal-body" id="recorder_new_info" style="border-top: 1px solid #e5e5e5">
        <div style="width: 95%;float: left;">
            <form id="recorder_new_info_modal" class="form-horizontal calender" role="form">
                <div class="form-group">
                    <label class="col-sm-3 control-label">Tên đầu ghi</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="title_encoder" name="name">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Ip/Domain</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="ip_address" name="ip">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Cổng media</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="media_port" name="media_port">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-3 control-label">Cổng rtsp</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="port_stream" name="port_stream">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Tên truy cập</label>
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
                <div class="form-group">
                    <label class="col-sm-3 control-label">Giao thức</label>
                    <div class="col-sm-9">
                        <select aria-controls="datatable-responsive" class="form-control input-sm" id="protocol" name="protocol">
                            <option value="rtsp">rtsp</option>
                            <option value="http">http</option>
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
    <input id="recorder_id" type="hidden" value="<?= $model->id ?>"/>
    <div class="modal-footer">
        <button type="button" id="update_recorder" class="btn btn-primary antosubmit">Lưu</button>
        <button type="button" id="btn_recorder_close" class="btn btn-default antoclose" data-dismiss="modal">Đóng</button>
    </div>
</div>


<script>
    $(document).ready(function() {
        $('#update_recorder').on('click', function () {
            var title_encoder = $('#recorder_new_info #title_encoder').val();
            var title_camera = $('#recorder_new_info #title_camera').val();
            var protocol = $('#recorder_new_info #protocol').val();
            var channel = $('#recorder_new_info #channel').val();
            var ip_address = $('#recorder_new_info #ip_address').val();
            var port = $('#recorder_new_info #port').val();
            var port_http = $('#recorder_new_info #port_http').val();
            var username = $('#recorder_new_info #username').val();
            var password = $('#recorder_new_info #password').val();
            var encoder_model = $('#recorder_new_info #encoder_model').val();
            var recorder_id = $('#recorder_id').val();
            if (title_encoder == '') {
                $('#recorder_new_info #title_encoder').focus();
                $('.show_error').html('Tên đầu ghi mới không được để trống');
            } else if (title_camera == '') {
                $('#recorder_new_info #title_camera').focus();
                $('.show_error').html('Tên camera mới không được để trống');
            } else if (protocol == '') {
                $('#recorder_new_info #protocol').focus();
                $('.show_error').html('Giao thức mới không được để trống');
            } else if (channel == '') {
                $('#recorder_new_info #channel').focus();
                $('.show_error').html('Tên kênh mới không được để trống');
            } else if (ip_address == '') {
                $('#recorder_new_info #ip_address').focus();
                $('.show_error').html('Địa chỉ IP mới không được để trống');
            } else if (port == '') {
                $('#recorder_new_info #port').focus();
                $('.show_error').html('Cổng media mới không được để trống');
            } else if (username == '') {
                $('#recorder_new_info #username').focus();
                $('.show_error').html('Username mới không được để trống');
            } else if (port_http == '') {
                $('#recorder_new_info #port_http').focus();
                $('.show_error').html('Cổng đầu ghi mới không được để trống');
            }
            else {
                $.ajax({
                    url: '/ajax/update_recorder',
                    type: "POST",
                    data: {
                        'recorder_old': $("#recorder_modal").serializeArray(),
                        'recorder_new': $("#recorder_new_info_modal").serializeArray(),
                        'recorder_id': recorder_id
                    },
                    success: function (response) {
                        data_res = JSON.parse(response);
                        if (data_res['return_code'] == 0) {
                            alert(data_res['message']);
                            window.location.reload();
                        } else {
                            alert(data_res['message']);
                        }
                    },
                });
            }
        });

    });

</script>