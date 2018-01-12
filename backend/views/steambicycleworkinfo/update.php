<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\SteambicycleworkInfo */

$this->title = 'ค่ามาตรฐานเงินประจำตำแหน่งนึ่งยางนอกจกย. : ' . $model->idwork;
$this->params['breadcrumbs'][] = ['label' => 'ค่ามาตรฐานเงินประจำตำแหน่งนึ่งยางนอกจกย.', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idwork, 'url' => ['view', 'id' => $model->idwork]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="steambicyclework-info-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
