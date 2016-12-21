<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\search\UserLogSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Log API';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-log-index">

    <h4><?= Html::encode($this->title) ?></h4>
	<?php $form = ActiveForm::begin([
			'action' => 'log-api/index'
		]
	); ?>
	   <span>Nhập ngày cần xem (YYYYMMDD~20160101)</span>
			  <input name="date" value="<?php echo date('Ymd');?>">
			
			 <?= Html::submitButton('Xem', ['class' => 'btn btn-primary']) ?>
	 <?php ActiveForm::end(); ?>
  <div style="max-height: 800px;overflow: auto; background: #000;color: #fff;;">
		
		<?php 
			if(file_exists($file_name))
				echo nl2br(file_get_contents($file_name));
			 else
				 echo "Không tồn tại file log";
			?>
  </div>
   
</div>
