<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\PIBITIRECUTSTANDARD */

$this->title = 'ค่ามาตรฐาน';
$this->params['breadcrumbs'][] = ['label' => 'มาตรฐานประกอบยางในดำ', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pibitirecutstandard-create">
    <div class="box box-default box-solid">
        <div class="box-body">
            <?= $this->render('_form', [
                'model' => $model,
            ]) ?>
        </div>
    </div>
    <div class="box box-default box-solid">
        <div class="box-body">
            <?= $this->render('_miniform', [
            ]) ?>
        </div>
    </div>
</div>
