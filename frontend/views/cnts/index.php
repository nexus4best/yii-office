<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap\Modal;
use yii\helpers\Url;
use kartik\date\DatePicker;

$this->title = 'แจ้งซ่อม IT';
?>
<div class="cnts-repair-index">
    <div class="form-group">
        <div class="row">
            <?php Url::remember(); //echo Url::previous();?>
        </div>
    </div>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'label' => 'สถานะ',
                'attribute' => 'BrnStatus',
                'filter' => array("แจ้งซ่อม" => "แจ้งซ่อม","รับเรื่อง" => "รับเรื่อง","ส่งของ" => "ส่งของ","เรียบร้อย" => "เรียบร้อย","ลบ" => "ลบ"),
                'format' => 'raw',
                'value' => function ($model) {
                    if($model->BrnStatus == 'แจ้งซ่อม'){
                        $brn_status = '<span style="background-color:red;color:white">'.$model->BrnStatus.'</span>';
                    }elseif($model->BrnStatus == 'ลบ'){
                        $brn_status = '<span class="alert-default">'.$model->BrnStatus.'</span>';
                    }elseif($model->BrnStatus == 'เรียบร้อย'){
                        $brn_status = '<span class="alert-success">'.$model->BrnStatus.'</span>';
                    }elseif($model->BrnStatus == 'รับเรื่อง'){
                        $brn_status = '<span class="alert-info">'.$model->BrnStatus.'</span>';
                    }else{
                        $brn_status = $model->BrnStatus;
                    }
                    return $brn_status;
                }
            ],
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
            'BrnRepair',
            [
                'attribute' => 'BrnPos',
                'filter' => array("ADSL" => "ADSL","CCTV" => "CCTV"),
                'headerOptions' => ['width' => '100'],
            ],
            [
                'attribute' => 'BrnCode',
                'headerOptions' => ['width' => '80'],
            ],
            [
                'label' => 'ชื่อสาขา',
                'attribute' => 'branchBrnName',
                'value' => 'branch.BrnName',
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
                        'class' => 'detaildatepicker',
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
                'label' => 'วันที่ส่งของ',
                'attribute' => 'sendCreatedAt',
                'content' => function ($data) {
                    if(empty($data->getSendCreatedAt())){
                        return '';
                    } else {
                        return substr($data->getSendCreatedAt(),8,2).'/'.substr($data->getSendCreatedAt(),5,2).'/'.substr($data->getSendCreatedAt(),2,2).' '.substr($data->getSendCreatedAt(),11,5); 
                    }
                },
                'filter' => DatePicker::widget([
                    'type' => DatePicker::TYPE_INPUT,
                    'model' => $searchModel,
                    'attribute' => 'sendCreatedAt',
                    'options' => [
                        'template' => '{widget}{error}',
                        'class' => 'detaildatepicker',
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
                'label' => 'ผู้จัดส่ง',
                'attribute' => 'sendSendByName',
                'filter' => array("ไพบูลย์" => "ไพบูลย์","ศรัณยู" => "ศรัณยู","วีระภา" => "วีระภา","เชิดศักดิ์" => "เชิดศักดิ์","กัลยา" => "กัลยา"),
                'content' => function ($data) {
                    if(empty($data->getSendByName())){
                        return '';
                    } else {
                        return $data->getSendByName();
                    }
                },
                'headerOptions' => ['width' => '120'],
            ],
            [
                'label' => 'ผู้รับเรื่อง',
                'attribute' => 'UserAccept',
                'filter' => array("ไพบูลย์" => "ไพบูลย์","ศรัณยู" => "ศรัณยู","วีระภา" => "วีระภา","เชิดศักดิ์" => "เชิดศักดิ์","กัลยา" => "กัลยา"),
                'value' => function ($model) {
                    if(empty($model->UserAccept)){
                        return '';
                    }else{
                        return $model->UserAccept;
                    }
                },
                'headerOptions' => ['width' => '120'],
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'header' => '',
                'template' => '{view} {useraccept} {send} {delete}',
                'buttons' => [
                    'delete' => function($url,$model){
                        return ($model->BrnStatus <> 'ลบ' && $model->BrnStatus <> 'เรียบร้อย' && $model->BrnStatus <> 'ส่งของ') ? Html::a(
                            '<span class="glyphicon glyphicon-trash"></span>',
                            Yii::$app->urlManager->createUrl([
                                'cnts/undelete',
                                'id' => $model->id,
                            ]),[
                                'title' => Yii::t('app', 'ลบ'),
                                'class' => 'userDelete',
                            ]) : '';
                    },
                    'view' => function($url,$model){
                        return Html::a(
                            '<span class="glyphicon glyphicon-search"></span>',
                            Yii::$app->urlManager->createUrl([
                                'cnts/view',
                                'id' => $model->id,
                            ]),[
                                'title' => Yii::t('app', 'แสดง'),
                                'class' => 'userView',
                            ]);
                    },
                    'useraccept' => function($url,$model){
                        return $model->BrnStatus == 'แจ้งซ่อม' ? Html::a(
                            '<span class="glyphicon glyphicon-user"></span>',
                            Yii::$app->urlManager->createUrl([
                                'cnts/useraccept',
                                'id' => $model->id,
                            ]),[
                                'title' => Yii::t('app', 'รับเรื่อง'),
                                'class' => 'userAccept',
                            ]) : '';
                    },
                    'send' => function($url,$model){
                        return $model->BrnStatus == 'รับเรื่อง' ? Html::a(
                            '<span class="glyphicon glyphicon-plus"></span>',
                            Yii::$app->urlManager->createUrl([
                                'cnts/send',
                                'id' => $model->id,
                            ]),[
                                'title' => Yii::t('app', 'ส่งของ'),
                                'class' => 'sendBranch',
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
        'id' => 'viewModal',
        'header' => '<h4 class="modal-title">แสดง</h4>',
    ]);
    echo "<div id='viewModalContent'></div>";
    Modal::end();
?>

<?php
    Modal::begin([
        'id' => 'userAcceptModal',
        'header' => '<h4 class="modal-title">รับเรื่อง</h4>',
    ]);
    echo "<div id='userAcceptModalContent'></div>";
    Modal::end();
?>

<?php
    Modal::begin([
        'id' => 'sendModal',
        'header' => '<h4 class="modal-title">ส่งของ</h4>',
    ]);
    echo "<div id='sendModalContent'></div>";
    Modal::end();
?>

<?php
    Modal::begin([
        'id' => 'deleteModal',
        'header' => '<h4 class="modal-title">ลบ</h4>',
    ]);
    echo "<div id='deleteModalContent'></div>";
    Modal::end();
?>

