<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\TblRecheckSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tbl-recheck-search">

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

    <?php // echo $form->field($model, 'BrnCreateByName') ?>

    <?php // echo $form->field($model, 'AcceptAt') ?>

    <?php // echo $form->field($model, 'AcceptByName') ?>

    <?php // echo $form->field($model, 'DeleteByName') ?>

    <?php // echo $form->field($model, 'DeleteCause') ?>

    <?php // echo $form->field($model, 'DeleteIP') ?>

    <?php // echo $form->field($model, 'ReciveAt') ?>

    <?php // echo $form->field($model, 'RepairAt') ?>

    <?php // echo $form->field($model, 'RepairStatus') ?>

    <?php // echo $form->field($model, 'RepairReport') ?>

    <?php // echo $form->field($model, 'RepairByName') ?>

    <?php // echo $form->field($model, 'CreatedAt') ?>

    <?php // echo $form->field($model, 'UpdatedAt') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
