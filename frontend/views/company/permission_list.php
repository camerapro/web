
<select id="level" class="form-control" required  name="level">
    <?php
    $permission = \frontend\models\PermissionGroup::find()->where(['=', 'status', 1])->all();
    ?>
    <?php foreach ($permission as $item):?>
        <option <?= ($item->id ==$id) ? 'selected' : ''?> value="<?= $item->id?>"><?= $item->name?></option>
    <?php endforeach;?>
</select>