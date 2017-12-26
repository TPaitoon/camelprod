<?php

use backend\models\CheckDebug;
use common\models\CheckStatusInfo;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\BicycletireInfo */

$this->title = 'Calculator Bicycletire';
$this->params['breadcrumbs'][] = ['label' => 'Calculator Bicycletire', 'url' => ['index']];
$this->params['breadcrumbs'][] = $model->empid;

//$debug = new CheckDebug();
//$debug->printr($model, 1);
?>
<div class="bicycletire-info-view">
    <div class="box box-success box-solid">
        <div class="box-body">
            <?= DetailView::widget([
                'model' => $model,
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
                    [
                        'format' => 'raw',
                        'label' => 'สถานะ',
                        'value' => function ($model) {
                            $status = CheckStatusInfo::find()->where(['statusid' => $model->checkconfirm])->one();
                            if ($model->checkconfirm == 1) {
                                return '<span class="label label-success">' . $status->name . '</span>';
                            } elseif ($model->checkconfirm == 0) {
                                return '<span class="label label-info">' . $status->name . '</span>';
                            }
                        }
                    ],
                ],
            ]) ?>
            <hr>
            <div class="pull-left">
                <?= Html::a('แก้ไขข้อมูล', ['update', 'empid' => $model->empid, 'date' => $model->date], ['class' => 'btn btn-primary']) ?>
                <?= Html::a('ลบข้อมูล',
                    ['delete', 'empid' => $model->empid, 'date' => $model->date],
                    ['class' => 'btn btn-danger', 'data' => ['confirm' => 'Are you sure you want to delete this item?', 'method' => 'post']]) ?>
            </div>
            <div class="pull-right">
                <?= Html::a('หน้าหลัก', ['index'], ['class' => 'btn btn-info']) ?>
                <?= Html::a('ย้อนกลับ', Yii::$app->request->referrer, ['class' => 'btn btn-danger']) ?>
            </div>
        </div>
    </div>
</div>
