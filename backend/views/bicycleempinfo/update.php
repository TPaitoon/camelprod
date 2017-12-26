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
    <div class="box box-primary box-solid">
        <div class="box-header">
            <label style="font-size: x-large">แก้ไขข้อมูล</label>
            <hr>
        </div>
        <div class="box-body">
            <?= $this->render('_form', [
                'model' => $model,
                'chk' => $chk,
            ]) ?>
        </div>
    </div>
</div>
