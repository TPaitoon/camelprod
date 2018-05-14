<?php
/**
 * Created by PhpStorm.
 * User: paitoon.j
 * Date: 05/05/2018
 * Time: 16:09
 */

use yii\helpers\Html;

?>
    <div class="col-md-12">
        <h4>จำนวณ : <label id="count" style="color: #00a65a">#</label> แถว</h4>
    </div>
    <div class="col-md-12">
        <div class="row">
            <form id="bc-form" action="index.php?r=bicycleinfo/createmanual" method="post">
                <div class="col-md-12">
                    <div style="overflow-x: scroll">
                        <table class="table table-bordered listemp">
                            <thead>
                            <tr>
                                <th>รหัสพนักงาน</th>
                                <th>วันที่</th>
                                <th>รายการยาง</th>
                                <th>กลุ่มยาง</th>
                                <th>ยอดผลิต</th>
                                <th>เสียเวลา : นาที</th>
                                <th>ยอดยาง</th>
                                <th>ราคา : เส้น</th>
                                <th>ค่าพิเศษ : วัน</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>
                                    <input readonly type="text" name="empidx[]" class="form-control empids"
                                           style="width: 150px">
                                </td>
                                <td>
                                    <input readonly type="text" name="datex[]" class="form-control dates"
                                           style="width: 100px">
                                </td>
                                <td>
                                    <input readonly type="text" name="tirenamex[]" class="form-control tirenames"
                                           style="width: 300px">
                                </td>
                                <td>
                                    <input readonly type="text" name="grouptirex[]" class="form-control grouptires"
                                           style="width: 75px">
                                </td>
                                <td>
                                    <input readonly type="text" name="amountx[]" class="form-control amounts"
                                           style="width: 100px">
                                </td>
                                <td>
                                    <input readonly type="text" name="losttimex[]" class="form-control losttimes"
                                           style="width: 100px">
                                </td>
                                <td>
                                    <input readonly type="text" name="minusx[]" class="form-control minuses"
                                           style="width: 100px">
                                </td>
                                <td>
                                    <input readonly type="text" name="perpcsx[]" class="form-control perpcses"
                                           style="width: 100px">
                                </td>
                                <td>
                                    <input readonly type="text" name="ratex[]" class="form-control rates"
                                           style="width: 100px">
                                </td>
                                <td>
                                    <button type="button" class="btn btn-danger" onclick="removegroupline($(this))"><i
                                                class="fa fa-minus"></i></button>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="col-md-12">
        <br>
        <div class="pull-left">
            <button id="btnsave" class="btn btn-success">บันทึกข้อมูล</button>
        </div>
        <div class="pull-right">
            <?= Html::a('<i class="fa fa-home"></i>', ['index'], ['class' => 'btn btn-info']) ?>
            <?= Html::a('<i class="fa fa-undo"></i>', Yii::$app->request->referrer, ['class' => 'btn btn-danger']) ?>
        </div>
    </div>
<?php
/* @var $this yii\web\View */
$Scriptjs = <<<JS
$("#btnsave").click(function(e) {
    $("#bc-form").submit();
});

var empid = $("#bempid");
var date = $("#bdate");
var grouptire = $("#bgrouptire");
var amount = $("#bamount");
var losttime = $("#blosttime");
var minus = $("#bminus");
var perpcs = $("#bperpcs");
var rate = $("#brate");
var cntline = 0;

$("#count").text(cntline);
$("#bc-form").each(function() {
    var fBody = $(this).find(".listemp");
    var fLast = fBody.find("tr:last");
    var fLaststr = fLast.closest("tr");
    var fNew;
    /* Form bicycle\_form.php */
    $(".adddata").click(function() {
        var tirename = $("#btirename option:selected");
        if (empid.val() !== "" && tirename.text() !== "เลือกรายการยาง" && amount.val() !== "0") {
            if (fLaststr.find(".empids").val() === "") {
                fLaststr.find(".empids").val(empid.val());
                fLaststr.find(".dates").val(date.val());
                fLaststr.find(".tirenames").val(tirename.text());
                fLaststr.find(".grouptires").val(grouptire.val());
                fLaststr.find(".amounts").val(amount.val());
                fLaststr.find(".losttimes").val(losttime.val());
                fLaststr.find(".minuses").val(minus.val());
                fLaststr.find(".perpcses").val(perpcs.val());
                fLaststr.find(".rates").val(rate.val());
                cntline++;
                setGroupLine(cntline);
            } else if (checkGroupValue(empid.val(),date.val()) === 1) {
                fLast = fBody.find("tr:last");
                fNew = fLast.clone();
                fLast.after(fNew);
                fLast = fBody.find("tr:last");
                fLaststr = fLast.closest("tr");
                fNew.find("input:text").each(function() {
                   $(this).val("");
                });
                fLaststr.find(".empids").val(empid.val());
                fLaststr.find(".dates").val(date.val());
                fLaststr.find(".tirenames").val(tirename.text());
                fLaststr.find(".grouptires").val(grouptire.val());
                fLaststr.find(".amounts").val(amount.val());
                fLaststr.find(".losttimes").val(losttime.val());
                fLaststr.find(".minuses").val(minus.val());
                fLaststr.find(".perpcses").val(perpcs.val());
                fLaststr.find(".rates").val(rate.val());
                cntline++;
                setGroupLine(cntline);
            } 
        } 
    });
});

function setGroupLine(val) {
    document.getElementById("count").innerText = val;
}
    
function checkGroupValue(empid, date) {
    var emplist = document.getElementsByName("empidx[]");
    var datelist = document.getElementsByName("datex[]");
    for (var i = 0; i < emplist.length; i++) {
        if (empid === emplist[i].value && date === datelist[i].value) {
            return 0;
        }
    } 
    return 1;
}

function removegroupline(e) {
    var fBody = $("#bc-form").find(".listemp");
    var fLast = fBody.find("tr:last");
    var fLaststr = fLast.closest("tr");
    if ($("table.listemp >tbody >tr").length > 1) {
        e.parent().parent().remove();
        cntline--;
        setGroupLine(cntline);
    } else {
        if (fLaststr.find(".empids").val() !== "") { 
            fLaststr.find(".empids").val("");
            fLaststr.find(".dates").val("");
            fLaststr.find(".tirenames").val("");
            fLaststr.find(".grouptires").val("");
            fLaststr.find(".amounts").val("");
            fLaststr.find(".losttimes").val("");
            fLaststr.find(".minuses").val("");
            fLaststr.find(".perpcses").val("");
            fLaststr.find(".rates").val("");
            cntline--;
            setGroupLine(cntline);
        }
    }
}
JS;
$this->registerJs($Scriptjs, static::POS_END);
?>