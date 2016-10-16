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
        $(this).removeClass('icon_shutdown').addClass('icon_play');
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
             $('#camera_video_' + cam_id).removeClass('cam_enable').addClass('cam_visible');

            }
         },
         });
    });

    $('.icon_play').on('click', function() {
        $(this).removeClass('icon_play').addClass('icon_shutdown');
        var cam_id = $(this).attr('value');
        //ajax update status
        $.ajax({
            url: '/ajax/update_cam',
            type: "POST",
            data: {
                'cam_id':cam_id,
                'status':1
            } ,
            success: function (response) {
                data = JSON.parse(response);
                if(data['return_code'] == 0){
                    var player = videojs('camera_video_' + cam_id);
                    player.play();
                    $('#camera_video_' + cam_id).removeClass('cam_visible').addClass('cam_enable');

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
