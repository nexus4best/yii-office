<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\TblFind */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tbl-find-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'BrnStatus')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'BrnCode')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'BrnRepair')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'BrnPos')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'BrnBrand')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'BrnModel')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'BrnSerial')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'BrnCause')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'BrnCreateByName')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'AcceptAt')->textInput() ?>

    <?= $form->field($model, 'AcceptByName')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'DeleteByName')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'DeleteCause')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'DeleteIP')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ReciveAt')->textInput() ?>

    <?= $form->field($model, 'RepairAt')->textInput() ?>

    <?= $form->field($model, 'RepairStatus')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'RepairReport')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'RepairByName')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'CreatedAt')->textInput() ?>

    <?= $form->field($model, 'UpdatedAt')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
