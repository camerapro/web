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
        <a data-ignore-state="1" id="notify-id"  data-target="#modalPopup" data-toggle="modal" class="title pull-left btn btn-success" href="/department/delete"><i class="glyphicon glyphicon-minus"></i> Xóa</a>
        <a data-ignore-state="1" id="notify-id"  data-target="#modalPopup" data-toggle="modal" class="title pull-left btn btn-success" href="/department/update"><i class="fa fa-edit"></i> Đổi tên</a>

    </p>
<div class ="dep-manager">
<div class="clear-both"></div>
    <div class="dep-table">
<div class="dep-left">
    <input type="checkbox" class="select-on-check-all" name="selection_all" value="1">
    <a href="#" data-sort="name">Hiển thị tất cả phòng <span class="fa fa-list"></span></a>
    <div>

       <ul>
           <li><b> Trường PTTH Lê Hồng Phong</b>
           </li>
           <li>
               <ul>
                   <li> Cơ sở 1 </li>
                   <li><ul>
                           <li class="child">Lớp 5A </li>
                           <li class="child"> Lớp 5B</li>

                       </ul></li>
                   <li> Cơ sở 2 </li>
                   <li><ul>
                           <li class="child">Lớp 3A </li>
                           <li class="child"> Lớp 4B</li>

                       </ul></li>

               </ul>
           </li>
       </ul>
    </div>

</div>
    <div class="dep-right">
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            //'filterModel' => $searchModel,
            'columns' => [
              //  ['class' => 'yii\grid\CheckboxColumn'],
                //  'id',
                'name',
                [
                    'class' => 'yii\grid\ActionColumn',
                    'header' => 'Nhân viên hiện tại',
                    'template' => '{view}',
                    'buttons' => [
                        //view button
                        'view' => function ($url, $model) {
                            return '<span class=""> '.$model->id.'</span>';
                        },

                    ],
                    'urlCreator' => function ($action, $model, $key, $index) {

                        if ($action === 'view') {
                            $url = '/staff/index?id=' . $model->id.'&status=1';
                            return $url;
                        };
                    }
                ],
                [
                    'class' => 'yii\grid\ActionColumn',
                    'header' => 'Nhân viên nghỉ',
                    'template' => '{view}',
                    'buttons' => [
                        //view button
                        'view' => function ($url, $model) {
                            return '<span class=""> '.$model->id.'</span>';
                        },

                    ],
                    'urlCreator' => function ($action, $model, $key, $index) {

                        if ($action === 'view') {
                            $url = '/staff/index?id=' . $model->id.'&status=2';
                            return $url;
                        };
                    }
                ],
                [
                    'class' => 'yii\grid\ActionColumn',
                    'header' => '',
                    'template' => '{view}',
                    'buttons' => [
                        //view button
                        'view' => function ($url, $model) {
                            return Html::a('<span class="">Xem nhân viên hiện tại</span>', $url, [
                                'title' => Yii::t('app', 'Xem'),
                            ]);
                        },

                    ],
                    'urlCreator' => function ($action, $model, $key, $index) {

                        if ($action === 'view') {
                            $url = '/staff/index?id=' . $model->id;
                            return $url;
                        };
                    }
                ],
            ],
        ]); ?>
        </div>
</div>
<div>
</div>

</div>

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
