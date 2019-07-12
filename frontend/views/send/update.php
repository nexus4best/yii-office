<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\TblNavision */

$this->title = 'Update Tbl Navision: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Tbl Navisions', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="tbl-navision-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
