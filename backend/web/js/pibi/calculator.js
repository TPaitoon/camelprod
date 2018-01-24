function calculator() {
    if (parseInt(document.getElementById("cline").innerHTML) > 0) {
        var amount = $("#amount");
        var xrate = $("#xrate");
        if (!parseInt(amount.val()) < 1) {
            var hour = parseInt($("#hour").val());
            var std = parseInt($("#std").val());
            var _amount = parseInt(amount.val());
            $.when(getRate(hour, std, _amount)).done(function (data) {
                xrate.val(data);
                var cal = (parseInt(xrate.val()) - parseInt($("#deduct").val()))
                    / parseInt(document.getElementById("cline").innerHTML);
                $("#rate").val(Math.ceil(cal));
            })
        }
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
    } else if ($("#amount").val() === '0' || $("#amount").val() === '') {
        status = false;
    } else if (parseInt(document.getElementById("cline").innerHTML) < 1) {
        status = false;
    }
    return status;
}

function calDeduct() {
    var deduct1 = parseFloat($("#listprice1").val());
    var deduct2 = parseFloat($("#listprice2").val());
    var deduct3 = parseFloat($("#listprice3").val());
    var cal = deduct1 + deduct2 + deduct3;
    $("#deduct").val(cal);
}

$("#hour").on('change', function () {
    calculator();
});

$("#std").on('change', function () {
    calculator();
});

var amount = $("#amount");
amount.on('change', function () {
    calculator();
});
amount.on('click', function () {
    if ($(this).val() === '0') {
        $(this).val('');
    } else {
        $(this).select();
    }
});
amount.on('focusout', function () {
    if ($(this).val() === '') {
        $(this).val(0);
    }
});

var losttire1 = $("#losttire1");
losttire1.on('change', function () {
    if ($(this).val() === '') {
        $(this).val(0);
    }
    var losttire = parseInt($(this).val());
    var deduct = parseFloat($("#dummy1").val());
    var cal = losttire * deduct;
    $("#listprice1").val(cal.toFixed(2));
    calDeduct();
    calculator();
});
losttire1.on('click', function () {
    if ($(this).val() === '0') {
        $(this).val('');
    } else {
        $(this).select();
    }
});
losttire1.on('focusout', function () {
    if ($(this).val() === '') {
        $(this).val(0);
    }
});

var losttire2 = $("#losttire2");
losttire2.on('change', function () {
    if ($(this).val() === '') {
        $(this).val(0);
    }
    var losttire = parseInt($(this).val());
    var deduct = parseFloat($("#dummy2").val());
    var cal = losttire * deduct;
    $("#listprice2").val(cal);
    calDeduct();
    calculator();
});
losttire2.on('click', function () {
    if ($(this).val() === '0') {
        $(this).val('');
    } else {
        $(this).select();
    }
});
losttire2.on('focusout', function () {
    if ($(this).val() === '') {
        $(this).val(0);
    }
});

var losttube = $("#losttube");
losttube.on('change', function () {
    if ($(this).val() === '') {
        $(this).val(0);
    }
    var losttube = parseInt($(this).val());
    var deduct = parseFloat($("#dummy3").val());
    var cal = losttube * deduct;
    $("#listprice3").val(cal);
    calDeduct();
    calculator();
});
losttube.on('click', function () {
    if ($(this).val() === '0') {
        $(this).val('');
    } else {
        $(this).select();
    }
});
losttube.on('focusout', function () {
    if ($(this).val() === '') {
        $(this).val(0);
    }
});

// $("#checkinfo").on('click', function (e) {
//     e.preventDefault();
//     if (chkStatus() === true) {
//         alert('OK !');
//     } else {
//         alert('False !');
//     }
// });

$("#pibisubmit").on('click', function (e) {
    e.preventDefault();
    if (chkStatus() === true) {
        $(this).submit();
    } else {
        return alert('กรอกข้อมูลไม่ครบ ...');
    }
});