<?php

/**
 * Created by PhpStorm.
 * User: paitoon.j
 * Date: 09/03/2018
 * Time: 10:18
 */

use common\models\ItemData;
use kartik\date\DatePicker;
use kartik\datetime\DateTimePicker;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

date_default_timezone_set("Asia/Bangkok");
/* @var $this yii\web\View */
/* @var $model common\models\PTBMPlanning */
/* @var $statusinfo */
/* @var $form yii\widgets\ActiveForm */
$itemid = ItemData::findAll(["ITEMBUYERGROUPID" => "PTBM"]);
//print $statusinfo;
//print_r($model);
?>
    <div class="ptbmplanning-form">
        <input hidden class="statusinfo" value="<?= $statusinfo ?>">
        <input hidden class="c_itemddesc" value="<?= ArrayHelper::getValue($model, 'c_itemiddesc') ?>">
        <input hidden class="recid" value="<?= ArrayHelper::getValue($model, 'recid') ?>">
        <?php $form = ActiveForm::begin() ?>
        <div class="row">
            <div class="col-lg-2">
                <?php $model->wrno == "" ? $model->wrno = date('dmy') : $model->wrno ?>
                <?= $form->field($model, 'wrno')->textInput(['readonly' => true, 'id' => 'wrno'])->label("เลขที่") ?>
            </div>
            <div class="col-lg-4">
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
                        "format" => "yyyy-mm-dd HH:ii:ss",
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
                <?= $form->field($model, 'asset')->textInput(["id" => "asset"])->label("รหัสเครื่องจักร") ?>
            </div>
            <div class="col-lg-3">
                <?= $form->field($model, 'itemid')->widget(Select2::className(), [
                    "data" => ArrayHelper::map($itemid, "ITEMID", "ITEMID"),
                    "options" => [
                        "placeholder" => "เลือกรหัสวัตถุดิบ",
                        "id" => "itemids"
                    ],
                    "pluginOptions" => [
                        "allowClear" => true
                    ]
                ])->label("รหัสวัตถุดิบ") ?>
            </div>
            <div class="col-lg-3">
                <?php $model->qty == "" ? $model->qty = 0 : $model->qty ?>
                <?= $form->field($model, 'qty')->textInput(["onkeypress" => "return chknumber(event);", "id" => "qty"])
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
                            <input type="text" name="desc[]" class="form-control description" readonly>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row">
            <hr>
        </div>
        <div class="form-group">
            <?= Html::submitButton("บันทึก", ["class" => "btn btn-success", "id" => "btnsave"]) ?>
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
function getcId(id) {
    var x = null;
    $.ajax({
        type: "post",
        url: "?r=ptbmplanning/getcid",
        data: {id:id},
        async: false,
        dataType: "json",
        success: function(data) {
            x = data;
        }
    });
    return x;
}
function getDesc(id) {
    var x = null;
    $.ajax({
        type: "post",
        url: "?r=ptbmplanning/getdesc",
        data: {id:id},
        async: false,
        dataType: "json",
        success: function(data) {
            x = data;
        }
    });
    return x;
}
function getCount(id,date) {
    var x = null;
    $.ajax({
        type: "post",
        url: "?r=ptbmplanning/getcount",
        data: {id:id,date:date},
        async: false,
        success: function(data) {
            x = data;
        }
    });
    return x;
}
function pad(num) {
    var x;
    if (num < 10) {
        x = "0" + num;
    } else if (num.toString().length > 2) {
        x = num.toString().substr(-2);
    } else {
        x = num.toString();
    }
    return x;
}

$(document).ready(function() {
    var assyF = $("#assyF");
    var assyW = $("#assyW");
    if (assyF.val() === "" && assyW.val() === "") {
        assyF.val(0);
        assyW.val(0);
    }
    // alert($("#date").val());
});
var itemid = $("#itemids");
var btnsave = $("#btnsave");
var date = $("#date");
var asset = $("#asset");
var qty = $("#qty");
var statusinfo = $(".statusinfo");

qty.on("click",function() {
    if ($(this).val() === "0") { $(this).val(""); } else { $(this).select(); }
}).on("focusout",function() {
    if ($(this).val() === "") { $(this).val(0); }
});
itemid.select2()
.on("select2:opening",function() {
    $("#create-modal").removeAttr("tabindex","-1");
})
.on("select2:close",function() {
    $("#create-modal").attr("tabindex","1");
});
itemid.on("change",function() {
    // alert(itemid.val());
    if (itemid.val() !== "") {
        // alert(getId(itemid.val()));
        $.when(getcId(itemid.val())).done(function(data) {
            // alert(data.length);
            var fBody = $(".ptbmplanning-form").find(".listitemid");
            var fLast = fBody.find("tr:last");
            var fLaststr = fLast.closest("tr");
            var fNew;

            if (data.length > 0) {
                fLast = fBody.find("tr:last");
                fNew = fLast.clone();
                $(".listitemid >tbody >tr").empty();
                fLast.after(fNew);
                fLast = fBody.find("tr:last");
                fLaststr = fLast.closest("tr");
                fLaststr.find(".itemid").val("");
                fLaststr.find(".description").val("");
            }

            // alert(data);
            var id, desc;
            for (var i = 0; i < data.length; i++) {
                var cut = data[i].split(":");
                id = cut[0];
                desc = cut[1];
                // alert(id + ":" + desc);
                if (fLaststr.find(".itemid").val() === "") {
                    fLaststr.find(".itemid").val(id);
                    fLaststr.find(".description").val(desc);
                } else {
                    fLast = fBody.find("tr:last");
                    fNew = fLast.clone();
                    fLast.after(fNew);
                    fLast = fBody.find("tr:last");
                    fLaststr = fLast.closest("tr");
                    fNew.find("id input:text").each(function () {
                        $(this).val("");
                    });
                    fLaststr.find(".itemid").val(id);
                    fLaststr.find(".description").val(desc);
                }
            }
        });
        $.when(getDesc(itemid.val())).done(function(data) {
            // alert(data);
            var obj = data.split(":");
            $("#desc").val(obj[0]);
            $("#assyF").val(obj[1]);
            $("#assyFD").val(parseInt(obj[1]) + 20);
            $("#assyW").val(obj[2]);
        });
    } else {
        var fBody = $(".ptbmplanning-form").find(".listitemid");
        var fLast;
        var fLaststr, fNew;
        fLast = fBody.find("tr:last");
        fNew = fLast.clone();
        $(".listitemid >tbody >tr").empty();
        fLast.after(fNew);
        fLast = fBody.find("tr:last");
        fLaststr = fLast.closest("tr");
        fLaststr.find(".itemid").val("");
        fLaststr.find(".description").val("");
        $("#assyF").val(0);
        $("#assyFD").val(0);
        $("#assyW").val(0);
        $("#desc").val("");
    }
});

if (parseInt(statusinfo.val()) === 1) {
    $("#assyFD").val(parseInt($("#assyF").val()) + 20);
    var cdesc = $(".c_itemddesc");
    // alert(cdesc.val());
    var fstr = cdesc.val().split(",");
    for (var i = 0; i < fstr.length; i++) {
        // alert(fstr[i]);
        var sstr = fstr[i].split(":");
        var fBody = $(".ptbmplanning-form").find(".listitemid");
        var fLast = fBody.find("tr:last");
        var fLaststr = fLast.closest("tr");
        var fNew;
        if (fLaststr.find(".itemid").val() === "") {
            fLaststr.find(".itemid").val(sstr[0]);
            fLaststr.find(".description").val(sstr[1]);
        } else {
            fLast = fBody.find("tr:last");
            fNew = fLast.clone();
            fLast.after(fNew);
            fLast = fBody.find("tr:last");
            fLaststr = fLast.closest("tr");
            fNew.find("id input:text").each(function() {
                $(this).val();
            });
            fLaststr.find(".itemid").val(sstr[0]);
            fLaststr.find(".description").val(sstr[1]);
        }
    }
}

date.on("change",function() {
    var d = new Date(date.val());
    $("#wrno").val(pad(d.getDate()) + pad(d.getMonth() +1) + pad(d.getFullYear()));
});

btnsave.on("click",function(e) {
    if (confirm("ต้องการบันทึกข้อมูล ?")) {
        $.when(getCount($("#itemids").val(),$("#date").val())).done(function(data) {
            // alert(data);
            // alert("statusinfo : " + $(".statusinfo").val());
            // e.preventDefault(); // wait edit
            if (itemid.val() !== "" && qty.val() !== "" && asset.val() !== "" && qty.val() !== 0) {
                if (parseInt($(".statusinfo").val()) === 0 && parseInt(data) > 0) {
                    alert("มีข้อมูลแล้ว ...");
                    e.preventDefault();
                } else {
                    $("#btnsave").submit();
                    // e.preventDefault();
                }
            } else {
                alert("ข้อมูลไม่ครบ ...");
                e.preventDefault();
            }
        });
    }
});
JS;
$this->registerJs($scriptjs, static::POS_END);
?>