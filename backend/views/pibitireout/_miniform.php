<?php
/**
 * Created by PhpStorm.
 * User: paitoon.j
 * Date: 14/05/2018
 * Time: 16:03
 */
?>
    <h4>จำนวน : <label id="count" style="color: #00a65a">#</label> แถว</h4>
    <div class="col-lg-12">
        <div class="row">
            <form action="index.php?r=pibitireout/createmanual" id="tireout-form" method="post">
                <div style="overflow-x: scroll">
                    <table class="table table-bordered listemp">
                        <thead>
                        <tr>
                            <th>รหัสพนักงาน</th>
                            <th>ช่วงทำงาน</th>
                            <th>วันที่</th>
                            <th>ค่าพิเศษ</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>
                                <input readonly type="text" name="empidx[]" class="form-control empids">
                            </td>
                            <td>
                                <input readonly type="text" name="shiftx[]" class="form-control shifts">
                            </td>
                            <td>
                                <input readonly type="text" name="datex[]" class="form-control dates">
                            </td>
                            <td>
                                <input readonly type="text" name="ratex[]" class="form-control rates">
                            </td>
                            <td style="text-align: center">
                                <button type="button" class="btn btn-danger" onclick="removegroupline($(this))"><i
                                            class="fa fa-minus"></i></button>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </form>
        </div>
        <br>
    </div>
    <div class="pull-left">
        <button id="btnminisave" class="btn btn-success">บันทึกข้อมูล</button>
    </div>
    <div class="pull-right">
        <?= \yii\helpers\Html::a('<i class="fa fa-home"></i>', ['index'], ['class' => 'btn btn-info']) ?>
        <?= \yii\helpers\Html::a('<i class="fa fa-undo"></i>', Yii::$app->request->referrer, ['class' => 'btn btn-danger']) ?>
    </div>
<?php
/* @var $this yii\web\View */
$ScriptJs = <<<JS
$("#btnminisave").click(function() {
  // $("#tireout-form").submit();
  // var shift = $("#shiftselect option:selected");
  // alert(empid.val() + ' | ' + shift.text() + ' | ' + date.val() + ' | ' + rate.val());
  if (confirm("ยืนยันการทำรายการ")) {
      var emplist = document.getElementsByName("empidx[]");
      if (emplist.length > 0 && emplist[0].value != "") 
          $("#tireout-form").submit();
  } 
});

var empid = $("#empidselect");
var date = $("#date");
var rate = $("#rate");
var cntline = 0;
setGroupLine(cntline);

$("#tireout-form").each(function() {
    var fBody = $(this).find(".listemp");
    var fLast = fBody.find("tr:last");
    var CTR = fLast.closest("tr");
    var fNew;
    
    /* Form pibitireout/_form.php */
    $(".adddata").click(function() {
        var shift = $("#shiftselect option:selected");
        if (empid.val() !== "" && date.val() !== "" && rate.val() !== "" && shift.text() !== "") {
            // alert(checkGroupValue(empid.val(),date.val()));
            if (CTR.find(".empids").val() === "") {
                CTR.find(".empids").val(empid.val());
                CTR.find(".shifts").val(shift.text());
                CTR.find(".dates").val(date.val());
                CTR.find(".rates").val(rate.val());
                cntline++;
                setGroupLine(cntline);
            } else if (checkGroupValue(empid.val(),date.val()) === 1) {
                // alert('');
                fLast = fBody.find("tr:last");
                fNew = fLast.clone();
                fLast.after(fNew);
                fLast = fBody.find("tr:last");
                CTR = fLast.closest("tr");
                CTR.find("input:text").each(function() {
                    $(this).val("");
                });
                CTR.find(".empids").val(empid.val());
                CTR.find(".shifts").val(shift.text());
                CTR.find(".dates").val(date.val());
                CTR.find(".rates").val(rate.val());
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
        // alert("emplist" + emplist[i].value);
        if (empid === emplist[i].value && date === datelist[i].value)
            return 0;
    } 
    return 1;
}
JS;
$this->registerJs($ScriptJs, static::POS_END);
?>