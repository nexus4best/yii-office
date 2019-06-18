<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\CntsRepairSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cnts-repair-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'BrnStatus') ?>

    <?= $form->field($model, 'BrnCode') ?>

    <?= $form->field($model, 'BrnRepair') ?>

    <?= $form->field($model, 'BrnPos') ?>

    <?php // echo $form->field($model, 'BrnBrand') ?>

    <?php // echo $form->field($model, 'BrnModel') ?>

    <?php // echo $form->field($model, 'BrnSerial') ?>

    <?php // echo $form->field($model, 'BrnCause') ?>

    <?php // echo $form->field($model, 'BrnUserCreate') ?>

    <?php // echo $form->field($model, 'CreatedAt') ?>

    <?php // echo $form->field($model, 'UpdatedAt') ?>

    <?php // echo $form->field($model, 'UserAccept') ?>

    <?php // echo $form->field($model, 'UserAcceptAt') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
