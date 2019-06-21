<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

$this->title = 'Cnts Repairs';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cnts-repair-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Cnts Repair', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php Pjax::begin(['id'=>'cnts-pjax']); ?>

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

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

    <?php Pjax::end(); ?>


</div>
