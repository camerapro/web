<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\StaffFrontend */

$this->title = 'Create Staff Frontend';
$this->params['breadcrumbs'][] = ['label' => 'Staff Frontends', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="staff-frontend-create">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
