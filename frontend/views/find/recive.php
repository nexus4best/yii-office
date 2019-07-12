<?php

use yii\helpers\Html;
use yii\grid\GridView;
use kartik\date\DatePicker;

$this->title = 'Tbl Finds';
?>
<div class="tbl-find-index">

    <?php echo $this->render('_searchRecive', ['model' => $searchModel]); ?>

<?php

    if(!isset($_GET['TblFindSearch'])){
        echo '';
    }else{
?>
<?= GridView::widget([
        'dataProvider' => $dataProviderCount,
        //'filterModel' => $searchModel,
        //'filterPosition' => '',
        'summary'=>'',
        'columns' => [
            [
                'class' => 'yii\grid\SerialColumn',
                'headerOptions' => ['width' => '50'],
            ],
            [
                'attribute'=>'BrnRepair',
                'label' => 'รายการ',
                'headerOptions' => ['width' => '400'],
            ],
            [
                'attribute'=>'cntRepair',
                'label' => 'จำนวน',
                'headerOptions' => ['width' => '150'],
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'header' => '',
                'template' => '',
            ]
        ],
    ]); ?>


<?= GridView::widget([
        'dataProvider' => $dataProviderRecive,
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
            'BrnCode',
            [
                'label' => 'ชื่อสาขา',
                'attribute' => 'BrnName',
                'content' => function ($data) {
                    return $data->getBrnName();
                },
                //'headerOptions' => ['width' => '120'],
            ],
            'BrnRepair',
            //'BrnSerial',
            [
                'attribute' => 'BrnCause',
                'value' => function ($model) {
                    return substr($model->BrnCause,0,220);
                },
            ],
            [
                'attribute' => 'RepairStatus',
                'value' => function ($model) {
                    return substr($model->RepairStatus,0,100);
                },
            ],

        ],
    ]); } ?>


</div>
