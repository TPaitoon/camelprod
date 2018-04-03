$("#bicyclesubmit").on('click', function (e) {
    e.preventDefault();
    if ($("#bamount").val() === '0' || $("#bamount").val() === '') {
        alert('ยอดผลิตห้ามต่ำกว่า 1');
        $("bamount").focus();
    } else {
        if (confirm('ยืนยันการทำรายการ ?')) {
            $.when(getcount()).done(function (data) {
                if (data > 0) {
                    alert('วันที่ ' + $("#bdate").val() + ' รหัสพนักงาน ' + $("#bempid").val() + ' มีข้อมูลแล้ว ...');
                    return;
                } else {
                    $("#bicyclesubmit").submit();
                }
            });
        }
    }
});

function getcount() {
    var c = 0;
    var empid = $("#bempid").val();
    var date = $("#bdate").val();
    $.ajax({
        type: 'post',
        url: 'index.php?r=bicycleinfo/getcount',
        async: false,
        data: {empid: empid, date: date},
        cache: false,
        success: function (data) {
            c = data;
        }
    });
    return c;
}