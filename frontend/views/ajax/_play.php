<?php if($cam_info->protocol == 'http'){?>
    <video  class="col-md-12 camera_video" id=camera_video_<?= $cam_info->id;?> data-target="http">
        <source src="<?= $cam_info->streaming_url;?>"  type="application/x-mpegURL">
    </video>
    <script>
        var player<?= $cam_info->id;?> = videojs('camera_video_<?= $cam_info->id;?>');
        player<?= $cam_info->id;?>.play();
    </script>
<?php }else{
    if (strpos($_SERVER['HTTP_USER_AGENT'], 'Chrome') !== false  || strpos($_SERVER['HTTP_USER_AGENT'], 'CriOS') !== false) {?>
        <div class="vxgplayer"
             id="vxg_media_player1"
             width="720"
             height="480"
             url="<?= $cam_info->streaming_url;?>"
             nmf-src="/player/pnacl/Release/media_player.nmf"
             nmf-path="media_player.nmf"
             useragent-prefix="MMP/3.0"
             latency="10000"
             autohide="2"
             volume="0.7"
             autostart=true
             avsync
             mute
             aspect-ratio
             aspect-ratio-mode="1"
             auto-reconnect>
        </div>
        <script>
            $(document).ready(function() {
                var height = $(window).height();
                var width = $(window).width();
                $('.vxgplayer').css('height',height - 80);
                $('.vxgplayer').css('width',width - 240);
            });
        </script>
    <?php }else{ ?>

        <embed  windowless="true" data-target="rtsp" id="camera_video_<?= $cam_info->id;?>"  type="application/x-google-vlc-plugin" version="VideoLAN.VLCPlugin.2" autoplay="yes" loop="no" width="100%" height="100%"
                target="<?= $cam_info->streaming_url;?>" ></embed>
        <script>
            $(document).ready(function() {
                var height = $(window).height();
                $('.camera_detail').css('height',height - 80);
            });
        </script>
    <?php }} ?>
