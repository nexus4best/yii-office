<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\TblNavisionSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tbl-navision-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'SendBrand') ?>

    <?= $form->field($model, 'SendModel') ?>

    <?= $form->field($model, 'SendSerial') ?>

    <?= $form->field($model, 'SendByName') ?>

    <?php // echo $form->field($model, 'SendFrom') ?>

    <?php // echo $form->field($model, 'SendNumber') ?>

    <?php // echo $form->field($model, 'SendIP') ?>

    <?php // echo $form->field($model, 'SendNavision') ?>

    <?php // echo $form->field($model, 'SendNavisionAt') ?>

    <?php // echo $form->field($model, 'CreatedAt') ?>

    <?php // echo $form->field($model, 'UpdatedAt') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
