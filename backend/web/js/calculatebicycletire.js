$(document).on('ready', function () {
    loadtire1();
    loadtire2();
    loadsticker();
    loadtotal();
    $("#bttireamount1").on('change', function () {
        calculatetire1();
    });
    $("#btlosttime").on('change', function () {
        calculatetire1();
    });
    $("#btstandard").on('change', function () {
        calculatetire1();
    });
    $("#bthour").on('change', function () {
        calculatetire1();
    });
    $("#bttireamount2").on('change', function () {
        calculatetire2();
    });
    $("#btdeduct").on('change',function () {
        totalrate();
    });
    $("#btstickeramount").on('change', function () {
        var amounttire1 = $("#bttireamount1").val();
        var amounttire2 = $("#bttireamount2").val();
        var stickeramount = $("#btstickeramount").val();
        var cal = parseInt(amounttire1) + parseInt(amounttire2);
        if (Math.round(cal) < parseInt(stickeramount)) {
            alert("ยอดติดสติกเกอร์ห้ามมากกว่ายอดยางที่ผลิต");
            $("#btstickeramount").val(Math.round(cal));
            calculatesticker(Math.round(cal));
        } else {
            calculatesticker(parseInt(stickeramount));
        }
    });
    $("#btstickername").on('change', function () {
        calculatesticker(parseInt($("#btstickeramount").val()));
    })
});

function loadtire1() {
    if ($("#bttireamount1").val() === '') {
        $("#bttireamount1").val(0);
    }
    if ($("#btlosttime").val() === '') {
        $("#btlosttime").val(0);
    }
    if ($("#bttotaltire").val() === '') {
        $("#bttotaltire").val(0);
    }
    if ($("#bttireperpcs").val() === '') {
        $("#bttireperpcs").val(0);
    }
    if ($("#bttirerate1").val() === '') {
        $("#bttirerate1").val(0);
    }
}

function loadtire2() {
    if ($("#bttireamount2").val() === '') {
        $("#bttireamount2").val(0);
    }
    if ($("#bttirerate2").val() === '') {
        $("#bttirerate2").val(0);
    }
}

function loadsticker() {
    if ($("#btstickeramount").val() === '') {
        $("#btstickeramount").val(0);
    }
    if ($("#btstickerperpcs").val() === '') {
        $("#btstickerperpcs").val(0);
    }
    if ($("#btstickerrate").val() === '') {
        $("#btstickerrate").val(0);
    }
}

function loadtotal() {
    if ($("#btdeduct").val() === '') {
        $("#btdeduct").val(0);
    }
    if ($("#bttotalrate").val() === '') {
        $("#bttotalrate").val(0);
    }
}

function gettireamount1(standard, losttime) {
    var c = 0;
    var m = 0;
    var group = 0;
    $.ajax({
        type: 'post',
        url: 'index.php?r=bicycletireinfo/getgroupcm',
        async: false,
        data: {standard: standard},
        cache: false,
        dataType: 'json',
        success: function (data) {
            c = data[0];
            m = data[1];
            group = data[2];
        }
    });
    var cal = (losttime / m) * c;
    return group + ',' + Math.round(cal);
}

function totalrate() {
    var cal = (parseInt($("#bttirerate1").val()) + parseInt($("#bttirerate2").val()) + parseInt($("#btstickerrate").val()) - parseInt($("#btdeduct").val()));
    // alert(cal);
    $("#bttotalrate").val(Math.round(cal));
}

function calculatetire1() {
    var amount = $("#bttireamount1").val();
    $.when(gettireamount1($("#btstandard").val(), $("#btlosttime").val())).done(function (data) {
        if (amount > 0) {
            var decode = data.split(',');
            var cal = parseInt(amount) + parseInt(decode[1]);
            $("#bttotaltire").val(Math.round(cal));
            //alert($("#bthour").val());
            $.ajax({
                type: 'post',
                url: 'index.php?r=bicycletireinfo/getperpcsarate',
                async: false,
                data: {group: decode[0], hour: $("#bthour").val(), value: Math.round(cal), amount: amount},
                cache: false,
                dataType: 'json',
                success: function (data) {
                    $("#bttireperpcs").val(data[0]);
                    $("#bttirerate1").val(data[1]);
                    //alert(data);
                }
            });
        }
        totalrate();
    });
}

function calculatetire2() {
    var amount = $("#bttireamount2").val();
    if (amount > 0) {
        var cal = amount * 0.6;
        $("#bttirerate2").val(Math.round(cal));
    } else {
        $("#bttirerate2").val(0);
    }
    totalrate();
}

function calculatesticker(amount) {
    $.ajax({
        type: 'post',
        url: 'index.php?r=bicycletireinfo/getstickerrate',
        async: false,
        data: {stickerid: $("#btstickername").val()},
        cache: false,
        success: function (data) {
            // alert(amount);
            var cal = parseInt(amount) * data;
            $("#btstickerperpcs").val(data);
            $("#btstickerrate").val(Math.round(cal));
        }
    });
    totalrate();
}

var bttireamount1 = $("#bttireamount1");
var btlosttime = $("#btlosttime");
var bttireamount2 = $("#bttireamount2");
var bstickeramount = $("#btstickeramount");
var btdeduct = $("#btdeduct");

bttireamount1.on("click",function () {
    $(this).select();
});
btlosttime.on("click",function () {
   $(this).select();
});
bttireamount2.on("click",function () {
   $(this).select();
});
bstickeramount.on("click",function () {
   $(this).select();
});
btdeduct.on("click",function () {
   $(this).select();
});