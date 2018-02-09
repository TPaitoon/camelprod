var itemid = $(".itemid");

if (itemid.val() !== "") {
    var cntline = 0;
    $.when(getAmount(itemid.val())).done(function (data) {
        var txt = null;
        var groupid = null;
        var value = null;
        setLine(cntline);
        var fBody = $(".pibitubecalculator-form").find(".listqty");
        var fLast, fLaststr, fNew, cnt;
        for (var i = 0; i < data.length; i++) {
            txt = data[i].split(":");
            groupid = txt[0];
            value = txt[1];
            cnt = $(".listqty").length;
            if (cnt <= 1) {
                fLast = fBody.find("tr:last");
                fLaststr = fLast.closest("tr");
                if (fLaststr.find(".groups").val() === "") {
                    fLaststr.find(".groups").val(groupid);
                    fLaststr.find(".values").val(value);
                } else {
                    fLast = fBody.find("tr:last");
                    // fLaststr = fLast.closest("tr");
                    fNew = fLast.clone();
                    fLast.after(fNew);
                    fLast = fBody.find("tr:last");
                    fLaststr = fLast.closest("tr");
                    fNew.find("id input:text").each(function () {
                        $(this).val("");
                    });
                    fLaststr.find(".groups").val(groupid);
                    fLaststr.find(".values").val(value);
                }
            } else {
                fLast = fBody.find("tr:last");
                // fLaststr = fLast.closest("tr");
                fNew = fLast.clone();
                fLast.after(fNew);
                fLast = fBody.find("tr:last");
                fLaststr = fLast.closest("tr");
                fNew.find("id input:text").each(function () {
                    $(this).val("");
                });
                fLaststr.find(".groups").val(groupid);
                fLaststr.find(".values").val(value);
            }
        }

        if (parseInt(car.val()) === 1) {
            $("#listprice3").val(100);
        } else {
            $("#listprice3").val(0);
        }
        
        setAmount(calAmount());
        calDeduct();
        calculator();
    })
}

function setLine(value) {
    document.getElementById("gline").innerHTML = value;
}

function setAmount(value) {
    document.getElementById("aline").innerHTML = value;
}

function getAmount(value) {
    var amount = null;
    // alert(value);
    $.ajax({
        type: "post",
        url: "?r=pibitubecalculator/getamount",
        data: {amount: value},
        dataType: "json",
        cache: false,
        async: false,
        success: function (data) {
            cntline = data.length;
            amount = data;
        }
    });
    return amount;
}

function calAmount() {
    var loopcal = document.getElementsByName("values[]");
    var cal = 0;
    for (var i = 0; i < loopcal.length; i++) {
        cal = cal + loopcal[i].value;
    }
    return cal;
}