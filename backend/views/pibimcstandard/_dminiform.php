<?php

/**
 * Created by PhpStorm.
 * User: paitoon.j
 * Date: 16/08/2018
 * Time: 16:11
 */

/* @var $this \yii\web\View */
?>
    <div class="row">
        <div class="col-lg-12">
            <form action="?r=pibimcstandard/createdetail" id="dlist" method="post">
                <table class="table table-bordered dlistt">
                    <thead>
                    <tr>
                        <td>Refid</td>
                        <td>Standard</td>
                        <td>Hour</td>
                        <td>Amount</td>
                        <td>Rate</td>
                        <td class="text-center">#</td>
                    </tr>
                    </thead>
                    <tr>
                        <td><input type="text" readonly name="stdx[]" class="form-control stds"></td>
                        <td><input type="text" readonly name="stdxx[]" class="form-control stdxs"></td>
                        <td><input type="text" readonly name="hourx[]" class="form-control hours"></td>
                        <td><input type="text" name="amountx[]" class="form-control amounts"></td>
                        <td><input type="text" name="ratex[]" class="form-control rates"></td>
                        <td class="text-center">
                            <button type="button" class="btn btn-danger btn-lg fa fa-minus" onclick="removeline($(this))"></button>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
        <br>
        <div class="col-lg-12">
            <div class="pull-left">
                <button id="btnsave" class="btn btn-success">บันทึกข้อมูล</button>
            </div>
            <div class="pull-right">
                <?= \yii\helpers\Html::a("<i class='fa fa-home'></i>", ["index"], ["class" => "btn btn-info"]) ?>
                <?= \yii\helpers\Html::a('<i class="fa fa-undo"></i>', Yii::$app->request->referrer, ['class' => 'btn btn-danger']) ?>
            </div>
        </div>
    </div>
<?php
$Script = <<<JS
$("#btnsave").click(function() {
    $("#dlist").submit();  
});    

var std = $("#drefid");
var hour = $("#dhour");
var amount = $("#damount");
var rate = $("#drate"); 

$("#dlist").each(function() {
    var fBody = $(this).find(".dlistt");
    var fLast = fBody.find("tr:last");
    var fTr = fLast.closest("tr");
    var fNew;
    $(".addlist").click(function() {
          if (std.val() !== "" && hour.val() !== "" && amount.val() !== "" && rate.val() !== "") {
              if (fTr.find(".stds").val() === "") {
                  fTr.find(".stds").val(std.val());
                  fTr.find(".stdxs").val(std.select2('data')[0].text);
                  fTr.find(".hours").val(hour.val());
                  fTr.find(".amounts").val(amount.val());
                  fTr.find(".rates").val(rate.val());
              } else if (CheckDuplicate(std.val(),hour.val()) == 1) {
                  fLast = fBody.find("tr:last");
                  fNew = fLast.clone();
                  fLast.after(fNew);
                  fLast = fBody.find("tr:last");
                  fTr = fLast.closest("tr");
                  fNew.find("id input:text").each(function() {
                      $(this).val();
                  });
                  fTr.find(".stds").val(std.val());
                  fTr.find(".stdxs").val(std.select2('data')[0].text);
                  fTr.find(".hours").val(hour.val());
                  fTr.find(".amounts").val(amount.val());
                  fTr.find(".rates").val(rate.val());
              } 
          } 
    });
});

function CheckDuplicate(std,hour) {
    var slist = document.getElementsByName("stdx[]");
    var hlist = document.getElementsByName("hourx[]");
    for (var i = 0; i < slist.length; i++) {
        if (slist[i].value === std && hlist[i].value === hour)
            return 0;
    } 
    return 1;
}

function removeline(e) {
    var fBody = $("#dlist").find(".dlistt");
    var fLast = fBody.find("tr:last");
    var fTr = fLast.closest("tr");
    if ($("table.dlistt >tbody >tr").length > 1)
        e.parent().parent().remove();
    else if (fTr.find(".stds").val() !== "") {
        fTr.find(".stds").val("");
        fTr.find(".stdxs").val("");
        fTr.find(".hours").val("");
        fTr.find(".amounts").val("");
        fTr.find(".rates").val("");
    } 
}
JS;
/* @var $this yii\web\View */
$this->registerJs($Script, static::POS_END);
?>