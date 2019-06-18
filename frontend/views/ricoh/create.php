<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\RicohRepair */

$this->title = 'Create Ricoh Repair';
$this->params['breadcrumbs'][] = ['label' => 'Ricoh Repairs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ricoh-repair-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
