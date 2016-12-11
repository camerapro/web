<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap\Modal;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\search\CompanySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Company';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="company-frontend-index">

    <h4><?php echo  Html::encode($this->title) ?></h4>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
	<p>
        <a data-ignore-state="1" id="notify-id" class="title pull-left btn btn-success" href="/company/create"><i class="glyphicon glyphicon-plus"></i> Tạo mới</a>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

           // 'id',
            'name',
            'contact_name',
            'address',
            'email:email',
             'phone',
            // 'city',
            // 'country',
            // 'status',
            // 'balance',
             'created_time',
             'expired_time',
            // 'updated_time',
             'website',

           
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
                            $url = '/company/update?id=' . $model->id;
                            return $url;
                        };
                        if ($action === 'delete') {
                            $url = '/company/delete?id=' . $model->id;
                            return $url;
                        };
                        if ($action === 'view') {
                            $url = '/company/view?id=' . $model->id;
                            return $url;
                        };
                    }
                ],
        ],
    ]); ?>
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
    $('#MyButton').click(function(){
        var recorder_ids = [];
        $("input[type=checkbox]:checked").each ( function() {
            recorder_ids.push($(this).val());
        });

        $.ajax({
            url: '/ajax/multiple_delete_recorder',
            type: "POST",
            data: {
                'recorder_ids':recorder_ids,
            } ,
            success: function (response) {
                data_res = JSON.parse(response);
                if(data_res['return_code'] == 0){
                    alert(data_res['message']);
                    window.location.reload();
                }else{
                    alert(data_res['message']);
                }
            },
        });

    });

</script>