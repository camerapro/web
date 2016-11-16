<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\TimekeepingFrontend */

$this->title = 'Create Timekeeping Frontend';
$this->params['breadcrumbs'][] = ['label' => 'Timekeeping Frontends', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="timekeeping-frontend-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
