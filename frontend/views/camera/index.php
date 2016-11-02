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
            <th style="width: 15%">Tên đăng nhập</th>
            <th style="width: 20%">Link Streaming</th>
            <th style="width: 10%">Giao thức</th>
            <th style="width: 5%">Trạng thái</th>
            <th style="width: 19%">Chỉnh sửa</th>
        </tr>
        </thead>
        <tbody class="tbody_view">
        <?php foreach ($models as $cam):?>
            <tr>
                <td><?= $cam->id;?></td>
                <td>
                    <?= $cam->name;?>
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
                    <?= isset(\frontend\models\RelationsCamUser::findOne(['cam_id'=>$cam->id, 'owner'=>1])->created_by_name) ? \frontend\models\RelationsCamUser::findOne(['cam_id'=>$cam->id, 'owner'=>1])->created_by_name : ''?>
                </td>
                <td>
                    <a href="<?=  Url::to(['site/index', 'id' => $cam->id])?>"><?= \common\components\Common::getLinkStream($cam->id);?></a>
                </td>
                <td class="project_progress">
                    <?= $cam->protocol;?>
                </td>
                <td>
                    <button type="button" class="btn btn-success btn-xs"><?= $cam->status;?></button>
                </td>
                <td>
                    <a href="<?=  Url::to(['camera/update', 'id' => $cam->id])?>" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Edit </a>
                    <a href="<?=  Url::to(['camera/delete', 'id' => $cam->id])?>" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> Delete </a>
                </td>
            </tr>
        <?php endforeach;?>

        </tbody>
    </table>
    <?php
    echo \yii\widgets\LinkPager::widget([
        'pagination' => $pages,
    ]);
    ?>
</div>