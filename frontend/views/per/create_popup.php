<div class="modal-body">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <div class="modal-title new_recoder" id="myModalLabel">Vui lòng nhập đúng thông tin đầu ghi để xóa</div>

    </div>
    <p class="show_error"></p>
    <div class="modal-body">
        <div style="width: 95%;float: left;">
            <form id="recorder_modal" class="form-horizontal calender" role="form">
                <?php foreach ($list_permission as $per ):?>
                    <div class="form-group">
                        <input type="checkbox" id="<?= $per['id']?>_toggle" name="permission[<?= $per['id']?>][]" value="<?= $per['id']?>"  alt="select" onClick="do_this(<?= $per['id']?>)" <?= (in_array($per['id'], $list_permission_by_group))? 'checked' : '' ?>/>
                        <span><?= $per['name']?></span>
                        <?php foreach ($per['child'] as $child ):?>
                            <input type="checkbox" name="permission[<?= $per['id']?>][]" value="<?= $child['id']?>" <?= (in_array($child['id'], $list_permission_by_group))? 'checked' : '' ?>/>
                            <span><?= $child['name']?></span>
                        <?php endforeach;?>
                    </div>
                <?php endforeach;?>
            </form>
        </div>
    </div>

    <div class="modal-footer">
        <button type="button" id="delete_camera" class="btn btn-primary antosubmit">Xóa</button>
        <button type="button" id="btn_recorder_close" class="btn btn-default antoclose" data-dismiss="modal">Đóng</button>
    </div>
    <input id="recorder_id" type="hidden" value="<?= $model->id ?>"/>

</div>
