<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\TatFrontend */

$this->title = 'Create Tat Frontend';
$this->params['breadcrumbs'][] = ['label' => 'Tat Frontends', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tat-frontend-create">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
