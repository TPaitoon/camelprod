<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\BOMInfo */

$this->title = '';
$this->params['breadcrumbs'][] = ['label' => 'Calculator BOM', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->empid];
$this->params['breadcrumbs'][] = 'แก้ไขข้อมูล';
?>
<br>
<div class="bominfo-update">
    <div class="box box-primary box-solid">
        <div class="box-header">
            <label style="font-size: x-large">แก้ไขข้อมูล</label>
            <hr>
        </div>
        <div class="box-body">
            <?= $this->render('_form', [
                'model' => $model,
                'data' => $data
            ]) ?>
        </div>
    </div>
</div>
