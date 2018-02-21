function checkDel(e) {
    if (confirm("ต้องการลบข้อมูล ?")) {
        var rl = $(".role").val();
        if (rl !== '1') {
            var st = e.closest('tr').attr('id');
            if (st !== '0') {
                alert('ไม่สามารถลบข้อมูลได้เนื่องจากไม่มีสิทธิ์');
            } else {
                del(e);
            }
        } else {
            del(e);
        }
    }
}

function del(e) {
    var link = e.parent().attr('data-url');
    $.ajax({
        type: 'post',
        url: link,
        async: false,
        cache: false
    })
}

$("#binfo").on("click", function (e) {
    e.preventDefault();
    var dataar = $("input[type=checkbox]:checked").map(function () {
        return $(this).val();
    }).get();

    var rl = $(".role").val();
    if (confirm("ต้องการยืนยันข้อมูล ?")) {
        if (rl !== '1') {
            alert('ไม่สามารถยืนยันได้เนื่องจากไม่มีสิทธิ์');
        } else {
            $.ajax({
                type: 'post',
                url: '?r=pibimccalculator/setapproved',
                data: {data: dataar},
                dataType: 'json',
                success: function (data) {
                    if (data === 0) {
                        alert('บันทึกถูกยกเลิก');
                    } else {
                        alert('บันทึกเรียบร้อยแล้ว');
                        location = '?r=pibimccalculator'
                    }
                }
            })
        }
    }
});