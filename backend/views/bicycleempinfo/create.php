<?php

use yii\helpers\Html;
use yii\web\JqueryAsset;


/* @var $this yii\web\View */
/* @var $model common\models\BicycleEmpInfo */
$this->registerJsFile(Yii::$app->request->baseUrl.'/js/chkbicycleempcreate.js?Ver=0001',['depends'=> JqueryAsset::className()]);
$this->title = 'ค่าเข้างานประกอบยางนอกจกย.';
$this->params['breadcrumbs'][] = ['label' => 'ค่าเข้างานประกอบยางนอกจกย.', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'เพิ่มข้อมูล';
?>
<div class="bicycle-emp-info-create">
    <div class="box box-primary box-solid">
        <div class="box-header">
            <label style="font-size: x-large">เพิ่มข้อมูล</label>
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
