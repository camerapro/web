<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\departmentFrontend */

$this->title = 'Update Department Frontend: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Department Frontends', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="department-frontend-update">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
