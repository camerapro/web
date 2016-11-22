<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\TimeP;
/* @var $this yii\web\View */
/* @var $searchModel frontend\models\search\TmpVideoPeriodBase */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Video';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="tmp-video-period-base-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php  echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Tạo mới', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
//            'id',
            'period_name',
            'subject_name',
            'class_name',
            'teacher_name',
             'watch_count',
             'comment_count',
             'like_count',
             'dislike_count',
             'start_time',
             'end_time',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
