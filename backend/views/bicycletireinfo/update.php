<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\BicycletireInfo */

$this->title = 'ค่าพิเศษนึ่งยางนอกจกย.';
$this->params['breadcrumbs'][] = ['label' => 'ค่าพิเศษนึ่งยางนอกจกย.', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->empid, 'url' => ['view', 'empid' => $model->empid, 'date' => $model->date]];
$this->params['breadcrumbs'][] = 'แก้ไขข้อมูล';
?>
<div class="bicycletire-info-update">
    <div class="box box-primary box-solid">
        <div class="box-header">
            <label style="font-size: x-large">แก้ไขข้อมูล</label>
            <hr>
        </div>
        <div class="box-body">
            <?= $this->render('_form', [
                'model' => $model,
            ]) ?>
        </div>
    </div>
</div>
