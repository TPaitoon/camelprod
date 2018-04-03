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
