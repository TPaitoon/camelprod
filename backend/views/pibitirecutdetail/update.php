<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\PIBITIRECUTDETAIL */

$this->title = 'Update Pibitirecutdetail: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Pibitirecutdetails', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="pibitirecutdetail-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
