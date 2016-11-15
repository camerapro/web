<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\CompanyFrontend */

$this->title = 'Cập nhật: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Company Frontends', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id, 'name' => $model->name]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="company-frontend-update">

   
    <?= $this->render('_form', [
        'model' => $model,
		 'ajax' => $ajax,
    ]) ?>

</div>
