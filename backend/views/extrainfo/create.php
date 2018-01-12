<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\ExtraInfo */

$this->title = 'ค่ามาตรฐานเตา BOM';
$this->params['breadcrumbs'][] = ['label' => 'ค่ามาตรฐานเตา BOM', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'เพิ่มมาตรฐานเตา';

$name = \backend\models\ExtraInfo::find()->select(['ExtraName'])->where(['extra_id' => $model->extra_id])->one();
?>
<div class="box box-success box-solid">
    <div class="box-header">
        <h4><span>เพิ่มข้อมูลมาตรฐาน BOM</span></h4>
    </div>
    <div class="box-body ">
        <?= $this->render('_form', [
            'model' => $model,
//            'extradetail' => $extradetail,
        ]) ?>
    </div>
</div>
