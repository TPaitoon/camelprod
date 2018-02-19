var listid = $(".listid");

if (listid.val() !== "") {
    $.when(getEmpname(listid.val())).done(function (data) {
        // alert("To Call : " + data);
        for (var i = 0; i < cntgroupline; i++) {

            var fBody = $(".pibitubecalculator-form").find(".listemp");
            var fLast = fBody.find("tr:last");
            var fLaststr = fLast.closest("tr");
            var fNew;
            var cnt = $(".listemp").length;
            var id = data[i].substr(0, 7);
            var name = data[i].substr(8, data[i].length);
            if (cnt <= 1) {

                if (fLaststr.find(".empname").val() === "") {
                    fLaststr.find(".empid").val(id);
                    fLaststr.find(".empname").val(name);
                } else {
                    fLast = fBody.find("tr:last");
                    // fLaststr.closest("tr");
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
            }
        }
    });
    calDeduct();
    calculator();
}

function setGroupLine(val) {
    document.getElementById("cline").innerText = val;
}

function getEmpname(value) {
    var name = null;
    // alert("First EMP : " + value);
    $.ajax({
        type: "post",
        url: "?r=pibitubecalculator/getempname",
        data: {empid: value},
        dataType: 'json',
        cache: false,
        async: false,
        success: function (data) {
            cntgroupline = data.length;
            setGroupLine(data.length);
            name = data;
            // alert("After Query with Controller : " + data);
        }
    });
    return name;
}