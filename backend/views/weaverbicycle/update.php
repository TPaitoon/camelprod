<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Weaverbicycle */

$this->title = 'Update Weaverbicycle: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Weaverbicycles', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="weaverbicycle-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
