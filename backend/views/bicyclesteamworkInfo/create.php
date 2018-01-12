<?php

use yii\helpers\Html;
use yii\web\JqueryAsset;


/* @var $this yii\web\View */
/* @var $model common\models\BicyclesteamworkInfo */

$this->registerJsFile(Yii::$app->request->baseUrl . '/js/chkbicyclesteamworkcreate.js?Ver=0001', ['depends' => JqueryAsset::className()]);

$this->title = 'ค่าเข้างานนึ่งยางนอกจกย.';
$this->params['breadcrumbs'][] = ['label' => 'ค่าเข้างานนึ่งยางนอกจกย.', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'เพิ่มข้อมูล';
?>
<div class="bicyclesteamwork-info-create">
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
