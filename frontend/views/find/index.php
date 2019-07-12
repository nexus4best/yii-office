<?php

use yii\helpers\Html;
use yii\grid\GridView;
use kartik\date\DatePicker;

$this->title = 'Tbl Finds';
?>
<div class="tbl-find-index">

    <?php echo $this->render('_search', ['model' => $searchModel]); ?>

<?php

    if(!isset($_GET['TblFindSearch'])){
        echo '';
    }else{
?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            [
                'class' => 'yii\grid\SerialColumn',
                'headerOptions' => ['width' => '50'],
            ],
            [
                'label' => 'เลขที่',
                'attribute' => 'id',
                'headerOptions' => ['width' => '120'],
            ],
            [
                'label' => 'สาขา',
                'attribute' => 'BrnCode',
                'headerOptions' => ['width' => '120'],
            ],
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
            'BrnSerial',
            'BrnRepair',
            'BrnPos',  
            'BrnCause',
            'RepairStatus',         
        ],
    ]);  ?>

<?= GridView::widget([
        'dataProvider' => $dataProviderSend,
        //'filterModel' => $searchModel,
        'columns' => [
            [
                'class' => 'yii\grid\SerialColumn',
                'headerOptions' => ['width' => '50'],
            ],
            [
                'label' => 'เลขที่',
                'attribute' => 'id',
                'headerOptions' => ['width' => '120'],
            ],
            [
                'label' => 'สาขา',
                'attribute' => 'BrnCode',
                'content' => function ($data) {
                    return $data->getBrnCode();
                },
                'headerOptions' => ['width' => '120'],
            ],
            [
                'label' => 'วันที่ส่ง',
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
                'label' => 'หมายเลขที่ส่ง',
                'attribute' => 'SendSerial',
                //'headerOptions' => ['width' => '200'],
            ],
            [
                'label' => 'ยี่ห้อที่ส่ง',
                'attribute' => 'SendBrand',
                //'headerOptions' => ['width' => '120'],
            ],
            [
                'label' => 'ผู้จัดส่ง',
                'attribute' => 'SendByName',
                //'headerOptions' => ['width' => '120'],
            ],

        ],
    ]); } ?>


</div>
