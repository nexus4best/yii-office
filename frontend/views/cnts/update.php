<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\CntsRepair */

$this->title = 'Update Cnts Repair: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Cnts Repairs', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="cnts-repair-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
