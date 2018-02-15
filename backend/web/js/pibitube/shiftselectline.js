var cntgroupline = 0;
setGroupLine(cntgroupline);

function setGroupLine(val) {
    document.getElementById("cline").innerText = val;
}

var shift = $("#shiftselect");
shift.on("change", function () {
    // alert(shift.val());
    $.when(getEmpname(shift.val())).done(function (data) {
        
    });
});

function getEmpname($id) {
    $.ajax({
        type: "post",
        url: "?r=pibitubecalculator/getempname",
        data: {id:shift.val()},
        dataType: "json",
        cache: false,
        async: false,
        success: function (data) {
            alert(data);
        }
    });
}