<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap\ButtonGroup;
use yii\widgets\Pjax;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\search\TimekeepingSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Khôi phục dữ liệu chấm công';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="timekeeping-frontend-index">

    <h4><?= Html::encode($this->title) ?></h4>
	<?php \yii\widgets\Pjax::begin(); ?>
    <?php  echo $this->render('_search_restore', ['model' => $searchModel]); ?>
	
	<div class ="action-restore">
	
	<span class="btn-restore-confirm"><img src="/images/btn-restore.png"  width="80"></span>
	<span class="btn-del-confirm"><img src="/images/btn-del-confirm.png"  width="65"></span>
		</div>

    <?php  echo $this->render('_index', ['dataProvider' => $dataProvider,'searchModel'=>$searchModel]); ?>
    <?php \yii\widgets\Pjax::end(); ?>
</div>
<script>
		$('.btn-restore-confirm').click(function(){
		var status = 0;
		var ids = [];
        $("input[type=checkbox]:checked").each ( function() {
            ids.push($(this).val());
        });
        $.ajax({
            url: '/timekeeping/restore-confirm',
            type: "POST",
            data: {
                'ids':ids,'_csrf':YII_CSRF_TOKEN,'status':status
            } ,
            success: function (response) {
                data_res = JSON.parse(response);
                if(data_res['error'] == 0){
                    alert(data_res['message']);
                    window.location.reload();
                }else{
                    alert(data_res['message']);
                }
            },
        });

    });
	$('.btn-del-confirm').click(function(){
		 if (confirm('Bạn có chắc chắn xóa')) {
			var check = $('#timekeepingsearch-status input').is(':checked');
			var status = 5;
			var ids = [];
			$("input[type=checkbox]:checked").each ( function() {
				ids.push($(this).val());
			});
			$.ajax({
				url: '/timekeeping/delete-restore',
				type: "POST",
				data: {
					'ids':ids,'_csrf':YII_CSRF_TOKEN,'status':status
				} ,
				success: function (response) {
					data_res = JSON.parse(response);
					if(data_res['error'] == 0){
						alert(data_res['message']);
						window.location.reload();
					}else{
						alert(data_res['message']);
					}
				},
        });
		}
		

    });
</script>
