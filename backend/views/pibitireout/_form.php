<?php

use backend\models\Scripts;
use common\models\EmpInfo;
use common\models\ShiftList;
use kartik\date\DatePicker;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\web\JqueryAsset;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\PIBITireOut */
/* @var $form yii\widgets\ActiveForm */

$emplist = EmpInfo::findAll(["Dept" => "ฝ่ายผลิต", "Sec" => "ประกอบยางใน"]);
$shiftlist = ShiftList::find()->all();

$value = [];
for ($i = 0; $i < 4; $i++) {
    $i == 0 ? array_push($value, ["A" => 60]) : $i == 1 ? array_push($value, ["A" => 90]) : $i == 2 ? array_push($value, ["A" => 120]) : $i == 3 ? array_push($value, ["A" => 180]) : null;
}
?>
    <div class="pibitireout-form">
        <?php $form = ActiveForm::begin(); ?>
        <div class="row">
            <div class="col-lg-7">
                <?= $form->field($model, 'empid')->widget(Select2::className(), [
                    "data" => ArrayHelper::map($emplist, "PRS_NO", function ($model) {
                        return $model->PRS_NO . " " . $model->EMP_NAME . " " . $model->EMP_SURNME;
                    }),
                    "options" => [
                        "placeholder" => "เลือกรหัสพนักงาน",
                        "id" => "empidselect",
//                        "onchange" => '$.post("index.php?r=pibitireout/getempname&id=' . '"+$(this).val(),function(data){
//					$("#empname").val(data);
//					 });',
                    ]
                ])->label("รหัสพนักงาน") ?>
            </div>
        </div>
        <div class="row">
            <hr>
        </div>
        <div class="row">
            <div class="col-lg-3">
                <?= $form->field($model, 'shift')->dropDownList(
                    ArrayHelper::map($shiftlist, "id", "shiftname"), ["id" => "shiftselect"]
                )->label("ช่วงทำงาน") ?>
            </div>
            <div class="col-lg-3">
                <?php $model->date == "" ? $model->date = date('d/m/Y') : $model->date = Scripts::ConvertDateYMDtoDMYforForm($model->date) ?>
                <?= $form->field($model, 'date')
                    ->widget(DatePicker::className(), [
                        'name' => 'datepk',
                        'type' => DatePicker::TYPE_COMPONENT_APPEND,
                        'layout' => '{picker}{input}',
//                        'readonly' => true,
                        'pluginOptions' => [
                            'format' => 'dd/mm/yyyy',
                            'autoclose' => true,
                            'todayHighlight' => true
                        ],
                        'options' => [
                            'id' => 'date'
                        ]
                    ])->label("วันที่") ?>
            </div>
            <div class="col-lg-3">
                <?= $form->field($model, 'qty')->dropDownList(ArrayHelper::map($value, "A", "A"))->label("ค่าพิเศษ") ?>
            </div>
        </div>
        <div class="row">
            <hr>
        </div>
        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary', 'id' => 'btnsave']) ?>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
<?php
$checkjs = <<<JS
// alert($status);
$("#empidselect").select2()
.on("select2:opening",function() {
    $("#create-modal").removeAttr("tabindex","-1");
})
.on("select2:close",function() {
    $("#create-modal").attr("tabindex","1");  
});

$("#btnsave").on("click",function(e) {
    if (confirm("ต้องการบันทึกข้อมูล ?")){
        $.when(getCount()).done(function(data) {
            // alert(data);
            if (parseInt(data) > 0) {
                if ($status == 0) {
                    alert("มีข้อมูลแล้ว ...");
                    e.preventDefault();
                } else {
                    $("#btnsave").submit();
                }
            } else {
                 $("#btnsave").submit();
            }
        });
    }
});

function getCount() {
    var x = 1;
    $.ajax({
         type: "post",
         url: "?r=pibitireout/countmodel",
         data: {date:$("#date").val(),empid:$("#empidselect").val()},
         async: false,
         success: function(data) {
             x = data;
         }
    });
    return x;
}
JS;
$this->registerJs($checkjs, static::POS_END);
?>