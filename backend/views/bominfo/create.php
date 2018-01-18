<?php

use yii\helpers\Html;
use yii\web\JqueryAsset;


/* @var $this yii\web\View */
/* @var $model backend\models\BOMInfo */

$this->title = 'ค่าพิเศษเตา BOM';
$this->params['breadcrumbs'][] = ['label' => 'ค่าพิเศษเตา BOM', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'เพิ่มข้อมูล';
$baseurl = Yii::$app->request->baseUrl;
$this->registerJsFile($baseurl . '/js/chkbomscript.js?Ver=0001', ['depends' => JqueryAsset::className()]);
$this->registerCssFile($baseurl . '/css/panel.css?Ver=0001', ['depends' => JqueryAsset::className()]);
?>
<div class="bominfo-create">
    <div class="panel">
        <div class="panel panel-heading">
            <label style="font-size: x-large">เพิ่มข้อมูล</label>
        </div>
        <div class="panel panel-body">
            <?= $this->render('_form', [
                'model' => $model,
                'data' => $data,
            ]) ?>
        </div>
    </div>
</div>
