/**
 * Created by Paitoon on 2560/07/31.
 */

$(document).ready(function () {
    $("#bicyclesteamwork-submit").click(function (e) {
        e.preventDefault();
        $.when(getcount()).done(function (data) {
            if (data > 0) {
                alert("วันที่ " + $("#bsdate").val() + " รหัสพนักงาน " + $("#bsempid").val() + " มีข้อมูลแล้ว ...");
                return;
            } else {
                $("#bicyclesteamwork-form").submit();
            }
        })
    });
});

function getcount() {
    var c = 0;
    var empid = $("#bsempid").val();
    var date = $("#bsdate").val();

    $.ajax({
        type: 'post',
        url: 'index.php?r=bicyclesteamworkinfo/getcount',
        async: false,
        data: {
            empid: empid,
            date: date
        },
        cache: false,
        success: function (data) {
            c = data;
        }
    });

    return c;
}
