/**
 * Created by Paitoon on 17/07/2017.
 */

$('#bomsubmit').click(function (e) {
    e.preventDefault();
    if ($('#camount').val() === '0' || $('#camount').val() === '') {
        alert('ค่ายอดนึ่งห้ามต่ำกว่า 1');
        $('#camount').focus();
        return;
    } else {
        if (confirm('ยืนยันการทำรายการ ?')) {
            $.when(getcount()).done(function (data) {
                if (data > 0) {
                    alert("วันที่ " + $('#cdate').val() + " รหัสพนักงาน " + $('#cempid').val() + " เตาที่ " + $('#cstoveid').val() + " มีข้อมูลแล้ว ...");
                    return;
                } else {
                    $('#bomform').submit();
                }
            });
        }
    }
});

var cntline = 0;
var empid = $("#cempid");
var date = $("#cdate");
var stove = $("#cstoveid");
var standard = $("#cstandard");
var hour = $("#chour");
var amount = $("#camount");
var losttime = $("#closttime");
var deduct = $("#cdeduct");
var totaltire = $("#ctotaltire");
var perpcs = $("#cperpcs");
var rate = $("#crate");
$("#count").text(cntline);

$(".bominfo-form").each(function () {
    var fBody = $(".bominfo-form").find(".listemp");
    var fLast = fBody.find("tr:last");
    var fLaststr = fLast.closest("tr");
    var fNew;

    $(".adddata", $(this)).click(function () {
        if (empid.val() !== "") {
            // alert(fLaster.find(".empids").val());
            if (fLaststr.find(".empids").val() === "") {
                fLaststr.find(".empids").val(empid.val());
                fLaststr.find(".dates").val(date.val());
                fLaststr.find(".hours").val(hour.val());
                fLaststr.find(".standards").val(standard.val());
                fLaststr.find(".stoveids").val(stove.val());
                fLaststr.find(".amounts").val(amount.val());
                fLaststr.find(".losttimes").val(losttime.val());
                fLaststr.find(".deducts").val(deduct.val());
                fLaststr.find(".totaltires").val(totaltire.val());
                fLaststr.find(".perpcss").val(perpcs.val());
                fLaststr.find(".rates").val(rate.val());
                cntline++;
                setGroupLine(cntline);
            } else if (checkGroupValue(empid.val(),date.val(),stove.val()) === 1) {

            }
        }
    });
});

function removegroupline(e) {
    var fBody = $(".bominfo-form").find(".listemp");
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
            fLaststr.find(".stoveids").val("");
            fLaststr.find(".amounts").val("");
            fLaststr.find(".losttimes").val("");
            fLaststr.find(".deducts").val("");
            fLaststr.find(".totaltires").val("");
            fLaststr.find(".perpcss").val("");
            fLaststr.find(".rates").val("");
            cntline--;
            setGroupLine(cntline);
        }
    }
}

function checkGroupValue(empid, date, stoveid) {
    var emplist = document.getElementsByName("empidx[]");
    var datelist = document.getElementsByName("datex[]");
    var stovelist = document.getElementsByName("stoveidx[]");
    for (var i = 0; i < emplist.length; i++) {
        if (empid === emplist[i].value && date === datelist[i].value) {
            if (stoveid === stovelist[i].value) {
                return 0;
            }
        }
    }
    return 1;
}

function setGroupLine(val) {
    document.getElementById("count").innerHTML = val;
}

function getcount() {
    var c = 0;
    var empid = $('#cempid').val();
    var date = $('#cdate').val();
    var stoveid = $('#cstoveid').val();

    $.ajax({
        type: 'post',
        url: 'index.php?r=bominfo/getcount',
        async: false,
        data: {
            empid: empid,
            date: date,
            stoveid: stoveid
        },
        cache: false,
        success: function (data) {
            c = data;
        }
    });

    return c;
}