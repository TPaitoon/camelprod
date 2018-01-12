function calculator() {
    if ($(".cline").val() < 1) {
        //alert('เลือกพนักงานก่อน ...');
        return;
    } else if ($("#amount").val() < 1) {
        //alert('ใส่จำนวนยอดยาง (ก่อนนึ่ง) ที่ผลิตได้ก่อน ...');
        return;
    } else if ($("#totaltire").val() < 1) {
        //alert('ใส่จำนวนยอดยาง (หลังนึ่ง) ที่ผลิตได้ก่อน ...');
        return;
    } else if (parseInt($("#amount").val()) < parseInt($("#totaltire").val())) {
        alert('ยอดยาง (หลังนึ่ง) ต้องไม่เยอะกว่า ยอดยาง (ก่อนนึ่ง)');
        $("#totaltire").val($("#amount").val());
    }
    $.when(getRate($("#hour").val(), $("#std").val(), $("#totaltire").val())).done(function (data) {
        //alert(data);
        $("#xrate").val(data);
        var cal = (parseInt(data) - parseInt($("#deduct").val())) / $(".cline").val();
        $("#rate").val(Math.ceil(cal));
    })
}

function getRate(hour, std, amount) {
    var x = 0;
    $.ajax({
        type: 'post',
        url: 'index.php?r=pibicalculator/getrate',
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

function chkstatus() {
    var status = true;
    if ($("#hour").val() === '') {
        status = false;
    } else if ($("#std").val() === '') {
        status = false;
    } else if ($("#amount").val() === '0' || $("#amount").val() === '') {
        status = false;
    } else if ($("#totaltire").val() === '0' || $("#totaltire").val() === '') {
        status = false;
    }  else if ($(".cline").val() < 1) {
        status = false;
    }
    return status;
}

$("#hour").on('change', function () {
    calculator();
});

$("#std").on('change', function () {
    calculator();
});

$("#amount").on('change', function () {
    calculator();
});

$("#totaltire").on('change', function () {
    calculator();
});

$("#deduct").on('change', function () {
    calculator();
});

$("#check").on('click', function () {
    //alert($("#amount").val());
    // $.when(getRate($("#hour").val(),$("#std").val(),$("#totaltire").val())).done(function (data) {
    //     //alert(data);
    //     $("#xrate").val(data);
    //     var cal = (parseInt(data) - parseInt($("#deduct").val())) / $(".cline").val();
    //     $("#rate").val(Math.round(cal));
    // })
    // alert(555555555555);
    calculator();
});

$("#pibisubmit").on('click', function (e) {
    e.preventDefault();
    if (chkstatus() === true) {
        $("#pibisubmit").submit();
    } else {
        alert('กรอกข้อมูลไม่ครบ ...');
    }
});