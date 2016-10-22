<div class="row">
        <div class="col-xs-5">
            <select name="from" id="multiselect" class="form-control" size="<?= count($list_cam);?>" multiple="multiple">
                <?php foreach ($list_cam as $cam):?>
                    <option value="<?= $cam->id?>"><?= $cam->name?></option>
                <?php endforeach;?>
            </select>
        </div>
        <div class="col-xs-2">
            <button type="button" id="multiselect_rightAll" class="btn btn-default btn-block"><i class="glyphicon glyphicon-forward"></i></button>
            <button type="button" id="multiselect_rightSelected" class="btn btn-default btn-block"><i class="glyphicon glyphicon-chevron-right"></i></button>
            <button type="button" id="multiselect_leftSelected" class="btn btn-default btn-block"><i class="glyphicon glyphicon-chevron-left"></i></button>
            <button type="button" id="multiselect_leftAll" class="btn btn-default btn-block"><i class="glyphicon glyphicon-backward"></i></button>
        </div>
        <div class="col-xs-5">
            <select name="to" id="multiselect_to" class="form-control" size="<?= count($list_cam);?>" multiple="multiple">
                <?php foreach ($list_cam_granded as $cam):?>
                    <option value="<?= $cam->id?>"><?= $cam->name?></option>
                <?php endforeach;?>
            </select>
        </div>
        <div class="form-group">
            <div class="col-md-6 col-md-offset-3">
                <button type="cancel" onclick="javascript:window.location='<?=\yii\helpers\Url::base()?>/user/index';" class="btn btn-primary">&nbsp;&nbsp;&nbsp;&nbsp;  Đóng&nbsp;&nbsp; &nbsp;&nbsp; </button>
                <button id="send" type="submit" class="btn btn-success">&nbsp;&nbsp; &nbsp;&nbsp; Lưu&nbsp;&nbsp; &nbsp;&nbsp; </button>
            </div>
        </div>
</div>
<script>
    $('#multiselect').multiselect();

    $('#send').on('click',function () {
        var selectedValues = [];
        $("#multiselect_to option").each(function(){
            selectedValues.push($(this).val());
        });
        $.ajax({
            url: '/ajax/grandcam',
            type: "POST",
            data: {
                'cam_ids':selectedValues,
            } ,
            success: function (response) {
                data = JSON.parse(response);
                if(data['return_code'] == 0){
                    alert('Gán cam thành công!');
                }else {
                    alert('Có lỗi xảy ra, vui lòng liên hệ kỹ thuật!');
                }
            },


        });
    })
</script>