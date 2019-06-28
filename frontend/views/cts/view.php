<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\TblRepair */

$this->title = $model->id;
//$this->params['breadcrumbs'][] = ['label' => 'Tbl Repairs', 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="tbl-repair-view">

<?php
    if($model->BrnStatus == 'แจ้งซ่อม'){
        echo DetailView::widget([
            'model' => $model,
            'attributes' => [
                'id',
                //'BrnStatus',
                [
                    'format' => 'html',
                    'label' => 'สถานะ',
                    'value' => '<span style="background-color:red;color:white;">'.$model->BrnStatus.'</span>',
                ],
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
                //'UpdatedAt',
                //'AcceptByName',
                //'AcceptAt',
            ],
        ]);
    }elseif($model->BrnStatus == 'รับเรื่อง'){
        echo DetailView::widget([
            'model' => $model,
            'attributes' => [
                'id',
                //'BrnStatus',
                [
                    'format' => 'html',
                    'label' => 'สถานะ',
                    'value' => '<span class="alert-info">'.$model->BrnStatus.'</span>',
                ],
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
                //'BrnCreateByName',
                //'AcceptByName',
                [
                    'format' => 'html',
                    'label' => 'วันที่สร้าง',
                    'value' => substr($model->CreatedAt,8,2).'/'.substr($model->CreatedAt,5,2).'/'.substr($model->CreatedAt,2,2).' '.substr($model->CreatedAt,11,5).' '.$model->BrnCreateByName,
                        //.' <span style="color:blue;">'.Yii::$app->formatter->asRelativeTime($model->CreatedAt).'</span>',
                ],
                [
                    'format' => 'html',
                    'label' => 'วันที่รับเรื่อง',
                    'value' => substr($model->AcceptAt,8,2).'/'.substr($model->AcceptAt,5,2).'/'.substr($model->AcceptAt,2,2).' '.substr($model->AcceptAt,11,5).' '.$model->AcceptByName,
                ],
                //'UpdatedAt',
                //'AcceptByName',
                //'AcceptAt',
            ],
        ]);
    }elseif($model->BrnStatus == 'ส่งของ'){
        echo DetailView::widget([
            'model' => $model,
            'attributes' => [
                'id',
                //'BrnStatus',
                [
                    'format' => 'html',
                    'label' => 'สถานะ',
                    'value' => '<span style="color:blue">'.$model->BrnStatus.'</span>',
                ],
                [
                    'label' => 'สาขา',
                    'value' => $model->BrnCode.' '.$model->branch->BrnName,
                ],
                'BrnRepair',
                'BrnPos',
                [
                    'format'=> 'html',
                    'label' => 'ยี่ห้อ',
                    'value' => $model->BrnBrand.' | <span style="color:blue">'.$model->send->SendBrand.'</span>',
                ],
                [
                    'format'=> 'html',
                    'label' => 'รุ่น',
                    'value' => $model->BrnModel.' | <span style="color:blue">'.$model->send->SendModel.'</span>',
                ],
                [
                    'format'=> 'html',
                    'label' => 'หมายเลข',
                    'value' => $model->BrnSerial.' | <span style="color:blue">'.$model->send->SendSerial.'</span>',
                ],
                'BrnCause',
                //'BrnCreateByName',
                //'AcceptByName',
                [
                    'format' => 'html',
                    'label' => 'วันที่สร้าง',
                    'value' => substr($model->CreatedAt,8,2).'/'.substr($model->CreatedAt,5,2).'/'.substr($model->CreatedAt,2,2).' '.substr($model->CreatedAt,11,5).' '.$model->BrnCreateByName,
                        //.' <span style="color:blue;">'.Yii::$app->formatter->asRelativeTime($model->CreatedAt).'</span>',
                ],
                [
                    'format' => 'html',
                    'label' => 'วันที่รับเรื่อง',
                    'value' => substr($model->AcceptAt,8,2).'/'.substr($model->AcceptAt,5,2).'/'.substr($model->AcceptAt,2,2).' '.substr($model->AcceptAt,11,5).' '.$model->AcceptByName,
                ],
                [
                    'format' => 'html',
                    'label' => 'วันที่ส่งของ',
                    'value' => substr($model->getSendCreatedAt(),8,2).'/'.substr($model->getSendCreatedAt(),5,2).'/'.substr($model->getSendCreatedAt(),2,2).' '.substr($model->getSendCreatedAt(),11,5).' '.$model->getSendByName(),
                ],
                //'UpdatedAt',
                //'AcceptByName',
                //'AcceptAt',
            ],
        ]);
    }elseif($model->BrnStatus == 'เรียบร้อย'){
        echo DetailView::widget([
            'model' => $model,
            'attributes' => [
                'id',
                //'BrnStatus',
                [
                    'format' => 'html',
                    'label' => 'สถานะ',
                    'value' => '<span style="color:blue">'.$model->BrnStatus.'</span>',
                ],
                [
                    'label' => 'สาขา',
                    'value' => $model->BrnCode.' '.$model->branch->BrnName,
                ],
                'BrnRepair',
                'BrnPos',
                [
                    'format'=> 'html',
                    'label' => 'ยี่ห้อ',
                    'value' => $model->BrnBrand.' | <span style="color:blue">'.$model->send->SendBrand.'</span>',
                ],
                [
                    'format'=> 'html',
                    'label' => 'รุ่น',
                    'value' => $model->BrnModel.' | <span style="color:blue">'.$model->send->SendModel.'</span>',
                ],
                [
                    'format'=> 'html',
                    'label' => 'หมายเลข',
                    'value' => $model->BrnSerial.' | <span style="color:blue">'.$model->send->SendSerial.'</span>',
                ],
                'BrnCause',
                [
                    'format' => 'html',
                    'label' => 'วันที่สร้าง',
                    'value' => substr($model->CreatedAt,8,2).'/'.substr($model->CreatedAt,5,2).'/'.substr($model->CreatedAt,2,2).' '.substr($model->CreatedAt,11,5).' '.$model->BrnCreateByName,
                        //.' <span style="color:blue;">'.Yii::$app->formatter->asRelativeTime($model->CreatedAt).'</span>',
                ],
                [
                    'format' => 'html',
                    'label' => 'วันที่รับเรื่อง',
                    'value' => substr($model->AcceptAt,8,2).'/'.substr($model->AcceptAt,5,2).'/'.substr($model->AcceptAt,2,2).' '.substr($model->AcceptAt,11,5).' '.$model->AcceptByName,
                ],
                [
                    'format' => 'html',
                    'label' => 'วันที่ส่งของ',
                    'value' => substr($model->getSendCreatedAt(),8,2).'/'.substr($model->getSendCreatedAt(),5,2).'/'.substr($model->getSendCreatedAt(),2,2).' '.substr($model->getSendCreatedAt(),11,5).' '.$model->getSendByName(),
                ],
                [
                    'format' => 'html',
                    'label' => 'วันที่ Comment',
                    'value' => substr($model->comment->CreatedAt,8,2).'/'.substr($model->comment->CreatedAt,5,2).'/'.substr($model->comment->CreatedAt,2,2).' '.substr($model->comment->CreatedAt,11,5).' '.$model->comment->MessageByName,
                ],
                [
                    'format' => 'html',
                    'label' => 'Comment',
                    'value' => $model->comment->Message,
                ],
            ],
        ]);
    }elseif($model->BrnStatus == 'ลบ'){
        echo DetailView::widget([
            'model' => $model,
            'attributes' => [
                'id',
                //'BrnStatus',
                [
                    'format' => 'html',
                    'label' => 'สถานะ',
                    'value' => '<span class="alert-danger">'.$model->BrnStatus.'</span>',
                ],
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
                //'BrnCreateByName',
                //'AcceptByName',
                [
                    'format' => 'html',
                    'label' => 'วันที่สร้าง',
                    'value' => substr($model->CreatedAt,8,2).'/'.substr($model->CreatedAt,5,2).'/'.substr($model->CreatedAt,2,2).' '.substr($model->CreatedAt,11,5).' '.$model->BrnCreateByName,
                        //.' <span style="color:blue;">'.Yii::$app->formatter->asRelativeTime($model->CreatedAt).'</span>',
                ],
                [
                    'format' => 'html',
                    'label' => 'วันที่ลบ',
                    'value' => substr($model->UpdatedAt,8,2).'/'.substr($model->UpdatedAt,5,2).'/'.substr($model->UpdatedAt,2,2).' '.substr($model->UpdatedAt,11,5).' '.$model->DeleteByName,
                ],
                'DeleteCause'
            ],
        ]);
    }

?>

</div>
