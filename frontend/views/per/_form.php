<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\PermissionGroup */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="permission-group-form">

    <?php $form = ActiveForm::begin(); ?>

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
        <?= Html::submitButton($model->isNewRecord ? 'Thêm mới' : 'Cập nhật', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>
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
</script>