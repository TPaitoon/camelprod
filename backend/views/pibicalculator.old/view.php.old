<?php


use common\models\PIBIStandard;
use common\models\ShiftList;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\PIBICalculator */
$id = explode(',', ArrayHelper::getValue($model, 'recid'));
$this->title = $id[0];
//print_r($model);
$this->params['breadcrumbs'][] = ['label' => 'Pibicalculators', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pibicalculator-view">
    <div class="box box-info box-solid">
        <div class="box-header"></div>
        <div class="box-body">
            <?=
            DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'listid:text:รหัสพนักงาน',
                    'Groupid:raw:กลุ่ม',
                    [
                        'attribute' => 'Shiftid',
                        'format' => 'raw',
                        'value' => function ($model) {
                            $sid = ArrayHelper::getValue($model, 'Shiftid');
                            $mshift = ShiftList::find()->where(['id' => $sid])->one();
                            if ($sid == 1) {
                                return '<label class="label label-primary">' . $mshift->shiftname . '</label>';
                            } elseif ($sid == 2) {
                                return '<label class="label label-warning">' . $mshift->shiftname . '</label>';
                            }
                        },
                        'label' => 'ช่วงทำงาน'
                    ],
                    [
                        'attribute' => 'Date',
                        'format' => 'raw',
                        'value' => function ($model) {
                            $date = ArrayHelper::getValue($model, 'Date');
                            return '<i class="fa fa-calendar text-success"></i>' . '<span style="padding-left: 10px"></span>' . date('d-m-Y', strtotime($date));
                        },
                        'label' => 'วันที่'
                    ],
                    'Hour:raw:ชั่วโมง',
                    [
                        'attribute' => 'Itemid',
                        'format' => 'raw',
                        'value' => function ($model) {
                            $id = ArrayHelper::getValue($model, 'Itemid');
                            $ls = PIBIStandard::find()->select(['name'])->where(['refid' => $id])->one();
                            return $ls->name;
                        },
                        'label' => 'มาตรฐาน'
                    ],
                    'Totaltire:raw:ยอดผลิต',
                    'Deduct:raw:หักเงิน',
                    'rate:raw:ค่าพิเศษ : คน',
                ]
            ])
            ?>
            <hr>
            <div class="pull-left">
                <?= Html::a('หน้าหลัก', ['index'], ['class' => 'btn btn-info']) ?>
                <?= Html::a('ย้อนกลับ',Yii::$app->request->referrer,['class' => 'btn btn-danger']) ?>
            </div>
        </div>
    </div>
</div>
