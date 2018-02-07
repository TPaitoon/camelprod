var listid = $(".listid");

if (listid.val() !== "") {
    var cntline = 0;
    $.when(getEmpname(listid.val())).done(function (data) {
        setLine(cntline);

        for (var i = 0; i < cntline; i++) {

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
                    fLaststr.closest("tr");
                    fNew = fLast.clone();
                    fLast.after(fNew);
                    fNew.find("id input:text").each(function () {
                        $(this).val("");
                    });
                    fLaststr.find(".empid").val(id);
                    fLaststr.find(".empname").val(name);
                }
            } else {
                fLast = fBody.find("tr:last");
                fLaststr.closest("tr");
                fNew = fLast.clone();
                fLast.after(fNew);
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

function setLine(value) {
    document.getElementById("cline").innerHTML = value;
}

function getEmpname(value) {
    var name = null;
    $.ajax({
        type: "post",
        url: "?r=pibitubecalculator/getempname",
        data: {empid: value},
        dataType: 'json',
        cache: false,
        async: false,
        success: function (data) {
            cntline = data.length;
            name = data;
        }
    });
    return name;
}