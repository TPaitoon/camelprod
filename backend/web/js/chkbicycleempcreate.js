/**
 * Created by Paitoon on 19/07/2017.
 */
$(document).ready(function () {
    $('#bicycleemp-submit').click(function (e) {
        e.preventDefault();
        $.when(getcount()).done(function (data) {
            if (data > 0) {
                alert("วันที่ " + $('#edate').val() + " รหัสพนักงาน " + $('#eempid').val() + " มีข้อมูลแล้ว ...");
                return;
            } else {
                $('#bicycleemp-form').submit();
            }
        })
    });
});

function getcount() {
    var c = 0;
    var empid = $('#eempid').val();
    var date = $('#edate').val();

    $.ajax({
        type: 'post',
        url: 'index.php?r=bicycleempinfo/getcount',
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