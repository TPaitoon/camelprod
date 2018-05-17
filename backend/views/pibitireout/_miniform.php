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
  var shift = $("#shiftselect option:selected");
  alert(empid.val() + ' | ' + shift.text() + ' | ' + date.val() + ' | ' + rate.val());
});

var empid = $("#empidselect");
var date = $("#date");
var rate = $("#rate");
JS;
$this->registerJs($ScriptJs,static::POS_END);
?>