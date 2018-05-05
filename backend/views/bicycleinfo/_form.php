<?php

use backend\controllers\BicycleinfoController;
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
    <?php $form = ActiveForm::begin(['id' => 'bicycleform']); ?>
    <div class="row">
        <div class="col-md-5">
            <?= $form->field($model, 'empid')->widget(Select2::className(), [
                'data' => ArrayHelper::map($empmodel, 'PRS_NO', function ($data) {
                    return $data->PRS_NO . " : " . $data->EMP_NAME . " " . $data->EMP_SURNME;
                }),
                'options' => [
                    'placeholder' => 'เลือกรหัสพนักงาน',
                    'id' => 'bempid',
                    'onchange' => '$.post("index.php?r=bicycleinfo/showempname&empid=' . '"+$(this).val(),function(data){
                        $("#bempname").val(data);
                        });',
                ],])->label('รหัสพนักงาน') ?>
        </div>
        <div class="col-md-2">
            <?php $model->date == '' ? $model->date = date('d/m/Y') : $model->date = date('d/m/Y', strtotime(BicycleinfoController::ConvertDate($model->date))) ?>
            <?= $form->field($model, 'date')->widget(DatePicker::className(), [
                'options' => ['id' => 'bdate'],
                'type' => DatePicker::TYPE_COMPONENT_APPEND,
                'layout' => '{picker}{input}',
                'pluginOptions' => [
                    'format' => 'dd/mm/yyyy',
                    'autoclose' => true,
                    'todayHighlight' => true,
                ]
            ])->label('วันที่ทำงาน') ?>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-md-4">
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
    </div>
    <div class="row">
        <div class="col-md-2">
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
    <div class="row">
        <div class="col-md-12">
            <!--?= Html::submitButton($model->isNewRecord ? 'บันทึก' : 'แก้ไข', ['id' => 'bicyclesubmit', 'class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?-->
            <div style="text-align: center">
                <?= Html::a('<i class="fa fa-plus"></i>', 'javascript:void(0)', ['class' => 'btn btn-success addata', 'style' => 'width: 50px']) ?>
            </div>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
</div>