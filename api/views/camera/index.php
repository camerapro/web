<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;


/* @var $this yii\web\View */
/* @var $searchModel frontend\models\CameraSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Quản lý camera';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="camera-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Thêm mới camera', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <table class="table table-striped projects">
        <thead>
        <tr>
            <th style="width: 1%">#</th>
            <th style="width: 15%">Tên camera</th>
            <th style="width: 15%">Tên Đầu ghi</th>
            <th style="width: 15%">Kênh</th>
            <th style="width: 20%">Link Streaming</th>
            <th style="width: 10%">Giao thức</th>
            <th style="width: 5%">Trạng thái</th>
            <th style="width: 19%">Chỉnh sửa</th>
        </tr>
        </thead>
        <tbody class="tbody_view">
        <?php foreach ($cams as $cam):?>
            <tr>
                <td><?= $cam->id;?></td>
                <td>
                    <a href="<?=  Url::to(['camera/view', 'id' => $cam->id])?>"><?= $cam->name;?></a>
                    <br />
                    <small>Ngày tạo: <?= date('H:i:s d-m-Y', strtotime($cam->created_time));?></small>
                </td>
                <td>
                    <?= $cam->encoder_name;?>
                </td>
                <td>
                    <?= $cam->channel;?>
                </td>
                <td>
                    <a href="<?=  Url::to(['site/index', 'id' => $cam->id])?>"><?= $cam->streaming_url;?></a>
                </td>
                <td class="project_progress">
                    <?= $cam->protocol;?>
                </td>
                <td>
                    <button type="button" class="btn btn-success btn-xs"><?= $cam->status;?></button>
                </td>
                <td>
                    <a href="<?=  Url::to(['camera/view', 'id' => $cam->id])?>" class="btn btn-primary btn-xs"><i class="fa fa-folder"></i> View </a>
                    <a href="<?=  Url::to(['camera/update', 'id' => $cam->id])?>" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Edit </a>
                    <a href="<?=  Url::to(['camera/delete', 'id' => $cam->id])?>" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> Delete </a>
                </td>
            </tr>
        <?php endforeach;?>

        </tbody>
    </table>
</div>
