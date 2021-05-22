<?php
/*
* v_clocking_information
* แสดงหน้าจอการ input รหัสหนักงาน,วันที่เพื่อค้นหาข้อมูลลงเวลางาน
*
*@input emp_code,date_start,date_end
*@output clockinginformation table
*@author Thanisorn thumsawanit 62160088
*@create date 2564-04-19
*@update Date 2564-05-12
*/
?>

<head>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.js"></script>
    <!-- bootstrap-datepicker -->
</head>
<style>
#late {
    color: red;
}

.button-apply {
    width: 50px;
    height: 26px;
    display: inline-block;
    cursor: pointer;
    text-align: center;
    outline: none;
    color: #fff;
    background-color: #3385ff;
    border: none;
    border-radius: 4px;

}

.button-apply:hover {
    background-color: #3385ff;
    color: #fff;
    transform: translateY(-1px);
}

.button-apply:active {
    background-color: #3385ff;
    color: #fff;
}
</style>
<br>
<br>
<br>
<br>
<br>
<br>

<div class="container-fluid">
    <p class="header-text">&nbsp;&nbsp;Clocking Information</p>
    <div class="shadow card">
        <div class="border-0 card-header">
            <br>
            <!-- start Input Date Form -->
            <form>
                Employee ID : <input type="text" name="emp_id" id="emp_id" placeholder="Please enter Employee ID">
                &nbsp;Choose Date :
                <input type="text" name="daterange" id="date"
                    value="<?php echo get_date_mouth() . '-01 - ' . get_date_today() ?>">
                &nbsp;<input type="button" id="submit" name="submit" value="Search"
                    class="btn btn-info btn-fill pull-right">
            </form>
            <!-- End Input Date Form -->
            <p id="test"></p>
            <br>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="row">
        <div class="col">
            <div class="card">
                <!-- Card header -->
                <div class="card-header card-header-bg border-0">
                    <h3 class="mb-0 text-white">Clocking Information Table</h3>
                </div>
                <div class="table-responsive" style="margin-top: 20px;" id="clocking_table">
                </div>
            </div>
        </div>
    </div>
</div>
<script>
var date_start = "";
var date_end = "";
var emp_id = "";
var clear;
date_start = $('#date').val().substring(0, 10); // ตัด string วันที่เริ่มต้น 
date_end = $('#date').val().substring(13, 23); // ตัด string วันที่สิ้นสุด 
$(document).ready(function() {
    $(function() {
        $('#date').daterangepicker({
            opens: 'left',
            cancelButtonClasses: "cancel",
            applyButtonClasses: "button-apply",
            locale: {
                format: "YYYY-MM-DD",
                cancelLabel: 'Clear',
            }
        }, function(start, end) {
            date_start = start.format('YYYY-MM-DD');
            date_end = end.format('YYYY-MM-DD');

        }); //จัด format วันที่ และ ปรับสีปุ่มของ date picker
        $('#date').on('cancel.daterangepicker', function(ev, picker) {
            clear = $('#date').val();
            $('#date').val('');
            date_start = '';
            date_end = '';
        }); //clear ข้อมูลวันที่ใน date picker เมื่อกดปุ่ม cancel
        $('#date').on('apply.daterangepicker', function(ev, picker) {
            if ($('#date').val() == '') {
                date_start = clear.substring(0, 10);
                date_end = clear.substring(13, 23);
                $('#date').val(date_start + ' - ' + date_end);
            } else {
                $('#date').val(date_start + ' - ' + date_end);
            }
        });
        // restore date value
        if ($('#date').val() == '') {
            $('#date').val('');
            $('#date').val(date_start + ' - ' + date_end);
        } else {
            $('#date').val(date_start + ' - ' + date_end);
        }
    });

    $("#submit").click(function() {
        emp_id = $('#emp_id').val();
        get_clocking_information();
    }); //เมื่อกดปุ่ม search จะทำการค้นหาข้อมูลการลงเวลาจากรหัสพนักงาน

    get_clocking_information();
    emp_id = $('#emp_id').val();
});
/*
 * get_clocking_information
 * check create clocking information table
 *@input -
 * output clocking information table
 *@parameter -
 *@author Thanisorn thumsawanit 62160088
 *@Create Date 2564-04-25
 */
function get_clocking_information() {
    $.ajax({
        method: "POST",
        url: 'table_by_date_show',
        dataType: 'JSON',
        data: {
            date_start: date_start,
            date_end: date_end,
            emp_id: emp_id
        },
        success: function(json_data) {
            create_table(json_data['arr_clocking']);
        }
    }); //เรียกใช้ function แสดง และ สร้างตารางข้อมูลการลงเวลา 
}
/*
 * Make table
 * create_table
 *@input arr_clocking
 *@parameter -
 *output Clocking information table
 *@author Thanisorn thumsawanit 62160088
 *@Create Date 2564-04-25
 *@update Date 2564-05-12
 */


function create_table(arr_clocking) {
    let html_code = '';
    html_code += '<table id="clocking"  class="table table-hover">';
    html_code += '<thead class="thead-light">';
    html_code += '<tr>';
    html_code += '<th   width="5%"style="text-align: center;font-size: 20px;" >Date</th>';
    html_code += '<th   width="5%"style="text-align: center;font-size: 20px;" >ID</th>';
    html_code += '<th   width="1%" style="text-align: center;font-size: 20px;" >Name</th>';
    html_code += '<th   width="5%"style="text-align: center;font-size: 20px;" >in</th>';
    html_code += '<th   width="5%"style="text-align: center;font-size: 20px;" >out</th>';
    html_code += '<th   width="5%" style="text-align: center;font-size: 20px;" >Work hour</th>';
    html_code += '<th   width="5%" style="text-align: center;font-size: 20px;" >status</th>';
    html_code += '</tr>';
    html_code += '</thead>';
    html_code += '<tbody>';

    arr_clocking.forEach((row_cim) => {
        html_code += '<tr>';
        html_code += '<td  style="text-align: center;font-size: 20px;" >' + (row_cim['tsm_date']) + '</td>';
        html_code += '<td  style="text-align: center;font-size: 20px;" >' + (row_cim['emp_code']) + '</td>';
        html_code += '<td  style="font-size: 20px; "  >' + (row_cim['emp_firstname']) + ' ' + (
            row_cim['emp_lastname']) + '</td>';
        if (row_cim['tsm_timestamp'] != null) {
            html_code += '<td  style="text-align: center;font-size: 20px;" >' + (row_cim['tsm_timestamp']) +
                '</td>';
        } else {
            html_code += '<td  style="text-align: center;font-size: 20px;" >' + '-' + '</td>'; //output -
        }
        if (row_cim['tsm_timestamp_out'] != null) {
            html_code += '<td  style="text-align: center;font-size: 20px;" >' + (row_cim['tsm_timestamp_out']) +
                '</td>';
        } else {
            html_code += '<td  style="text-align: center;font-size: 20px;"  >' + '-' + '</td>'; //output -
        }
        if (row_cim['diff'] != null) {
            //html_code += '<td  style="text-align: center;font-size: 20px;" >' + (row_cim['diff']) + '</td>';
                let str1 = row_cim['diff'].substring(0, 2);
                if (str1.substring(0, 1) == '0') {
                    str1 = row_cim['diff'].substring(1, 2);
                }
                let str2 = row_cim['diff'].substring(3, 5);

                html_code += '<td style="font-size: 20px; text-align: center;" >' + str1 + ' H ' + str2 + ' M ' + '</td>';
        } else {
            html_code += '<td  style="text-align: center;font-size: 20px;"  >' + '-' + '</td>'; //output -
        }
        if (row_cim['tsm_timestamp'] > "08:00" && row_cim['tsm_timestamp_out'] < "17:00") {
            html_code +=
                '<td style="color:red; text-align: center;font-size: 20px;" >' + 'Late,Leave early' +
                '</td>'; //Late + Leave early
        } else if (row_cim['tsm_timestamp'] <= "08:00" && row_cim['tsm_timestamp_out'] >= "17:00") {
            html_code += '<td  style="color:red; text-align: center;font-size: 20px;"  >' + '-' +
                '</td>'; //-
        } else if (row_cim['tsm_timestamp'] > "08:00" && row_cim['tsm_timestamp_out'] > "08:00") {
            html_code += '<td  style="color:red; text-align: center;font-size: 20px;"  >' + 'Late' +
                '</td>'; //Late
        } else if (row_cim['tsm_timestamp'] > "08:00" && row_cim['tsm_timestamp_out'] == null) {
            html_code += '<td  style="color:red; text-align: center;font-size: 20px;"  >' +
                'Late,Not sign out' +
                '</td>'; //Late + Not sign out 
        } else if (row_cim['tsm_timestamp'] != null && row_cim['tsm_timestamp_out'] < "17:00") {
            html_code += '<td  style="color:red; text-align: center;font-size: 20px;"  >' + 'Leave early' +
                '</td>'; //Leave early
        } else if (row_cim['tsm_timestamp'] == null && row_cim['tsm_timestamp_out'] < "17:00") {
            html_code += '<td  style="color:red; text-align: center;font-size: 20px;"  >' +
                'Not sign in,Leave early' +
                '</td>'; //Not sign in Leave early
        } else if (row_cim['tsm_timestamp'] == null && row_cim['tsm_timestamp_out'] == null) {
            html_code += '<td  style="color:red; text-align: center;font-size: 20px;"  >' +
                'Not sign in,Not sign out' +
                '</td>'; //Not sign in,Not sign out 
        } else if (row_cim['tsm_timestamp'] == null && row_cim['tsm_timestamp_out'] > "08:00") {
            html_code += '<td  style="color:red; text-align: center;font-size: 20px;"  >' + 'Not sign in' +
                '</td>'; //Not sign in
        } else if (row_cim['tsm_timestamp'] < "17:00" && row_cim['tsm_timestamp_out'] == null) {
            html_code += '<td  style="color:red; text-align: center;font-size: 20px;"  >' + 'Not sign out' +
                '</td>'; //Not sign out
        }

        html_code += '</tr>';
    });

    html_code += '</tbody>';
    html_code += '</table>';

    $('#clocking_table').html(html_code); // ส่งข้อมูลตารางไปที #clocking_table 
    $('#clocking').DataTable({
        "pagingType": "full_numbers",
        "lengthMenu": [
            [10, 25, 50, -1],
            [10, 25, 50, "All"]
        ],
        deferRender: true,
        scrollY: '20rem',
        scrollCollapse: true,
        scrollX: true,
        scroller: true
    }); //DataTable

}; //clocking information table
</script>