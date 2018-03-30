<?php

use backend\models\CheckDebug;
use common\models\CheckStatusInfo;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\BicycletireInfo */

$this->title = 'ค่าพิเศษนึ่งยางนอกจกย.';
$this->params['breadcrumbs'][] = ['label' => 'ค่าพิเศษนึ่งยางนอกจกย.', 'url' => ['index']];
$this->params['breadcrumbs'][] = $model->empid;

//$debug = new CheckDebug();
//$debug->printr($model, 1);
?>
<div class="bicycletire-info-view">
    <?= DetailView::widget([
        'model' => $model,
        'template' => '<tr><th width="30%">{label}</th><td>{value}</td></tr>',
        'attributes' => [
            'empid:text:รหัสพนักงาน',
            'empName:text:ชื่อ - นามสกุล',
            'date:date:วันที่',
            'hour:text:ชั่วโมง',
            'standard:text:มาตรฐาน',
            'tireamount1:integer:ยอดเตา 1',
            'losttime:integer:เสียเวลา : นาที',
            'totaltire:integer:ยอดนึ่งเตา 1',
            'tireperpcs:text:ราคา : เส้น',
            'tirerate1:integer:ค่าพิเศษเตา 1',
            'tireamount2:integer:ยอดเตา 2',
            'tirerate2:integer:ค่าพิเศษเตา 2',
            'stickername:text:รายการสติกเกอร์',
            'stickeramount:integer:ติดสติกเกอร์',
            'stickerperpcs:text:ราคา : ดวง',
            'stickerrate:integer:ค่าติดสติกเกอร์',
            'deduct:integer:หักเงิน',
            'totalrate:integer:ค่าพิเศษทั้งหมด',
        ],
    ]) ?>
</div>
