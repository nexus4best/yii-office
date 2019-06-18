<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\CntsRepair */

$this->title = 'Create Cnts Repair';
$this->params['breadcrumbs'][] = ['label' => 'Cnts Repairs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cnts-repair-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
