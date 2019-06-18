<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\CntsRepair */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cnts-repair-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'BrnStatus')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'BrnCode')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'BrnRepair')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'BrnPos')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'BrnBrand')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'BrnModel')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'BrnSerial')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'BrnCause')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'BrnUserCreate')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'CreatedAt')->textInput() ?>

    <?= $form->field($model, 'UpdatedAt')->textInput() ?>

    <?= $form->field($model, 'UserAccept')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'UserAcceptAt')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
