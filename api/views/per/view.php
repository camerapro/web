<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\PermissionGroup */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Permission Groups', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="permission-group-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Cập nhật', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Xóa?', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            [
                'attribute' => 'Danh sách quyền',
                'value' => \frontend\models\Permission::getPermissionName($model->permission_ids)
            ],
//            'permission_ids:ntext',
            'created_time',
            'status',
        ],
    ]) ?>

</div>
