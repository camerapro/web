<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\TatFrontend */

$this->title = 'Tạo mới';
$this->params['breadcrumbs'][] = ['label' => 'T', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tat-frontend-create">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
