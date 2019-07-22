<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap\Modal;
use yii\helpers\Url;
use kartik\date\DatePicker;

$this->title = 'รายการส่งของ';

?>
<div class="tbl-navision-index">

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'summary'=>'',
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'id',
                'format' => 'raw',
                'value' => function ($model) {
                    if(strlen($model->id) == 1){
                        $new_id = '00000';
                    }elseif(strlen($model->id) == 2){
                        $new_id = '0000';
                    }elseif(strlen($model->id) == 3){
                        $new_id = '000';
                    }elseif(strlen($model->id) == 4){
                        $new_id = '00';
                    }elseif(strlen($model->id) == 5){
                        $new_id = '0';
                    }
                    return 'CTS-'.substr($model->CreatedAt,2,2).'-'.substr($model->CreatedAt,5,2).'-'.$new_id.$model->id;
                },
                'headerOptions' => ['width' => '125'],
            ],
            [
                'label' => 'รหัส',
                'attribute' => 'BrnCode',
                'content' => function ($data) {
                    return $data->getBrnCode();
                },
                'headerOptions' => ['width' => '100'],
            ],
            [
                'label' => 'เครื่อง',
                'attribute' => 'BrnPos',
                'content' => function ($data) {
                    return $data->getBrnPos();
                },
                'headerOptions' => ['width' => '100'],
            ],
            [
                'label' => 'รายการ',
                'attribute' => 'BrnRepair',
                'content' => function ($data) {
                    return $data->getBrnREpair();
                },
            ],
            'SendBrand',
            'SendModel',
            'SendSerial',
            [
                'label' => 'วันที่ส่งของ',
                'attribute' => 'CreatedAt',
                'value' => function ($model) {
                    return substr($model->CreatedAt,8,2).'/'.substr($model->CreatedAt,5,2).'/'.substr($model->CreatedAt,2,2).' '.substr($model->CreatedAt,11,5);
                },
                'filter' => DatePicker::widget([
                    'type' => DatePicker::TYPE_INPUT,
                    'model' => $searchModel,
                    'attribute' => 'CreatedAt',
                    'options' => [
                        'template' => '{widget}{error}',
                        //'class' => 'form-control krajee-datepicker',
                        ],
                        'pluginOptions' => [
                            'todayHighlight' => true,
                            'autoclose' => true,
                            'format' => 'yyyy-mm-dd',
                        ]
                ]),
                'headerOptions' => ['width' => '120'],
            ],
            [
                'attribute' => 'SendByName',
                'headerOptions' => ['width' => '120'],
            ],
            [
                'attribute' => 'SendNavision',
                'headerOptions' => ['width' => '120'],
            ],

            [
                'class' => 'yii\grid\ActionColumn',
                'header' => '',
                'template' => '{update}',
                'buttons' => [
                    'update' => function($url,$model){
                        return Html::a(
                            '<span class="glyphicon glyphicon-user"></span>',
                            Yii::$app->urlManager->createUrl([
                                'send/update',
                                'id' => $model->id,
                            ]),[
                                'title' => Yii::t('app', 'Navision'),
                                'class' => 'sendNavision',
                            ]);
                    },
                ],
            ],
        ],
    ]); ?>


</div>

<?php
    Modal::begin([
        'id' => 'sendModal',
        'header' => '<h4 class="modal-title">Navision รายการส่งของ</h4>',
    ]);
    echo "<div id='sendModalContent'></div>";
    Modal::end();
?>
