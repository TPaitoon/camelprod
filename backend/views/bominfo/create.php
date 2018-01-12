<?php

use yii\helpers\Html;
use yii\web\JqueryAsset;


/* @var $this yii\web\View */
/* @var $model backend\models\BOMInfo */

$this->title = 'ค่าพิเศษเตา BOM';
$this->params['breadcrumbs'][] = ['label' => 'ค่าพิเศษเตา BOM', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'เพิ่มข้อมูล';
$this->registerJsFile(Yii::$app->request->baseUrl.'/js/chkbomscript.js?Ver=0001',['depends' => JqueryAsset::className()]);
?>
<br>
<div class="bominfo-create">
    <div class="box box-primary box-solid">
        <div class="box-header">
            <label style="font-size: x-large">เพิ่มข้อมูล</label>
            <hr>
        </div>
        <div class="box-body">
            <?= $this->render('_form', [
                'model' => $model,
                'data' => $data,
            ]) ?>
        </div>
    </div>
</div>
