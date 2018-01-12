<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\StandardBicycle */

$this->title = 'ค่ามาตรฐานเงินประจำตำแหน่งประกอบยางนอกจกย.';
$this->params['breadcrumbs'][] = ['label' => 'ค่ามาตรฐานเงินประจำตำแหน่งประกอบยางนอกจกย.', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id];
$this->params['breadcrumbs'][] = 'แก้ไข';
?>
<br>
<div class="standard-bicycle-update">
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
