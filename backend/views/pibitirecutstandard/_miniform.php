<?php

/**
 * Created by PhpStorm.
 * User: paitoon.j
 * Date: 07/09/2018
 * Time: 10:25
 */

/* @var $this \yii\web\View */
?>
    <div class="col-lg-12">
        <div class="row">
            <div class="col-md-6">
                <div class="row">
                    <form action="index.php?r=pibitirecutstandard/createmasterlist" method="post"
                          id="pibitirecutstandard-form">
                        <table class="table table-bordered masterlist">
                            <thead>
                            <tr>
                                <td>Name</td>
                                <td>Rate</td>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td><input type="text" name="namex[]" class="form-control names"></td>
                                <td><input type="text" name="ratex[]" class="form-control rates"></td>
                                <td class="text-center">
                                    <button type="button" class="btn btn-danger btn-lg fa fa-minus "
                                            onclick="removeline($(this))"></button>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </form>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <button id="btnsave" class="btn btn-success">บันทึกข้อมูล</button>
                </div>
            </div>
        </div>
    </div>
<?php
$JS = <<<JS
$("#btnsave").click(function() {
    $("#pibitirecutstandard-form").submit();      
});

var names = $("#namex");
var rates = $("#ratex");

$("#pibitirecutstandard-form").each(function() {
    // alert();
    var Fbody = $(this).find(".masterlist");
    var Flast = Fbody.find("tr:last");
    var Ftr = Flast.closest("tr");
    var Fnew;
    
    $(".adddata").click(function() {
        if (names.val() !== "" && rates.val() !== "") {
            if (Ftr.find(".names").val() === "") {
                Ftr.find(".names").val(names.val());
                Ftr.find(".rates").val(rates.val());
            } else if (CheckDuplicate(names.val()) == 1) {
                Flast = Fbody.find("tr:last");
                Fnew = Flast.clone();
                Flast.after(Fnew);
                Flast = Fbody.find("tr:last");
                Ftr = Flast.closest("tr");
                Fnew.find("id input:text").each(function() {
                    $(this).val();
                });
                Ftr.find(".names").val(names.val());
                Ftr.find(".rates").val(rates.val());
                
            }  
        } 
    });
    
    function CheckDuplicate(val) {
        var list = document.getElementsByName("namex[]");
        for (var i = 0; i < list.length; i++) {
            if (list[i].value === val)
                return 0;
        } 
        return 1;
    }
});

function removeline(e) {
    var Fbody = $("#pibitirecutstandard-form").find(".masterlist");
    var Flast = Fbody.find("tr:last");
    var Ftr = Flast.closest("tr");
    if ($("table.masterlist >tbody >tr").length > 1) {
        e.parent().parent().remove();
    } else if (Ftr.find(".names").val() !== "") {
        Ftr.find(".names").val("");
        Ftr.find(".rates").val("");
    }
}
JS;
$this->registerJs($JS, static::POS_END);
?>