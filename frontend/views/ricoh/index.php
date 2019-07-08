<?php

use yii\helpers\Html;
use yii\grid\GridView;
use kartik\date\DatePicker;
use yii\bootstrap\Modal;
use yii\widgets\Pjax;

$this->title = 'Ricoh';
?>
<div class="ricoh-repair-index">
<div class="form-group">
    <?php Pjax::begin(); ?>
    <?= Html::a("SendMail", ['ricoh/sendmail'], ['class' => 'btn btn-primary']) ?>
    <?php
        if(!empty($response)){
            echo $response;
        }
    ?>
    <?php Pjax::end(); ?>
</div>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'summary'=>'',
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'label' => 'สถานะ',
                'attribute' => 'BrnStatus',
                'filter' => array("แจ้งซ่อม" => "แจ้งซ่อม","SendMail" => "SendMail","ส่งของ" => "ส่งของ","เรียบร้อย" => "เรียบร้อย","ลบ" => "ลบ"),
                'format' => 'raw',
                'value' => function ($model) {
                    if($model->BrnStatus == 'แจ้งซ่อม'){
                        $brn_status = '<span style="background-color:red;color:white">'.$model->BrnStatus.'</span>';
                    }elseif($model->BrnStatus == 'ลบ'){
                        $brn_status = '<span class="alert-default">'.$model->BrnStatus.'</span>';
                    }elseif($model->BrnStatus == 'เรียบร้อย'){
                        $brn_status = '<span class="alert-success">'.$model->BrnStatus.'</span>';
                    }elseif($model->BrnStatus == 'SendMail'){
                        $brn_status = '<span style="color:blue"><i class="glyphicon glyphicon-envelope"></i></span>';
                    }else{
                        $brn_status = $model->BrnStatus;
                    }
                    return $brn_status;
                },
                //'headerOptions' => ['width' => '120'],
            ],
            [
                'attribute' => 'id',
                //'headerOptions' => ['width' => '120'],
            ],
            [
                'attribute' => 'BrnSerial',
                //'headerOptions' => ['width' => '120'],
            ],
            [
                'attribute' => 'BrnCode',
                //'headerOptions' => ['width' => '120'],
            ],
            [
                'label' => 'วันที่แจ้งซ่อม',
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
                //'headerOptions' => ['width' => '150'],
            ],
            [
                'label' => 'วันที่รับเรื่อง',
                'attribute' => 'OpenJobAt',
                'value' => function ($model) {
                    if(!empty($model->ricoh->UpdatedAt)){
                        return substr($model->ricoh->UpdatedAt,8,2).'/'.substr($model->ricoh->UpdatedAt,5,2).'/'.substr($model->ricoh->UpdatedAt,2,2).' '.substr($model->ricoh->UpdatedAt,11,5);
                    }
                },
                'filter' => DatePicker::widget([
                    'type' => DatePicker::TYPE_INPUT,
                    'model' => $searchModel,
                    'attribute' => 'OpenJobAt',
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
                //'headerOptions' => ['width' => '150'],
            ],
            [
                'label' => 'job',
                'attribute' => 'OpenJob',
                'value' => 'ricoh.OpenJob',
                //'headerOptions' => ['width' => '120'],
            ],
            [
                'attribute' => 'BrnCause',
                //'headerOptions' => ['width' => '150'],
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'header' => '',
                'template' => '{view} {update} {delete} {openjob}',
                'buttons' => [
                    'view' => function($url,$model){
                        return Html::a(
                            '<span class="glyphicon glyphicon-search"></span>',
                            Yii::$app->urlManager->createUrl([
                                'ricoh/view',
                                'id' => $model->id,
                            ]),[
                                'title' => Yii::t('app', 'แสดง'),
                                'class' => 'RicohView',
                            ]);
                    },
                    'delete' => function($url,$model){
                        return ($model->BrnStatus <> 'ลบ' && $model->BrnStatus <> 'เรียบร้อย' && $model->BrnStatus <> 'ส่งของ') ? Html::a(
                            '<span class="glyphicon glyphicon-trash"></span>',
                            Yii::$app->urlManager->createUrl([
                                'ricoh/undelete',
                                'id' => $model->id,
                            ]),[
                                'title' => Yii::t('app', 'ลบ'),
                                'class' => 'ricohDelete',
                            ]) : '';
                    },
                    'openjob' => function($url,$model){
                        return ($model->BrnStatus=='SendMail') ? Html::a(
                            '<span class="glyphicon glyphicon-print"></span>',
                            Yii::$app->urlManager->createUrl([
                                'ricoh/openjob',
                                'id' => $model->id,
                            ]),[
                                'title' => Yii::t('app', 'เปิด job'),
                                'class' => 'ricohOpenjob',
                            ]) : '';
                    },
                    'update' => function($url,$model){
                        return ($model->BrnStatus == 'แจ้งซ่อม') ? Html::a(
                            '<span class="glyphicon glyphicon-pencil"></span>',
                            Yii::$app->urlManager->createUrl([
                                'ricoh/update',
                                'id' => $model->id,
                            ]),[
                                'title' => Yii::t('app', 'แก้ไข'),
                                'class' => 'ricohUpdate',
                            ]) : '';
                    },
                ],
            ],
        ],
        'tableOptions' => ['class'=>'table table-striped table-bordered table-hover'],
    ]); ?>


</div>

<?php
    Modal::begin([
        'id' => 'ricohViewModal',
        'header' => '<h4 class="modal-title">แสดง</h4>',
    ]);
    echo "<div id='ricohViewModalContent'></div>";
    Modal::end();
?>

<?php
    Modal::begin([
        'id' => 'ricohModal',
        'header' => '<h4 class="modal-title">Ricoh</h4>',
    ]);
    echo "<div id='ricohModalContent'></div>";
    Modal::end();
?>

<?php
    Modal::begin([
        'id' => 'ricohModalOpenjob',
        'header' => '<h4 class="modal-title">Ricoh</h4>',
    ]);
    echo "<div id='ricohModalContentOpenJob'></div>";
    Modal::end();
?>

<?php
    Modal::begin([
        'id' => 'deleteRicohModal',
        'header' => '<h4 class="modal-title">ลบ</h4>',
    ]);
    echo "<div id='deleteRicohModalContent'></div>";
    Modal::end();
?>
