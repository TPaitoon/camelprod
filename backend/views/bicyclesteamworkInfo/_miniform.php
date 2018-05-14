<?php
/**
 * Created by PhpStorm.
 * User: paitoon.j
 * Date: 07/05/2018
 * Time: 13:52
 */
?>
    <h4>จำนวณ : <label id="count" style="color: #00a65a">#</label> แถว</h4>
    <div class="col-lg-12">
        <div class="row">
            <form action="index.php?r=bicyclesteamworkinfo/createmanual" id="bcsteamwork-form" method="post">
                <div style="overflow-x: scroll">
                    <table class="table table-bordered listemp">
                        <thead>
                        <tr>
                            <th>รหัสพนักงาน</th>
                            <th>วันที่</th>
                            <th>ตำแหน่ง</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td><input readonly type="text" name="empidx[]" class="form-control empids"></td>
                            <td><input readonly type="text" name="datex[]" class="form-control dates"></td>
                            <td><input readonly type="text" name="sectionx[]" class="form-control sections"></td>
                            <td class="text-center">
                                <button type="button" class="btn btn-danger" onclick="removegroupline($(this))"><i class="fa fa-minus"></i></button>
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
        <button id="btnsave" class="btn btn-success">บันทึกข้อมูล</button>
    </div>
    <div class="pull-right">
        <?= \yii\helpers\Html::a('<i class="fa fa-home"></i>', ['index'], ['class' => 'btn btn-info']) ?>
        <?= \yii\helpers\Html::a('<i class="fa fa-undo"></i>', Yii::$app->request->referrer, ['class' => 'btn btn-danger']) ?>
    </div>
<?php
/* @var $this yii\web\View */
$ScriptJS = <<<JS
$("#btnsave").click(function(e) {
    $("#bcsteamwork-form").submit();
})

var empid = $("#bsempid");
var date = $("#bsdate");
var cntline = 0;
setGroupLine(cntline);

$("#bcsteamwork-form").each(function() {
    var fBody = $(this).find(".listemp");
    var fLast = fBody.find("tr:last");
    var fTr = fLast.closest("tr");
    var fNew;
    
    /* Form bicyclesteamworkinfo/_form.php */
    $(".adddata").click(function() {
        var rank = $("#bsrank option:selected");
        // alert(rank.text());
        if (empid.val() !== "" && rank.text() !== "เลือกตำแหน่งงาน") {
            if (fTr.find(".empids").val() === "") {
                fTr.find(".empids").val(empid.val());
                fTr.find(".dates").val(date.val());
                fTr.find(".sections").val(rank.text());
                cntline++;
                setGroupLine(cntline);
            } else if (checkGroupValue(empid.val(),date.val()) === 1) {
                fLast = fBody.find("tr:last");
                fNew = fLast.clone();
                fLast.after(fNew);
                fLast = fBody.find("tr:last");
                fTr = fLast.closest("tr");
                fTr.find("input:text").each(function() {
                    $(this).val("");
                });
                fTr.find(".empids").val(empid.val());
                fTr.find(".dates").val(date.val());
                fTr.find(".sections").val(rank.text());
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
        if (empid === emplist[i].value && date === datelist[i].value)
        return 0;
    } 
    return 1;
}

function removegroupline(e) {
    var fBody = $("#bcsteamwork-form").find(".listemp");
    var fLast = fBody.find("tr:last");
    var fTr = fLast.closest("tr");
    if ($("table.listemp >tbody >tr").length > 1) {
        e.parent().parent().remove();
        cntline--;
        setGroupLine(cntline);
    } else if (fTr.find(".empids").val() !== "") {
        fTr.find(".empids").val("");
        fTr.find(".dates").val("");
        fTr.find(".sections").val("");
        cntline--;
        setGroupLine(cntline);
    }
}
JS;
$this->registerJs($ScriptJS, static::POS_END);
?>