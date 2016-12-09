<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Agency */

$this->title = 'Update Agency: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Agencies', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id, 'name' => $model->name]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="agency-update">

   
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
