<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>

<div class="tbl-repair-form_user_accept">

    <?php $form = ActiveForm::begin([
        'id' => 'form_user_accept',
        'enableAjaxValidation' => true,
    ]); ?>

    <?= $form->field($model, 'BrnRepair')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'BrnPos')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'BrnCause')->textArea(['maxlength' => true]) ?>

    <?= $form->field($model, 'UserAccept')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
