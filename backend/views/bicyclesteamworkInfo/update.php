<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\BicyclesteamworkInfo */

$this->title = 'ค่าเข้างานนึ่งยางนอกจกย.';
$this->params['breadcrumbs'][] = ['label' => 'ค่าเข้างานนึ่งยางนอกจกย.', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->empid];
$this->params['breadcrumbs'][] = 'แก้ไขข้อมูล';
?>
<div class="bicyclesteamwork-info-update">
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
