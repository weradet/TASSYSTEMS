$(document).ready(function() {
    $("#emp_code").blur(function() {
        var emp_code = $('#emp_code').val();
        if (emp_code != "") {
            jQuery.ajax({
                type: "POST",
                url: ' <?php echo site_url(' / C_task / callAjax ') ?>',
                dataType: 'html',
                data: { emp_code: emp_code },
                success: function(res) {
                    if (res == 1) {
                        $("#msg").css({ "color": "red" });
                        $("#msg").html("This user already exists");
                    } else {
                        $("#msg").css({ "color": "green" });
                        $("#msg").html("Congrates username available !");
                    }

                },
                error: function() {
                    alert('some error');
                }
            });
        }
    });
});
















function startTime() {
    var today = new Date();
    var h = today.getHours();
    var m = today.getMinutes();
    var s = today.getSeconds();
    m = checkTime(m);
    s = checkTime(s);
    document.getElementById('text').innerHTML =
        h + ":" + m + ":" + s;
    var t = setTimeout(startTime, 500);
}

function checkTime(i) {
    if (i < 10) {
        i = "0" + i
    }; // add zero in front of numbers < 10
    return i;
}