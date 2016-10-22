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

    $('.cam_name').on('click', function() {
        var cam_id = $(this).attr('value');
        var current_cam_id  = $(this).parent().parent().parent().find('.cam_select').attr('value');
        $(this).parent().parent().parent().find('.cam_select').removeClass('cam_select');
        $('.cam_number_' + cam_id + ' li a').addClass('cam_select');
        var player = videojs('camera_video_' + current_cam_id);
        player.dispose();
        $.ajax({
            url: '/ajax/play',
            type: "POST",
            data: {
                'cam_id':cam_id,
            } ,
            success: function (response) {
                data = JSON.parse(response);
                if(data['return_code'] == 0){
                    $('.camera_view').html(data['return_html']);
                }
            },


        });

    });

/*    $('.icon_shutdown').on('click', function() {
        $(this).removeClass('icon_shutdown').addClass('icon_play');
        var cam_id = $(this).attr('value');
        //ajax update status
        $.ajax({
         url: '/ajax/update_cam',
         type: "POST",
         data: {
         'cam_id':cam_id,
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
    });*/

    /*$('.icon_play_shut').on('click', function() {
        var here = $(this);
        var cam_id = $(this).attr('value');
        //ajax update status
        $.ajax({
            url: '/ajax/update_cam',
            type: "POST",
            data: {
                'cam_id':cam_id,
            } ,
            success: function (response) {
                data = JSON.parse(response);
                if(data['return_code'] == 0){
                    if(data['check_status'] ==1){
                        var player = videojs('camera_video_' + cam_id);
                        player.play();
                        here.removeClass('icon_play').addClass('icon_shutdown');
                        $('#camera_video_' + cam_id).removeClass('cam_visible').addClass('cam_enable');
                    }else {
                        var player = videojs('camera_video_' + cam_id);
                        player.pause();
                        here.removeClass('icon_shutdown').addClass('icon_play');
                        $('#camera_video_' + cam_id).removeClass('cam_enable').addClass('cam_visible');
                    }


                }
            },
        });
    });*/

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

