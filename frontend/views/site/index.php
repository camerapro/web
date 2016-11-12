<div class="camera_view">
    <div class="camera_detail">
        <?php
//        print_r($cam_info->id);exit;
        if($cam_info):
            $recoder = \frontend\models\FrontendRecorder::findOne($cam_info->recorder_id);
            if($recoder):?>
            <?php
            $link_stream = \common\components\Common::getLinkStream($cam_info->id);
            if($recoder->protocol == 'http'){?>
                <video  class="col-md-12 camera_video" id=camera_video_<?= $cam_info->id;?> data-target="http">
                    <source src="<?= $link_stream;?>"  type="application/x-mpegURL">
                </video>
                <script>
                    var player<?= $cam_info->id;?> = videojs('camera_video_<?= $cam_info->id;?>');
                    player<?= $cam_info->id;?>.play();
                </script>
            <?php }else{
            if (strpos($_SERVER['HTTP_USER_AGENT'], 'Chrome') !== false  || strpos($_SERVER['HTTP_USER_AGENT'], 'CriOS') !== false) {?>
                <div class="vxgplayer" id="vxg_media_player_<?= $cam_info->id;?>" url="<?= $link_stream;?>" width="720" height="480"
                     nmf-src="/player/pnacl/Release/media_player.nmf"  nmf-path="media_player.nmf" useragent-prefix="MMP/3.0" latency="10000"  autohide="2"
                     volume="0.7"  autostart=true avsync  mute aspect-ratio aspect-ratio-mode="1" auto-reconnect>
                </div>
                <script>
                    $(document).ready(function() {
                        var height = $(window).height();
                        var width = $(window).width();
                        $('.camera_detail').css('height',height-80);
                        $('.camera_detail').css('width',width - 240);
                    });
                </script>
            <?php }else{ ?>

                <embed  windowless="true" data-target="rtsp" id="camera_video_<?= $cam_info->id;?>"  type="application/x-google-vlc-plugin" version="VideoLAN.VLCPlugin.2" autoplay="yes" loop="no" width="100%" height="100%"
                        target="<?= $link_stream;?>" ></embed>
                <script>
                    $(document).ready(function() {
                        var height = $(window).height();
                        $('.camera_detail').css('height',height - 80);
                    });
                </script>
            <?php }} ?>
        <?php elseif($message):?>
            <?= $message; ?>
        <?php endif;?>
        <?php endif;?>
    </div>
</div>


<div id="CalenderModalNew" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" style="width: 980px">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <div class="modal-title new_recoder" id="myModalLabel">Thêm mới đầu ghi</div>
                <div class="title_select_recoder">Chọn đầu ghi</div>
                <?php
                $recoders = \frontend\models\FrontendRecorder::getRecorderById();
                ?>
                <select name="datatable-responsive_length" aria-controls="datatable-responsive" class="form-control input-sm recoder_sl" id="recorder_id" name="recorder_id">
                    <option value="0">Tạo đầu ghi mới</option>
                    <?php foreach ($recoders as $item){ ?>
                        <option value="<?= $item['id'];?>"><?= $item['name'];?></option>
                    <?php } ?>
                </select>
            </div>
            <p class="show_error"></p>
            <div class="modal-body">
                <div style="width: 95%;float: left;">
                    <form id="recorder_modal" class="form-horizontal calender" role="form">
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
            <div class="modal-header">
                <div class="modal-title new_recoder" id="myModalLabel">Thông tin camera</div>
            </div>

            <div class="modal-body" id="camera_info" style="border-top: 1px solid #e5e5e5">
                <div style="width: 95%;float: left;">
                    <form id="camera_modal" class="camera_info_item form-horizontal calender" role="form">
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
                                    <?php for($i=1; $i<=16;$i++):?>
                                        <option value="<?= $i?>"><?= $i ?></option>
                                    <?php endfor;?>
                                </select>
                            </div>
                        </div>
                    </form>

                    <button type="button" class="btn btn-default" id="button_add">Thêm</button>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" id="save_and_create" class="btn btn-primary antosubmit">Lưu</button>
                <button type="button" class="btn btn-default antoclose" data-dismiss="modal">Đóng</button>
            </div>
            <input id="number_cam_show" type="hidden" value="1"/>
        </div>
    </div>
</div>

</div>

<script>
    $(document).ready(function() {
        var height_camshow = $('.cam_show').height();
        var height = $(window).height();
        if(height_camshow > 600){
            $('.cam_show').css('overflow-y','scroll');
        }
        $("#media_port").val('34567');
        $("#port_stream").val('554');
        $('#protocol').val('rtsp');

    });
    $('body').on('hidden.bs.modal', '.modal', function () {
        alert('1');
        $(".modal-content").empty();
    });
    $( "#recorder_id" ) .change(function () {
            $( "#recorder_id option:selected" ).each(function() {
                var id_recoder = $( this ).val();
                if(id_recoder != 0){
                    $.ajax({
                        url: '/ajax/encorder_info',
                        type: "POST",
                        data: {
                            'id_recoder':id_recoder,
                        } ,
                        success: function (response) {
                            data_res = JSON.parse(response);
                            if(data_res['return_code'] == 0){
                                $('#title_encoder').prop('readonly', 'readonly').val(data_res['data']['name']);
                                $('#protocol').prop('readonly', 'readonly').val(data_res['data']['protocol']);
                                $('#encoder_model').prop('readonly', 'readonly').val(data_res['data']['model']);
                                $('#port_stream').prop('readonly', 'readonly').val(data_res['data']['port_stream']);
                                $('#media_port').prop('readonly', 'readonly').val(data_res['data']['media_port']);
                                if(lever >=3){
                                    $('#ip_address').prop('readonly', 'readonly').val(data_res['data']['ip']);
                                    $('#username').prop('readonly', 'readonly').val(data_res['data']['username']);
                                    $('#password').prop('readonly', 'readonly').val(data_res['data']['password']);
                                }
                            }
                        },
                    });
                }else{
                    $('#title_encoder').prop('readonly', false).val('');
                    $('#ip_address').prop('readonly', false).val('');
                    $('#port_stream').prop('readonly', false).val('554');
                    $('#media_port').prop('readonly', false).val('34567');
                    $('#username').prop('readonly', false).val('');
                    $('#password').prop('readonly', false).val('');
                    $('#protocol').prop('readonly', false).val('');
                    $('#encoder_model').prop('readonly', false).val('');
                }
            });
        }) .change();

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


</script>