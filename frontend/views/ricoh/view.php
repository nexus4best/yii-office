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

<?php if($model->BrnStatus=='แจ้งซ่อม'){ ?>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'BrnStatus',
            [
                'label' => 'สาขา',
                'value' => $model->BrnCode.' '.$model->branch->BrnName,
            ],
            'BrnSerial',
            'BrnCause',
            'BrnCreateByName',
            [
                'label' => 'วันที่สร้าง',
                'value' => $model->CreatedAt,
            ],
        ],
    ]) ?>
<?php }elseif($model->BrnStatus=='SendMail'){ ?>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'BrnStatus',
            [
                'label' => 'สาขา',
                'value' => $model->BrnCode.' '.$model->branch->BrnName,
            ],
            'BrnSerial',
            'BrnCause',
            'BrnCreateByName',
            [
                'label' => 'วันที่สร้าง',
                'value' => $model->CreatedAt,
            ],
            [
                'label' => 'วันที่รับเรื่อง SendMail',
                'value' => $model->UpdatedAt,
            ],
        ],
    ]) ?>
<?php }elseif($model->BrnStatus=='ส่งของ'){ ?>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'BrnStatus',
            [
                'label' => 'สาขา',
                'value' => $model->BrnCode.' '.$model->branch->BrnName,
            ],
            'BrnSerial',
            'BrnCause',
            'BrnCreateByName',
            [
                'label' => 'วันที่สร้าง',
                'value' => $model->CreatedAt,
            ],
            [
                'label' => 'วันที่รับเรื่อง',
                'value' => $model->ricoh->UpdatedAt,
            ],
            [
                'label' => 'ผู้รับเรื่อง',
                'value' => $model->ricoh->OpenJobByName,
            ],
            [
                'label' => 'Job',
                'value' => $model->ricoh->OpenJob,
            ],
        ],
    ]) ?>
<?php }elseif($model->BrnStatus=='เรียบร้อย'){ ?>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'BrnStatus',
            [
                'label' => 'สาขา',
                'value' => $model->BrnCode.' '.$model->branch->BrnName,
            ],
            'BrnSerial',
            'BrnCause',
            'BrnCreateByName',
            [
                'label' => 'วันที่สร้าง',
                'value' => $model->CreatedAt,
            ],
            [
                'label' => 'วันที่รับเรื่อง',
                'value' => $model->ricoh->UpdatedAt,
            ],
            [
                'label' => 'ผู้รับเรื่อง',
                'value' => $model->ricoh->OpenJobByName,
            ],
            [
                'label' => 'Job',
                'value' => $model->ricoh->OpenJob,
            ],
            [
                'label' => 'ข้อเสนอแนะ',
                'value' => $model->comment->Message,
            ],
            [
                'label' => 'ผู้เสนอแนะ',
                'value' => $model->comment->MessageByName,
            ],
            [
                'label' => 'วันที่เสนอแนะ',
                'value' => $model->comment->CreatedAt,
            ],
        ],
    ]) ?>
<?php }elseif($model->BrnStatus=='ลบ'){ ?>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'BrnStatus',
            [
                'label' => 'สาขา',
                'value' => $model->BrnCode.' '.$model->branch->BrnName,
            ],
            'BrnSerial',
            'BrnCause',
            'BrnCreateByName',
            [
                'label' => 'วันที่สร้าง',
                'value' => $model->CreatedAt,
            ],
            [
                'label' => 'วันที่ลบ',
                'value' => $model->UpdatedAt,
            ],
            'DeleteCause',
            'DeleteByName',

        ],
    ]) ?>
<?php } ?>

</div>
