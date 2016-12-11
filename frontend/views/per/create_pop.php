<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\PermissionGroup */

$this->title = 'Phân quyền';
$this->params['breadcrumbs'][] = ['label' => 'Permission Groups', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="permission-group-create">


    <?= $this->render('_form_pop', [
        'model' => $model,
        'list_permission'=>$list_permission,
        'list_permission_by_group'=>[],
    ]) ?>

</div>
