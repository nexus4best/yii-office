<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\TblNavision */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tbl-navision-form">

    <?php $form = ActiveForm::begin([
        'id' => 'form_send',
        'enableAjaxValidation' => true,
    ]); ?>

<div class="form-group">
        <div class="row">
            <div class="col-md-6">
                <span style="background-color:yellow">
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
                </span>
            </div>
            <div class="col-md-6" align="right"><?= $model->repair->BrnCode.' '.$model->branch->BrnName ?></div>
        </div>    
        <div class="row">
            <div class="col-md-6">รายการ <?= $model->repair->BrnRepair ?></div>
            <div class="col-md-6" align="right">เครื่อง <?= $model->repair->BrnPos ?></div>
        </div>    
        <div class="row">
            <div class="col-md-12">สาเหตุ <?= $model->repair->BrnCause ?></div>
        </div>         
    </div>

    <?= $form->field($model, 'SendBrand')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'SendModel')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'SendSerial')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'SendNavision')->textInput(['maxlength' => true]) ?>


    <div class="form-group">
        <div style="text-align:right">
            <?= Html::submitButton('บันทึก', ['class' => 'btn btn-success']) ?>
            <a href="#" class="btn btn-default" data-dismiss="modal">ยกเลิก</a>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
