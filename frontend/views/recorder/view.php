<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\FrontendRecorder */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Frontend Recorders', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="frontend-recorder-view">

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
            'username',
            'password',
            'protocol',
            'media_port',
            'port_stream',
            'port',
            'params',
            'activation_time',
            'created_time',
            'updated_time',
            'order',
            'status',
            'user_id',
            'agency_id',
            'model',
            'channels:ntext',
        ],
    ]) ?>

</div>
