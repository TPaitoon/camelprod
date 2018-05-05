<?php

use backend\models\Scripts;
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
        <div class="col-md-5">
            <?= $form->field($model, 'empid')->widget(Select2::className(), [
                'data' => ArrayHelper::map($empmodel, 'PRS_NO', function ($data) {
                    return $data->PRS_NO . " : " . $data->EMP_NAME . " " . $data->EMP_SURNME;
                }),
                'options' => [
                    'placeholder' => 'เลือกรหัสพนักงาน',
                    'id' => 'eempid',
                ],])->label('รหัสพนักงาน')
            ?>
        </div>
        <div class="col-md-2">
            <?= $form->field($model, 'Extra')->hiddenInput(['id' => 'eextra', 'readonly' => true])->label(false) ?>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-md-3">
            <?php $model->date == '' ? $model->date = date('d/m/Y') : $model->date = Scripts::ConvertDateYMDtoDMYforForm($model->date) ?>
            <?= $form->field($model, 'date')->widget(DatePicker::className(), [
                'options' => [
                    'id' => 'edate'
                ],
                'type' => DatePicker::TYPE_COMPONENT_APPEND,
                'layout' => '{picker}{input}',
//                'readonly' => true,
                'pluginOptions' => [
                    'format' => 'dd/mm/yyyy',
                    'autoclose' => true,
                    'todayHighlight' => true,
                ]
            ])->label('วันที่ทำงาน') ?>
        </div>
        <div class="col-md-4">
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
        <?= Html::submitButton($model->isNewRecord ? 'บันทึก' : 'แก้ไข', ['id' => 'bicycleemp-submit', 'class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
<?php
$scriptjs = <<<JS
$("#eempid")
.on("select2:opening",function() {
    $("#modal-create").removeAttr("tabindex","-1");
})
.on("select2:close",function() {
    $("#modal-create").attr("tabindex","1");  
});
JS;
$this->registerJs($scriptjs);
?>