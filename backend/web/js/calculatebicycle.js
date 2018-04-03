$(document).on('ready', function () {
    defaultLoad();
    $("#bamount").on('change', function () {
        calculatebicycle();
    });
    $("#blosttime").on('change', function () {
        calculatebicycle();
    });
    $("#breset").on('click', function () {
        $("#bamount").val('');
        defaultLoad();
    });
});

function defaultLoad() {
    if ($("#btirename").val() == '') {
        $("#bgrouptire").val(0);
    }
    if ($("#bamount").val() == '') {
        $("#bamount").val(0);
        calculatebicycle();
    }
}

function calculatebicycle() {
    if ($("#bamount").val() == '0') {
        $("#blosttime").val(0);
        $("#bminus").val(0);
        $("#bperpcs").val(0);
        $("#brate").val(0);
        return;
    } else if ($("#bgrouptire").val() == '0') {
        alert('เลือกรายการยางก่อน');
        $("#bamount").val(0);
        defaultLoad();
        $("#btirename").focus();
        return;
    } else {
        var totaltire = 0;
        var losttimetire = 0;
        var grouptire = $('#bgrouptire').val();
        if ($("#blosttime").val() != '' && $("#bgrouptire").val() != '') {
            var cal = ($("#bgrouptire").val() / 60) * $("#blosttime").val();
            losttimetire = Math.round(cal);
        }
        if ($("#blosttime").val() == '0') {
            totaltire = $("#bamount").val();
        }
        if ($("#blosttime").val() != '' && $("#bamount").val() != '') {
            totaltire = Math.round(parseInt(losttimetire) + parseInt($("#bamount").val()));
        }
        $("#bminus").val(totaltire);
        if ($("#bminus").val() > '0') {
            $.when(getData(grouptire, totaltire)).done(function () {
                var cal = totaltire * $("#bperpcs").val();
                $("#brate").val(Math.round(cal));
            });
        }
    }
}

function getData(average, value) {
    $.ajax({
        type: 'post',
        url: 'index.php?r=bicycleinfo/getrate',
        async: false,
        data: {average: average, value: value},
        cache: false,
        success: function (data) {
            $('#bperpcs').val(data);
        }
    });
}

var amount = $("#bamount");
var losttime = $("#blosttime");
amount.on("click",function () {
    amount.select();
});
losttime.on("click",function () {
    losttime.select();
});