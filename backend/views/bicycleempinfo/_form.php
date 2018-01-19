<?php

use backend\models\StandardBicycle;
use common\models\CheckStatusInfo;
use common\models\EmpInfo;
use kartik\date\DatePicker;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\BicycleEmpInfo */
/* @var $form yii\widgets\ActiveForm */
$empmodel = EmpInfo::find()->where(['Dept' => 'ฝ่ายผลิต', 'Sec' => 'ประกอบยางนอก'])->all();
$bicyclesec = StandardBicycle::find()->all();
?>

<div class="bicycle-emp-info-form">
    <?php $form = ActiveForm::begin(['id' => 'bicycleemp-form']); ?>
    <div class="row">
        <div class="col-md-3">
            <?= $form->field($model, 'empid')->widget(Select2::className(), [
                'data' => ArrayHelper::map($empmodel, 'PRS_NO', 'PRS_NO'),
                'options' => [
                    'placeholder' => 'เลือกรหัสพนักงาน',
                    'id' => 'eempid',
                    'onchange' => '$.post("index.php?r=bicycleempinfo/showempname&id=' . '"+$(this).val(),function(data){
            $("#eempname").val(data);
            });',
                ],])->label('รหัสพนักงาน')
            ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'empName')->textInput(['id' => 'eempname', 'readonly' => true])->label('ชื่อ - นามสกุล') ?>
        </div>
        <div class="col-md-2">
            <?= $form->field($model, 'Extra')->hiddenInput(['id' => 'eextra', 'readonly' => true])->label(false) ?>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-md-2">
            <?php $model->date == '' ? $model->date = date('Y-m-d') : $model->date ?>
            <?= $form->field($model, 'date')->widget(DatePicker::className(), [
                'options' => [
                    'id' => 'edate'
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
        <div class="col-md-2">
            <?= $form->field($model, 'rank')->widget(Select2::className(), [
                'data' => ArrayHelper::map($bicyclesec, 'Section', 'Section'),
                'options' => [
                    'placeholder' => 'เลือกตำแหน่งงาน',
                    'id' => 'erank',
                    'onchange' => '$.post("index.php?r=bicycleempinfo/showextra&id=' . '"+$(this).val(),function(data){
                        $("#eextra").val(data); 
                    });',
                ],])->label('ตำแหน่ง') ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'confirms')->hiddenInput(['value' => 0])->label(false) ?>
        </div>
    </div>
    <hr>
    <div class="form-group">
        <div class="pull-left">
            <?= Html::submitButton($model->isNewRecord ? 'บันทึก' : 'แก้ไข', ['id' => 'bicycleemp-submit', 'class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
        <div class="pull-right">
            <?= Html::a('หน้าหลัก', ['index'], ['class' => 'btn btn-info']) ?>
            <?= Html::a('ย้อนกลับ', Yii::$app->request->referrer, ['class' => 'btn btn-danger']); ?>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
</div>
