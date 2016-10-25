<div class="camera_view">
    <div class="camera_detail">
     <?php if($cam_info):?>
     <?php if($cam_info->protocol == 'http'):?>
         <video  class="col-md-12 camera_video" id=camera_video_<?= $cam_info->id;?> data-target="http">
             <source src="<?= $cam_info->streaming_url;?>"  type="application/x-mpegURL">
         </video>
     <script>
         var player<?= $cam_info->id;?> = videojs('camera_video_<?= $cam_info->id;?>');
         player<?= $cam_info->id;?>.play();
     </script>
         <?php else:?>
             <div style="width:500px; height:400px; position:relative;">

                 <embed type="application/x-vlc-plugin" pluginspage="http://www.videolan.org"
                        version="VideoLAN.VLCPlugin.2" id="vlc1"
                        style="z-index:-1; position:absolute; left:0px; top:0px; width:100%; height:100%"
                        windowless="true"
                        text="Waiting for Video..." />

                 <div style="z-index:0; position:absolute; left:0px; top:0px; width:100%; height:100%; color:white" id="pano1">
                     Overlay
                 </div>

             </div>

         <?php endif;?>
     <?php elseif($message):?>
         <?= $message; ?>
     <?php endif;?>
    </div>
</div>

<div id="CalenderModalNew" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" style="width: 980px">
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

</div>

<script>
    $(document).ready(function() {
        var height_camshow = $('.cam_show').height();
        var height = $(window).height();
        $('.cam_show').css('max-height',height - 140);
        if(height_camshow > 600){
            $('.cam_show').css('overflow-y','scroll');
        }
    });
</script>