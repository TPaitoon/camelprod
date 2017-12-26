<?php

use common\models\CheckStatusInfo;
use common\models\EmpInfo;
use common\models\Weaverbicycle;
use kartik\date\DatePicker;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\web\JqueryAsset;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\BicycleInfo */
/* @var $form yii\widgets\ActiveForm */
$this->registerJsFile(Yii::$app->request->baseUrl . '/js/calculatebicycle.js?Ver=0001', ['depends' => JqueryAsset::className()]);
$empmodel = EmpInfo::find()->where(['Dept' => 'ฝ่ายผลิต'])->andFilterWhere(['Sec' => 'ประกอบยางนอก'])->all();
$tiremodel = Weaverbicycle::find()->all();
?>

<div class="bicycle-info-form">
    <div class="box-body">
        <?php $form = ActiveForm::begin(['id' => 'bicycleform']); ?>
        <div class="row">
            <div class="col-md-3">
                <?= $form->field($model, 'empid')->widget(Select2::className(), [
                    'data' => ArrayHelper::map($empmodel, 'PRS_NO', 'PRS_NO'),
                    'options' => [
                        'placeholder' => 'เลือกรหัสพนักงาน',
                        'id' => 'bempid',
                        'onchange' => '$.post("index.php?r=bicycleinfo/showempname&empid=' . '"+$(this).val(),function(data){
                        $("#bempname").val(data);
                        });',
                    ],])->label('รหัสพนักงาน') ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($model, 'empname')->textInput(['id' => 'bempname', 'readonly' => true])->label('ชื่อ - นามสกุล') ?>
            </div>
            <div class="col-md-3">
                <?php $model->date == '' ? $model->date = date('Y-m-d') : $model->date ?>
                <?= $form->field($model, 'date')->widget(DatePicker::className(), [
                    'options' => ['id' => 'bdate'],
                    'type' => DatePicker::TYPE_COMPONENT_APPEND,
                    'layout' => '{picker}{input}',
                    'readonly' => true,
                    'pluginOptions' => [
                        'format' => 'yyyy-mm-dd',
                        'autoclose' => true,
                        'todayHighlight' => true,
                    ]
                ])->label('วันที่ทำงาน') ?>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-md-2">
                <?= $form->field($model, 'tirename')->widget(Select2::className(), [
                    'data' => ArrayHelper::map($tiremodel, 'sizename', 'sizename'),
                    'options' => [
                        'placeholder' => 'เลือกรายการยาง',
                        'id' => 'btirename',
                        'onchange' => '$.post("index.php?r=bicycleinfo/showgrouptire&name=' . '"+$(this).val(),function(data){
                        $("#bgrouptire").val(data);
                        calculatebicycle();
                        });',
                    ]
                ])->label('รายการยาง') ?>
            </div>
            <div class="col-md-1">
                <?= $form->field($model, 'grouptire')->textInput(['id' => 'bgrouptire', 'readonly' => true])->label('กลุ่มยาง') ?>
            </div>
            <div class="col-md-2">
                <?= $form->field($model, 'amount')->textInput(['id' => 'bamount', 'autocomplete' => 'off'])->label('ยอดผลิต') ?>
            </div>
            <div class="col-md-1">
                <?= $form->field($model, 'losttime')->textInput(['id' => 'blosttime', 'autocomplete' => 'off'])->label('เสียเวลา : นาที') ?>
            </div>
            <div class="col-md-2">
                <?= $form->field($model, 'minus')->textInput(['id' => 'bminus', 'readonly' => true])->label('ยอดยาง') ?>
            </div>
            <div class="col-md-2">
                <?= $form->field($model, 'perpcs')->textInput(['id' => 'bperpcs', 'readonly' => true])->label('ราคา : เส้น') ?>
            </div>
            <div class="col-md-2">
                <?= $form->field($model, 'rate')->textInput(['id' => 'brate', 'readonly' => true])->label('ค่าพิเศษ : วัน') ?>
                <?= $form->field($model, 'checks')->hiddenInput(['value' => 0])->label(false) ?>
            </div>
        </div>
        <hr>
        <div class="form-group">
            <div class="pull-left">
                <?= Html::submitButton($model->isNewRecord ? 'บันทึก' : 'แก้ไข', ['id' => 'bicyclesubmit', 'class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                <?= Html::button('ค่าเริ่มต้น', ['id' => 'breset', 'class' => 'btn btn-danger']) ?>
            </div>
            <div class="pull-right">
                <?= Html::a('หน้าหลัก', ['index'], ['class' => 'btn btn-info']) ?>
                <?= Html::a('ย้อนกลับ', Yii::$app->request->referrer, ['class' => 'btn btn-danger']) ?>
            </div>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>