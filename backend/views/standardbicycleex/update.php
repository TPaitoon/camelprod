<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\StandardbicycleEx */

$this->title = 'Update Standardbicycle Ex: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Standardbicycle Exes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="standardbicycle-ex-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
