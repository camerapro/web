<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap\ButtonGroup;
use yii\widgets\Pjax;
use yii\bootstrap\ActiveForm;
?>

<?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
		
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],
            ['class' => 'yii\grid\CheckboxColumn'],
			[

                'attribute' => 'staff_name',
                'header' => 'Tên nhân viên',
                'format' => 'raw',
                'headerOptions' => ['style'=>'text-align: center;width:150px'],
                'contentOptions'=>['style'=>'text-align: center; vertical-align:middle;'],
                'value' => function($data) {
	
                    return isset($data->staff) ?$data->staff->name : null;
   
                }
             ],
			 [
			     'attribute' => 'phone',
                'header' => 'Điện thoại',
                'format' => 'raw',
                'options' => ['width' => '20px'],
                'headerOptions' => ['style'=>'text-align: center;'],
                'contentOptions'=>['style'=>'text-align: center; vertical-align:middle;'],
                'value' => function($data) {
	
                    return isset($data->staff) ?$data->staff->phone : null;
   
                }
            ],

			[
                'attribute' => 'tat_name',
                'header' => 'Máy chấm công',
                'format' => 'raw',
                'options' => ['width' => '120px'],
                'headerOptions' => ['style'=>'text-align: center;'],
                'contentOptions'=>['style'=>'text-align: center; vertical-align:middle;'],
                'value' => function($data) {
                    return ($data) ?
                      $data->tat->name:null; 
                }
            ],
            [
                'attribute' => 'department_id',
                'header' => 'Phòng ban',
                'format' => 'raw',
                'filter' =>  yii\helpers\ArrayHelper::map(\frontend\models\DepartmentFrontend::findAll(['status' => 1]), 'id', 'name'),
                'options' => ['width' => '100px'],
                'contentOptions'=>['style'=>'text-align: center;'],
                'value' => function ($data) {
                    $dep = \frontend\models\DepartmentFrontend::find()->where(['id' => $data->staff->department_id])->one();
                    if (!empty($dep)) {
                        return $dep->name;
                    }
                },
                'headerOptions' => ['style' => 'text-align: center;'],
                'contentOptions' => ['style' => 'text-align: center; vertical-align: middle;']
            ],
            [
                'attribute' => 'created_time',
                'format' => ['date', 'php:H:i:s d/m/Y']
            ],
            [
                'attribute' => 'type',
                'header' => 'Kiểu',
                'format' => 'raw',
                'options' => ['width' => '120px'],
                'headerOptions' => ['style'=>'text-align: center;'],
                'contentOptions'=>['style'=>'text-align: center; vertical-align:middle;'],
                'value' => function($data) {
                    return $data->type;
                }
            ],            [
                'header' => 'Trạng thái',
                'format' => 'raw',
                'options' => ['width' => '100px'],
                'headerOptions' => ['style'=>'text-align: center;'],
                'contentOptions'=>['style'=>'text-align: center; vertical-align:middle;'],
                'value' => function($data) {
					if($data->status ==1 )
					$status ='Đúng';
					if($data->status ==0 )
					$status ='Chưa xác nhận';
					if($data->status ==3 )
					$status ='Sai';
                    return $status;
                }
            ],
			
			
            // 'image:ntext',
			[
                'header' => 'Ảnh camera',
                'format' => 'raw',
                'options' => ['width' => '100px'],
                'headerOptions' => ['style'=>'text-align: center;'],
                'contentOptions'=>['style'=>'text-align: center; vertical-align:middle;'],
                'value' => function($data) {
                    return ($data->id) ?Html::img(\common\components\Common::getImage($data,'timekeeping'),['width'=>'100%']) : null;
                }
            ],
			[
                'header' => 'Ảnh gốc',
                'format' => 'raw',
                'options' => ['width' => '100px'],
                'headerOptions' => ['style'=>'text-align: center;'],
                'contentOptions'=>['style'=>'text-align: center; vertical-align:middle;'],
                'value' => function($data) {
                    return ($data->staff) ?Html::img(\common\components\Common::getImage($data->staff,'staff'),['width'=>'100%', 'title' => $data->staff->{'name'}]) : null;
                }
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'header' => 'Thao tác',
                'template' => '{update}',
                'buttons' => [
                    //view button

                    'update' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, [
                            'title' => Yii::t('app', 'Sửa'),
                            'data-target'=>'#modalPopup',
                            'data-toggle'=>'modal',
                            'data-ignore-state'=>1,
                        ]);
                    },

                ],
                'urlCreator' => function ($action, $model, $key, $index) {
                    if ($action === 'update') {
                        $url = '/timekeeping/popup-confirm?id=' . $model->id;
                        return $url;
                    };
                }
            ],
            //'staff_id',
			
 
        ],
    ]); ?>

<div id="modalPopup" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modalPopup" aria-hidden="true">
    <div class="modal-dialog modal-lg" style="width: 700px">
        <div class="modal-header">
            <span>Xác nhận nhân viên</span>
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
