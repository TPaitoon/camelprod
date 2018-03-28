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
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
