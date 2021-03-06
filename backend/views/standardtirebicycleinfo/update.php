<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\StandardTireBicycleInfo */

$this->title = 'ค่ามาตรฐานนึ่งยางนอกจกย. : ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'ค่ามาตรฐานนึ่งยางนอกจกย.', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="standard-tire-bicycle-info-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
