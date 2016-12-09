<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Agency */

$this->title = 'Create Agency';
$this->params['breadcrumbs'][] = ['label' => 'Agencies', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="agency-create">

  
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
