<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">
                <span style="color:blue"><i class="glyphicon glyphicon-print"></i></span>
                    บันทึก job <?= $model->BrnRepair ?>
                </h3>
            </div>
            <div class="panel-body">
                <div class="ricoh-repair-form">

                <?php $form = ActiveForm::begin([
                        'id' => 'form-repair-form',
                        'enableAjaxValidation' => true,
                ]); ?>

                <div class="form-group">
                    <div class="row">
                        <div class="col-md-6"><span class="alert-danger">เลขที่ <?= $model->id ?></span></div>
                        <div class="col-md-6" align="right"><?= $model->BrnCode.' '.$model->branch->BrnName ?></div>
                    </div>    
                </div>

                <?= $form->field($model, 'BrnCause')->textInput(['maxlength' => true]) ?>

                <?= $form->field($new_ricoh, 'OpenJob')->textInput(['maxlength' => true]) ?>

                <?= $form->field($new_ricoh, 'OpenJobByName')->dropDownList(
                        ["ราชศักดิ์" => "ราชศักดิ์","ณัฐวุฒิ" => "ณัฐวุฒิ","ชวัท" => "ชวัท","กิตติ" => "กิตติ","ธานี" => "ธานี"],
                        ['prompt'=>'']); ?>

                <div class="form-group">
                        <div style="text-align:right">
                            <?= Html::submitButton('บันทึก', ['class' => 'btn btn-success']) ?>
                            <a href="#" class="btn btn-default" data-dismiss="modal">ยกเลิก</a>
                        </div>
                </div>

                <?php ActiveForm::end(); ?>

                </div>
            </div>
        </div>
    </div>
</div>
