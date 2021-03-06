<?php

use yii\helpers\Html;
use yii\web\JqueryAsset;


/* @var $this yii\web\View */
/* @var $model common\models\BicycleInfo */

$this->title = 'ค่าพิเศษประกอบยางนอกจกย.';
$this->params['breadcrumbs'][] = ['label' => 'ค่าพิเศษประกอบยางนอกจกย.', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'เพิ่มข้อมูล';
$baseurl = Yii::$app->request->baseUrl;

$this->registerJsFile($baseurl . '/js/chkbicyclecreate.js?Ver=0001', ['depends' => JqueryAsset::className()]);
?>
<div class="bicycle-info-create">
    <div class="panel">
        <div class="panel-heading">
            <h4>เพิ่มข้อมูล</h4>
        </div>
        <div class="panel-body">
            <?= $this->render('_form', [
                'model' => $model,
            ]) ?>
        </div>
    </div>
    <div class="panel">
        <div class="panel-body">
            <div class="row">
                <?= $this->render('_miniform') ?>
            </div>
        </div>
    </div>
</div>
<?php
$baseurl = Yii::$app->request->baseUrl;
$this->registerCssFile($baseurl . '/css/panel.css?Ver=0001', ['depends' => JqueryAsset::className()]);
?>