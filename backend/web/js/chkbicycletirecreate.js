$("#bicycletire-submit").on('click', function (e) {
    // e.preventDefault();
    // if ($("#bttireamount1").val() === '0' || $("#bttireamount1").val() === '') {
    //     alert("ยอดยางห้ามต่ำกว่า 1");
    //     $("#bttireamount1").focus();
    // } else {
    //     $.when(getcount()).done(function (data) {
    //         if (data > 0) {
    //             alert("วันที่ " + $("#btdate").val() + " รหัสพนักงาน " + $("#btempid").val() + " มีข้อมูลแล้ว ...");
    //             return;
    //         } else {
    //             $("#bicycletire-form").submit();
    //         }
    //     });
    // }
});

function getcount() {
    var c = 0;
    var empid = $("#btempid").val();
    var date = $("#btdate").val();
    $.ajax({
        type: 'post',
        url: 'index.php?r=bicycletireinfo/getcount',
        async: false,
        data: {empid: empid, date: date},
        cache: false,
        success: function (data) {
            c = data;
        }
    });
    return c;
}

var cntline = 0;
var empid = $("#btempid");
var date = $("#btdate");
var standard = $("#btstandard");
var tireamount1 = $("#bttireamount1");
var losttime = $("#btlosttime");
var totaltire = $("#bttotaltire");
var tireperpcs = $("#bttireperpcs");
var tirerate1 = $("#bttirerate1");
var tireamount2 = $("#bttireamount2");
var tirerate2 = $("#bttirerate2");
var stickeramount = $("#btstickeramount");
var stickerperpcs = $("#btstickerperpcs");
var stickerrate = $("#btstickerrate");
var deduct = $("#btdeduct");
var totalratex = $("#bttotalrate");
$("#count").text(cntline);

$(".bicycletire-info-form").each(function () {
    var fBody = $(this).find(".listemp");
    var fLast = fBody.find("tr:last");
    var fLaststr = fLast.closest("tr");
    var fNew;

    $(".adddata", $(this)).click(function () {
        var hour = $("#bthour option:selected");
        var stickername = $("#btstickername option:selected");
        // alert(hour.text());
        // alert(stickername.text());
        if (empid.val() !== "") {
            if (fLaststr.find(".empids").val() === "") {
                fLaststr.find(".empids").val(empid.val());
                fLaststr.find(".dates").val(date.val());
                fLaststr.find(".hours").val(hour.text());
                fLaststr.find(".standards").val(standard.val());
                fLaststr.find(".tireamount1s").val(tireamount1.val());
                fLaststr.find(".losttimes").val(losttime.val());
                fLaststr.find(".totaltires").val(totaltire.val());
                fLaststr.find(".tireperpcss").val(tireperpcs.val());
                fLaststr.find(".tirerate1s").val(tirerate1.val());
                fLaststr.find(".tireamount2s").val(tireamount2.val());
                fLaststr.find(".tirerate2s").val(tirerate2.val());
                fLaststr.find(".stickernames").val(stickername.text());
                fLaststr.find(".stickeramounts").val(stickeramount.val());
                fLaststr.find(".stickerperpcss").val(stickerperpcs.val());
                fLaststr.find(".stickerrates").val(stickerrate.val());
                fLaststr.find(".deducts").val(deduct.val());
                fLaststr.find(".totalrates").val(totalratex.val());
                cntline++;
                setGroupLine(cntline);
            } else if (checkGroupValue(empid.val(),date.val(),standard.val()) === 1) {
                fLast = fBody.find("tr:last");
                fNew = fLast.clone();
                fLast.after(fNew);
                fLast = fBody.find("tr:last");
                fLaststr = fLast.closest("tr");
                fNew.find("input:text").each(function () {
                    $(this).val("");
                });
                fLaststr.find(".empids").val(empid.val());
                fLaststr.find(".dates").val(date.val());
                fLaststr.find(".hours").val(hour.text());
                fLaststr.find(".standards").val(standard.val());
                fLaststr.find(".tireamount1s").val(tireamount1.val());
                fLaststr.find(".losttimes").val(losttime.val());
                fLaststr.find(".totaltires").val(totaltire.val());
                fLaststr.find(".tireperpcss").val(tireperpcs.val());
                fLaststr.find(".tirerate1s").val(tirerate1.val());
                fLaststr.find(".tireamount2s").val(tireamount2.val());
                fLaststr.find(".tirerate2s").val(tirerate2.val());
                fLaststr.find(".stickernames").val(stickername.text());
                fLaststr.find(".stickeramounts").val(stickeramount.val());
                fLaststr.find(".stickerperpcss").val(stickerperpcs.val());
                fLaststr.find(".stickerrates").val(stickerrate.val());
                fLaststr.find(".deducts").val(deduct.val());
                fLaststr.find(".totalrates").val(totalratex.val());
                cntline++;
                setGroupLine(cntline);
            }
        }
    });
});

function removegroupline(e) {
    var fBody = $(".bicycletire-info-form").find(".listemp");
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
            fLaststr.find(".hours").val("");
            fLaststr.find(".standards").val("");
            fLaststr.find(".tireamount1s").val("");
            fLaststr.find(".losttimes").val("");
            fLaststr.find(".totaltires").val("");
            fLaststr.find(".tireperpcss").val("");
            fLaststr.find(".tirerate1s").val("");
            fLaststr.find(".tireamount2s").val("");
            fLaststr.find(".tirerate2s").val("");
            fLaststr.find(".stickernames").val("");
            fLaststr.find(".stickeramounts").val("");
            fLaststr.find(".stickerperpcss").val("");
            fLaststr.find(".stickerrates").val("");
            fLaststr.find(".deducts").val("");
            fLaststr.find(".totalrates").val("");
            cntline--;
            setGroupLine(cntline);
        }
    }
}

function setGroupLine(val) {
    document.getElementById("count").innerHTML = val;
}

function checkGroupValue(empid, date, standard) {
    var emplist = document.getElementsByName("empidx[]");
    var datelist = document.getElementsByName("datex[]");
    var standardlist = document.getElementsByName("standardx[]");
    for (var i = 0; i < emplist.length; i++) {
        if (empid === emplist[i].value && date === datelist[i].value) {
            if (standard === standardlist[i].value) {
                return 0;
            }
        }
    }
    return 1;
}

$("#btnshowtable").click(function () {
    $("#bctire-form").submit();
});