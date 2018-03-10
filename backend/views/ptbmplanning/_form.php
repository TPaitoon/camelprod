<?php

/**
 * Created by PhpStorm.
 * User: paitoon.j
 * Date: 09/03/2018
 * Time: 10:18
 */

use common\models\USRMPD04;
use kartik\date\DatePicker;
use kartik\datetime\DateTimePicker;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;

date_default_timezone_set("Asia/Bangkok");
/* @var $this yii\web\View */
/* @var $model common\models\PTBMPlanning */
/* @var $form yii\widgets\ActiveForm */
$itemid = USRMPD04::findAll(["ITEMBUYERGROUPID" => "PTBM"]);
?>
    <div class="ptbmplanning-form">
        <?php $form = ActiveForm::begin() ?>
        <div class="row">
            <div class="col-lg-2">
                <?php $model->wrno == "" ? $model->wrno = date('dmy') : $model->wrno ?>
                <?= $form->field($model, 'wrno')->textInput(['readonly' => true])->label("เลขที่") ?>
            </div>
            <div class="col-lg-3">
                <?php $model->date == "" ? $model->date = date('Y-m-d H:i:s') : $model->date ?>
                <?= $form->field($model, 'date')->widget(DateTimePicker::className(), [
                    "name" => "datepk",
                    "type" => DatePicker::TYPE_COMPONENT_APPEND,
                    "layout" => "{picker}{input}",
                    "readonly" => true,
                    "options" => [
                        "id" => "date"
                    ],
                    "pluginOptions" => [
                        "format" => "yyyy-mm-dd H:i:ss",
                        "autoclose" => true,
                        "todayHighlight" => true
                    ]
                ])->label("วันที่") ?>
            </div>
            <div class="col-lg-3">
                <?php $model->group == "" ? $model->group = "ประกอบยางนอก" : $model->group ?>
                <?= $form->field($model, 'group')->textInput(['readonly' => true])->label("แผนก") ?>
            </div>
        </div>
        <div class="row">
            <hr>
        </div>
        <div class="row">
            <div class="col-lg-2">
                <?= $form->field($model, 'asset')->textInput()->label("รหัสเครื่องจักร") ?>
            </div>
            <div class="col-lg-3">
                <?= $form->field($model, 'itemid')->widget(Select2::className(), [
                    "data" => ArrayHelper::map($itemid, "ITEMID", "ITEMID"),
                    "options" => [
                        "placeholder" => "เลือกรหัสวัตถุดิบ",
                        "id" => "itemid"
                    ],
                    "pluginOptions" => [
                        "allowClear" => true
                    ]
                ])->label("รหัสวัตถุดิบ") ?>
            </div>
            <div class="col-lg-3">
                <?= $form->field($model, 'qty')->textInput(["onkeypress" => "return chknumber(event);"])
                    ->label("จำนวนผลิต") ?>
            </div>
        </div>
        <div class="row">
            <hr>
        </div>
        <div class="row">
            <div class="col-lg-3">
                <?= $form->field($model, 'desc')->textInput(["readonly" => true, "id" => "desc"])->label("ลักษณะยาง") ?>
            </div>
            <div class="col-lg-3">
                <?= $form->field($model, 'assy_Frame')->textInput(["readonly" => true, "id" => "assyF"])->label("ขนาดวงล้อ (+/- 2 mm)") ?>
            </div>
            <div class="col-lg-3">
                <?= $form->field($model, 'assy_FrameDummy')->textInput(["readonly" => true, "id" => "assyFD", "value" => 0])->label("ประกอบเสร็จ (+/- 2 mm)") ?>
            </div>
            <div class="col-lg-3">
                <?= $form->field($model, 'assy_Weight')->textInput(["readonly" => true, "id" => "assyW"])->label("น้ำหนักรวม (+/- 0.06kg)") ?>
            </div>
        </div>
        <div class="row">
            <br>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <table class="table table-bordered listitemid">
                    <thead>
                    <tr>
                        <th width="150">รหัส</th>
                        <th>รายละเอียด</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>
                            <input type="text" name="itemid[]" class="form-control itemid" readonly>
                        </td>
                        <td>
                            <input type="text" class="form-control description" readonly>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row">
            <hr>
        </div>
        <?php ActiveForm::end() ?>
    </div>
<?php
$scriptjs = <<<JS
function chknumber(event) {
    var key = window.event ? event.keyCode : event.which;
    // alert(key);
    if (key === 8 || key === 37 || key === 39 || key === 0) {
        return true;
    } else if ( key < 48 || key > 57 ) {
        return false;
    }
    return true;
}

function getId(id) {
    var x = null;
    $.ajax({
        type: "post",
        url: "?r=ptbmplanning/getid",
        data: {id:id},
        async: false,
        dataType: "json",
        success: function(data) {
            x = data;
        }
    });
    return x;
}

$(document).ready(function() {
    var assyF = $("#assyF");
    var assyW = $("#assyW");
    if (assyF.val() === "" && assyW.val() === "") {
        assyF.val(0);
        assyW.val(0);
    }
    // alert(getId(1));
});

$("#itemid").select2()
.on("select2:opening",function() {
    $("#create-modal").removeAttr("tabindex","-1");
})
.on("select2:close",function() {
    $("#create-modal").attr("tabindex","1");
});
JS;
$this->registerJs($scriptjs, static::POS_END);
?>