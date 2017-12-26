$("#bicycletire-submit").on('click', function (e) {
    e.preventDefault();
    if ($("#bttireamount1").val() === '0' || $("#bttireamount1").val() === '') {
        alert("ยอดยางห้ามต่ำกว่า 1");
        $("#bttireamount1").focus();
    } else {
        $.when(getcount()).done(function (data) {
            if (data > 0) {
                alert("วันที่ " + $("#btdate").val() + " รหัสพนักงาน " + $("#btempid").val() + " มีข้อมูลแล้ว ...");
                return;
            } else {
                $("#bicycletire-form").submit();
            }
        });
    }
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