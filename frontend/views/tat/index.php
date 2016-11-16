<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap\Modal;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\search\TatSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Quản lý máy chấm công';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tat-frontend-index">

    <h4><?= Html::encode($this->title) ?></h4>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>


   <p>
        <a data-ignore-state="1" id="notify-id"  data-target="#modalPopup" data-toggle="modal" class="title pull-left btn btn-success" href="/tat/create"><i class="glyphicon glyphicon-plus"></i> Tạo mới</a>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

           // 'id',
            'name',
           // 'category_id',
            'ip',
            'port',
            // 'protocol',
             'created_time',
            // 'updated_time',
            // 'description',
            // 'order',
            // 'camera_main_id',
            // 'camera_secondary_id',
            // 'user_id',
            // 'agency_id',
            // 'status',
             'camera_ip',
             'camera_port',
             'camera_channel',
            // 'camera_username',
            // 'camera_password',
            // 'camera_model',
            // 'expired_time',
            ['attribute' => 'company',
                'format' => 'raw',
                'filter' =>  yii\helpers\ArrayHelper::map(\frontend\models\CompanyFrontend::findAll(['status' => 1]), 'id', 'name'),
                'options' => ['width' => '90px'],
                'value' => function ($data) {
                   $company = \frontend\models\CompanyFrontend::find()->where(['id' => $data->company])->one();
                    if (!empty($company)) {
                        return $company->name;
                    }
                },
                'headerOptions' => ['style' => 'text-align: center; vertical-align: middle;'],
                'contentOptions' => ['style' => 'text-align: center; vertical-align: middle;']
            ],
           
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
                                'data-target'=>'#modalPopup',
                                'data-toggle'=>'modal',
                                'data-ignore-state'=>1,
                            ]);
                        },
                        'delete' => function ($url, $model) {
                            return Html::a('<span class="glyphicon glyphicon-trash"></span>', $url, [
                                'title' => Yii::t('app', 'Delete'),
                              
                                'data-confirm' => 'Bạn có chắc chắn muốn xóa?',
                            ]);
                        },
                    ],
                    'urlCreator' => function ($action, $model, $key, $index) {
                        if ($action === 'update') {
                            $url = '/tat/update?id=' . $model->id;
                            return $url;
                        };
                        if ($action === 'delete') {
                            $url = '/tat/delete?id=' . $model->id;
                            return $url;
                        };
                        if ($action === 'view') {
                            $url = '/tat/view?id=' . $model->id;
                            return $url;
                        };
                    }
                ],
        ],
    ]); ?>
</div>

<div id="modalPopup" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modalPopup" aria-hidden="true">
    <div class="modal-dialog modal-lg" style="width: 500px">
	<div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
     
    </div>
        <div class="modal-content"></div>
    </div>
</div>
<script>

    $('body').on("hidden.bs.modal", function(e) {
        $(e.target).removeData("bs.modal").find(".modal-content").empty();
     });

    $('body').on("show.bs.modal", function(e) {
        var link = $(e.relatedTarget);
		
        $(this).find(".modal-content").load(link.attr("href"));
    });
	$("#modalPopup").draggable({
		handle: ".modal-header"
	}); 


</script>