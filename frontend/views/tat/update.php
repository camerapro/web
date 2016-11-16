<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\TatFrontend */

$this->title = 'Cập nhật: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Máy chấm công', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="tat-frontend-update">

    <h4><?= Html::encode($this->title) ?></h4>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
