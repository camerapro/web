<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\search\DepartmentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Department Frontends';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="department-frontend-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Department Frontend', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'company_id',
            'parent_id',
            'status',
            // 'created_time',
            // 'updated_time',
            // 'description',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
