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
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Tạo mới', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
//        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'name',
//            'category_id',
            'ip',
            'media_port',
            'username',
            'password',
            [
                'label' => 'Tên đăng nhập',
                'format' => 'raw',
                'value' => function ($model) {
//                    $user = \common\models\User::findOne($model->user_id);
//                    return Html::a($user->username, ['/user/view', 'id' => $user->id]);
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
                'contentOptions' => ['style' => 'width:260px;'],
                'header' => '',
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
//                                'data-method' => 'get',
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
</div>
