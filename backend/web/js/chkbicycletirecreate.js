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
var hour = $("#bthour option:selected");
var standard = $("#btstandard");
var tireamount1 = $("#bttireamount1");
var losttime = $("#btlosttime");
var totaltire = $("#bttotaltire");
var tireperpcs = $("#bttireperpcs");
var tirerate1 = $("#bttirerate1");
var tireamount2 = $("#bttireamount2");
var tirerate2 = $("#bttirerate2");
var stickername = $("#btstickername option:selected");
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
            }
        }
    });
});