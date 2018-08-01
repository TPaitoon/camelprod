<?php
/**
 * Created by PhpStorm.
 * User: paitoon.j
 * Date: 05/06/2018
 * Time: 10:59
 */
?>
    <!--    <h4>จำนวน : <label id="count" style="color: #00a65a">#</label> แถว</h4>-->
    <div class="col-lg-12">
        <div class="row">
            <div class="col-lg-4">
                <div class="row">
                    <form action="index.php?r=pibistandard/createmaster" id="pmaster-form" method="post">
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
$ScriptJS = <<<JS
var names = $("#aaaaa");
var ref = $("#refid");

$("#btnsave").click(function() {
    // alert(names.val() + "|" + ref.val());
$("#pmaster-form").submit();    
});

$("#pmaster-form").each(function() {
    var fBody = $(this).find(".masterlist");
    var fLast = fBody.find("tr:last");
    var fTr = fLast.closest("tr");
    var fNew;
    $(".adddata").click(function() {
        if (names.val() !== "" && ref.val() !== "") {
            // alert(names.val() + "|" + ref.val());
            if (fTr.find(".names").val() === "") {
                fTr.find(".names").val(names.val());
                fTr.find(".refs").val(ref.val());
                ref.val(parseInt(ref.val()) + 1);
            } else if (checkGroupDuplicate(names.val(),ref.val()) == 1)  {
                fLast = fBody.find("tr:last");
                fNew = fLast.clone();
                fLast.after(fNew);
                fLast = fBody.find("tr:last");
                fTr = fLast.closest("tr");
                fNew.find("id input:text").each(function() {
                    $(this).val();
                });
                fTr.find(".names").val(names.val());
                fTr.find(".refs").val(ref.val());
                ref.val(parseInt(ref.val()) + 1);
            }
        } 
    });
});

function checkGroupDuplicate(n,r) {
    var nlist = document.getElementsByName("namex[]");
    var rlist = document.getElementsByName("refx[]");
    for (var i = 0; i < nlist.length; i++) {
        if (nlist[i].value === n && rlist[i].value === r)
            return 0; 
    } 
    return 1;
}
JS;
$this->registerJs($ScriptJS, static::POS_END);
?>