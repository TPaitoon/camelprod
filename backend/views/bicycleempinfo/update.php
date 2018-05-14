<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\BicycleEmpInfo */

$this->title = 'Bicycle Employee Rate';
$this->params['breadcrumbs'][] = ['label' => 'Employee Rate', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id];
$this->params['breadcrumbs'][] = 'แก้ไข';
?>
<div class="bicycle-emp-info-update">
    <?= $this->render('_form', [
        'model' => $model,
        'chk' => $chk,
        'status' => 0
    ]) ?>
</div>
