<?php
/*
* v_timestamp
* แสดงหน้าจอการ input รหัสหนักงาน เพื่อลงเวลางาน
*
*@input emp_code
*@output Input form for add timestamp
*And table timestamp today
*@author Weradet Nopsombun 62160110
*@create date 2564-04-13
*/
?>

<style>
    ul {
        list-style: none;
        margin: 0;
        padding: 0;
    }

    .navbar {
        height: 100px;
    }

    .nav-link {
        color: #28a745;
    }

    .nav-link:hover {
        color: #F2F4F3;

    }

    footer {
        position: fixed;
        left: 0;
        bottom: 0;
        width: 100%;
        text-align: center;
    }
</style>



<!-- navbar -->
<nav class="navbar navbar-top navbar-expand navbar-dark fixed-top border-bottom" style="background-color: #1f2421;">
    <div class="container-fluid">
        <ul class="navbar-nav">
            <li class="nav-item">
                <h1>
                    <a href="<?php echo base_url(); ?>" style="color: white; border-left: 4px solid #18d26e; padding-left: 10px;">
                        IV Soft
                    </a>
                </h1>
            </li>
        </ul>
        <ul>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo base_url() . 'Login_admin' ?>"> <i class="fas fa-user"></i> Admin</a>
            </li>
        </ul>
    </div>
</nav>

<br>
<br>
<!-- user input -->
<div class="container" style="margin-top: 100px;">
    <center>
        <div class="row">
            <div class="col">
                <div class="card text-dark" style="width: 200px; height: 70px;">
                    <h1 class="mb-0  display-time" style="width: 200px; height: 70px; margin-top: 15px;" id="Time_now_text">
                    </h1>
                </div>
            </div>
        </div>
    </center>
    <div class="row">
        <div class="col">
            <h2 class="text-default" id="Clocking_txt"></h2>
        </div>
    </div>

    <form method="post" class="form-inline" id="timestamp_form">
        <input type="text" class="form-control" style="width: 100%; height: 60px; font-size: 20px;  border-color: #000000;" placeholder="Please Enter Employee ID" name="emp_code" id="emp_code" maxlength="6">
    </form>

    <!-- คำแจ้งเตือนใน JS -->
    <span id="check_user"></span><br>

</div>


<!-- table show employee Timpstamp today -->
<div class="container" style="margin-bottom: 30px;">
    <div class="row">
        <div class="col">
            <div class="card" style="margin-bottom: 30px;">
                <!-- Card header -->
                <div class="card-header card-header-bg border-0">
                    <h3 class="mb-0 text-white">Time Attendance Table Today</h3>
                </div>
                <div class="table-responsive" style="margin-top: 20px; " id="Tsm_today">
                </div>
            </div>
        </div>
    </div>
</div>

<!-- The Modal -->
<div class="modal fade" id="confirm_timestamp_out">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Do you want to Time Attendance out</h4>
                <button type="button" class="close" data-dismiss="modal">×</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <p>Today, You have Time Attendance. Do you want to leave early?</p>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="button-cancel" id="cancel" data-dismiss="modal">Cancel</button>
                <button type="button" class="button-confirm" id="confirm">Confirm</button>
            </div>

        </div>
    </div>
</div>


<footer style="margin-top: 30px;">
    <div class="container-fluid ">
        <div class="row">
            <div class="col">
                <!-- Copyright -->
                <div class="footer-copyright text-center py-3" style="float: left; font-size: 15px;">
                    © 2020 Copyright : Cluster 5
                </div>
                <!-- Copyright -->
            </div>

            <div class="col">
                <!-- Copyright -->
                <div class="footer-copyright text-center py-3" style="float: right; font-size: 15px;">
                    Contact : 0852812191
                </div>
                <!-- Copyright -->
            </div>
        </div>

    </div>
</footer>






<!-- /*
        * Jquery
        * 
        *@input emp_code
        *@author Weradet Nopsombun 62160110
        *@create date 2564-04-21
        */ -->

<script>
    $(document).ready(function() {


        display_time_today(); // display time clock now ex. "11:48"

        get_timestamp_today(); // get timedata in database for output only today

        check_txt_clocking(); // clocking in


        let ajaxRequestMade = false; // boolean flase

        $("#emp_code").on('keyup', function() {
            //
            let emp_code = $('#emp_code').val(); // ค่าที่ป้อนเข้าไปใน ช่อง input

            let len = $("#emp_code").val().length;

            if (len >= 6 && !ajaxRequestMade) {
                ajaxRequestMade = true;
                check_employee_ajax(emp_code);
            }

            if (len < 6) {
                ajaxRequestMade = false;
            }
        }); // Event Keyup
        $("#emp_code").val('');



    }); // Jqurey



    /*
     * display_time_today
     * Show Time in display
     *@input -
     * output  time 
     *@author Weradet Nopsombun 62160110
     *@Create Date 2564-05-04
     */

    function display_time_today() {

        let today = new Date();
        let hours_today = today.getHours();
        let min_today = today.getMinutes();

        min_today = checkTime(min_today);
        hours_today = checkTime(hours_today);


        $("#Time_now_text").html('<i class="fas fa-clock" ></i>' + ' ' + hours_today + ":" + min_today);

        setTimeout(display_time_today, 1000);
    }



    /*
     * checkTime
     * add zero in front of numbers < 10
     *@input -
     * output  time 
     *@author Weradet Nopsombun 62160110
     *@Create Date 2564-05-04
     */

    function checkTime(i) {
        if (i < 10) {
            i = "0" + i
        }; // add zero in front of numbers < 10
        return i;
    }




    /*
     * check_txt_clocking
     * check employee code in database
     *@input -
     * output  Clocking text
     *@parameter emp_code, emp_code_length
     *@author Weradet Nopsombun 62160110
     *@Create Date 2564-04-21
     */

    function check_txt_clocking() {
        let today = new Date();

        if (today.getHours() < 8) {
     
            $("#Clocking_txt").text("Time Attendance Time");

        } else if (today.getHours() >= 17) {

            $("#Clocking_txt").text("Time Attendance Out Time");

        } else {
    
            $("#Clocking_txt").text("Time Attendance Late Time");
        }
    }



    /*
     * check_employee_ajax
     * check employee code in database
     *@input -
     * output sweet alert name, lastname and Timestamp or Timestamp out
     *@parameter emp_code, emp_code_length
     *@author Weradet Nopsombun 62160110
     *@Create Date 2564-04-21
     */


    function check_employee_ajax(emp_code) {
        // var base_url = $('#base').val();
        //เช็ค รหัสพนักงานว่าตรงกับที่มีในระบบไหม
        $.ajax({
            type: "POST",
            // url: '{base_url}/Timestamp/Employee_ajax/Search_employee_ajax', //หาวิธีที่ ไม่ต้อง tag php
            url: 'Timestamp_input_ajax/search_employee_ajax',
            data: {
                emp_code: emp_code
            },
            success: function(json_res) {

                if (json_res == 1) {
                    $("#check_user").css({
                        "color": "green"
                    });
                    $("#check_user").html("Username  available");
                    check_timestamp_ajax(emp_code);


                } else {
                    $("#check_user").css({
                        "color": "red"
                    });
                    $("#check_user").html("Username not available");
                }


            },
            error: function() {
                alert('check_employee_ajax Not working');
            }
        });

    }


    /*
     * check_timestamp_ajax
     * check timestamp in database
     *@input -
     * output sweet alert name, lastname and Timestamp or Timestamp out
     *@parameter emp_code
     *@author Weradet Nopsombun 62160110
     *@Create Date 2564-04-21
     */
    function check_timestamp_ajax(emp_code) {

        // กรณีนี้ ถ้ามีข้อมูลการตอกบัตรของวันนี้แล้ว จะถือว่าพนักงาน ตอกบัตรออก
        //จากนั้นจะเช็คเวลาว่า ขณะนี้เวลาเกิน 5 โมงไหม ถ้าเกิน 5 โมงจะถือว่าได้ตอกบัตรออกเป็นที่เรียบร้อย
        //ถ้าไม่เกิน 5 โมง จะถือออกจากงาน ก่อนเวลาจริง จะมีการ คอนเฟริมว่า ต้องการออกจากงานไหม ในกรณีที่ลืมว่าตัวเองเคยตอกบัตรเข้างาน
        $.ajax({
            method: "POST",
            url: 'Timestamp_input_ajax/check_time_stamp_today',
            data: {
                emp_code: emp_code
            },
            success: function(json_num_timestamp) {

                if (json_num_timestamp == 1) { // กรณีที่ วันนี้เคยตอกบัตรแล้วถูกลบ


                    check_time_ever_timestamp_del(emp_code);

                } else if (json_num_timestamp == 0) { //วันนี้ไม่เคยตอกบัตร         


                    check_time_not_ever_timestamp(emp_code); // เรียกใช้ฟังก์ชั่น ตรวจสอบเวลาที่ไม่เคยตอกบัตร

                } else if (json_num_timestamp == 2) {

                    check_time_ever_timestamp(emp_code); // เรียกใช้ฟังก์ชั่น ตรวจสอบเวลาที่เคยตอกบัตร

                }

            },
            error: function() {
                //error exception
                alert('Cannot find Employee Ajax not working');
            }
        }); //ajax 

    } // check_timestamp_ajax




    /*
     * check_time_ever_timestamp
     * check time now to check clocking out (user ever timestamp)
     *@input -
     * output sweet alert name, lastname and Timestamp or Timestamp out
     *@parameter emp_code
     *@author Weradet Nopsombun 62160110
     *@Create Date 2564-05-09
     */

    function check_time_ever_timestamp_del(emp_code) {
        let date_today = new Date(); //ประกาศตัวแปร date เพื่อเอา ชั่วโมงมาเช็ค
        if (date_today.getHours() >= 17) { // ขณะนี้เวลาเกิน 5 โมงไหม
            //กรณีที่เวลาเกิน 5 โมง
            $.ajax({
                method: "POST",
                url: 'Timestamp_input_ajax/update_timestamp_out_del',
                dataType: 'JSON',
                data: {
                    emp_code: emp_code
                },
                success: function(json_Timestamp_out) {


                    swal({
                        title: "Time Attendance Out  Successfully",
                        text: json_Timestamp_out.arr_employee.emp_firstname + " " + json_Timestamp_out.arr_employee.emp_lastname + "\n" +
                            json_Timestamp_out.time_out.tsm_timestamp_out,
                        type: "success",
                        timer: 3000
                    })
                    get_timestamp_today();
                    $("#emp_code").val('');
                },
                error: function() {
                    alert(' Update_timestamp_out Not working');
                }
            }); //ajax


        } else { // ถ้าเวลาไม่เกิน 5 โมง

            $.ajax({
                method: "POST",
                url: 'Timestamp_input_ajax/update_timestamp_del',
                dataType: 'JSON',
                data: {
                    emp_code: emp_code
                },
                success: function(json_Timestamp) {

                    swal({
                        title: "Time Attendance  Successfully",
                        text: json_Timestamp.arr_employee.emp_firstname + " " + json_Timestamp.arr_employee.emp_lastname + "\n" +
                            json_Timestamp.time_out.tsm_timestamp,
                        type: "success",
                        timer: 3000,
                    })


                    get_timestamp_today();
                    $("#emp_code").val('');


                },
                error: function() {
                    alert('Insert_timestamp_out Not working');
                }
            }); //ajax

        } //else เวลาไม่เกิน 5 โมง

    }




    /*
     * check_time_ever_timestamp
     * check time now to check clocking out (user ever timestamp)
     *@input -
     * output sweet alert name, lastname and Timestamp or Timestamp out
     *@parameter emp_code
     *@author Weradet Nopsombun 62160110
     *@Create Date 2564-04-21
     */

    function check_time_ever_timestamp(emp_code) {
        let date_today = new Date(); //ประกาศตัวแปร date เพื่อเอา ชั่วโมงมาเช็ค

        if (date_today.getHours() >= 17) { // ขณะนี้เวลาเกิน 5 โมงไหม
            //กรณีที่เวลาเกิน 5 โมง
            Update_timestamp_out(emp_code);

        } else { // ถ้าเวลาไม่เกิน 5 โมง
            //กรณีตอกบัตร 2 ครั้ง หรือออกก่อนเวลา
            $("#confirm_timestamp_out").modal(); // เปิด Modal 

            //cancel confirm
            $("#cancel").click(function() {
                // $("#timestamp_form").find('input:text').val('');
                $("#emp_code").val('');
            });

            // confirm Timestamp out
            $("#confirm").click(function() {
                Update_timestamp_out(emp_code);

                $('#confirm_timestamp_out').modal('toggle');

                $("#emp_code").val('');
            });

        } //else เวลาไม่เกิน 5 โมง

    }



    /*
     * check_timestamp_or_out
     * check time now to check clocking in or clocking out
     *@input -
     * output sweet alert name, lastname and Timestamp or Timestamp out
     *@parameter emp_code
     *@author Weradet Nopsombun 62160110
     *@Create Date 2564-04-21
     */
    function check_time_not_ever_timestamp(emp_code) {

        let date_today = new Date();
        //ประกาศตัวแปร date เพื่อเอา ชั่วโมงมาเช็ค

        if (date_today.getHours() >= 17) {
            //เวลาหลังจาก 5 โมง ให้ตอกบัตรเป็น ออกจากงาน
            Insert_timestamp_out(emp_code);

        } else {
            //ก่อน 5 โมง ให้เป็นการ ตอกบัตรเข้างาน
            Insert_timestamp(emp_code)
        } //else

    } //





    /*
     * Update_timestamp_out
     * update timestamp  out in database
     *@input -
     *@parameter emp_code
     * output sweet alert name, lastname and Timestamp or Timestamp out
     *@author Weradet Nopsombun 62160110
     *@Create Date 2564-04-21
     */

    function Update_timestamp_out(emp_code) {
        $.ajax({
            method: "POST",
            url: 'Timestamp_input_ajax/update_timestamp_out',
            dataType: 'JSON',
            data: {
                emp_code: emp_code
            },
            success: function(json_Timestamp_out) {
                console.log(json_Timestamp_out);
                //  console.log(Timestamp_out["arr_employee"]);
                //  console.log(Timestamp_out["arr_employee"]["emp_firstname"])

                swal({
                    title: "Time Attendance Out  Successfully",
                    text: json_Timestamp_out.arr_employee.emp_firstname + " " + json_Timestamp_out.arr_employee.emp_lastname + "\n" +
                        json_Timestamp_out.time_out.tsm_timestamp_out,
                    type: "success",
                    timer: 3000
                })
                get_timestamp_today();
                $("#emp_code").val('');
            },
            error: function() {
                alert(' Update_timestamp_out Not working');
            }
        }); //ajax
    } // 





    /*
     * Insert_timestamp_out
     * Insert timestamp in database 
     *@input -
     * output sweet alert name, lastname and Timestamp or Timestamp out
     *@parameter emp_code
     *@author Weradet Nopsombun 62160110
     *@Create Date 2564-04-21
     */

    function Insert_timestamp_out(emp_code) {
        $.ajax({
            method: "POST",
            url: 'Timestamp_input_ajax/insert_timestamp_out',
            dataType: 'JSON',
            data: {
                emp_code: emp_code
            },
            success: function(json_Timestamp) {

                swal({
                    title: "Time Attendance Out  Successfully",
                    text: json_Timestamp.arr_employee.emp_firstname + " " + json_Timestamp.arr_employee.emp_lastname + "\n" +
                        json_Timestamp.time_out.tsm_timestamp_out,
                    type: "success",
                    timer: 3000,
                })

                get_timestamp_today();
                $("#emp_code").val('');


            },
            error: function() {
                alert('Insert_timestamp_out Not working');
            }
        }); //ajax
    }




    /*
     * Insert_timestamp
     * Insert timestamp in database 
     *@input -
     * output sweet alert name, lastname and Timestamp or Timestamp out
     *@parameter emp_code
     *@author Weradet Nopsombun 62160110
     *@Create Date 2564-04-21
     */
    function Insert_timestamp(emp_code) {
        $.ajax({
            method: "POST",
            url: 'Timestamp_input_ajax/insert_timestamp',
            dataType: 'JSON',
            data: {
                emp_code: emp_code
            },
            success: function(json_Timestamp) {

                swal({ //sweet alert
                    title: "Time Attendance  Successfully",
                    text: json_Timestamp.arr_employee.emp_firstname + " " + json_Timestamp.arr_employee.emp_lastname + "\n" +
                        json_Timestamp.time_out.tsm_timestamp,
                    type: "success",
                    timer: 3000,
                })

                get_timestamp_today();
                $("#emp_code").val('');

            },
            error: function() {
                alert('Insert_timestamp Not working');
            }
        }); //ajax
    } //insert 





    /*
     * get_timestamp_today
     * get timestamp data and display in table 
     *@input -
     *@parameter -
     * output sweet alert name, lastname and Timestamp or Timestamp out
     *@author Weradet Nopsombun 62160110
     *@Create Date 2564-04-23
     */


    function get_timestamp_today() {

        $.ajax({
            method: "POST",
            url: 'Timestamp_input_ajax/get_timestamp_list_today_ajax',
            dataType: 'JSON',
            success: function(json_data) {

                create_table(json_data['json_timestamp']);

            },
            error: function() {
                alert('Table_timestamp Not working');
            }
        });

    }




    /*
     * Make table
     * create_table
     *@input -
     *@parameter -
     * output sweet alert name, lastname and Timestamp or Timestamp out
     *@author Weradet Nopsombun 62160110
     *@Create Date 2564-04-23
     */


    function create_table(arr_timestamp) {
        let html_code = '';

        html_code += '<table class="table table-striped" id="Tsm_today_tb">';
        html_code += '<thead class="thead-light">';
        html_code += '<tr>';
        html_code += '<th  width="10%"" style="text-align: center;font-size: 16px;" >Employee ID</th>';
        html_code += '<th  width="5%" style="text-align: center;font-size: 16px;" >Employee</th>';
        html_code += '<th  width="5%" style="text-align: center;font-size: 16px;" >in</th>';
        html_code += '<th  width="5%"  style="text-align: center;font-size: 16px;"  >out </th>';
        html_code += '</tr>';
        html_code += ' </thead>';
        html_code += ' <tbody class="list">';



        arr_timestamp.forEach((row_tsm, index_tsm) => {

            html_code += '<tr>';
            html_code += '<td style="text-align: center; font-size: 16px;" >' + (row_tsm['emp_code']) + '</td>';
            html_code += '<td style="font-size: 16px;" >' + (row_tsm['emp_firstname']) + ' ' + (row_tsm['emp_lastname']) + '</td>';


            //check forget timestamp output
            if (row_tsm['tsm_timestamp'] != null) {

                html_code += '<td  style="text-align: center;font-size: 16px;" >' + (row_tsm['tsm_timestamp']) + '</td>'; //output time

            } else {
                html_code += '<td  style="text-align: center;font-size: 16px;" >' + '-' + '</td>'; //output -

            }



            //check forget timestamp out output
            if (row_tsm['tsm_timestamp_out'] != null) {

                html_code += '<td  style="text-align: center;font-size: 16px;" >' + (row_tsm['tsm_timestamp_out']) + '</td>'; //output time

            } else {

                html_code += '<td  style="text-align: center;font-size: 16px;" >' + '-' + '</td>'; //output -

            }

            html_code += '</tr>';

        });


        html_code += '</tbody>';
        html_code += ' </table>';

        $('#Tsm_today').html(html_code);

        $('#Tsm_today_tb').dataTable({
            "ordering": false,
            colReorder: {
                realtime: true
            },
            "lengthMenu": [
                [10, 25, 50, -1],
                [10, 25, 50, "All"]
            ],
            searching: false
        });

    }
</script>

</body>