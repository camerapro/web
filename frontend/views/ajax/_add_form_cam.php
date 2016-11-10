<div class="form-group">
    <label class="col-sm-3 control-label">Tên camera</label>
    <div class="col-sm-9">
        <input type="text" class="form-control" id="title_camera" name="name">
    </div>
</div>
<div class="form-group">
    <label class="col-sm-3 control-label">Kênh</label>
    <div class="col-sm-9">
        <select aria-controls="datatable-responsive" class="form-control" id="channel" name="channel">
            <?php for($i=1; $i<=16;$i++):?>
                <option value="<?= $i?>"><?= $i ?></option>
            <?php endfor;?>
        </select>
    </div>
</div>