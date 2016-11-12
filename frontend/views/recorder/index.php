<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\RecorderSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Quản lý đầu ghi';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="frontend-recorder-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <p>
        <a data-ignore-state="1" id="notify-id"  data-target="#CalenderModalNew" data-toggle="modal" class="title pull-left btn btn-success" href="/recorder/new">Tạo mới</a>
    </p>
    <?php if(Yii::$app->user->identity->level < 3):?>
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                'name',
                [
                    'label' => 'Tên đăng nhập',
                    'format' => 'raw',
                    'value' => function ($model) {
                        return \common\models\User::findOne($model->user_id)->username;
                    },
                ],
                [
                    'label' => 'Thời gian tạo',
                    'format' => 'raw',
                    'value' => function ($model) {
                        return date('d/m/Y H:i', strtotime($model->created_time));
                    },
                ],
                [
                    'class' => 'yii\grid\ActionColumn',
                    'header' => 'Quản lý',
                    'template' => '{update} {delete} {view}',
                    'buttons' => [
                        //view button
                        'view' => function ($url, $model) {
                            return Html::a('<span class="fa fa-pencil"></span>Set cam', $url, [
                                'title' => Yii::t('app', 'Set cam'),
                                'class' => 'btn btn-primary btn-xs',
                            ]);
                        },
                        'update' => function ($url, $model) {
                            return Html::a('<span class="fa fa-pencil"></span>Sửa', $url, [
                                'title' => Yii::t('app', 'Sửa'),
                                'class' => 'btn btn-primary btn-xs',
                            ]);
                        },
                        'delete' => function ($url, $model) {
                            return Html::a('<span class="fa fa-trash "></span>Xóa', $url, [
                                'title' => Yii::t('app', 'Delete'),
                                'class' => 'btn btn-primary btn-xs',
                                'data-confirm' => 'Bạn có chắc chắn muốn xóa đầu ghi này?',
                            ]);
                        },
                    ],
                    'urlCreator' => function ($action, $model, $key, $index) {
                        if ($action === 'update') {
                            $url = '/recorder/update?id=' . $model->id;
                            return $url;
                        };
                        if ($action === 'delete') {
                            $url = '/recorder/delete?id=' . $model->id;
                            return $url;
                        };
                    }
                ],

            ],
        ]); ?>
    <?php else:?>
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                'name',
                'ip',
                'media_port',
                'username',
                'password',
                [
                    'label' => 'Tên đăng nhập',
                    'format' => 'raw',
                    'value' => function ($model) {
                        return isset(\common\models\User::findOne($model->user_id)->username) ?   \common\models\User::findOne($model->user_id)->username :  '';
                    },
                ],
                [
                    'label' => 'Thời gian tạo',
                    'format' => 'raw',
                    'value' => function ($model) {
                        return date('d/m/Y H:i', strtotime($model->created_time));
                    },
                ],
                [
                    'class' => 'yii\grid\ActionColumn',
                    'header' => 'Quản lý',
                    'template' => '{update} {delete} {view}',
                    'buttons' => [
                        //view button
                        'view' => function ($url, $model) {
                            return Html::a('<span class="fa fa-pencil"></span>Set cam', $url, [
                                'title' => Yii::t('app', 'Set cam'),
                                'class' => 'btn btn-primary btn-xs',
                            ]);
                        },
                        'update' => function ($url, $model) {
                            return Html::a('<span class="fa fa-pencil"></span>Sửa', $url, [
                                'title' => Yii::t('app', 'Sửa'),
                                'class' => 'btn btn-primary btn-xs',
                                'data-target'=>'#CalenderModalNew',
                                'data-toggle'=>'modal',
                                'data-ignore-state'=>1,
                            ]);
                        },
                        'delete' => function ($url, $model) {
                            return Html::a('<span class="fa fa-trash "></span>Xóa', $url, [
                                'title' => Yii::t('app', 'Delete'),
                                'class' => 'btn btn-primary btn-xs',
                                'data-confirm' => 'Bạn có chắc chắn muốn xóa đầu ghi này?',
                            ]);
                        },
                    ],
                    'urlCreator' => function ($action, $model, $key, $index) {
                        if ($action === 'update') {
                            $url = '/recorder/update?id=' . $model->id;
                            return $url;
                        };
                        if ($action === 'delete') {
                            $url = '/recorder/delete?id=' . $model->id;
                            return $url;
                        };
                    }
                ],

            ],
        ]); ?>
    <?php endif;?>

</div>

<div id="CalenderModalNew" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" style="width: 980px">
        <div class="modal-content"></div>
    </div>
</div>

