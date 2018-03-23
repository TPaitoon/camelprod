<?php

use yii\helpers\Html;
use yii\web\JqueryAsset;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\BOMInfo */

$this->title = 'ข้อมูล : ' . $model->empid;
$this->params['breadcrumbs'][] = ['label' => 'ค่าพิเศษเตา BOM', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
    <div class="bominfo-view">
        <?= DetailView::widget([
            'model' => $model,
            'template' => '<tr><th width="30%">{label}</th><td>{value}</td></tr>',
            'attributes' => [
                'empid:text:รหัสพนักงาน',
                'empName:text:ชื่อ - นามสกุล',
                'date:date:วันที่',
                'stoveid:raw:เตาที่',
                'standard:raw:มาตรฐาน',
                'hour:raw:ชั่วโมง',
                'amount:raw:ยอดนึ่ง',
                'losttime:raw:เสียเวลา : นาที',
                'totaltire:raw:ยอดยาง',
                'perpcs:raw:ราคา : เส้น',
                'deduct:raw:หักเงิน',
                'rate:raw:ค่าพิเศษ'
            ],
        ]) ?>
    </div>
<?php
$baseurl = Yii::$app->request->baseUrl;
$this->registerCssFile($baseurl . '/css/panel.css?Ver=0001', ['depends' => JqueryAsset::className()]);
?>