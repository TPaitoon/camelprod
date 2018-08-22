<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\PIBITIRECUTSTANDARD */

$this->title = 'Update Pibitirecutstandard: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Pibitirecutstandards', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="pibitirecutstandard-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
