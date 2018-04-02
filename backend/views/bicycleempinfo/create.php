<?php

use yii\helpers\Html;
use yii\web\JqueryAsset;


/* @var $this yii\web\View */
/* @var $model common\models\BicycleEmpInfo */
$baseurl = Yii::$app->request->baseUrl;
$this->registerJsFile($baseurl . '/js/chkbicycleempcreate.js?Ver=0001', ['depends' => JqueryAsset::className()]);
$this->registerCssFile($baseurl . '/css/panel.css?Ver=0001', ['depends' => JqueryAsset::className()]);

$this->title = 'ค่าเข้างานประกอบยางนอกจกย.';
$this->params['breadcrumbs'][] = ['label' => 'ค่าเข้างานประกอบยางนอกจกย.', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'เพิ่มข้อมูล';
?>
<div class="bicycle-emp-info-create">
    <?= $this->render('_form', [
        'model' => $model,
        'chk' => $chk,
    ]) ?>
</div>
