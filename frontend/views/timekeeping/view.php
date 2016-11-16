<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\TimekeepingFrontend */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Timekeeping Frontends', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="timekeeping-frontend-view">

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
            'status',
            'card_code',
            'staff_name',
            'tap_id',
            'type',
            'created_time',
            'image:ntext',
            'staff_id',
        ],
    ]) ?>

</div>
