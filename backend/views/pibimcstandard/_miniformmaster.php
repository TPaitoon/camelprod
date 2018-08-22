<?php

/**
 * Created by PhpStorm.
 * User: paitoon.j
 * Date: 09/08/2018
 * Time: 16:17
 */

/* @var $this \yii\web\View */
/* @var $model \common\models\PIBIMCStandardDetail|\yii\db\ActiveRecord */
?>
    <div class="col-lg-12">
        <div class="row">
            <div class="col-lg-4">
                <div class="row">
                    <form action="index.php?r=pibimcstandard/createmasterlist" id="pibimcmaster-form" method="post">
                        <table class="table table-bordered masterlist">
                            <thead>
                            <tr>
                                <td>Name</td>
                                <td>Refid</td>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td><input readonly type="text" name="namex[]" class="form-control names"></td>
                                <td><input readonly type="text" name="refx[]" class="form-control refs"></td>
                            </tr>
                            </tbody>
                        </table>
                    </form>
                </div>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="pull-left">
                <button id="btnsave" class="btn btn-success">บันทึกข้อมูล</button>
            </div>
            <div class="pull-right">
                <?= \yii\helpers\Html::a('<i class="fa fa-home"></i>', ['index'], ['class' => 'btn btn-info']) ?>
                <?= \yii\helpers\Html::a('<i class="fa fa-undo"></i>', Yii::$app->request->referrer, ['class' => 'btn btn-danger']) ?>
            </div>
        </div>
    </div>
<?php
$ScriptJs = <<<JS
var names = $("#stdname");
var ref = $("#refidx");

$("#btnsave").click(function() {
    $("#pibimcmaster-form").submit();
});

$("#pibimcmaster-form").each(function() {
    var fBody = $(this).find(".masterlist");
    var fSelectTR = fBody.find("tr:last").closest("tr");

    $(".adddata").click(function() {
        if (names.val() !== "" && ref.val() !== "") {
            if (fSelectTR.find(".names").val() === "") {
                fSelectTR.find(".names").val(names.val());
                fSelectTR.find(".refs").val(ref.val());
                ref.val(parseInt(ref.val()) + 1);
            } else if (checkGroupDuplicate(names.val(),ref.val()) == 1) {
                var fNew = fBody.find("tr:last").clone();
                fBody.find('tr:last').after(fNew);
                fSelectTR = fBody.find('tr:last').closest('tr');
                fNew.find('id input:text').each(function() {
                    $(this).val();
                });
                fSelectTR.find('.names').val(names.val());
                fSelectTR.find('.refs').val(ref.val());
                ref.val(parseInt(ref.val()) + 1);
            }
        }
    });
});

function checkGroupDuplicate(val, val2) {
    var nlist = document.getElementsByName("namex[]");
    var rlist = document.getElementsByName("refx[]");
    for (var i = 0; i < nlist.length; i++) {
        if (nlist[i].value === val && rlist[i].value === val2) {
            return 0;
        }
    }
    return 1;
}
JS;
$this->registerJS($ScriptJs,static::POS_END);
?>
