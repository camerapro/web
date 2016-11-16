<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\CompanyFrontend */


$this->params['breadcrumbs'][] = $this->title;
?>
<div class="company-frontend-create">



    <?= $this->render('_form', [
        'model' => $model,
        'ajax' => $ajax,
    ]) ?>

</div>
