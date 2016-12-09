<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\search\UserLogSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'User Logs';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-log-index">

    <h4><?= Html::encode($this->title) ?></h4>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            //'id',
            'user_id',
            'user_username',
            'ip',
            'controller',
             'action',
             'activity',
             'object_id',
             'object_name',
            // 'params:ntext',
             'created_time',
            //['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
