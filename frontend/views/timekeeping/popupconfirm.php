<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\TimekeepingFrontend */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="modal-body">

    <?php $form = ActiveForm::begin([
        'layout' => 'horizontal',
        'action'=> '/timekeeping/index',
        'fieldConfig' => [
            'template' => " <div class=\"form-group form-md-line-input\">{label}\n{beginWrapper}\n{input}<div class=\"form-control-focus\"> </div>\n{error}\n</div>{endWrapper}",
            'horizontalCssClasses' => [
                'label' => 'col-sm-4',
                'offset' => 'col-sm-offset-2',
                'wrapper' => 'col-sm-5',
                'error' => '',
                'hint' => '',
            ],

        ],
    ]); ?>

        <div class="row popup-form">
            <div class="col-xs-8" >
                <p>Tên nhân viên :<b><?php echo $model->staff->name;?></b></p>
                <span class="card_code">Mã thẻ :  <b><?php echo $model->staff->card_code;?> </b></span> <span class=""> Thời gian chấm công :<b> <?php echo date("H:i:s d-m-Y",strtotime($model->created_time));?></b></span>
                 <p><?= $form->field($model, 'status')->inline()->hint('')->radioList(['1'=>'Đúng', '0'=>'Sai'])->label("Trạng thái"); ?></p>

            </div>
            <div class="col-xs-4">

                <div class="row">
                    <div class=" col-md-push-4" style="text-align: center" >
						<input type="hidden" id="popup-value-id" value="<?php echo $model->id;?>">
                      <?php echo Html::submitButton('Xác nhận',['class' =>  'btn btn-success','id'=>'btn-popup-confirm']);?><br>
                      <?php echo Html::submitButton('Đóng',['class' =>  'btn btn-primary','data-dismiss'=>'modal']);?>
                    </div>
                </div>
            </div>
        </div>


    <div class="clearfix" style="padding-top: 10px;"></div>
    
    <div class="pull-center popup-img" style="border: 1px solid #dddddd;padding: 10px;border-radius: 10px;min-height:300px">
		<div class="col-xs-8" >
		Ảnh camera<br>
               <img width="200"src ="<?php echo $model->image;?>">
            </div>
            <div class="col-xs-4">
			Ảnh đăng ký<br>
					<img width="200"  src ="<?php echo $model->image_base;?>">
            </div>
       
    </div>

    <?php ActiveForm::end(); ?>

</div>
<script>
	$( "#btn-popup-confirm" ).on( "click", function() {
		var check = $('.popup-form input').is(':checked');
		if(!check){
			alert('Chọn thuộc tính cần xử lý');
			return false;
		}
		var status = $('.popup-form').find('input[type="radio"]:checked').val();
        var ids = [];
		var id = $("#popup-value-id").val();
         ids.push(id);
        $.ajax({
            url: '/timekeeping/manual-confirm',
            type: "POST",
            data: {
                'ids':ids,'_csrf':YII_CSRF_TOKEN,'status':status
            } ,
            success: function (response) {
                data_res = JSON.parse(response);
                if(data_res['error'] == 0){
                    alert(data_res['message']);
                    window.location.reload();
                }else{
                    alert(data_res['message']);
                }
            },
        });

    });
	</script>