if (parseInt($("#amount").val()) === 0) {
    var cntline = 0;
    setLine(cntline);
}

function setLine(value) {
    document.getElementById("cline").innerHTML = value;
}

function checkValue(value) {
    var chkloop = document.getElementsByName("empids[]");
    for (var i = 0; i < chkloop.length; i++) {
        if (chkloop[i].value === value) {
            return 0;
        }
    }
    return 1;
}

$(".pibimccalculator-form").each(function () {
    var fBody = $(this).find(".listemp");
    var fLast = fBody.find("tr:last");
    var fLaststr = fLast.closest("tr");
    var fNew;

    if (fLast.closest("tr").find(".empid").val() !== "") {
        cntline++;
    }
    setLine(cntline);

    $(".addemp", $(this)).on('click', function () {
        var emplist = $("#emplistselect");
        var str = emplist.select2("data")[0].text;
        if (!isNaN(parseInt(str.substr(0, 1)))) {
            fLast = fBody.find("tr:last");
            fLaststr = fLast.closest("tr");
            var cnt = $(".listemp").length;
            var id = str.substr(0, 7);
            var name = str.substr(8, str.length);
            if (cnt <= 1) {
                if (fLaststr.find(".empid").val() === "") {
                    fLaststr.find(".empid").val(id);
                    fLaststr.find(".empname").val(name);
                    cntline++;
                    setLine(cntline);
                } else {
                    if (checkValue(id) === 1) {
                        fLast = fBody.find("tr:last");
                        fLaststr = fLast.closest("tr");
                        fNew = fLast.clone();
                        fLast.after(fNew);
                        fNew.find("id input:text").each(function () {
                            $(this).val("");
                        });
                        fLaststr.find(".empid").val(id);
                        fLaststr.find(".empname").val(name);
                        cntline++;
                        setLine(cntline);
                    } else {
                        alert('รหัสพนักงาน : ' + id + ' มีรายชื่อแล้ว');
                    }
                }
            }
        }
        emplist.val("").trigger("change");
        calculator();
    });
});

function removeline(e) {
    var fBody = $(".pibimccalculator-form").find(".listemp");
    var fLast = fBody.find("tr:last");
    var fLaststr = fLast.closest("tr");
    if ($("table.listemp >tbody >tr").length > 1) {
        e.parent().parent().remove();
        cntline--;
        setLine(cntline);
    } else {

        if (fLaststr.find(".empid").val() !== "") {
            fLaststr.find(".empid").val("");
            fLaststr.find(".empname").val("");
            cntline--;
            setLine(cntline);
        }
    }
    calculator();
}