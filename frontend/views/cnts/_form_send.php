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
            <div class="col-md-6"><span class="alert-danger">เลขที่ <?= $model->id ?></span></div>
            <div class="col-md-6" align="right"><?= $model->BrnCode.' '.$model->branch->BrnName ?></div>
        </div>    
    </div>

    <div class="row">
        <div class="col-md-12">
            <?= $form->field($model, 'BrnRepair')->textInput(['maxlength' => true, 'readonly' => 'readonly']) ?>
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
                            ["ไพบูลย์" => "ไพบูลย์","ศรัณยู" => "ศรัณยู","วีระภา" => "วีระภา","เชิดศักดิ์" => "เชิดศักดิ์","กัลยา" => "กัลยา"],
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
