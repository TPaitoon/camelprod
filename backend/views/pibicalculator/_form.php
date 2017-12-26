<?php

use common\models\EmpInfo;
use common\models\HourInfo;
use common\models\PIBIMaster;
use common\models\PIBIStandard;
use common\models\ShiftList;
use common\models\Standardcpbicycletirei;
use kartik\date\DatePicker;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\web\JqueryAsset;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Pibicalculator */
/* @var $form yii\widgets\ActiveForm */
$js1 = <<<JS

    if ($("#amount").val() === '') {
        var cntline = 0;
        $("#amount").val(0);
        $("#rate").val(0);  
        $("#xrate").val(0);
        $("#deduct").val(0);
        $("#totaltire").val(0);
    }

    $(".pibicalculator-form").each(function() {
        //alert($(".listemp").length);
        var fBody = $(".pibicalculator-form").find(".listemp");
        var fLast = fBody.find("tr:last"); 
        if (fLast.closest("tr").find(".empid").val() !== "") {
            //alert("");
            cntline++;
        }
        $(".cline").val(cntline);
        $(".addemp",$(this)).click(function() {
            var str = $("#empidselect").select2("data")[0].text;
            if (str !== "") {
                var cnt = $(".listemp").length;
                if(cnt <= 1) {
                    var fBody = $(".pibicalculator-form").find(".listemp");
                    var fLast = fBody.find("tr:last"); 
                    if (fLast.closest("tr").find(".empid").val() === "") {
                        //alert("");
                        fLast.closest("tr").find(".empid").val(str.substr(0,7));
                        fLast.closest("tr").find(".empname").val(str.substr(8,$("#empidselect").select2("data")[0].text.length));
                        cntline++;
                        $(".cline").val(cntline);
                    } else {
                        var fBody = $(".pibicalculator-form").find(".listemp");
                        var fLast = fBody.find("tr:last"); 
                        var fNew = fLast.clone();
                        fLast.after(fNew);
                        fNew.find("id input:text").each(function() {
                            $(this).val("");
                        })
                        fLast.closest("tr").find(".empid").val(str.substr(0,7));
                        fLast.closest("tr").find(".empname").val(str.substr(8,$("#empidselect").select2("data")[0].text.length));
                        cntline++;
                        $(".cline").val(cntline);
                    }
                } else {
                    var fBody = $(".pibicalculator-form").find(".listemp");
                    var fLast = fBody.find("tr:last"); 
                    var fNew = fLast.clone();
                    fLast.after(fNew);
                    fNew.find("id input:text").each(function() {
                        $(this).val("");
                    })
                    fLast.closest("tr").find(".empid").val(str.substr(0,7));
                    fLast.closest("tr").find(".empname").val(str.substr(8,$("#empidselect").select2("data")[0].text.length));
                    cntline++;
                    $(".cline").val(cntline);
                }
            } else {
                alert("เลือกรหัสพนักงาน ...");
            }
            $("#empidselect").val("").trigger("change");
            calculator();
        })
    });

    function removeline(e) {
        //alert($("table.listemp >tbody >tr").length);
        if ($("table.listemp >tbody >tr").length > 1) {
            e.parent().parent().remove();
            cntline--;
            $(".cline").val(cntline);
        } else {
            var fBody = $(".pibicalculator-form").find(".listemp");
            var fLast = fBody.find("tr:last");
            if (fLast.closest("tr").find(".empid").val() !== "")
            {
                fLast.closest("tr").find(".empid").val("");
                fLast.closest("tr").find(".empname").val("");
                cntline--;
                $(".cline").val(cntline);
            }
        }
        calculator();
    }
    
    function chknumber(event) {
        var key = window.event ? event.keyCode : event.which;
        //alert(key);
        if (key === 8 || key === 46 || key === 37 || key === 39 || key === 0) {
            return true;
        } else if ( key < 48 || key > 57 ) {
            return false;
        }
        return true;
    }
JS;
$this->registerJs($js1, static::POS_END);
$this->registerJsFile(Yii::$app->request->baseUrl . '/js/calculatepibi.js?Ver=0001', ['depends' => JqueryAsset::className()]);
$emplist = EmpInfo::find()->where(['Dept' => 'ฝ่ายผลิต'])->andFilterWhere(['Sec' => 'ประกอบยางใน'])->all();
$itemlist = PIBIStandard::find()->all();
$shiftlist = ShiftList::find()->all();
$hourlist = HourInfo::find()->orderBy(['values' => SORT_ASC])->all();
?>

    <div class="pibicalculator-form">
        <div class="row">
            <div class="col-lg-12">
                <h5><b>เลือกรายชื่อพนักงาน</b></h5>
            </div>
            <div class="col-lg-3">
                <?php echo Select2::widget([
                    'id' => 'empidselect',
                    'name' => '',
                    'data' => ArrayHelper::map($emplist, 'PRS_NO', function ($data) {
                        return $data->PRS_NO . ' ' . $data->EMP_NAME . ' ' . $data->EMP_SURNME;
                    }),
                    'options' => ['placeholder' => '']
                ]); ?>
            </div>
            <div class="col-lg-1">
                <button type="button" class="btn btn-primary addemp">+</button>
            </div>
        </div>
        <hr>
        <div class="row">
            <?php $form = ActiveForm::begin() ?>
            <div class="col-lg-4">
                <table class="table table-bordered listemp">
                    <thead>
                    <tr>
                        <th width="150">รหัสพนักงาน</th>
                        <th>ชื่อ - นามสกุล</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>
                            <input type="text" name="empids[]" class="form-control empid" readonly="true">
                        </td>
                        <td>
                            <input type="text" name="empname" class="form-control empname" readonly="true">
                        </td>
                        <td style="text-align: center">
                            <button type="button" class="btn btn-danger removeline" onclick="removeline($(this))">-
                            </button>
                        </td>
                    </tr>
                    </tbody>
                </table>
                <div class="row ">
                    <div class="col-lg-2">
                        Line ผลิต :
                    </div>
                </div>
                <div class="row ">
                    <div class="col-lg-2">
                        <input type="text" class="form-control cline" readonly="true" style="text-align: center">
                    </div>
                </div>
            </div>
            <div class="col-lg-1"></div>
            <div class="col-lg-7">
                <div class="row">
                    <div class="col-lg-2">
                        <?= $form->field($model, 'Shiftid')->widget(Select2::className(), [
                            'data' => ArrayHelper::map($shiftlist, 'id', 'shiftname')
                        ])->label('ช่วงเวลาทำงาน') ?>
                    </div>
                    <div class="col-lg-1">
                        <?= $form->field($model, 'Groupid')->textInput(['maxlength' => 2, 'autocomplete' => 'off', 'id' => 'groupid', 'onkeypress' => 'return chknumber(event);', 'style' => 'text-align: center'])->label('กลุ่ม') ?>
                    </div>
                    <div class="col-lg-3">
                        <?php $model->Date == '' ? $model->Date = date('Y-m-d') : $model->Date ?>
                        <?= $form->field($model, 'Date')->widget(DatePicker::className(), [
                            'options' => ['id' => 'date'],
                            'name' => 'datep1',
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
                    <div class="col-lg-2">
                        <?= $form->field($model, 'Hour')->dropDownList(ArrayHelper::map($hourlist, 'values', 'hour'), ['id' => 'hour'])->label('ชั่วโมงงาน') ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <hr>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-2">
                        <?= $form->field($model, 'Itemid')->dropDownList(ArrayHelper::map($itemlist, 'refid', 'name'), ['id' => 'std'])->label('มาตรฐาน') ?>
                    </div>
                    <div class="col-lg-2">
                        <?= $form->field($model, 'amount')->textInput(['maxlength' => 4, 'autocomplete' => 'off', 'id' => 'amount', 'onkeypress' => 'return chknumber(event);', 'style' => 'text-align: center'])->label('ยอดยาง (ก่อนนึ่ง)') ?>
                    </div>
                    <div class="col-lg-2">
                        <?= $form->field($model, 'Totaltire')->textInput(['maxlength' => 4, 'autocomplete' => 'off', 'id' => 'totaltire', 'onkeypress' => 'return chknumber(event);', 'style' => 'text-align: center'])->label('ยอดยาง (หลังนึ่ง)') ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <hr>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-2">
                        <?= $form->field($model, 'xrate')->textInput(['autocomplete' => 'off', 'id' => 'xrate', 'onkeypress' => 'return chknumber(event);', 'style' => 'text-align: center', 'readonly' => true])->label('ค่าพิเศษ') ?>
                    </div>
                    <div class="col-lg-2">
                        <?= $form->field($model, 'Deduct')->textInput(['autocomplete' => 'off', 'id' => 'deduct', 'onkeypress' => 'return chknumber(event);', 'style' => 'text-align: center'])->label('หักเงิน') ?>
                    </div>
                    <div class="col-lg-2">
                        <?= $form->field($model, 'rate')->textInput(['autocomplete' => 'off', 'id' => 'rate', 'onkeypress' => 'return chknumber(event);', 'style' => 'text-align: center', 'readonly' => true])->label('ค่าพิเศษ : คน') ?>
                    </div>
                    <div class="col-lg-2">
                        <input type="hidden" class="listid" name="listid[]" value="<?php echo $model->listid ?>">
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <hr>
                    </div>
                </div>
                <div class="form-group">
                    <div class="pull-left">
                        <?= Html::submitButton($model->isNewRecord ? 'บันทึก' : 'แก้ไข', ['id' => 'pibisubmit', 'class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                        <span hidden><?= Html::button('ตรวจสอบ', ['id' => 'check', 'class' => 'btn btn-info']) ?></span>
                    </div>
                    <div class="pull-right">
                        <?= Html::a('หน้าหลัก', ['index'], ['class' => 'btn btn-info']) ?>
                        <?= Html::a('ย้อนกลับ', Yii::$app->request->referrer, ['class' => 'btn btn-danger']) ?>
                    </div>
                </div>
            </div>
            <?php ActiveForm::end() ?>
        </div>
    </div>

<?php
$js2 = <<<JS
    // alert($(".listid").val());
    if ($(".listid").val() !== '') {
        // alert('');
        // var list = $(".listid").val().split(',');
        var list = $(".listid").val();
        var cntline = 0;
        // alert(Array.isArray(list));
        $.when(getEmpname(list)).done(function(data) {
            // alert(data.length);
            // alert(data);
            $(".cline").val(cntline);
            for (var i = 0;i < cntline;i++) {
                var cnt = $(".listemp").length;
                if (cnt <= 1) {
                    var fBody = $(".pibicalculator-form").find(".listemp");
                    var fLast = fBody.find("tr:last");
                    if (fLast.closest("tr").find(".empid").val() === "") {
                        //alert("");
                        fLast.closest("tr").find(".empid").val(data[i].substr(0,7));
                        fLast.closest("tr").find(".empname").val(data[i].substr(8,data[i].length));
                    } else {
                        var fBody = $(".pibicalculator-form").find(".listemp");
                        var fLast = fBody.find("tr:last"); 
                        var fNew = fLast.clone();
                        fLast.after(fNew);
                        fNew.find("id input:text").each(function() {
                            $(this).val("");
                        })
                        fLast.closest("tr").find(".empid").val(data[i].substr(0,7));
                        fLast.closest("tr").find(".empname").val(data[i].substr(8,data[i].length));
                    }
                } else {
                    var fBody = $(".pibicalculator-form").find(".listemp");
                    var fLast = fBody.find("tr:last"); 
                    var fNew = fLast.clone();
                    fLast.after(fNew);
                    fNew.find("id input:text").each(function() {
                        $(this).val("");
                    })
                    fLast.closest("tr").find(".empid").val(data[i].substr(0,7));
                    fLast.closest("tr").find(".empname").val(data[i].substr(8,data[i].length));
                }
            }
        });
        $.when(getRate($("#hour").val(),$("#std").val(),$("#totaltire").val())).done(function (data) {
        //alert(data);
        $("#xrate").val(data);
        var cal = (parseInt(data) - parseInt($("#deduct").val())) / $(".cline").val();
        $("#rate").val(Math.round(cal));
    })
    }
    
    function getEmpname(list) {
        var name;
        // alert(list);
        $.ajax({
            type: 'post',
            url: 'index.php?r=pibicalculator/getempname',
            async: false,
            data: {empid: list},
            dataType: 'json',
            cache: false,
            success: function(data) {
                // alert(data.length);
                cntline = data.length;
                name = data;
            }
        });      
        return name;
    }
JS;
$this->registerJs($js2, static::POS_END);
?>