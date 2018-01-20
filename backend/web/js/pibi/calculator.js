function calculator() {
    if (parseInt($("#cline").val()) < 1) {
        return alert("เลือกพนักงานก่อน ...");
    } else if (parseInt($("#amount").val()) < 1) {
        return alert("ยอดผลิตต้องไม่ต่ำกว่า 1");
    } else {
        var hour = parseInt($("#hour").val());
        var std = parseInt($("#std").val());
        var amount = parseInt($("#amount").val());
        $.when(getRate(hour, std, amount)).done(function (data) {
            $("#xrate").val(data);
            var cal = (parseInt($("#xrate").val()) - parseInt($("#deduct").val()))
                / $("#cline").val();
            $("#rate").val(Math.ceil(cal));
        })
    }
}

function getRate(hour, std, amount) {
    var x = 0;
    $.ajax({
        type: 'post',
        url: '?r=pibicalculator/getrate',
        async: false,
        data: {hour: hour, std: std, amount: amount},
        dataType: 'json',
        cache: false,
        success: function (data) {
            x = data;
        }
    });
    return x;
}

function chkStatus() {
    var status = true;
    if ($("#hour").val() === '') {
        status = false;
    } else if ($("#std").val() === '') {
        status = false;
    } else if ($("#amount").val() === 0 || $("#amount").val() === '') {
        status = false;
    } else if ($("#cline").val() < 1) {
        status = false;
    }
    return status;
}