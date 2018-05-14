<?php

use yii\helpers\Html;
use yii\web\JqueryAsset;


/* @var $this yii\web\View */
/* @var $model common\models\BicyclesteamworkInfo */
$baseurl = Yii::$app->request->baseUrl;
$this->registerJsFile($baseurl . '/js/chkbicyclesteamworkcreate.js?Ver=0001', ['depends' => JqueryAsset::className()]);

$this->title = 'ค่าเข้างานนึ่งยางนอกจกย.';
$this->params['breadcrumbs'][] = ['label' => 'ค่าเข้างานนึ่งยางนอกจกย.', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'เพิ่มข้อมูล';
?>
<div class="bicyclesteamwork-info-create">
    <div class="panel">
        <div class="panel-body">
            <?= $this->render('_form', [
                'model' => $model,
                'status' => 1
            ]) ?>
        </div>
    </div>
    <div class="panel">
        <div class="panel-body">
            <?= $this->render('_miniform') ?>
        </div>
    </div>
</div>
<?php
$this->registerCssFile($baseurl . '/css/panel.css?Ver=0001', ['depends' => JqueryAsset::className()]);
?>