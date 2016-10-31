$( document ).ready(function() {
    $('.cam_name').on('click', function() {
        var cam_id = $(this).attr('value');
        var current_cam_id  = $(this).parent().parent().parent().find('.cam_select').attr('value');

        $(this).parent().parent().parent().find('.cam_select').removeClass('cam_select');
        $('.cam_number_' + cam_id + ' li a').addClass('cam_select');
        var protocol = $('#camera_video_' + current_cam_id).attr('data-target');
        if(protocol == 'http'){
            var player = videojs('camera_video_' + current_cam_id);
            player.dispose();
        }else{
            vxgplayer('vxg_media_player_' + current_cam_id).stop();
        }
        $.ajax({
            url: '/ajax/play',
            type: "POST",
            data: {
                'cam_id':cam_id,
            } ,
            success: function (response) {
                data = JSON.parse(response);
                if(data['return_code'] == 0){
                    $('.camera_detail').html(data['return_html']);
                }
            },


        });

    });
    $('#save_and_create').on('click', function() {
        var title_encoder = $('#title_encoder').val();
        var title_camera = $('#title_camera').val();
        var protocol = $('#protocol').val();
        var channel = $('#channel').val();
        var ip_address = $('#ip_address').val();
        var port = $('#port').val();
        var port_http = $('#port_http').val();
        var username = $('#username').val();
        var password = $('#password').val() ;
        var encoder_type = $('#encoder_model').val() ;
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
            $('.show_error').html('Cổng rtsp không được để trống');
        }else if(username == ''){
            $('#username').focus();
            $('.show_error').html('Username không được để trống');
        }else if(port_http == ''){
            $('#port_http').focus();
            $('.show_error').html('Cổng media không được để trống');
        }
        else {
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
                    'password':password,
                    'port_http':port_http
                } ,
                success: function (response) {
                    data_res = JSON.parse(response);
                    if(data_res['return_code'] == 0){
                        alert(data_res['message']);
                        $('#title_camera').val('');
                        $('#channel').val('');
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
            var encoder_model = $('#encoder_model').val() ;
            var port_http = $('#port_http').val();

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
                        'port_http':port_http,
                        'username':username,
                        'password':password,
                        'encoder_model':encoder_model
                    } ,
                    success: function (response) {
                        data_res = JSON.parse(response);
                        if(data_res['return_code'] == 0){
                            // alert(data_res['message']);
                            $('.modal-backdrop').hide();
                            $('#CalenderModalNew').hide();
                            $('body').removeClass('modal-open');
                        }
                    },
                });
            }
        }
    );

});

