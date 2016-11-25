<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\StudentFrontend */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Student Frontends', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="student-frontend-view">

    <h4><?= Html::encode($this->title) ?></h4>

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
            'phone',
            'card_code',
            'card_id',
            'class_id',
            'class_name',
            'image:ntext',
            'created_time',
            'created_by',
            'updated_time',
            'updated_by',
            'status',
            'description',
            'company_id',
        ],
    ]) ?>

</div>
