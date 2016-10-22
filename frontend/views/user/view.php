<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\User */

$this->title = 'Thông tin người dùng ' . $model->username;
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Cập nhật', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Xóa', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Bạn có chắc chắn muốn xóa?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'username',
            'fullname',
            'email:email',
            'phone',
            'birthday',
            [
                'attribute' => 'gender',
                'value' => $model->gender == 1 ? 'Nam' : 'Nữ'
            ],
            'address',
            [
                'attribute' => 'status',
                'value' => $model->status == 1 ? 'Hoạt động' : 'Không hoạt động'
            ],
            [
                'attribute' => 'created_time',
                'value' => date('H:i:s d-m-Y', time($model->created_time))
            ],
            [
                'attribute' => 'updated_time',
                'value' => date('H:i:s d-m-Y', time($model->updated_time))
            ],
        ],
    ]) ?>

</div>
