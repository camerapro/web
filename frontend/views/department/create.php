<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\departmentFrontend */

$this->title = '';
$this->params['breadcrumbs'][] = ['label' => 'Department Frontends', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="department-frontend-create">

  
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
