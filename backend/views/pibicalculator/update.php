<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\PIBICalculator */

$this->title = 'Update Pibicalculator: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Pibicalculators', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="pibicalculator-update">
    <div class="box box-info box-solid">
        <div class="box-header"></div>
        <div class="box-body">
            <?= $this->render('_form', [
                'model' => $model,
            ]) ?>
        </div>
    </div>
</div>
