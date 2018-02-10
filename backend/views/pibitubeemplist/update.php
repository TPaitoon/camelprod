<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\PIBITubeEmplist */

$this->title = 'Update Pibitube Emplist: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Pibitube Emplists', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="pibitube-emplist-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
