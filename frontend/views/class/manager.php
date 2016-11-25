<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\search\ClassSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Quản lý lớp học';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="class-frontend-index">

    <h4><?= Html::encode($this->title) ?></h4>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <a data-ignore-state="1" id="notify-id"  data-target="#modalPopup" data-toggle="modal" class="title pull-left btn btn-success" href="/class/create"><i class="glyphicon glyphicon-plus"></i> Tạo mới</a>
        <a data-ignore-state="1" id="notify-id"  data-target="#modalPopup" data-toggle="modal" class="title pull-left btn btn-success" href="/class/delete"><i class="glyphicon glyphicon-minus"></i> Xóa</a>
        <a data-ignore-state="1" id="notify-id"  data-target="#modalPopup" data-toggle="modal" class="title pull-left btn btn-success" href="/class/update"><i class="fa fa-edit"></i> Đổi tên</a>

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
                        ['attribute' => '',
                            'format' => 'raw',
                            'header' => 'Giáo viên',
                            'filter' =>  yii\helpers\ArrayHelper::map(\frontend\models\StaffFrontend::findAll(['status' => 1]), 'id', 'name'),
                            'options' => ['width' => '90px'],
                            'value' => function ($data) {
                                $dep = \frontend\models\StaffFrontend::find()->where(['id' => $data->id])->one();
                                if (!empty($dep)) {
                                    return $dep->name;
                                }
                            },
                            'headerOptions' => ['style' => 'text-align: center; vertical-align: middle;'],
                            'contentOptions' => ['style' => 'text-align: center; vertical-align: middle;']
                        ],
                        [
                            'class' => 'yii\grid\ActionColumn',
                            'header' => 'Số học sinh',
                            'template' => '{view}',
                            'buttons' => [
                                //view button
                                'view' => function ($url, $model) {
                                    return '<span class=""> '.($model->id + 30).'</span>';
                                },

                            ],
                            'urlCreator' => function ($action, $model, $key, $index) {

                                if ($action === 'view') {
                                    $url = '/staff/index?id=' . $model->id.'&status=1';
                                    return $url;
                                };
                            }
                        ],
                       'start_time',
                       'end_time',
                        [
                            'class' => 'yii\grid\ActionColumn',
                            'header' => 'Lịch học',
                            'template' => '{view}',
                            'buttons' => [
                                //view button
                                'view' => function ($url, $model) {
                                    return Html::a('<span class="fa fa-table">Xem lịch</span>', $url, [
                                        'title' => Yii::t('app', 'Xem'),
                                    ]);
                                },

                            ],
                            'urlCreator' => function ($action, $model, $key, $index) {

                                if ($action === 'view') {
                                    $url = '/timetable/index?id=' . $model->id;
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
    <div class="modal-dialog modal-lg" style="width: 450px">
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
