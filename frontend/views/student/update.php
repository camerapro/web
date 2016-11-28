<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\StudentFrontend */

$this->title = 'Update Student Frontend: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Student Frontends', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="student-frontend-update">

    <h4><?= Html::encode($this->title) ?></h4>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
