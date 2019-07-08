<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

$this->title = $model->id;

\yii\web\YiiAsset::register($this);
?>
<div class="tbl-recive-view">

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'BrnStatus',
            [
                'label' => 'สาขา',
                'value' => $model->BrnCode.' '.$model->branch->BrnName,
            ],
            'BrnRepair',
            'BrnPos',
            'BrnBrand',
            'BrnModel',
            'BrnSerial',
            'BrnCause',
            'BrnCreateByName',
            [
                'format' => 'html',
                'label' => 'วันที่สร้าง',
                'value' => substr($model->CreatedAt,8,2).'/'.substr($model->CreatedAt,5,2).'/'.substr($model->CreatedAt,2,2).' '
                    .substr($model->CreatedAt,11,5).' '.$model->BrnCreateByName,
                    //.' <span style="color:blue;">'.Yii::$app->formatter->asRelativeTime($model->CreatedAt).'</span>',
            ],
        ],
    ]) ?>

</div>
