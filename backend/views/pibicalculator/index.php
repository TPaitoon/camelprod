<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\web\JqueryAsset;

$this->title = 'ค่าพิเศษประกอบยางในจกย.';
$this->params['breadcrumbs'][] = $this->title;
$baseurl = Yii::$app->request->baseUrl;
$this->registerCssFile($baseurl . '/css/panel.css?Ver=0001', ['depends' => JqueryAsset::className()]);
?>
<div class="pibicalculator-index">
    <div class="panel">
        <div class="panel panel-body">
            <?= Html::a('เพิ่มข้อมูล', ['create'], ['class' => 'btn btn-success']) ?>
            <br><br>
            For Reander->Search
            <hr>
            For GridView
        </div>
    </div>
</div>
