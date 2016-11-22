<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\_base\TmpVideoPeriodBase */

$this->title = 'Create Tmp Video Period Base';
$this->params['breadcrumbs'][] = ['label' => 'Tmp Video Period Bases', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tmp-video-period-base-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
