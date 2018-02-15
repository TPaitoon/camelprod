var cntgroupline = 0;
setGroupLine(cntgroupline);


function setGroupLine(value) {
    document.getElementById("cline").innerHTML = value;
}

function checkGroupValue(value) {
    var chkloop = document.getElementsByName("empids[]");
    for (var i = 0; i < chkloop.length; i++) {
        if (chkloop[i].value === value) {
            return 0;
        }
    }
    return 1;
}

$(".pibitubeemplist-form").each(function () {
    var fBody = $(this).find(".listemp");
    var fLast = fBody.find("tr:last");
    var fLaststr = fLast.closest("tr");
    var fNew;

    if (fLast.closest("tr").find(".empid").val() !== "") {
        cntgroupline++;
    }
    setGroupLine(cntgroupline);

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
                    cntgroupline++;
                    setGroupLine(cntgroupline);
                } else {
                    if (checkGroupValue(id) === 1) {
                        fLast = fBody.find("tr:last");
                        // fLaststr = fLast.closest("tr");
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
                        alert('รหัสพนักงาน : ' + id + ' มีรายชื่อแล้ว');
                    }
                }
            }
        }
        emplist.val("").trigger("change");
    });
});

function removegroupline(e) {
    var fBody = $(".pibitubeemplist-form").find(".listemp");
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

$("#pibiemplistsubmit").on("click",function (e) {
    if (!confirm("ต้องการบันทึกข้อมูล ?")) {
        e.preventDefault();
    }
});