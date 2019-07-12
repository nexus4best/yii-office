<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;

?>

<div class="tbl-find-search">

    <?php $form = ActiveForm::begin([
        'action' => ['recive'],
        'method' => 'get',
        'options' => [
            'class' => 'form-inline'
         ]
    ]); ?>

    <?= $form->field($model, 'dateStart')->widget(DatePicker::className(),[
                        'type' => DatePicker::TYPE_INPUT,
                        'removeButton' => ['icon' => 'trash'],
                        'pickerButton' => false,
                        'options' => [
                            'placeholder'=> 'วันที่เริ่มต้น',
                            'template' => '{widget}{error}',
                            //'class' => 'form-group'
                        ],
                        'pluginOptions' => [
                            'format' => 'yyyy-mm-dd',
                            'autoclose' => true,
                            'todayHighlight' => true,
                        ]
                ]);
    ?>

    <?= $form->field($model, 'dateStop')->widget(DatePicker::className(),[
                        'type' => DatePicker::TYPE_INPUT,
                        'removeButton' => ['icon' => 'trash'],
                        'pickerButton' => false,
                        'options' => [
                            'placeholder'=> 'วันที่สุดท้าย',
                            'template' => '{widget}{error}',
                            //'class' => 'form-group'
                        ],
                        'pluginOptions' => [
                            'format' => 'yyyy-mm-dd',
                            'autoclose' => true,
                            'todayHighlight' => true,
                        ]
                ]);
    ?>

    <div class="form-group" style="margin-top:-10px">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
