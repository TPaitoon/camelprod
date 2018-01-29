if ($(".listid").val() !== '') {
    var lid = $(".listid").val();
    var cntline = 0;
    $.when(getEmpname(lid)).done(function (data) {
        setLine(cntline);
        for (var i = 0; i < cntline; i++) {
            var fBody = $(".pibimccalculator-form").find(".listemp");
            var fLast = fBody.find("tr:last");
            var fLaststr = fLast.closest("tr");
            var fNew;
            var cnt = $(".listemp").val();
            var id = data[i].substr(0, 7);
            var name = data[i].substr(8, data[i].length);
            if (cnt <= 1) {
                if (fLaststr.find(".empname").val() === '') {
                    fLaststr.find(".empid").val(id);
                    fLaststr.find(".empname").val(name);
                } else {
                    fLast = fBody.find("tr:last");
                    fLaststr = fLast.closest("tr");
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
                fLaststr = fLast.closest("tr");
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
    calDeductEdit();
    calDeduct();
    calculator();
}

function getEmpname(list) {
    var name = null;
    $.ajax({
        type: 'post',
        url: '?r=pibimccalculator/getempname',
        data: {empid: list},
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

function setLine(value) {
    document.getElementById("cline").innerHTML = value;
}

function calDeductEdit() {
    var losttire1 = parseInt($("#losttire1").val());
    var deduct1 = parseFloat($("#dummy1").val());
    var cal1 = losttire1 * deduct1;
    $("#listprice1").val(cal1.toFixed(2));

    var losttire2 = parseInt($("#losttire2").val());
    var deduct2 = parseFloat($("#dummy2").val());
    var cal2 = losttire2 * deduct2;
    $("#listprice2").val(cal2);

    var losttube = parseInt($("#losttube").val());
    var deduct3 = parseFloat($("#dummy3").val());
    var cal3 = losttube * deduct3;
    $("#listprice3").val(cal3);
}