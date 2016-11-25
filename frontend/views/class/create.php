<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\ClassFrontend */

$this->title = 'Create Class Frontend';
$this->params['breadcrumbs'][] = ['label' => 'Class Frontends', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="class-frontend-create">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
