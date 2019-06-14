<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap\Modal;

$this->title = 'Tbl Repairs';
?>
<div class="tbl-repair-index">

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'BrnStatus',
            'BrnCode',
            'BrnRepair',
            'BrnPos',
            //'BrnBrand',
            //'BrnModel',
            //'BrnSerial',
            //'BrnCause',
            //'BrnUserCreate',
            //'CreatedAt',
            //'UpdatedAt',
            //'UserAccept',
            //'UserAcceptAt',

            [
                'class' => 'yii\grid\ActionColumn',
                'header' => '',
                'template' => '{useraccept}',
                'buttons' => [
                    'useraccept' => function($url,$model){
                        return $model->BrnStatus == 'แจ้งซ่อม' ? Html::a(
                            '<span class="glyphicon glyphicon-user"></span>',
                            Yii::$app->urlManager->createUrl([
                                'cts/useraccept',
                                'id' => $model->id,
                                //'edit' => 't'
                            ]),[
                                'title' => Yii::t('app', 'รับเรื่อง'),
                                'class' => 'userAccept',
                            ]) : '';
                    },
                ],
            ],
        ],
    ]); ?>


</div>

<?php
    Modal::begin([
        'id' => 'userAcceptModal',
        'header' => '<h4 class="modal-title">รับเรื่อง</h4>',
    ]);
    echo "<div id='userAcceptModalContent'></div>";
    Modal::end();
?>
