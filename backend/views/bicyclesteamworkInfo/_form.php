<?php

use common\models\CheckStatusInfo;
use common\models\EmpInfo;
use common\models\SteambicycleworkInfo;
use kartik\date\DatePicker;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\BicyclesteamworkInfo */
/* @var $form yii\widgets\ActiveForm */

$empmodel = EmpInfo::find()->where(['Dept' => 'ฝ่ายผลิต'])->andFilterWhere(['like', 'Sec', 'นึ่ง'])->all();
$bicyclesec = SteambicycleworkInfo::find()->all();
?>
<div class="bicyclesteamwork-info-form">
    <?php $form = ActiveForm::begin(['id' => 'bicyclesteamwork-form']); ?>
    <div class="row">
        <div class="col-md-3">
            <?= $form->field($model, 'empid')->widget(Select2::className(), [
                'data' => ArrayHelper::map($empmodel, 'PRS_NO', 'PRS_NO'),
                'options' => [
                    'placeholder' => 'เลือกรหัสพนักงาน',
                    'id' => 'bsempid',
                    'onchange' => '$.post("index.php?r=bicyclesteamworkinfo/showempname&empid=' . '"+$(this).val(),function(data){
                    $("#bsempname").val(data);
                    });',
                ],
            ])->label('รหัสพนักงาน') ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'empName')->textInput(['id' => 'bsempname', 'readonly' => true])->label('ชื่อ - นามสกุล') ?>
        </div>
    </div>
    <div class="row">
        <hr>
    </div>
    <div class="row">
        <div class="col-md-3">
            <?php $model->date == '' ? $model->date = date('Y-m-d') : $model->date ?>
            <?= $form->field($model, 'date')->widget(DatePicker::className(), [
                'options' => [
                    'id' => 'bsdate'
                ],
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
        <div class="col-md-4">
            <?= $form->field($model, 'rank')->widget(Select2::className(), [
                'data' => ArrayHelper::map($bicyclesec, 'section', 'section'),
                'options' => [
                    'placeholder' => 'เลือกตำแหน่งงาน',
                    'id' => 'bsrank',
                    'onchange' => '$.post("index.php?r=bicyclesteamworkinfo/showextra&id=' . '"+$(this).val(),function(data){
                    $("#bsextra").val(data);
                    });',
                ],
            ])->label('ตำแหน่ง') ?>
            <?= $form->field($model, 'Extra')->hiddenInput(['id' => 'bsextra'])->label(false) ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'confirms')->hiddenInput(['value' => 0])->label(false) ?>
        </div>
    </div>
    <div class="row">
        <hr>
    </div>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'บันทึก' : 'แก้ไข', ['id' => 'bicyclesteamwork-submit', 'class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
