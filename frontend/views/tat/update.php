<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\TatFrontend */

$this->title = 'Update Tat Frontend: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Tat Frontends', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="tat-frontend-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
