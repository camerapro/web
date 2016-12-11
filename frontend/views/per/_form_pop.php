<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\PermissionGroup */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="modal-body">
<div class="permission-group-form">

    <?php $form = ActiveForm::begin(['enableAjaxValidation'=>true,
        'validateOnSubmit'=>true]); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?php foreach ($list_permission as $list_ids ):?>

        <div class="form-group">
            <label class="w100"><?= $list_ids['name'];?></label>
            <?php foreach ($list_ids['list_ids'] as $per ): //print_r($per);exit;     ?>
                <div class="form-group">
                    <input type="checkbox" id="<?= $per['id']?>_toggle" name="permission[<?= $per['id']?>][]" value="<?= $per['id']?>"  alt="select" onClick="do_this(<?= $per['id']?>)" <?= (in_array($per['id'], $list_permission_by_group))? 'checked' : '' ?>/>
                    <span><?= $per['name']?></span>
                    <?php foreach ($per['child'] as $child ):?>
                        <input type="checkbox" name="permission[<?= $per['id']?>][]" value="<?= $child['id']?>" <?= (in_array($child['id'], $list_permission_by_group))? 'checked' : '' ?>/>
                        <span><?= $child['name']?></span>
                    <?php endforeach;?>
                </div>
            <?php endforeach;?>
        </div>

    <?php endforeach;?>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Thêm mới' : 'Cập nhật', ['class' => $model->isNewRecord ? 'btn btn-success main-form-btn' : 'btn btn-primary main-form-btn']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
</div>
<script type="text/javascript">

    function do_this(id){
        var checkboxes = document.getElementsByName('permission[' + id +'][]');
        var button = document.getElementById(id + '_toggle');

        if(button.alt == 'select'){
            for (var i in checkboxes){
                checkboxes[i].checked = 'FALSE';
            }
            button.alt = 'deselect'
        }else{
            for (var i in checkboxes){
                checkboxes[i].checked = '';
            }
            button.alt = 'select';
        }
    }
    $('.main-form-btn').click(function(){
        $.ajax({
            url: '/per/create',
            type: "POST",
            data: $('.permission-group-form form').serializeArray(),
            success: function (response) {
                data_res = JSON.parse(response);
                if(data_res['return_code'] == 0){
                    alert(data_res['message']);
                    var id = data_res['data'];
                    $.get( "/company/index?type=perlist&id="+id, function( data ) {
                        $( "#list-permission" ).html( data );

                    });
                    this.modal("close");
                    return false;
                }else{
                    alert(data_res['message']);
                }
            },
        });
        return false;
    });
</script>