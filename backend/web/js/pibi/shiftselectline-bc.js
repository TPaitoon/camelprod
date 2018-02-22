var cntgroupline = 0;
setGroupLine(cntgroupline);

function setGroupLine(val) {
    document.getElementById("cline").innerText = val;
}

function getGroupLine() {
    return document.getElementById("cline").innerText
}

// alert($("#group").val());

var shift = $("#shiftselect");
var group = $("#group");
shift.on("change", function () {
    setEmpname(shift.val(), group.val());
});
group.on("change", function () {
    setEmpname(shift.val(), group.val());
});

function setEmpname(sh, gr) {
    if (shift.val() !== "" && group.val() !== "") {
        $.when(getEmpname(sh, gr)).done(function (data) {
            // alert(data);
            var fBody = $(".pibicalculator-form").find(".listemp");
            var fLast = fBody.find("tr:last");
            var fLaststr = fLast.closest("tr");
            var fNew;

            if (data.length > 0) {
                fLast = fBody.find("tr:last");
                fNew = fLast.clone();
                $(".listemp >tbody >tr").empty();
                fLast.after(fNew);
                fLast = fBody.find("tr:last");
                fLaststr = fLast.closest("tr");
                fLaststr.find(".empid").val("");
                fLaststr.find(".empname").val("");
            }

            for (var i = 0; i < getGroupLine(); i++) {
                var cnt = $(".listemp").length;
                var id = data[i].substr(0, 7);
                var name = data[i].substr(8, data[i].length);
                if (cnt <= 1) {
                    if (fLaststr.find(".empname").val() === "") {
                        fLaststr.find(".empid").val(id);
                        fLaststr.find(".empname").val(name);
                    } else {
                        fLast = fBody.find("tr:last");
                        fNew = fLast.clone();
                        fLast.after(fNew);
                        fLast = fBody.find("tr:last");
                        fLaststr = fLast.closest("tr");
                        fNew.find("id input:text").each(function () {
                            $(this).val("");
                        });
                        fLaststr.find(".empid").val(id);
                        fLaststr.find(".empname").val(name);
                        calDeduct();
                        calculator();
                    }
                } else {
                    fLast = fBody.find("tr:last");
                    fNew = fLast.clone();
                    fLast.after(fNew);
                    fLast = fBody.find("tr:last");
                    fLaststr = fLast.closest("tr");
                    fNew.find("id input:text").each(function () {
                        $(this).val("");
                    });
                    fLaststr.find(".empid").val(id);
                    fLaststr.find(".empname").val(name);
                    calDeduct();
                    calculator();
                }
            }
        });
    } else {
        var fBody = $(".pibicalculator-form").find(".listemp");
        var fLast = fBody.find("tr:last");
        var fLaststr;
        var fNew;

        fLast = fBody.find("tr:last");
        fNew = fLast.clone();
        $(".listemp >tbody >tr").empty();
        fLast.after(fNew);
        fLast = fBody.find("tr:last");
        fLaststr = fLast.closest("tr");
        fLaststr.find(".empid").val("");
        fLaststr.find(".empname").val("");

        cntgroupline = 0;
        setGroupLine(cntgroupline);
        calDeduct();
        calculator();
    }
}

function getEmpname(sh, gr) {
    var x = null;
    $.ajax({
        type: "post",
        url: "?r=pibicalculator/getempname",
        data: {shift: sh, group: gr},
        dataType: "json",
        cache: false,
        async: false,
        success: function (data) {
            // alert(data);
            if (data === 0) {
                alert("ไม่มีข้อมูลพนักงาน");
            } else {
                x = data;
                cntgroupline = data.length;
                setGroupLine(data.length);
            }
        }
    });
    return x;
}

function removeline(e) {
    var fBody = $(".pibicalculator-form").find(".listemp");
    var fLast = fBody.find("tr:last");
    var fLaststr = fLast.closest("tr");
    if (getGroupLine() > 1) {
        e.parent().parent().remove();
        cntgroupline--;
        setGroupLine(cntgroupline);
    } else {
        if (fLaststr.find(".empid").val() !== "") {
            fLaststr.find(".empid").val("");
            fLaststr.find(".empname").val("");
            cntgroupline--;
            setGroupLine(cntgroupline);
        }
    }
    calDeduct();
    calculator();
}