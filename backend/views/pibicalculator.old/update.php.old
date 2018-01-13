<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\PIBICalculator */
//return print_r($model);
$id = explode(',', ArrayHelper::getValue($model, 'recid'));
$this->title = 'Update Pibicalculator: ' . $id[0];
//print_r($model);
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
