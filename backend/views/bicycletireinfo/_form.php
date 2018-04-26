<?php

use common\models\EmpInfo;
use common\models\HourInfo;
use common\models\Standardsticker;
use common\models\StandardTireBicycleInfo;
use kartik\date\DatePicker;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\web\JqueryAsset;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\BicycletireInfo */
/* @var $form yii\widgets\ActiveForm */
$this->registerJsFile(Yii::$app->request->baseUrl . '/js/calculatebicycletire.js?Ver=0001', ['depends' => JqueryAsset::className()]);
$empmodel = EmpInfo::find()->where(['Dept' => 'ฝ่ายผลิต'])->andFilterWhere(['like', 'Sec', 'นึ่ง'])->all();
$hourarray = HourInfo::find()->orderBy(['values' => SORT_ASC])->all();
$hourlist = [];
foreach ($hourarray as $item) {
    if ($item->values == '9') {
        continue;
    }
    if ($item->values == '11') {
        continue;
    }
    array_push($hourlist, [
        'values' => $item->values,
        'hour' => $item->hour,
    ]);
}
?>

<div class="bicycletire-info-form">
    <?php $form = ActiveForm::begin(['id' => 'bicycletire-form']); ?>
    <div class="panel">
        <div class="row">
            <div class="col-md-5">
                <?= $form->field($model, 'empid')->widget(Select2::className(), [
                    'data' => ArrayHelper::map($empmodel, 'PRS_NO', function ($data) {
                        return $data->PRS_NO . " : " . $data->EMP_NAME . " " . $data->EMP_SURNME;
                    }),
                    'options' => [
                        'placeholder' => 'เลือกรหัสพนักงาน',
                        'id' => 'btempid',
                    ],
                ])->label('รหัสพนักงาน') ?>
            </div>
            <div class="col-md-2">
                <?php $_temp = str_replace("-", "/", $model->date) ?>
                <?php $model->date == '' ? $model->date = date('d/m/Y') : $model->date = date('d/m/Y', strtotime($_temp)) ?>
                <?= $form->field($model, 'date')->widget(DatePicker::className(), [
                    'options' => [
                        'id' => 'btdate'
                    ],
                    'type' => DatePicker::TYPE_COMPONENT_APPEND,
                    'layout' => '{picker}{input}',
                    'readonly' => true,
                    'pluginOptions' => [
                        'format' => 'dd/mm/yyyy',
                        'autoclose' => true,
                        'todayHighlight' => true
                    ]
                ])->label('วันที่') ?>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-md-2">
                <?= $form->field($model, 'hour')->dropDownList(ArrayHelper::map($hourlist, 'values', 'hour'), ['id' => 'bthour'])->label('ชั่วโมง') ?>
            </div>
            <div class="col-md-2">
                <?= $form->field($model, 'standard')->dropDownList(ArrayHelper::map(StandardTireBicycleInfo::find()->all(), 'standardname', 'standardname'), ['id' => 'btstandard'])->label('มาตรฐาน') ?>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-md-2">
                <?= $form->field($model, 'tireamount1')->textInput(['id' => 'bttireamount1', 'autocomplete' => 'off', 'onkeypress' => 'return event.charCode >= 48 && event.charCode <= 57'])->label('ยอดนึ่งเตา 1') ?>
            </div>
            <div class="col-md-2">
                <?= $form->field($model, 'losttime')->textInput(['id' => 'btlosttime', 'autocomplete' => 'off', 'onkeypress' => 'return event.charCode >= 48 && event.charCode <= 57'])->label('เสียเวลา : นาที') ?>
            </div>
            <div class="col-md-2">
                <?= $form->field($model, 'totaltire')->textInput(['id' => 'bttotaltire', 'readonly' => true])->label('ยอดยางเตาที่ 1') ?>
            </div>
            <div class="col-md-2">
                <?= $form->field($model, 'tireperpcs')->textInput(['id' => 'bttireperpcs', 'readonly' => true])->label('ราคา : เส้น') ?>
            </div>
            <div class="col-md-2">
                <?= $form->field($model, 'tirerate1')->textInput(['id' => 'bttirerate1', 'readonly' => true])->label('ค่าพิเศษเตาที่ 1') ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-2"></div>
            <div class="col-md-2">
                <?= $form->field($model, 'tireamount2')->textInput(['id' => 'bttireamount2', 'autocomplete' => 'off', 'onkeypress' => 'return event.charCode >= 48 && event.charCode <= 57'])->label('ยอดยางเตาที่ 2') ?>
            </div>
            <div class="col-md-2"></div>
            <div class="col-md-2">
                <?= $form->field($model, 'tirerate2')->textInput(['id' => 'bttirerate2', 'readonly' => true])->label('ค่าพิเศษเตาที่ 2') ?>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-md-2">
                <?= $form->field($model, 'stickername')->dropDownList(ArrayHelper::map(Standardsticker::find()->all(), 'stickerid', 'stickername'), ['id' => 'btstickername'])->label('รายการสติกเกอร์') ?>
            </div>
            <div class="col-md-2">
                <?= $form->field($model, 'stickeramount')->textInput(['id' => 'btstickeramount', 'autocomplete' => 'off', 'onkeypress' => 'return event.charCode >= 48 && event.charCode <= 57'])->label('ติดสติกเกอร์') ?>
            </div>
            <div class="col-md-2">
                <?= $form->field($model, 'stickerperpcs')->textInput(['id' => 'btstickerperpcs', 'readonly' => true])->label('ราคา : ดวง') ?>
            </div>
            <div class="col-md-2">
                <?= $form->field($model, 'stickerrate')->textInput(['id' => 'btstickerrate', 'readonly' => true])->label('ค่าพิเศษสติกเกอร์') ?>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-md-2">
                <?= $form->field($model, 'deduct')->textInput(['id' => 'btdeduct', 'autocomplete' => 'off', 'onkeypress' => 'return event.charCode >= 48 && event.charCode <= 57'])->label('หักยางเสีย') ?>
            </div>
            <div class="col-md-2">
                <?= $form->field($model, 'totalrate')->textInput(['id' => 'bttotalrate', 'readonly' => true])->label('รวมเป็นเงิน') ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <!--?= Html::submitButton($model->isNewRecord ? 'บันทึก' : 'แก้ไข', ['id' => 'bicycletire-submit', 'class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?-->
                <div style="text-align: center">
                    <?= Html::a('<i class="fa fa-plus"></i>', 'javascript:void(0)', ['class' => 'btn btn-success adddata', 'style' => 'width: 50px']) ?>
                </div>
            </div>
        </div>
        <br>
    </div>
    <?php ActiveForm::end(); ?>
    <div class="row">
        <div class="col-md-12">
            <h4>จำนวน : <label id="count" style="color: #00a65a">#</label> แถว</h4>
        </div>
        <div class="row">
            <div class="col-md-12">
                <form id="bctire-form" action="index.php?r=bicycletireinfo/createmanual" method="post">
                    <div class="col-md-12">
                        <div style="overflow-x: scroll">
                            <table class="table table-bordered listemp">
                                <thead>
                                <tr>
                                    <th>รหัสพนักงาน</th>
                                    <th>วันที่</th>
                                    <th>ชั่วโมง</th>
                                    <th>มาตรฐาน</th>
                                    <th>ยอดนึ่งเตา 1</th>
                                    <th>เสียเวลา : นาที</th>
                                    <th>ยอดยางเตาที่ 1</th>
                                    <th>ราคา : เส้น</th>
                                    <th>ค่าพิเศษเตาที่ 1</th>
                                    <th>ยอดยางเตาที่ 2</th>
                                    <th>ค่าพิเศษเตาที่ 2</th>
                                    <th>รายการสติกเกอร์</th>
                                    <th>ติดสติกเกอร์</th>
                                    <th>ราคา : ดวง</th>
                                    <th>ค่าพิเศษสติกเกอร์</th>
                                    <th>หักยางเสีย</th>
                                    <th>รวมเป็นเงิน</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>
                                        <input readonly type="text" class="form-control empids" style="width: 100px"
                                               name="empidx[]">
                                    </td>
                                    <td>
                                        <input readonly type="text" class="form-control dates" style="width: 100px"
                                               name="datex[]">
                                    </td>
                                    <td>
                                        <input readonly type="text" class="form-control hours" style="width: 100px"
                                               name="hourx[]">
                                    </td>
                                    <td>
                                        <input readonly type="text" class="form-control standards" style="width: 100px"
                                               name="standardx[]">
                                    </td>
                                    <td>
                                        <input readonly type="text" class="form-control tireamount1s"
                                               style="width: 100px"
                                               name="tireamount1x[]">
                                    </td>
                                    <td>
                                        <input readonly type="text" class="form-control losttimes" style="width: 100px"
                                               name="losttimex[]">
                                    </td>
                                    <td>
                                        <input readonly type="text" class="form-control totaltires" style="width: 100px"
                                               name="totaltirex[]">
                                    </td>
                                    <td>
                                        <input readonly type="text" class="form-control tireperpcss"
                                               style="width: 100px"
                                               name="tireperpcsx[]">
                                    </td>
                                    <td>
                                        <input readonly type="text" class="form-control tirerate1s" style="width: 100px"
                                               name="tirerate1x[]">
                                    </td>
                                    <td>
                                        <input readonly type="text" class="form-control tireamount2s"
                                               style="width: 100px"
                                               name="tireamount2x[]">
                                    </td>
                                    <td>
                                        <input readonly type="text" class="form-control tirerate2s" style="width: 100px"
                                               name="tirerate2x[]">
                                    </td>
                                    <td>
                                        <input readonly type="text" class="form-control stickernames"
                                               style="width: 125px"
                                               name="stickernamex[]">
                                    </td>
                                    <td>
                                        <input readonly type="text" class="form-control stickeramounts"
                                               style="width: 100px"
                                               name="stickeramountx[]">
                                    </td>
                                    <td>
                                        <input readonly type="text" class="form-control stickerperpcss"
                                               style="width: 100px"
                                               name="stickerperpcsx[]">
                                    </td>
                                    <td>
                                        <input readonly type="text" class="form-control stickerrates"
                                               style="width: 125px"
                                               name="stickerratex[]">
                                    </td>
                                    <td>
                                        <input readonly type="text" class="form-control deducts" style="width: 100px"
                                               name="deductx[]">
                                    </td>
                                    <td>
                                        <input readonly type="text" class="form-control totalrates" style="width: 100px"
                                               name="totalratex[]">
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-danger" onclick="removegroupline($(this))">
                                            <i class="fa fa-minus"></i>
                                        </button>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="pull-right">
        <?= Html::a('หน้าหลัก', ['index'], ['class' => 'btn btn-info']) ?>
        <?= Html::a('ย้อนกลับ', Yii::$app->request->referrer, ['class' => 'btn btn-danger']) ?>
    </div>

</div>
