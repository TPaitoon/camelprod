if (getLine() === "") {
    var cntline = 0;
    setLine(cntline);
    setAmount(0);
}

function setLine(value) {
    document.getElementById("gline").innerHTML = value;
}

function setAmount(value) {
    document.getElementById("aline").innerHTML = value;
}

function getLine() {
    var chkloop = document.getElementsByName("groups[]");
    return chkloop[0].value;
}

function checkValue(value) {
    var chkloop = document.getElementsByName("groups[]");
    for (var i = 0; i < chkloop.length; i++) {
        if (chkloop[i].value === value) {
            return 0;
        }
    }
    return 1;
}

$(".pibitubecalculator-form").each(function () {
    var fBody = $(this).find(".listqty");
    var fLast = fBody.find("tr:last");
    var fLaststr = fLast.closest("tr");
    var fNew;

    if (fLast.closest("tr").find(".groups").val() !== "") {
        cntline++;
    }

    setLine(cntline);
    var amount = $(".amount");

    $(".adddetail", $(this)).on("click", function () {
        var grouplist = $("#grouplistselect");
        fLast = fBody.find("tr:last");
        fLaststr = fLast.closest("tr");
        var cnt = $(".listqty").length;
        var amounts = amount.val();
        var groups = grouplist.val();
        // alert(group);
        if (cnt <= 1) {
            // alert(cnt);
            if (fLaststr.find(".groups").val() === "") {
                fLaststr.find(".groups").val(groups);
                fLaststr.find(".values").val(amounts);
                cntline++;
                setLine(cntline);
            } else {
                if (checkValue(groups) === 1) {
                    fLast = fBody.find("tr:last");
                    // fLaststr = fLast.closest("tr");
                    fNew = fLast.clone();
                    fLast.after(fNew);
                    fLast = fBody.find("tr:last");
                    fLaststr = fLast.closest("tr");
                    fNew.find("id input:text").each(function () {
                        $(this).val("");
                    });
                    fLaststr.find(".groups").val(groups);
                    fLaststr.find(".values").val(amounts);
                    cntline++;
                    setLine(cntline);
                } else {
                    alert("กลุ่ม " + groups + " มีข้อมูลแล้ว");
                }
            }
        }
        amount.val(0);
        calculator();
    });
});

function removeline(e) {
    var fBody = $(".pibitubecalculator-form").find(".listqty");
    var fLast = fBody.find("tr:last");
    var fLaststr = fLast.closest("tr");
    if ($("table.listqty >tbody >tr").length > 1) {
        e.parent().parent().remove();
        cntline--;
        setLine(cntline);
    } else {
        if (fLaststr.find(".groups").val() !== "") {
            fLaststr.find(".groups").val("");
            fLaststr.find(".values").val("");
            cntline--;
            setLine(cntline);
        }
    }
    calculator();
}

var amount = $(".amount");
amount.on("click",function () {
    if ($(this).val() === "0"){
        $(this).val("");
    } else {
        $(this).select();
    }
});
amount.on("focusout",function () {
    if ($(this).val() === ""){
        $(this).val(0);
    }
});