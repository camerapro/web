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
});

