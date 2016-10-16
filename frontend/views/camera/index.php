<?php

use yii\helpers\Html;
use yii\grid\GridView;

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
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
//            'id',
            'encoder_name',
            'name',
//            'category_id',
            'streaming_url:url',
            'protocol',
             'port',
             'channel',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
