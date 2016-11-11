<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\FrontendRecorder */

$this->title = 'Tạo mới đầu ghi';
$this->params['breadcrumbs'][] = ['label' => 'Frontend Recorders', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="frontend-recorder-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
