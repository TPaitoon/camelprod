<?php

use common\models\EmpInfo;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Pibicalculator */
/* @var $form yii\widgets\ActiveForm */
$JS = <<<JS
    $(".multi-field-wrapper").each(function() {
        $("#add-field", $(this)).click(function(e) {
            //alert($("#empids").select2("data")[0].text);
            var str = $("#empids").select2("data")[0].text;
            var cnt = $(".multi-field").length;
            //alert(cnt);
            if (cnt <= 1) {
                var cLast = $(".multi-fields").find(".multi-field:last");
                
                if (cLast.closest(".multi-field").find(".ids").val() === "") {
                    // alert("");
                    cLast.closest(".multi-field").find(".ids").val(str.substr(0,7));
                    cLast.closest(".multi-field").find(".names").val(str.substr(8,$("#empids").select2("data")[0].text.length));
                    //cnt++;
                } else {
                    //$(".multi-field:first-child",wrapper).clone(true).appendTo(wrapper);
                    
                    var cLast = $(".multi-fields").find(".multi-field:last");
                    var cNew = cLast.clone();
                    cLast.after(cNew);
                    cNew.find("id input:text").each(function() {
                        $(this).val("");
                    })
                    cNew.closest(".multi-field").find(".ids").val(str.substr(0,7));
                    cNew.closest(".multi-field").find(".names").val(str.substr(8,$("#empids").select2("data")[0].text.length));
                    //cnt++;
                }
            } else {
                var cLast = $(".multi-fields").find(".multi-field:last");
                    var cNew = cLast.clone();
                    cLast.after(cNew);
                    cNew.find("id input:text").each(function() {
                        $(this).val("");
                    })
                    cNew.closest(".multi-field").find(".ids").val(str.substr(0,7));
                    cNew.closest(".multi-field").find(".names").val(str.substr(8,$("#empids").select2("data")[0].text.length));
                    //cnt++;
            }
            $("#empids").select2("val","0");
        })
    });

    function removeline(e) {
        //alert($(".multi-field").length);
        if ($(".multi-field").length > 1) {
            e.parent().parent().parent().remove();         
        }
    }
JS;
$this->registerJs($JS, static::POS_END);
$emplist = EmpInfo::find()->all();
?>

<div class="pibicalculator-form">

    <?php ActiveForm::begin([]); ?>
    <div class="multi-field-wrapper">
        Test Dynamicform
        <br>
        <div class="row">
            <div class="col-lg-4">
                <?php echo Select2::widget([
                    'id' => 'empids',
                    'name' => 'empid',
                    'value' => '',
                    'data' => ArrayHelper::map($emplist, 'PRS_NO', function ($data) {
                        return $data->PRS_NO . ' ' . $data->EMP_NAME . ' ' . $data->EMP_SURNME;
                    }),
                ]); ?>
            </div>
            <div class="form-group">
                <button type="button" class="btn btn-info" id="add-field"> +</button>
            </div>
        </div>

        <hr>

        <div>
            <label class="label label-primary" style="font-size: medium">Dynamic Form</label>
            <div>
                <br>
            </div>
            <div class="multi-fields">
                <div class="multi-field">
                    <div class="row">
                        <div class="col-lg-2">
                            <input type="text" name="dynamic[]" class="form-control ids">
                        </div>
                        <div class="col-lg-4">
                            <input type="text" name="empname" class="form-control names" readonly="true">
                        </div>
                        <div>
                            <button onclick="removeline($(this));" type="button" class="btn btn-danger remove-field" >x</button>
                        </div>
                    </div>
                    <br>
                </div>
            </div>
        </div>

        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? 'บันทึก' : 'แก้ไข', ['id' => 'bomsubmit', 'class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>

        <?php ActiveForm::end() ?>
    </div>
</div>

