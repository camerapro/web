<video class="col-md-12 camera_video <?php  echo $check->status == 1 ? 'cam_enable' : 'cam_visible'?>" id=camera_video_<?= $check->id;?> >
    <source src="<?= $check->streaming_url;?>"  type="application/x-mpegURL">
</video>
<script>
    var player<?= $check->id;?> = videojs('camera_video_<?= $$check->id;?>');
    player<?= $check->id;?>.play();
</script>