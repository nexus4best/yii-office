<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>

<div class="tbl-repair-form_user_accept">

    <?php $form = ActiveForm::begin([
        'id' => 'form_user_accept',
        'enableAjaxValidation' => true,
    ]); ?>

    <div class="form-group">
        <div class="row">
            <div class="col-md-6"><span class="alert-danger">เลขที่ <?= $model->id ?></span></div>
            <div class="col-md-6" align="right"><?= $model->BrnCode.' '.$model->branch->BrnName ?></div>
        </div>    
    </div>


    <?= $form->field($model, 'BrnRepair')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'BrnPos')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'BrnCause')->textArea(['maxlength' => true]) ?>

    <?= $form->field($model, 'UserAccept')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <div style="text-align:right">
            <?= Html::submitButton('บันทึก', ['class' => 'btn btn-success']) ?>
            <a href="#" class="btn btn-default" data-dismiss="modal">ยกเลิก</a>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
