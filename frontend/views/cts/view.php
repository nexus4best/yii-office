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
                'BrnUserCreate',
                [
                    'format' => 'html',
                    'label' => 'วันที่สร้าง',
                    'value' => substr($model->CreatedAt,8,2).'/'.substr($model->CreatedAt,5,2).'/'.substr($model->CreatedAt,2,2).' '
                        .substr($model->CreatedAt,11,5).' '.$model->BrnUserCreate,
                        //.' <span style="color:blue;">'.Yii::$app->formatter->asRelativeTime($model->CreatedAt).'</span>',
                ],
                //'UpdatedAt',
                //'UserAccept',
                //'UserAcceptAt',
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
                //'BrnUserCreate',
                //'UserAccept',
                [
                    'format' => 'html',
                    'label' => 'วันที่สร้าง',
                    'value' => substr($model->CreatedAt,8,2).'/'.substr($model->CreatedAt,5,2).'/'.substr($model->CreatedAt,2,2).' '.substr($model->CreatedAt,11,5).' '.$model->BrnUserCreate,
                        //.' <span style="color:blue;">'.Yii::$app->formatter->asRelativeTime($model->CreatedAt).'</span>',
                ],
                [
                    'format' => 'html',
                    'label' => 'วันที่รับเรื่อง',
                    'value' => substr($model->UserAcceptAt,8,2).'/'.substr($model->UserAcceptAt,5,2).'/'.substr($model->UserAcceptAt,2,2).' '.substr($model->UserAcceptAt,11,5).' '.$model->UserAccept,
                ],
                //'UpdatedAt',
                //'UserAccept',
                //'UserAcceptAt',
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
                    'value' => '<span class="alert-default">'.$model->BrnStatus.'</span>',
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
                //'BrnUserCreate',
                //'UserAccept',
                [
                    'format' => 'html',
                    'label' => 'วันที่สร้าง',
                    'value' => substr($model->CreatedAt,8,2).'/'.substr($model->CreatedAt,5,2).'/'.substr($model->CreatedAt,2,2).' '.substr($model->CreatedAt,11,5).' '.$model->BrnUserCreate,
                        //.' <span style="color:blue;">'.Yii::$app->formatter->asRelativeTime($model->CreatedAt).'</span>',
                ],
                [
                    'format' => 'html',
                    'label' => 'วันที่รับเรื่อง',
                    'value' => substr($model->UserAcceptAt,8,2).'/'.substr($model->UserAcceptAt,5,2).'/'.substr($model->UserAcceptAt,2,2).' '.substr($model->UserAcceptAt,11,5).' '.$model->UserAccept,
                ],
                [
                    'format' => 'html',
                    'label' => 'วันที่ส่งของ',
                    'value' => substr($model->getSendCreatedAt(),8,2).'/'.substr($model->getSendCreatedAt(),5,2).'/'.substr($model->getSendCreatedAt(),2,2).' '.substr($model->getSendCreatedAt(),11,5).' '.$model->getSendByName(),
                ],
                //'UpdatedAt',
                //'UserAccept',
                //'UserAcceptAt',
            ],
        ]);
    }elseif($model->BrnStatus == 'เรียบร้อย'){

    }elseif($model->BrnStatus == 'ลบ'){

    }

?>

</div>
