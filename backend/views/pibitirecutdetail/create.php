<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\PIBITIRECUTDETAIL */

$this->title = 'ค่าพิเศษประกอบยางในดำ.';
$this->params['breadcrumbs'][] = ['label' => 'ค่าพิเศษประกอบยางในดำ.', 'url' => ['index']];
$this->params['breadcrumbs'][] = "เพิ่มข้อมูล";
?>
<div class="pibitirecutdetail-create">
    <div class="panel">
        <div class="panel-heading">
            <h4>เพิ่มข้อมูล</h4>
        </div>
        <hr>
        <div class="panel-body">
            <?= $this->render('_form', ['model' => $model]) ?>
        </div>
    </div>
    <div class="panel">
        <div class="panel-body">
            <?= $this->render('_miniform') ?>
        </div>
    </div>
</div>