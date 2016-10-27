<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $searchModel frontend\models\search */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Hướng dẫn';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="news-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Tạo mới hướng dẫn', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'label'=>'Tiêu đề',
                'format' => 'raw',
                'value' => function ($model) {
                    return Html::a($model->title, ['/guide/index', 'id' => $model->id]);
                },
            ],
//            'title',
            'desc_content',
            'created_time',
            // 'updated_time',
            // 'created_by_id',
            // 'status',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
