<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\PIBIStandard */

$this->title = 'Update Pibistandard: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Pibistandards', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="pibistandard-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
