<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\RicohRepair */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Ricoh', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="ricoh-repair-view">

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'BrnStatus',
            [
                'label' => 'สาขา',
                'value' => $model->BrnCode.' '.$model->branch->BrnName,
            ],
            'RicohJob',
            'BrnSerial',
            'BrnCause',
            'BrnUserCreate',
            [
                'label' => 'วันที่สร้าง',
                'value' => $model->CreatedAt,
            ],
            //'UpdatedAt',
            [
                'label' => 'วันที่เปิด job',
                'value' => $model->UserAcceptAt,
            ],
            [
                'label' => 'Job',
                'value' => $model->RicohJob,
            ],
            [
                'label' => 'ผู้รับเรื่อง',
                'value' => $model->UserAccept,
            ],
        ],
    ]) ?>

</div>
