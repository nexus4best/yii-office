<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>

<div class="tbl-repair-form_send">

    <?php $form = ActiveForm::begin([
        'id' => 'form_send_ok',
        'enableAjaxValidation' => true,
    ]); ?>

    <div class="form-group">
        <div class="row">
            <div class="col-md-6"><span style="background-color:yellow">เลขที่ <?= $model->id ?></span></div>
            <div class="col-md-6" align="right"><?= $model->BrnCode.' '.$model->branch->BrnName ?></div>
        </div>    
        <div class="row">
            <div class="col-md-6">เครื่อง <?= $model->BrnPos ?></div>
            <div class="col-md-6" align="right">
                <?php
                      $time_ago =strtotime($model->CreatedAt);
                      echo timeAgo($time_ago);
                ?>
            </div>
        </div>           
    </div>

    <div class="row">
        <div class="col-md-12">
            <?= $form->field($model, 'BrnRepair')->textInput(['maxlength' => true, 'readonly' => 'readonly']) ?>
        </div>
        <div class="col-md-12">
            <?= $form->field($model, 'BrnCause')->textArea(['maxlength' => true, 'readonly' => 'readonly']) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($new_send, 'SendBrand')->textInput(['maxlength' => true]) ?>

            <?= $form->field($new_send, 'SendModel')->textInput(['maxlength' => true]) ?>

            <?= $form->field($new_send, 'SendSerial')->textInput(['maxlength' => true]) ?>        
        </div>
        <div class="col-md-6">
        
            <?= $form->field($new_send, 'SendFrom')->dropDownList(
                            ["Global line" => "Global line","DHL" => "DHL","TNT" => "TNT","เดินทางไปเอง" => "เดินทางไปเอง"],
                            ['prompt'=>'']); ?>   
                            
            <?= $form->field($new_send, 'SendNumber')->textInput(['maxlength' => true]) ?>

            <?= $form->field($new_send, 'SendByName')->dropDownList(
                            ["ราชศักดิ์" => "ราชศักดิ์","ณัฐวุฒิ" => "ณัฐวุฒิ","ชวัท" => "ชวัท","กิตติ" => "กิตติ","ธานี" => "ธานี"],
                            ['prompt'=>'']); ?>   
        </div>
    </div>

    <div class="form-group">
        <div style="text-align:right">
            <?= Html::submitButton('บันทึก', ['class' => 'btn btn-success']) ?>
            <a href="#" class="btn btn-default" data-dismiss="modal">ยกเลิก</a>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php
function timeAgo($time_ago){
$cur_time 	= time();
$time_elapsed 	= $cur_time - $time_ago;
$seconds 	= $time_elapsed ;
$minutes 	= round($time_elapsed / 60 );
$hours 		= round($time_elapsed / 3600);
$days 		= round($time_elapsed / 86400 );
$weeks 		= round($time_elapsed / 604800);
$months 	= round($time_elapsed / 2600640 );
$years 		= round($time_elapsed / 31207680 );
// Seconds
if($seconds <= 60){
	echo "$seconds seconds ago";
}
//Minutes
else if($minutes <=60){
	if($minutes==1){
		echo "one minute ago";
	}
	else{
		echo "$minutes minutes ago";
	}
}
//Hours
else if($hours <=24){
	if($hours==1){
		echo "an hour ago";
	}else{
		echo "$hours hours ago";
	}
}
//Days
else if($days <= 7){
	if($days==1){
		echo "yesterday";
	}else{
		echo "$days days ago";
	}
}
//Weeks
else if($weeks <= 4.3){
	if($weeks==1){
		echo "a week ago";
	}else{
		echo "$weeks weeks ago";
	}
}
//Months
else if($months <=12){
	if($months==1){
		echo "a month ago";
	}else{
		echo "$months months ago";
	}
}
//Years
else{
	if($years==1){
		echo "one year ago";
	}else{
		echo "$years years ago";
	}
}
}

?>
