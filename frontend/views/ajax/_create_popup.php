<div class="modal-body">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <div class="modal-title new_recoder" id="myModalLabel">Tạo mới quyền</div>

    </div>
    <p class="show_error"></p>
    <div class="modal-body">
        <div style="width: 95%;float: left;">
            <form id="recorder_modal" class="form-horizontal calender" role="form">
                <div class="form-group w100 mt10 mb10">
                    <label class="col-sm-3 control-label">Tên quyền</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="per_name" name="name" />
                    </div>
                </div>
                <?php foreach ($list_permission as $per ):
                    $label = '';
                    if($per['id']== 1) {
                        $label = 'Giám sát';
                    }elseif($per['id']== 4){
                        $label = 'Báo cáo chấm công';
                    }elseif($per['id']== 21){
                        $label = 'Quản trị';
                    }elseif($per['id']== 39){
                        $label = 'Hướng dẫn';
                    }
                    ?>

                    <div class="form-group w100 mt10 mb10">
                        <?php if(!empty($label)):?>
                            <label class="w100"><?= $label;?></label>
                        <?php endif;?>
                        <input type="checkbox" id="<?= $per['id']?>_toggle" name="permission[<?= $per['id']?>][]" value="<?= $per['id']?>"  alt="select" onClick="do_this(<?= $per['id']?>)" />
                        <span class="mr10 ml5"><?= $per['name']?></span>
                        <?php foreach ($per['child'] as $child ):?>
                            <input type="checkbox" name="permission[<?= $per['id']?>][]" value="<?= $child['id']?>" />
                            <span class="mr10 ml5"><?= $child['name']?></span>
                        <?php endforeach;?>
                    </div>
                <?php endforeach;?>
            </form>
        </div>
    </div>

    <div class="modal-footer">
        <button type="button" id="create_per" class="btn btn-primary antosubmit">Lưu</button>
        <button type="button" id="btn_recorder_close" class="btn btn-default antoclose" data-dismiss="modal">Đóng</button>
    </div>
</div>


<script>
    $(document).ready(function() {

        $('#create_per').on('click', function() {
            var per_name = $('#per_name').val();
            if(per_name == ''){
                $('#per_name').focus();
                $('.show_error').html('Vui lòng nhập tên quyền');
            }
            else {
                var per_ids = [];
                $("#recorder_modal input[type=checkbox]:checked").each ( function() {
                    per_ids.push($(this).val());
                });
                console.log(JSON.stringify(per_ids));
                $.ajax({
                    url: '/ajax/create_per',
                    type: "POST",
                    data: {
                        'per_ids': per_ids,
                        'per_name': per_name
                    } ,
                    success: function (response) {
                        data_res = JSON.parse(response);
                        if(data_res['return_code'] == 0){
                            alert(data_res['message']);
                            var current_id = data_res['id'];
                            $("#permission").append('<option value='+current_id+'>'+ per_name +'</option>');
                            //close popup
                            $("#show_create_per .close").click();
                        }else{
                            alert(data_res['message']);
                        }
                    },
                });
            }
        });

    });

</script>