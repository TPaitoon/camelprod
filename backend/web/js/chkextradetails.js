/**
 * Created by Paitoon on 12/07/2017.
 */
$(document).ready(function () {
    $("#extrasubmit").click(function (e) {
        e.preventDefault();
        var min = $("#cmin").val();
        var max = $("#cmax").val();

        if (min > max && max !== '') {
            alert('ใส่ค่าต่ำสุดให้มากกว่าค่าสูงสุด');
            $("#cmin").focus();
        } else {
            $("#extraform").submit();
        }
    });
});