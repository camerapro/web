<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\StudentFrontend */

$this->title = 'Create Student Frontend';
$this->params['breadcrumbs'][] = ['label' => 'Student Frontends', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="student-frontend-create">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
