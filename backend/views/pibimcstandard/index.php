<?php
/* @var $this yii\web\View */

use yii\grid\GridView;
use yii\helpers\Html;
use yii\web\JqueryAsset;

/* @var $dataProvider */

$this->title = 'มาตรฐานประกอบยางในมตซ.';
$this->params['breadcrumbs'][] = $this->title;
$baseurl = Yii::$app->request->baseUrl;
$this->registerCssFile($baseurl . '/css/panel.css?Ver=0001', ['depends' => JqueryAsset::className()]);
?>
<div class="pibimcstandard-index">
    <div class="panel">
        <div class="panel panel-heading">
            <?= Html::a('เพิ่มข้อมูลมาตรฐาน', ['createmaster'], ['class' => 'btn btn-success']) ?>
            <?= Html::a('เพิ่มข้อมูลรายละเอียด', ['create'], ['class' => 'btn btn-success']) ?>
        </div>
        <div class="panel panel-body">
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'pager' => [
                    'firstPageLabel' => 'First',
                    'lastPageLabel' => 'Last'
                ],
                'columns' => [
                    [
                        'class' => 'yii\grid\SerialColumn'
                    ],
                    'name:raw:มาตรฐาน',
                    'hour:raw:ชั่วโมง',
                    'amount:raw:เป้าหมาย',
                    'rate:raw:ค่าพิเศษ'
                ],
            ]) ?>
        </div>
    </div>
</div>
