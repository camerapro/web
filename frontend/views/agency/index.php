<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap\Modal;
/* @var $this yii\web\View */
/* @var $searchModel frontend\models\search\AgencySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Agencies';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="agency-index">

        <h4><?= Html::encode($this->title) ?></h4>
    <a data-ignore-state="1" id="notify-id" class="title pull-left btn btn-success" href="/agency/create"><i class="glyphicon glyphicon-plus"></i> Tạo mới</a>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

           // 'id',
            'name',
            'address',
            'email:email',
            'phone',
            // 'city',
            // 'country',
            // 'status',
            // 'balance',
             'created_time',
            // 'updated_time',

            [
                'class' => 'yii\grid\ActionColumn',
                'header' => 'Quản lý',
                'template' => '{update} {delete} {view}',
                'buttons' => [
                    //view button
                    'view' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', $url, [
                            'title' => Yii::t('app', 'Xem'),
                        ]);
                    },
                    'update' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, [
                            'title' => Yii::t('app', 'Sửa'),
                            'data-ignore-state'=>1,
                        ]);
                    },
                    'delete' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-trash"></span>', $url, [
                            'title' => Yii::t('app', 'Delete'),

                            'data-confirm' => 'Bạn có chắc chắn muốn xóa?',
                            'data-method' => 'post',
                        ]);
                    },
                ],
                'urlCreator' => function ($action, $model, $key, $index) {
                    if ($action === 'update') {
                        $url = '/agency/update?id=' . $model->id;
                        return $url;
                    };
                    if ($action === 'delete') {
                        $url = '/agency/delete?id=' . $model->id;
                        return $url;
                    };
                    if ($action === 'view') {
                        $url = '/agency/view?id=' . $model->id;
                        return $url;
                    };
                }
            ],
        ],
    ]); ?>
</div>

