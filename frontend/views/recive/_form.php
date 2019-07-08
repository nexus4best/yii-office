<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>

<div class="tbl-recive-form">

    <div class="form-group">
        <div class="row">
            <div class="col-md-6">
            <?php
                    if(strlen($model->id) == 1){
                        $new_id = '00000';
                    }elseif(strlen($model->id) == 2){
                        $new_id = '0000';
                    }elseif(strlen($model->id) == 3){
                        $new_id = '000';
                    }elseif(strlen($model->id) == 4){
                        $new_id = '00';
                    }elseif(strlen($model->id) == 5){
                        $new_id = '0';
                    }
                    echo 'CTS-'.substr($model->CreatedAt,2,2).'-'.substr($model->CreatedAt,5,2).'-'.$new_id.$model->id;        
                ?>    
            </div>
            <div class="col-md-6" align="right"><?= $model->BrnCode.' '.$model->branch->BrnName ?></div>
        </div>    
        <div class="row">
            <div class="col-md-6">
            <?php
                echo '<span style="background:yellow">'.$model->BrnRepair.'</span> เครื่อง '.$model->BrnPos
            ?>    
            </div>
            <div class="col-md-6" align="right">
                <?php 
                    echo 'แจ้งซ่อม '.substr($model->CreatedAt,8,2).'/'.substr($model->CreatedAt,5,2).'/'.substr($model->CreatedAt,2,2).' '.substr($model->CreatedAt,11,5);  
                ?>
            </div>
        </div>     
    </div>

    <?php $form = ActiveForm::begin([
        'id' => 'form_recive',
        'enableAjaxValidation' => true,
    ]); ?>

    <?= $form->field($model, 'BrnBrand')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'BrnModel')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'BrnSerial')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'BrnCause')->textArea(['maxlength' => true]) ?>

    <?= $form->field($model, 'RepairReport')->textArea(['maxlength' => true]) ?>

    <?= $form->field($model, 'RepairStatus')->dropDownList(
                            ["ส่งเคลมอยู่ในประกัน" => "ส่งเคลมอยู่ในประกัน","รอตรวจซ่อมจากช่าง" => "รอตรวจซ่อมจากช่าง","ซ่อมไม่ได้ รอจำหน่าย" => "ซ่อมไม่ได้ รอจำหน่าย","เก็บคืน stock" => "เก็บคืน stock","ตรวจสอบแล้ว รออะไหล่" => "ตรวจสอบแล้ว รออะไหล่"],
                            ['prompt'=>'']); ?>
    <div class="form-group">
        <div style="text-align:right">
            <?= Html::submitButton('บันทึก', ['class' => 'btn btn-success']) ?>
            <a href="#" class="btn btn-default" data-dismiss="modal">ยกเลิก</a>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
