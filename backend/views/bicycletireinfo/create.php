<?php

use yii\helpers\Html;
use yii\web\JqueryAsset;


/* @var $this yii\web\View */
/* @var $model common\models\BicycletireInfo */

$this->title = 'ค่าพิเศษนึ่งยางนอกจกย.';
$this->params['breadcrumbs'][] = ['label' => 'ค่าพิเศษนึ่งยางนอกจกย.', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'เพิ่มข้อมูล';
$this->registerJsFile(Yii::$app->request->baseUrl . '/js/chkbicycletirecreate.js?Ver=0001', ['depends' => JqueryAsset::className()]);
?>
<div class="bicycletire-info-create">
    <div class="box box-primary box-solid">
        <div class="box-header">
            <label style="font-size: x-large">เพิ่มข้อมูล</label>
            <hr>
        </div>
        <div class="box-body">
            <?= $this->render('_form', [
                'model' => $model,
            ]) ?>
        </div>
    </div>
</div>
