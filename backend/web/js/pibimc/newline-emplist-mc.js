var cntgroupline = 0;
setGroupLine(cntgroupline);

function setGroupLine(val) {
    document.getElementById("cline").innerHTML = val;
}

function checkGroupValue(val) {
    var chkloop = document.getElementsByName("empids[]");
    for (var i = 0; i < chkloop.length; i++) {
        if (chkloop[i].value === val) {
            return 0;
        }
    }
    return 1;
}

function getGroupLength() {
    var chklenght = document.getElementsByName("empids[]");
    for (var i = 0; i < chklenght.length; i++) {
        if (chklenght[i].value === "") {
            return 0;
        }
    }
    return 1;
}

$(".pibimcemplist-form").each(function () {
    var fBody = $(this).find(".listemp");
    var fLast = fBody.find("tr:last");
    var fLaststr = fLast.closest("tr");
    var fNew;

    if (fLast.closest("tr").find(".empid").val() !== "") {
        cntgroupline++;
    }
    setGroupLine(cntgroupline);

    $(".addemp", $(this)).on("click", function () {
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
                    cntgroupline++;
                    setGroupLine(cntgroupline);
                } else {
                    if (checkGroupValue(id) === 1) {
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
                        cntgroupline++;
                        setGroupLine(cntgroupline);
                    } else {
                        alert("รหัสพนักงาน : " + id + " มีรายชื่อแล้ว");
                    }
                }
            }
        }
        emplist.val("").trigger("change");
    });
});

function removegroupline(e) {
    var fBody = $(".pibimcemplist-form").find(".listemp");
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
}

$("#pibimcemplistsubmit").on("click", function (e) {
    if (confirm("ต้องการบันทึกรายการ ?")) {
        if (getGroupLength() === 0) {
            alert("กรอกข้อมูลไม่ครบ ...");
            e.preventDefault();
        }
    } else {
        e.preventDefault();
    }
});