<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\StandardBicycle */

$this->title = 'ค่ามาตรฐานเงินประจำตำแหน่งประกอบยางนอกจกย.';
$this->params['breadcrumbs'][] = ['label' => 'ค่ามาตรฐานเงินประจำตำแหน่งประกอบยางนอกจกย.', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'เพิ่มเงินประจำตำแหน่ง';
?>
<div class="standard-bicycle-create">
    <div class="box box-success box-solid">
        <div class="box-header">
            <h4><span>เพิ่มเงินประจำตำแหน่ง</span></h4>
            <hr>
        </div>
        <div class="box-body">
            <?= $this->render('_form', [
                'model' => $model,
            ]) ?>
        </div>
    </div>
</div>
