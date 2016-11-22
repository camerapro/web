<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\search\TmpVideoPeriodBase */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tmp-video-period-base-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?php echo $form->field($model,'created_time')->textInput(['value' => date('Y-m-d 00:00:00')])->label('Từ ngày'); ?>
    <?php echo $form->field($model,'end_time')->textInput(['value' => date('Y-m-d 00:00:00')])->label('Đến ngày'); ?>


    <div class="form-group">
        <?= Html::submitButton('Tìm kiếm', ['class' => 'btn btn-primary']) ?>

    </div>

    <?php ActiveForm::end(); ?>

</div>
