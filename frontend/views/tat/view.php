<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\TatFrontend */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Tat Frontends', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tat-frontend-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
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
            'category_id',
            'ip',
            'port',
            'protocol',
            'created_time',
            'updated_time',
            'description',
            'order',
            'camera_main_id',
            'camera_secondary_id',
            'user_id',
            'agency_id',
            'status',
            'camera_ip',
            'camera_port',
            'camera_channel',
            'camera_username',
            'camera_password',
            'camera_model',
            'expired_time',
            'company',
        ],
    ]) ?>

</div>
