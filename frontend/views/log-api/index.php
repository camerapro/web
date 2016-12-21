<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\search\UserLogSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Log API';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-log-index">

    <h4><?= Html::encode($this->title) ?></h4>
  <div style="max-height: 800px;overflow: auto; background: #000;color: #fff;;">
		<?php  echo file_get_contents($file_name);?>
  </div>
   
</div>
