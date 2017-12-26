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
?>

<div class="bicycletire-info-form">
    <?php $form = ActiveForm::begin(['id' => 'bicycletire-form']); ?>
    <div class="box-body">
        <div class="row">
            <div class="col-md-3">
                <?= $form->field($model, 'empid')->widget(Select2::className(), [
                    'data' => ArrayHelper::map($empmodel, 'PRS_NO', 'PRS_NO'),
                    'options' => [
                        'placeholder' => 'เลือกรหัสพนกงาน',
                        'id' => 'btempid',
                        'onchange' => '$.post("index.php?r=bicycletireinfo/showempname&empid=' . '"+$(this).val(),function(data){
                        $("#btempname").val(data);
                        });',
                    ],
                ])->label('รหัสพนักงาน') ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($model, 'empName')->textInput(['id' => 'btempname', 'readonly' => 'true'])->label('ชื่อ - นามสกุล') ?>
            </div>
            <div class="col-md-3">
                <?php $model->date == '' ? $model->date = date('Y-m-d') : $model->date ?>
                <?= $form->field($model, 'date')->widget(DatePicker::className(), [
                    'options' => [
                        'id' => 'btdate'
                    ],
                    'type' => DatePicker::TYPE_COMPONENT_APPEND,
                    'layout' => '{picker}{input}',
                    'readonly' => true,
                    'pluginOptions' => [
                        'format' => 'yyyy-mm-dd',
                        'autoclose' => true,
                        'todayHighlight' => true
                    ]
                ])->label('วันที่') ?>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-md-2">
                <?= $form->field($model, 'hour')->dropDownList(ArrayHelper::map(HourInfo::find()->all(), 'values', 'hour'), ['id' => 'bthour'])->label('ชั่วโมง') ?>
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
        <hr>
        <div class="form-group">
            <div class="pull-left">
                <?= Html::submitButton($model->isNewRecord ? 'บันทึก' : 'แก้ไข', ['id' => 'bicycletire-submit','class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            </div>
            <div class="pull-right">
                <?= Html::a('หน้าหลัก', ['index'], ['class' => 'btn btn-info']) ?>
                <?= Html::a('ย้อนกลับ', Yii::$app->request->referrer, ['class' => 'btn btn-danger']) ?>
            </div>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
