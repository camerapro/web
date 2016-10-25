<?php if($cam_info->protocol == 'http'): ?>
    <video class="col-md-12 camera_video <?php  echo $cam_info->status == 1 ? 'cam_enable' : 'cam_visible'?>" id=camera_video_<?= $cam_info->id;?> >
        <source src="<?= $cam_info->streaming_url;?>"  type="application/x-mpegURL">
    </video>
    <script>
        var player<?= $cam_info->id;?> = videojs('camera_video_<?= $cam_info->id;?>');
        player<?= $cam_info->id;?>.play();
    </script>
<?php else: ?>
    <embed data-target="rtsp" id="camera_video_<?= $cam_info->id;?>"  type="application/x-google-vlc-plugin" version="VideoLAN.VLCPlugin.2" autoplay="yes" loop="no" width="100%" height="100%"
           target="rtsp://astechvietnam.myq-see.com:554/user=admin&password=&channel=6&stream=1.sdp" ></embed>
    <script>
        $(document).ready(function() {
            var height = $(window).height();
            $('.camera_detail').css('height',height - 80);
        });
    </script>
<?php endif; ?>
