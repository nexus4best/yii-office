<?php

use yii\helpers\Html;
use yii\grid\GridView;
use kartik\date\DatePicker;
use yii\bootstrap\Modal;
use yii\helpers\Url;

$this->title = 'Tbl Rechecks';
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tbl-recheck-index">

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'class' => 'yii\grid\SerialColumn',
                'headerOptions' => ['width' => '50'],
            ],
            [
                'attribute' => 'id',
                'headerOptions' => ['width' => '120'],
            ],
            'BrnRepair',
            'BrnSerial',
            'BrnPos',
            'BrnCode',
            // [
            //     'label' => 'ชื่อสาขา',
            //     'attribute' => 'branchBrnName',
            //     'value' => 'branch.BrnName',
            // ],
            [
                'label' => 'แจ้งซ่อม',
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
                'label' => 'รับของ',
                'attribute' => 'ReciveAt',
                'value' => function ($model) {
                    if(!empty($model->ReciveAt)){
                        return substr($model->ReciveAt,8,2).'/'.substr($model->ReciveAt,5,2).'/'.substr($model->ReciveAt,2,2).' '.substr($model->ReciveAt,11,5);
                    }
                },
                'filter' => DatePicker::widget([
                    'type' => DatePicker::TYPE_INPUT,
                    'model' => $searchModel,
                    'attribute' => 'ReciveAt',
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
                'label' => 'วันที่ซ่อม',
                'attribute' => 'RepairAt',
                'value' => function ($model) {
                    if(!empty($model->RepairAt)){
                        return substr($model->RepairAt,8,2).'/'.substr($model->RepairAt,5,2).'/'.substr($model->RepairAt,2,2).' '.substr($model->RepairAt,11,5);
                    }
                },
                'filter' => DatePicker::widget([
                    'type' => DatePicker::TYPE_INPUT,
                    'model' => $searchModel,
                    'attribute' => 'RepairAt',
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
                'label' => 'สถานะซ่อม',
                'attribute' => 'RepairStatus',
                'filter' => array("ส่งเคลมอยู่ในประกัน" => "ส่งเคลมอยู่ในประกัน","รอตรวจซ่อมจากช่าง" => "รอตรวจซ่อมจากช่าง","ซ่อมไม่ได้ รอจำหน่าย" => "ซ่อมไม่ได้ รอจำหน่าย","เก็บคืน stock" => "เก็บคืน stock","ตรวจสอบแล้ว รออะไหล่" => "ตรวจสอบแล้ว รออะไหล่","อยู่ระหว่างตรวจซ่อม"=>"อยู่ระหว่างตรวจซ่อม"),
                'value' => function ($model) {
                    if(empty($model->RepairStatus)){
                        return '';
                    }else{
                        return $model->RepairStatus;
                    }
                },
                //'headerOptions' => ['width' => '120'],
            ],
            [
                'label' => 'ซ่อมโดย',
                'attribute' => 'RepairByName',
                'filter' => array("ราชศักดิ์" => "ราชศักดิ์","ณัฐวุฒิ" => "ณัฐวุฒิ","ชวัท" => "ชวัท","กิตติ" => "กิตติ","ธานี" => "ธานี","อรรคเดช"=>"อรรคเดช"),
                'value' => function ($model) {
                    if(empty($model->RepairByName)){
                        return '';
                    }else{
                        return $model->RepairByName;
                    }
                },
                'headerOptions' => ['width' => '120'],
            ],

            [
                'class' => 'yii\grid\ActionColumn',
                'header' => '',
                'template' => ' {update} ',
                'buttons' => [
                    'update' => function($url,$model){
                        return Html::a(
                            '<span class="glyphicon glyphicon-wrench"></span>',
                            Yii::$app->urlManager->createUrl([
                                'recheck/update',
                                'id' => $model->id,
                            ]),[
                                'title' => Yii::t('app', 'ซ่อม'),
                                'class' => 'recheckUpdate',
                            ]);
                    },
                ],
            ],
        ],
    ]); ?>


</div>

<?php
    Modal::begin([
        'id' => 'RecheckModal',
        'header' => '<h4 class="modal-title">
                        <span class="glyphicon glyphicon-wrench" style="color:red"></span>
                        ตรวจซ่อมจากช่าง
                    </h4>',
    ]);
    echo "<div id='RecheckModalContent'></div>";
    Modal::end();
?>
