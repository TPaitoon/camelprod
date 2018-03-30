/**
 * Created by Paitoon on 13/07/2017.
 */
$(document).on('ready', function () {
    defaultload();
    $("#camount").on('change', function () {
        //alert($(this).val());
        if ($(this).val() !== '0' || $(this).val() !== '') {
            calculatebom();
        }
    });
    $("#closttime").on('change', function () {
        calculatebom();
    });
    $("#cstandard").on('change', function () {
        calculatebom();
    });
    $("#cdeduct").on('change', function () {
        calculatebom();
    });
    $("#creset").on('click', function () {
        $("#camount").val('');
        defaultload();
    });
});

function getWork() {
    var x = 0;
    $.ajax({
        type: 'post',
        url: 'index.php?r=bominfo/getwork',
        async: false,
        data: {standard: $("#cstandard").val()},
        cache: false,
        success: function (data) {
            x = data;
        }
    });
    return x;
}

function getData(standard, value) {
    $.ajax({
        type: 'post',
        url: 'index.php?r=bominfo/getdata',
        async: false,
        data: {standard: standard, value: value},
        cache: false,
        success: function (data) {
            $("#cperpcs").val(data);
        }
    });
}

function defaultload() {
    if ($("#camount").val() === '') {
        $("#camount").val(0);
        calculatebom();
    }
}

function calculatebom() {
    if ($("#camount").val() == '0' || $("#camount").val() == '') {
        $("#ctotaltire").val(0);
        $("#crate").val(0);
        $("#cperpcs").val(0);
        $("#closttime").val(0);
        $("#cdeduct").val(0);
    } else {
        var amount = $("#camount").val();
        var at = 0;
        var losttime = $("#closttime").val();

        $.when(getWork()).done(function (work) {
            at = (parseInt(losttime) / parseInt(work) * 3);
            var totaltire = Math.round(at);
            var total = parseInt(amount) + parseInt(totaltire);
            $("#ctotaltire").val(total);
            getData($("#cstandard").val(), total);
            var rate = parseInt(total) * parseFloat($("#cperpcs").val());
            var totals = Math.round(rate) - parseInt($("#cdeduct").val());
            $("#crate").val(totals);
        });
    }
}

var amount = $("#camount");
var losttime = $("#closttime");
var deduct = $("#cdeduct");

amount.on("click", function () {
    if (amount.val() == "" || amount.val() == 0) {
        $(this).val("");
    } else {
        $(this).select();
    }
}).on("focusout", function () {
    if (amount.val() == '') {
        $(this).val(0);
    }
});

losttime.on("click", function () {
    if ($(this).val() == '' || $(this).val() == 0) {
        $(this).val('');
    } else {
        $(this).select();
    }
}).on("focusout", function () {
    if ($(this).val() == '') {
        $(this).val(0);
    }
});

deduct.on("click", function () {
    if ($(this).val() == '' || $(this).val() == 0) {
        $(this).val('');
    } else {
        $(this).select();
    }
}).on("focusout", function () {
    if ($(this).val() == '') {
        $(this).val(0);
    }
});