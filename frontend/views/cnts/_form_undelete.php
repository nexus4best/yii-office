<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>

<div class="tbl-repair-form_user_delete">

    <?php $form = ActiveForm::begin([
        'id' => 'form_user_delete',
        'enableAjaxValidation' => true,
    ]); ?>

    <div class="form-group">
        <div class="row">
            <div class="col-md-6"><span class="alert-danger">เลขที่ <?= $model->id ?></span></div>
            <div class="col-md-6" align="right"><?= $model->BrnCode.' '.$model->branch->BrnName ?></div>
        </div>    
    </div>


    <?= $form->field($model, 'BrnRepair')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'BrnCause')->textArea(['maxlength' => true]) ?>

    <?= $form->field($model, 'DeleteCause')->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'DeleteByName')->dropDownList(
                            ["ไพบูลย์" => "ไพบูลย์","ศรัณยู" => "ศรัณยู","วีระภา" => "วีระภา","เชิดศักดิ์" => "เชิดศักดิ์","กัลยา" => "กัลยา"],
                            ['prompt'=>'']); ?>

    <div class="form-group">
        <div style="text-align:right">
            <?= Html::submitButton('บันทึก', ['class' => 'btn btn-danger']) ?>
            <a href="#" class="btn btn-default" data-dismiss="modal">ยกเลิก</a>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
