var cntgroupline = 0;
setGroupLine(cntgroupline);

function setGroupLine(val) {
    document.getElementById("cline").innerText = val;
}

function getGroupLine() {
    return document.getElementById("cline").innerText;
}

var shift = $("#shiftselect");
shift.on("change", function () {
    // alert(shift.val());
    if (shift.val() !== "") {
        $.when(getEmpname(shift.val())).done(function (data) {
            // alert(data); //return empid:empname lastname
            var fBody = $(".pibitubecalculator-form").find(".listemp");
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
                }
            }
        });
    } else {
        var fBody = $(".pibitubecalculator-form").find(".listemp");
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
    }
});

function getEmpname($id) {
    var x = null;
    $.ajax({
        type: "post",
        url: "?r=pibitubecalculator/getempname",
        data: {id: shift.val()},
        dataType: "json",
        cache: false,
        async: false,
        success: function (data) {
            // alert(data);
            x = data;
            cntgroupline = data.length;
            setGroupLine(data.length);
        }
    });
    return x;
}

function removegroupline(e) {
    var fBody = $(".pibitubecalculator-form").find(".listemp");
    var fLast = fBody.find("tr:last");
    var fLaststr = fLast.closest("tr");
    if ($("table.listemp >tbody >tr").length > 1) {
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