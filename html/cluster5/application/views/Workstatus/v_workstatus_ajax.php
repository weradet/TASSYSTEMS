<!-- * v_workstatus_ajax
* แสดงหน้าจอการ input วันที่ และรหัสพนักงาน และ แสดงตารางข้อมูลการลงเวลาของพนักงาน
* สามารถ แก้ไขเวลาลงงานและลบเวลาลงงานได้

*@input emp_code,date_start,
*@output workstatus table
*@author Natdanai Intasorn
*@create Date 2564-04-21
*@update Date 2564-05-04 -->



<br>
<br>
<br>
<br>
<br>
<br>
<style>
    .modal-dialog {
        overflow-y: initial !important
    }

    .modal-body_edit {
        height: 45vh;
        overflow-y: auto;
        overflow-x: hidden;
        /* Hide horizontal scrollbar */

    }

    .pointer {
        cursor: pointer;
    }
</style>

<head>
    <!-- bootstrap-datepicker -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.js"></script>


</head>
<!-- card input date and employee id -->
<div class="container-fluid">
    <p class="header-text">&nbsp;&nbsp;Work Status</p>
    <div class="shadow card">
        <div class="border-0 card-header">
            <br>
            <!-- start Input Date Form -->
            <form>
                Employee ID : <input type="text" name="emp_id" id="emp_id" placeholder="Please enter Employee ID">
                &nbsp;Choose Date :
                <input type="text" name="date" id="date_search" value="<?php echo get_date_today(); ?>" placeholder="Choose Date">
                &nbsp;<input type="button" name="submit" value="Search" id="enter" class="btn btn-info btn-fill pull-right"><br>

            </form>
            <!-- end Input Date Form -->
            <!-- ตัวขั้นบรรทัด -->
            <p id="test"></p>
            <br>
        </div>
    </div>
</div>
<!-- card work status table  -->
<div class="container-fluid">
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header card-header-bg border-0 ">
                    <div class="row" style="width: 100%;">
                        <div class="col">
                            <h3 class="mb-0  text-white" style="margin-top: 7px;"> Work Status Table </h3>
                        </div>
                        <div class="col" style="float: right;">
                            <h3 style="float: right;" class="mb-0  text-white"> Date : <?php echo get_date_today(); ?> &nbsp;<button class="btn btn-primary btn-sm-lg" data-toggle="modal" data-target="#modal_restore" type="button" onclick="show_table_restore()">Restore </button></h3>
                        </div>
                    </div>
                </div>

                <!-- table work status -->
                <div class="table-responsive" style="margin-top: 10px" id="table_emp">

                </div>
            </div>
        </div>
    </div>
</div>

<!-- เรียก modal มาจากไฟล์ v_workstatus_edit.php -->
<?php require 'v_workstatus_edit.php' ?>


<script>
    $(document).ready(function() {


        // เรียกใช้ ฟังชั่น datepicker
        $('#date_search').datepicker({
            todayBtn: 'linked',
            format: "yyyy-mm-dd",
            autoclose: true
        });
        // คำสั่งทำงานเมื่อ กดปุ่ม search 
        $('#enter').click(function() {
            let date_search = $('#date_search').val(); //ประกาศตัวแปร date_search เก็บค่าจากวันที่ ที่input
            let emp_id = $('#emp_id').val(); //ประกาศตัวแปร emp_id เก็บค่าจาก ไอดีของนพักงานที่ input
            // console.log(date);
            $.ajax({
                type: 'post',
                url: 'show_table_by_date', //ส่งค่าไป ฟังชั่น show_table_by_date ใน controller
                dataType: "json",
                data: {
                    date_search: date_search,
                    emp_id: emp_id
                },

                success: function(json_data) {
                    console.log(json_data);
                    create_table((json_data)['json_date']); //สร้างตาราง จากข้อมูลที่ส่งกลับมา

                },
                error: function() { //แจ้งระบบทำงานพลาด
                    alert('check_employee_ajax Not working');
                }

            });
        });
        Get_emp_timestamp(); //ฟังชั่น แสดงตารางของวันปัจจุบัน


    });

    //ฟังชั่น แสดงตารางของวันปัจจุบัน
    function Get_emp_timestamp() {
        $.ajax({
            type: 'post',
            url: 'Get_emp_timestamp',
            dataType: "json",
            success: function(json_data) {
                console.log(json_data);
                create_table((json_data)['json_emp']);
            }

        });
    }


    /*
     * Make table
     * create_table
     *@parameter arr_emp
     *output Workstatus table
     *@author Natdanai Intasorn 62160150
     *@Create Date 2564-04-25
     */

    function create_table(arr_emp) {
        let today = new Date();
        let admin_name = $('#admin').val();
        let html_code = '';
        html_code += '<table class="table " id="table_emp_stamp" >';
        html_code += '<thead class="thead-light" style="text-align: center;">';
        html_code += '<tr>';
        html_code += '<th style="font-size: 20px;"> ID </th>';
        html_code += '<th style="font-size: 20px;"> Name</th>';
        html_code += '<th style="font-size: 20px;"> In</th>';
        html_code += '<th style="font-size: 20px;"> Out</th>';
        html_code += '<th style="font-size: 20px;"> Work Hour</th>';
        html_code += '<th style="font-size: 20px;"> Status</th>';
        html_code += '<th style="font-size: 20px;"> History</th>';
        html_code += '<th style="font-size: 20px;"> Action</th>';
        html_code += '</tr>';
        html_code += '</thead>';
        html_code += '<tbody>';
        arr_emp.forEach((row_emp) => {
            html_code += '<tr>';
            html_code += '<td style="font-size: 20px; text-align: center;" >' + row_emp['emp_code'] + '</td>';
            html_code += '<td style="font-size: 20px;" >' + row_emp['emp_firstname'] + ' ' + row_emp[
                'emp_lastname'] + '</td>';

            if (row_emp['Time_in'] == null) {
                html_code += '<td style="font-size: 20px; text-align: center;" >' + ' - ' + '</td>';
            } else {
                html_code += '<td style="font-size: 20px; text-align: center;" >' + row_emp['Time_in'] +
                    '</td>';
            }

            if (row_emp['Time_out'] == null) {
                html_code += '<td style="font-size: 20px; text-align: center;" >' + ' - ' + '</td>';
            } else {
                html_code += '<td style="font-size: 20px; text-align: center;" >' + row_emp['Time_out'] +
                    '</td>';
            }

            if (row_emp['Working'] == null) {
                html_code += '<td style="font-size: 20px; text-align: center;" >' + ' - ' + '</td>';
            } else {
                let str1 = row_emp['Working'].substring(0, 2); // เอาแค่ 2 ตัวแรก
                if (str1.substring(0, 1) == '0') { //้ถ้าตัวแรกเป็น 0
                    str1 = row_emp['Working'].substring(1, 2); //ไม่เอาตัวแรก
                }
                let str2 = row_emp['Working'].substring(3, 5); //เอา 2 ตัวท้าย

                html_code += '<td style="font-size: 20px; text-align: center;" >' + str1 + ' H ' + str2 + ' M ' + '</td>';
            }




            if (row_emp['Time_in'] > "08:00" && row_emp['Time_out'] < "17:00") {
                html_code += '<td style="text-align: center;font-size: 20px;">' + '<a id="late" style="color:red;">' + 'Late' + ', ' +
                    'Leave early' + '</td>'; //Late+Leave early

            } else if (row_emp['Time_in'] > "08:00" && row_emp['Time_out'] == null) {
                html_code += '<td  style="color:red; text-align: center;font-size: 20px;"  >' + 'Late' + ', ' + 'Not sign out' +
                    '</td>'; //Late
            } else if (row_emp['Time_in'] > "08:00") {
                html_code += '<td  style="color:red; text-align: center;font-size: 20px;"  >' + 'Late' +
                    '</td>'; //Late
            } else if (row_emp['Time_out'] < "17:00" && row_emp['Time_in'] == null) {
                html_code += '<td  style="color:red; text-align: center;font-size: 20px;"  >' + 'Leave early' + ', ' + 'Not sign in' +
                    '</td>'; //Leave early
            } else if (row_emp['Time_out'] < "17:00") {
                html_code += '<td  style="color:red; text-align: center;font-size: 20px;"  >' + 'Leave early' +
                    '</td>'; //Leave early
            } else if (row_emp['Time_in'] == null) {
                html_code += '<td  style="color:red; text-align: center;font-size: 20px;"  >' + 'Not sign in' + '</td>';
            } else if (row_emp['Time_out'] == null) {
                if (today.getHours() >= 17) {
                    html_code += '<td  style="color:red; text-align: center;font-size: 20px;"  >' + 'Not sign out' +
                        '</td>'; //Not sign out
                } else {
                    html_code += '<td style="text-align: center;font-size: 20px;">' + '-' +
                        '</td>'; //เวลาลทำงานปกติ
                }
            } else {
                html_code += '<td style="text-align: center;font-size: 20px;">' + '-' +
                    '</td>'; //ไม่เข้าสักเงื่อนไข
            }




            if (row_emp['tsm_edit_status'] == '0') {
                html_code += '<td style="font-size: 20px; text-align: center;" >' + ' - ' + '</td>';
            } else {
                html_code += '<td style="font-size: 20px; text-align: center;" >';
                html_code += '<button class="btn btn-info btn-sm" onclick="show_edited(' + row_emp['tsm_id'] + ')" data-target="#modal_show_edited" data-toggle="modal" class="pointer">';
                html_code += '<i class="fas fa-history" style="font-size:20px"></i>';
                html_code += '</button>';
                html_code += '</td>';
            }


            if (admin_name == row_emp['emp_firstname'] + ' ' + row_emp['emp_lastname']) {
                html_code += '<td style="text-align: center;">';
                html_code +=
                    '<button class="btn btn-warning btn-sm" style="margin-right: 15px;" type="button" " data-toggle="modal" data-target="#modal_warning1" >';
                html_code += '<i class="far fa-edit" style="font-size:20px"></i>';
                html_code += '</button>';
                html_code += '<button class="btn btn-danger btn-sm"  type="button" data-toggle="modal" data-target="#modal_warning2">';
                html_code += '<i class="far fa-trash-alt" style="font-size:20px"></i>';
                html_code += '</button>';
                html_code += '</td>';
            } else {
                html_code += '<td style="text-align: center;">';
                html_code +=
                    '<button class="btn btn-warning btn-sm" style="margin-right: 15px;" type="button"  data-toggle="modal" data-target="#EditModal" onclick="edit_timestamp(' +
                    row_emp['tsm_id'] + ')">';
                html_code += '<i class="far fa-edit" style="font-size:20px"></i>';
                html_code += '</button>';
                html_code += '<button class="btn btn-danger btn-sm"  type="button" onclick="confirm(' + row_emp['tsm_id'] +
                    ')">';
                html_code += '<i class="far fa-trash-alt" style="font-size:20px"></i>';
                html_code += '</button>';
                html_code += '</td>';
            }
            html_code += '</tr>';
        });
        html_code += '</tbody>';
        html_code += '</table>';

        $('#table_emp').html(html_code); //ส่งข้อมูลตารางไปที่ #table_emp line 52
        $('#table_emp_stamp').DataTable(); //เรียกใช้ pugin datatable
    }

    /*
     * show table
     * edit_timestamp
     *@parameter arr_emp
     *output Workstatus table
     *@author Natdanai Intasorn 62160150
     *@Create Date 2564-04-25
     */
    function edit_timestamp(tsm_id) {
        console.log('tsm_id:', tsm_id);
        $.ajax({
            type: 'post',
            url: 'show_edit',
            dataType: "json",
            data: {
                tsm_id: tsm_id
            },

            success: function(json_data) {
                console.log(json_data);
                create_edit_table((json_data)['json_emp'], tsm_id);
            }
        });

    }
    /*
     * show history table
     * show_edited
     *@parameter arr_emp
     *output history table
     *@author Natdanai Intasorn 62160150
     *@Create Date 2564-04-25
     */
    function show_edited(tsm_id) {
        console.log('tsm_id:', tsm_id);
        $.ajax({
            type: 'post',
            url: 'show_old_timestamp',
            dataType: "json",
            data: {
                tsm_id: tsm_id
            },

            success: function(json_data) {
                console.log(json_data);
                create_edited_table((json_data)['json_re']);
            }
        });
    }

    /*
     * Make history table
     * create_edited_table
     *@parameter arr_re
     *output history table
     *@author Natdanai Intasorn 62160150
     *@Create Date 2564-04-25
     */

    function create_edited_table(arr_re) {
        let html_code = '';
        arr_re.forEach((row_emp) => {

            html_code += '<div class="row bg-dark text-white" style="height:50px ">';
            html_code += '<div class="col" style="margin-top: 10px;">';
            html_code += '<a style="margin-left: 199px;">' + 'IN' + '</a>';
            html_code += '</div>';
            html_code += '<div class="col" style="margin-top: 10px;">';
            html_code += '<a style="margin-left: 131px;">' + 'OUT' + '</a>';
            html_code += '</div>';
            html_code += '</div>';

            html_code += '<br>';


            html_code += '<div class="row">';
            html_code += '<div class="col">';
            if (row_emp['Time_in'] == null) {
                html_code += ' - ';
            } else {
                html_code += '<input style="margin-left: 185px; width: 60px; height: 40px;" value="' + row_emp['Time_in'] + '" disabled>';
            }

            if (row_emp['Time_out'] == null) {
                html_code += ' - ';
            } else {
                html_code += '<input style="margin-left: 280px; width: 60px; height: 40px;" value="' + row_emp['Time_out'] + '" disabled>';
            }

            html_code += '<div class="row">';
            html_code += '<div class="col">';
            html_code += '<br>';
            html_code += '<a style="margin-left: 150px;">' + 'Admin note : ' + '</a>';
            html_code += '</div>';
            html_code += '</div>';
            html_code += '<div class="row">';
            html_code += '<textarea  rows="2" cols="50" style="margin-left: 150px;" disabled>' + row_emp['ots_admin_note'] + '</textarea>';
            html_code += '</div>';
            html_code += '<br>';
            html_code += '<div class="row">';
            html_code += '<a style="margin-left: 230px;">' + 'Admin name : ' + '</a>';
            html_code += '<input type="text" value="' + row_emp['ots_admin_sig'] + '" disabled>';
            html_code += '</div>';
            // html_code += '<br>';
            html_code += '<hr>';
        });
        html_code += '</div>';
        html_code += '</div>';

        $('#body_edited').html(html_code); //ส่งข้อมูลตารางไปที่ #table_emp line 52
        // $('#table_restore').DataTable(); //เรียกใช้ pugin datatable
    }
    //ฟังชั่นเรียกใช้ตาราง edit ใน modal


    //ฟังก์ชั่น confirm เวลากด delete 
    function confirm(tsm_id) {
        $('#modal_confirm_del').modal();

        $('#confirm_delete').click(function() {
            delete_timestamp(tsm_id);
        });

    }
    /*
     * delete_timestamp
     *@parameter tsm_id
     *@author Mattaneeya Phosrisuk 62160334
     *@Create Date 2564-04-25
     */

    function delete_timestamp(tsm_id) {
        console.log('tsm_id:', tsm_id);
        $.ajax({
            type: 'post',
            url: 'delete',
            dataType: "json",
            data: {
                tsm_id: tsm_id
            },
            success: function(json_data) {
                let date_search = $('#date_search').val();
                //let emp_id = $('#emp_id').val();
                // console.log(date);
                $.ajax({
                    type: 'post',
                    url: 'show_table_by_date',
                    dataType: "json",
                    data: {
                        date_search: date_search,
                        //emp_id: emp_id
                    },

                    success: function(json_data) {
                        console.log(json_data);
                        create_table((json_data)['json_date']);


                    },

                });
            },
        });
    }

    /*
     * Make table
     * create_edit_table
     *@parameter arr_emp, tsm_id
     *output modal edit
     *@author Natdanai Intasorn 62160150
     *@Create Date 2564-04-30
     */

    function create_edit_table(arr_emp, tsm_id) {
        let html_code = ' ';
        let modal_footer = ' ';
        html_code += '<table class="table" style="text-align: center;">';
        html_code += '<thead class="thead-light" >';
        html_code += '<tr>';
        html_code += '<th style="font-size: 20px;">Name</th>';
        html_code += '<th style="font-size: 20px;">in</th>';
        html_code += '<th style="font-size: 20px;">out</th>';
        html_code += '</tr>';
        html_code += '</thead>';
        html_code += '<tbody>';
        html_code += '<tr>';
        arr_emp.forEach((row_emp) => {

            html_code += '<td style="font-size: 20px; width: 50%;" >' + row_emp['emp_firstname'] + ' ' + row_emp[
                'emp_lastname'] + '</td>';

            if (row_emp['tsm_timestamp'] == null) {
                html_code += '<td style="font-size: 20px;">' +
                    "<input type='time' style='width: 80%; text-align: center;' value='-'  id='new_timestamp'>" +
                    '<p style="color:#adb5bd">' + 'Ex 11:00' + '</p>' + '</td>';
            } else {
                html_code += '<td style="font-size: 20px;">' +
                    "<input type='time' style='width: 80%; text-align: center;' value='" + row_emp['Time_in'] +
                    "'  id='new_timestamp'>" + '<p style="color:#adb5bd">' + 'Ex 11:00' + '</p>' + '</td>';

            }

            if (row_emp['tsm_timestamp_out'] == null) {
                html_code += '<td style="font-size: 20px;">' +
                    "<input type='time' style='width: 80%; text-align: center;' value='-'  id='new_timestamp_out'>" +
                    '<p style="color:#adb5bd">' + 'Ex 15:00' + '</p>' + '</td>';
            } else {
                html_code += '<td style="font-size: 20px;">' +
                    "<input type='time' style='width: 80%; text-align: center;' value='" + row_emp['Time_out'] +
                    "'  id='new_timestamp_out'>" + '<p style="color:#adb5bd">' + 'Ex 15:00' + '</p>' + '</td>';
            }
            html_code += '</tr>';


            html_code += '</tbody>';
            html_code += '</table>';

            //เมื่อกดปุ่ม save change จะส่งข้อมูลไปที่ ฟังชั่น save_edit_timestamp
            modal_footer += '<button type="button" class="button-save" id="save" onclick="save_edit_timestamp(' +
                tsm_id + ', \'' + row_emp['tsm_timestamp'] + '\' , \' ' + row_emp['tsm_timestamp_out'] +
                ' \')"> Save change </button>';
            //ปุ่มปิด modal
            modal_footer +=
                '<button type="button" class="button-cancel" data-dismiss="modal" id="close" onclick="reset()"> Close </button>';
        });
        $('#EDIT').html(html_code); //ส่งข้อมูลไป modal ในไฟล์ v_workstatus_edit.php ที่ #EDIT ส่วน body
        $('#modal_footer').html(
            modal_footer); //ส่งข้อมูลไป modal ในไฟล์ v_workstatus_edit.php ที่ #modal_footer ส่วน footer
    }

    //ฟังก์ชั่น reset คำแจ้งเตือน เมื่อกด close
    function reset() {
        $('#alert').html('');

        $('#edit_note').val('');

    }
    /*
     * save_edit_timestamp
     *@parameter tsm_id, tsm_timestamp, tsm_timestamp_out
     *output save edit
     *@author Natdanai Intasorn 62160150
     *@Create Date 2564-05-2
     */
    function save_edit_timestamp(tsm_id, tsm_timestamp, tsm_timestamp_out) {

        let new_timestamp = $('#new_timestamp').val(); //new
        let new_timestamp_out = $('#new_timestamp_out').val();
        let edit_note = $('#edit_note').val();
        let admin = $('#admin').val();

        console.log(new_timestamp, new_timestamp_out, tsm_timestamp, tsm_timestamp_out, edit_note);
        //แจ้งเตือน หากไม่ใส่ note
        if (document.getElementById('edit_note').value == "") {
            $("#alert").css({
                "color": "red"
            });
            $("#alert").html("*Please input note.");

        } else if (new_timestamp_out < new_timestamp || new_timestamp_out == new_timestamp) {
            $("#alert").css({
                "color": "red"
            });
            $("#alert").html("*Please input time out in less than time in.");
        } else {
            // ajax ส่งค่าไปที่ update_and_insert_timestamp ใน controller
            $.ajax({
                type: 'post',
                url: 'update_and_insert_timestamp',
                dataType: "json",
                data: {
                    new_timestamp: new_timestamp,
                    new_timestamp_out: new_timestamp_out,
                    edit_note: edit_note,
                    admin: admin,
                    tsm_id: tsm_id,
                    tsm_timestamp: tsm_timestamp,
                    tsm_timestamp_out: tsm_timestamp_out
                },

                success: function(json_data) {
                    console.log(json_data);
                    let date_search = $('#date_search').val();
                    let emp_id = $('#emp_id').val(); //ประกาศตัวแปร emp_id เก็บค่าจาก ไอดีของนพักงานที่ input
                    // console.log(date);
                    //เรียกใช้ฟังชั่น แสดงตารางตามวันที่ input
                    $.ajax({
                        type: 'post',
                        url: 'show_table_by_date',
                        dataType: "json",
                        data: {
                            date_search: date_search,
                            emp_id: emp_id
                        },

                        success: function(json_data) {
                            console.log(json_data);
                            // window.location.reload();
                            $('#EditModal').modal('hide');
                            reset();
                            create_table((json_data)['json_date']);

                        },
                        error: function() {
                            alert('check_employee_ajax Not working');
                        }

                    });
                }
            });
        }

    }

    /*
     *show_table_restore
     *output JSON data
     *@author Natdanai Intasorn 62160150
     *@Create Date 2564-05-10
     */
    function show_table_restore() {

        $.ajax({
            type: 'post',
            url: 'show_restore_timestamp',
            dataType: "json",
            success: function(json_data) {
                console.log(json_data);
                create_table_restore((json_data)['json_re']);
            }

        });
    }


    /*
     *Make table
     *create_table_restore
     *@parameter arr_re
     *output table restore
     *@author Natdanai Intasorn 62160150
     *@Create Date 2564-05-10
     */
    function create_table_restore(arr_re) {
        let html_code = '';
        html_code += '<table class="table" id="table_restore">';
        html_code += '<thead class="thead-light" style="text-align: center;" >';
        html_code += '<tr>';
        html_code += '<th style="font-size: 20px;"> Name</th>';
        html_code += '<th style="font-size: 20px;"> Date</th>';
        html_code += '<th style="font-size: 20px;"> In</th>';
        html_code += '<th style="font-size: 20px;"> Out</th>';
        html_code += '<th style="font-size: 20px;"> Working Hours</th>';
        html_code += '<th style="font-size: 20px;"> Action</th>';
        html_code += '</tr>';
        html_code += '</thead>';
        html_code += '<tbody>';
        html_code += '<tr>';
        arr_re.forEach((row_emp) => {

            html_code += '<td style="font-size: 20px; " >' + row_emp['emp_firstname'] + ' ' + row_emp[
                'emp_lastname'] + '</td>';

            html_code += '<td style="font-size: 20px; text-align: center; " >' + row_emp['tsm_date'] + '</td>';

            if (row_emp['Time_in'] == null) {
                html_code += '<td style="font-size: 20px; text-align: center; " >' + ' - ' + '</td>';
            } else {
                html_code += '<td style="font-size: 20px; text-align: center; " >' + row_emp['Time_in'] +
                    '</td>';
            }

            if (row_emp['Time_out'] == null) {
                html_code += '<td style="font-size: 20px; text-align: center; " >' + ' - ' + '</td>';
            } else {
                html_code += '<td style="font-size: 20px; text-align: center; " >' + row_emp['Time_out'] +
                    '</td>';
            }

            if (row_emp['Working'] == null) {
                html_code += '<td style="font-size: 20px; text-align: center; " >' + ' - ' + '</td>';
            } else {
                let str1 = row_emp['Working'].substring(0, 2); // เอาแค่ 2 ตัวแรก
                if (str1.substring(0, 1) == '0') { //้ถ้าตัวแรกเป็น 0
                    str1 = row_emp['Working'].substring(1, 2); //ไม่เอาตัวแรก
                }
                let str2 = row_emp['Working'].substring(3, 5); //เอา 2 ตัวท้าย

                html_code += '<td style="font-size: 20px; text-align: center;" >' + str1 + ' H ' + str2 + ' M ' + '</td>';
            }

            html_code += '<td style="text-align: center;">';
            html_code +=
                '<button class="btn btn-primary" style="margin-right: 15px;" type="button" data-dismiss="modal" onclick="action_restore(' +
                row_emp['tsm_id'] + ')">';
            html_code += '<i class="fas fa-undo-alt" style="font-size:20px"></i>';
            html_code += '</button>';
            html_code += '</td>';


            html_code += '</tr>';
        });
        html_code += '</tbody>';
        html_code += '</table>';

        $('#body_restore').html(html_code); //ส่งข้อมูลตารางไปที่ #table_emp line 52
        // $('#table_restore').DataTable(); //เรียกใช้ pugin datatable
    }

    /*
     *action_restore
     *@parameter tsm_id
     *output restore timestamp
     *@author Natdanai Intasorn 62160150
     *@Create Date 2564-05-10
     */
    function action_restore(tsm_id) {
        console.log(tsm_id);
        $.ajax({
            type: 'post',
            url: 'restore',
            dataType: "json",
            data: {
                tsm_id: tsm_id
            },
            success: function(json_data) {
                console.log(json_data);
                let date_search = $('#date_search').val();
                //let emp_id = $('#emp_id').val();
                // console.log(date);
                $.ajax({
                    type: 'post',
                    url: 'show_table_by_date',
                    dataType: "json",
                    data: {
                        date_search: date_search,
                        //emp_id: emp_id
                    },

                    success: function(json_data) {
                        console.log(json_data);
                        create_table((json_data)['json_date']);


                    },

                });
            },

        });
    }
</script>