<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\search\DepartmentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Quản lý phòng ban';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="department-frontend-index">

    <h4><?= Html::encode($this->title) ?></h4>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <a data-ignore-state="1" id="notify-id"  data-target="#modalPopup" data-toggle="modal" class="title pull-left btn btn-success" href="/department/create"><i class="glyphicon glyphicon-plus"></i> Tạo mới</a>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\CheckboxColumn'],
          //  'id',
            'name',
            'company_id',
            'parent_id',
            'status',
             'created_time',
            // 'updated_time',
            // 'description',

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
                        $url = '/department/update?id=' . $model->id;
                        return $url;
                    };
                    if ($action === 'delete') {
                        $url = '/department/delete?id=' . $model->id;
                        return $url;
                    };
                    if ($action === 'view') {
                        $url = '/department/view?id=' . $model->id;
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
