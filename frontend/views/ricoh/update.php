<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\RicohRepair */

$this->title = 'Update Ricoh Repair: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Ricoh Repairs', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ricoh-repair-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
