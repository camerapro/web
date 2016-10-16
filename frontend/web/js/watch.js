$( document ).ready(function() {
    $('.icon_rec_1').on('click', function() {
        $('.camera_view').children().removeClass('col-md-6').removeClass('col-md-12').removeClass('col-md-4').removeClass('col-md-3').addClass('col-md-12');
    });
    $('.icon_rec_4').on('click', function() {
        $('.camera_view').children().removeClass('col-md-6').removeClass('col-md-12').removeClass('col-md-4').removeClass('col-md-3').addClass('col-md-6');
    });
    $('.icon_rec_9').on('click', function() {
        $('.camera_view').children().removeClass('col-md-6').removeClass('col-md-12').removeClass('col-md-4').removeClass('col-md-3').addClass('col-md-4');
    });
    $('.icon_rec_16').on('click', function() {
        $('.camera_view').children().removeClass('col-md-6').removeClass('col-md-12').removeClass('col-md-4').removeClass('col-md-3').addClass('col-md-3');
    });
    $('.icon_shutdown').on('click', function() {
        var cam_id = $(this).attr('value');
        //ajax update status
        $.ajax({
         url: '/ajax/update_cam',
         type: "POST",
         data: {
         'cam_id':cam_id,
         'status':0
         } ,
         success: function (response) {
         data = JSON.parse(response);
         if(data['return_code'] == 0){
             var player = videojs('camera_video_' + cam_id);
             player.pause();
             $('#camera_video_' + cam_id).css('display','none');
             $('.cam_number_' + cam_id).css('display','none');

            }
         },
         });
    });

    $('.icon_capture').on('click', function() {
        var cam_id = $(this).attr('value');
        var player = videojs('camera_video_' + cam_id);
        setTimeout(function(){
            player.play();
        }, 1000);
        player.pause()
        // var cam_id = $(this).attr('value');
        // var player = videojs('camera_video_' + cam_id);
        // player.pause();
        // player.play();
        // setTimeout(player.play(),5000);
        ;
    });
});

