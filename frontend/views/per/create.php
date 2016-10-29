<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\PermissionGroup */

$this->title = 'Phân quyền';
$this->params['breadcrumbs'][] = ['label' => 'Permission Groups', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="permission-group-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'list_permission'=>$list_permission,
        'list_permission_by_group'=>[],
    ]) ?>

</div>
