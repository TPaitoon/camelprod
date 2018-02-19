function calculator() {
    var xrate = $("#xrate");
    var  rate = $("#rate");
    setAmount(getValue());
    var cline = parseInt(document.getElementById("cline").innerHTML);
    var aline = parseInt(document.getElementById("aline").innerHTML);
    if (cline > 0 && aline > 0) {
        if (parseInt(xrate.val()) > 0) {
            var deduct = $("#deduct");
            var cal = parseInt(xrate.val()) - parseInt(deduct.val());
            var fcal = cal / cline;
            rate.val(Math.round(fcal));
        }
        if (aline >= 25000) {
            var acal = parseInt(rate.val()) + 20;
            rate.val(acal);
        }
    } else {
        rate.val(0);
    }
}

var losttire1 = $("#losttire1");
losttire1.on("change", function () {
    if ($(this).val() === "") {
        $(this).val(0);
    }
    var losttire = parseInt($(this).val());
    var deduct = parseFloat($("#dummy1").val());
    var cal = losttire * deduct;
    $("#listprice1").val(cal.toFixed(2));
    calDeduct();
    calculator();
});
losttire1.on("click", function () {
    if ($(this).val() === "0") {
        $(this).val("");
    } else {
        $(this).select();
    }
});
losttire1.on("focusout", function () {
    if ($(this).val() === "") {
        $(this).val(0);
    }
});

var losttire2 = $("#losttire2");
losttire2.on("change", function () {
    if ($(this).val() === "") {
        $(this).val(0);
    }
    var losttire = parseInt($(this).val());
    var deduct = parseFloat($("#dummy2").val());
    var cal = losttire * deduct;
    $("#listprice2").val(cal);
    calDeduct();
    calculator();
});
losttire2.on("click", function () {
    if ($(this).val() === "0") {
        $(this).val("");
    } else {
        $(this).select();
    }
});
losttire2.on("focusout", function () {
    if ($(this).val() === "") {
        $(this).val(0);
    }
});

var car = $("#car");
car.on("change", function () {
    if (parseInt(car.val()) === 1) {
        $("#listprice3").val(100);
    } else {
        $("#listprice3").val(0);
    }
    calDeduct();
    calculator();
});

function calDeduct() {
    var deduct1 = parseFloat($("#listprice1").val());
    var deduct2 = parseFloat($("#listprice2").val());
    var deduct3 = parseFloat($("#listprice3").val());
    var cal = deduct1 + deduct2 + deduct3;
    $("#deduct").val(cal);
}

function setAmount(value) {
    document.getElementById("aline").innerHTML = value;
}

function setRate(value) {
    $("#xrate").val(value);
}

function getValue() {
    var cal = 0;
    var rate = 0;
    var chkloop = document.getElementsByName("values[]");
    for (var i = 0; i < chkloop.length; i++) {
        if (chkloop[i].value !== "") {
            cal = cal + parseInt(chkloop[i].value);
            if (parseInt(chkloop[i].value) > 5000) {
                rate = rate + 30;
            }
        } else {
            setRate(rate);
            return cal;
        }
    }
    setRate(rate);
    return cal;
}

function chkStatus() {
    var status = true;
    if ($("#shift").val() === '') {
        status = false;
    } else if (parseInt(document.getElementById("aline").innerHTML) < 1) {
        status = false;
    } else if (parseInt(document.getElementById("cline").innerHTML) < 1) {
        status = false;
    }
    return status;
}

$("#pibisubmit").on('click', function (e) {
    e.preventDefault();
    if (confirm("ต้องการบันทึกรายการ ?")) {
        if (chkStatus() === true) {
            var shift = $("#shiftselect").val();
            var date = $("#date").val();
            $.ajax({
                type: 'post',
                url: '?r=pibitubecalculator/getcount',
                data: {shift: shift, date: date},
                success: function (data) {
                    if (parseInt(data) === 0) {
                        $("#pibisubmit").submit();
                    } else if (parseInt(data) >= 1) {
                        if ($(".listid").val() === "") {
                            var txt;
                            if (shift === '1') {
                                txt = 'กลางวัน';
                            } else {
                                txt = 'กลางคืน';
                            }
                            alert("กะ " + txt  + " ของวันที่ " + date + " มีข้อมูลแล้ว ..");
                        } else {
                            $("#pibisubmit").submit();
                        }
                    }
                }
            });
        } else {
            return alert('กรอกข้อมูลไม่ครบ ...');
        }
    }
});