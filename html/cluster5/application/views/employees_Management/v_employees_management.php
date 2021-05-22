<head>

</head>
<style>
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
<!-- The Modal EDIT-->
<div class="modal fade" id="EditModal">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <p class="modal-title" style="font-size: 30px;">&nbsp;EDIT </p>
                <button type="button" class="close" data-dismiss="modal" onclick='reset_data()'>&times;</button>

            </div>

            <!-- Modal body -->

            <div class="modal-body" id="EDIT">

            </div>

            <div class="row">
                <div class="col">

                    <p style="margin: 35px;font-size:16px"><b>Admin Status : </b> <a id='status'></a>
                        <a style="float: right; margin-right: 35px;"><b>Admin : </b><input type="text" id="admin" style='width: 150px; height: 25px;' value="<?php echo $this->session->userdata("Admin_name") . " " . $this->session->userdata("Admin_lastname"); ?>" disabled></a>
                    </p>


                    <div class="form-group">

                        <a style="margin: 35px;font-size:16px" id="user_admin"> </a>
                        <a style="margin: 35px;font-size:16px" id="user_password"> </a>
                        <a style="margin: 35px;font-size:16px" id="user_password_con"></a>
                    </div>

                    <span id="Alert" style="font: size 25px; color: red;margin: 35px;"> </span>

                </div>
            </div>
            <!-- Modal footer -->
            <div class="modal-footer" id="modal_footer">

            </div>
        </div>
    </div>
</div>


<!-- The Modal ADD-->
<div class="container-fluid">
    <!-- Modal -->
    <div class="modal fade" id="myModal">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <p class="modal-title" style="font-size: 30px;">ADD EMPLOYEE</p>
                    <button type="button" class="close" data-dismiss="modal" onclick='reset_data()'>&times;</button>
                </div>
                <form>
                    <div class="modal-body">
                        <div class="form-inline">
                            <label for="id" style="font-size: 16px;">ID :</label>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" class="form-control" style="width: 60%;" id="id" placeholder="Employee ID" name="id" required>
                            <button type="button" class="btn btn-sm btn-primary" id="emp_code_gen" style="margin-left: 10px;">Auto ID</button>
                            <span id="usernameavailable"></span>
                        </div>
                        <br>
                        <div class="form-group">
                            <label for="name" style="font-size: 16px;">Name :</label>
                            <input type="text" class="form-control" id="name" placeholder="Enter Name" name="name" size="10" required>
                            <span id="pfatf"></span>
                            <br>
                            &nbsp;<label for="lname" style="font-size: 16px;">Last name :</label>
                            <input type="text" class="form-control" id="lname" placeholder="Enter Last name" name="lname" size="10" required>
                            <span id="pfatf2"></span>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="button-save" id="butsave">Add</button>
                        <button type="button" class="button-cancel" data-dismiss="modal" onclick='reset_data()'>Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>

<!-- The Modal -->
<div class="modal fade" id="DeleteModal">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <p class="modal-title" style="font-size: 30px;">DELETE</p>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                Do you want to delete it?
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="button-cancel" id=" cancel" data-dismiss="modal">Cancel</button>
                <button type="button" class="button-confirm" id="confirm_delete" data-dismiss="modal">Confirm</button>
            </div>

        </div>
    </div>
</div>

<br>
<br>
<br>
<br>
<br>
<br>
<div class="container-fluid">
    <p class="header-text">&nbsp; Employee Management</p>
</div>

<div class="container-fluid">
    <div class="row">
        <div class="col">
            <div class="card">
                <!-- Card header -->

                <div class="card-header card-header-bg border-0">
                    <h3 class="mb-0 text-white">Employee Table</h3>
                </div>
                <button type="button" class="btn btn-info " data-toggle="modal" data-target="#myModal" onclick="reset_data()" style="margin-top: 20px;  margin-left: 10px;  width: 200px;  height: 50px">
                    <i class="fa fa-plus"></i> Add Employee
                </button>
                <div class="table-responsive" style="margin-top: 20px;" id="Employees_table">

                </div>
            </div>
        </div>
    </div>
</div>

<script>
    var emp_id = "";
    var emp_code = "";
    var emp_firstname = "";
    var emp_lastname = "";
    var emp_type = "";
    var User_id = '';
    var Pass = '';
    $(document).ready(function() {


        $("#emp_code_gen").click(function() {
            $.ajax({
                type: 'POST',
                dataType: 'JSON',
                url: 'max_id_show',
                success: function(data) {
                    $('#id').val(data['last']);
                }
            });
        }); //สร้างรหัสพนักงานอัตโนมัติ เมื่อทำทำการเพิ่มนักงานใหม่่


        $("#butsave").click(function() {
            let id = $('#id').val();

            $.ajax({
                type: 'POST',
                url: 'checkuser_available',
                data: {
                    id: id
                },
                success: function(data) {
                     console.log(data);
                    if (data == 1) {
                        $("#usernameavailable").css({
                            "color": "red"
                        });

                        $('#usernameavailable').html("ID not available");

                    } else if (data == 2) {
                        // document.getElementById("butsave").disabled = false;
                        var emp_code = $('#id').val();
                        var emp_firstname = $('#name').val();
                        var emp_lastname = $('#lname').val();
                        if (emp_code.length == "6" && emp_code != "" && emp_firstname != "" && emp_lastname != "") {
                            $("#butsave").attr("disabled", "disabled");
                            $.ajax({
                                url: 'insert_employees',
                                type: "POST",
                                data: {
                                    emp_code: emp_code,
                                    emp_firstname: emp_firstname,
                                    emp_lastname: emp_lastname
                                },
                                cache: false,
                                success: function(dataResult) {
                                    get_employees_information();
                                    var dataResult = JSON.parse(dataResult);
                                    if (dataResult.statusCode == 200) {
                                        $("#butsave").removeAttr("disabled");
                                        $('#fupForm').find('input:text').val('');
                                        $("#success").show();
                                        $('#success').html('Data added successfully !');
                                    } else if (dataResult.statusCode == 201) {
                                        alert("Error occured !");
                                    }
                                    $('#myModal').modal('hide');
                                    reset_data();
                                }
                            });
                        } else {
                            $("#pfatf2").css({
                                "color": "red"
                            });
                            $('#pfatf2').html("*Please fill all the fields");

                        }

                    }

                }
            });


        }); // event

        $(function() {
            get_employees_information();
            emp_id = $('#emp_id').val();
        });


    }); //document.ready

    /*
     * Make table
     * create_table
     *@input arr_emp
     *@parameter -
     *output employee management table
     *@author Thanisorn thumsawanit 62160088
     *@Create Date 2564-04-11
     *@update Date 2564-05-13
     */


    function create_table(arr_emp) {
        let html_code = '';
        html_code += '<table id="emp_manage"  class="table table-hover">';
        html_code += '<thead class="thead-light">';
        html_code += '<tr>';
        html_code += '<th  width="1%"style="text-align: center;font-size: 20px;" >No</th>';
        html_code += '<th  width="1%"style="text-align: center;font-size: 20px;" >ID</th>';
        html_code += '<th  width="1%" style="text-align: center;font-size: 20px;" >Name</th>';
        html_code += '<th  width="1%"style="text-align: center;font-size: 20px;" >Action</th>';
        html_code += '</tr>';
        html_code += '</thead>';
        html_code += '<tbody>';

        arr_emp.forEach((row_emp, index) => {

            html_code += '<tr>';
            html_code += '<td style="font-size: 20px;"width="2%"><center>' + (index + 1) +
                '</center></td>';
            html_code += '<td  style="text-align: center;font-size: 20px;" >' + (row_emp['emp_code']) +
                '</td>';
            html_code += '<td  style="font-size: 20px; "  >' + (row_emp['emp_firstname']) + ' ' + (
                row_emp['emp_lastname']) + '</td>';
            html_code += '<td style="text-align: center;">';
            html_code +=
                '<button class="btn btn-warning btn-sm" style="margin-right: 15px;" type="button"  data-toggle="modal" data-target="#EditModal" onclick="edit_employee(' +
                row_emp['emp_code'] + ')">';
            html_code += '<i class="far fa-edit" style="font-size:20px"></i>';
            html_code += '</button>';
            html_code +=
                '<button class="btn btn-danger btn-sm"  type="button"  data-toggle="modal" data-target="#DeleteModal" onclick="confirm(' +
                row_emp['emp_code'] + ')">';
            html_code += '<i class="far fa-trash-alt" style="font-size:20px"></i>';
            html_code += '</button>';
            html_code += '</td>';
            html_code += '</tr>';
        });

        html_code += '</tbody>';
        html_code += '</table>';

        $('#Employees_table').html(html_code);
        $('#emp_manage').DataTable({
            "pagingType": "full_numbers",
            "lengthMenu": [
                [10, 25, 50, -1],
                [10, 25, 50, "All"]
            ],
            deferRender: true,
            scrollY: '20rem',
            scrollX: true,
            scrollCollapse: true,
            scroller: true
        });
    };

    /*
     * 
     * edit_employee
     *@input emp_code
     *@parameter -
     *output employee edit
     *@author Ponprapai Atsawanurak 62160102
     *@Create Date 2564-04-10
     *@update Date 2564-05-12
     */

    function edit_employee(emp_code) {
        $("#Alert").html("");

        $.ajax({
            type: 'post',
            url: 'show_edit',
            dataType: "json",
            data: {
                emp_code: emp_code
            },

            success: function(json_data) {

                create_table_employee((json_data)['json_emp'], emp_code);
            }
        });

    }

    /*
     * confirm
     *@input emp_code
     *@parameter emp_code
     *output employee deleted
     *@author Preechaya Choosrithong 62160157
     *@Create Date 2564-04-11
     *@update Date 2564-05-12
     */
    function confirm(emp_code) {
        $('#DeleteModal').modal();

        $('#confirm_delete').click(function() {
            delete_emp(emp_code);
        });

    }
    /*
     * delete_emp
     * confirm
     *@input emp_code
     *@parameter emp_code
     *output employee deleted
     *@author Preechaya Choosrithong 62160157
     *@Create Date 2564-04-11
     *@update Date 2564-05-12
     */
    function delete_emp(emp_code) {
        $.ajax({
            type: 'post',
            url: 'delete_employee',
            dataType: "json",
            data: {
                emp_code: emp_code
            },
            success: function(json_data) {
                get_employees_information();
            },
        });
    }


    /*
     * Make table
     * create_edit_table
     *@input JSON_EMP, emp_code
     *@parameter -
     *output employee management table
     *@author Ponprapai Atsawanurak 62160102
     *@Create Date 2564-04-10
     *@update Date 2564-05-13
     */

    function create_table_employee(JSON_EMP, emp_code) {

        let status_edit = '';
        let admin_status = '';
        let admin_pass = '';
        let admin_pass_con = '';
        let modal_footer = '';
        let html_code = '';
        html_code += '<table id="Edit_table"  class="table table-hover">';
        html_code += '<thead class="thead-light">';
        html_code += '<tr>';
        html_code += '<th  width="1%"style="text-align: center;font-size: 20px;" >ID</th>';
        html_code += '<th  width="5%" style="text-align: center;font-size: 20px;" >Name</th>';
        html_code += '<th  width="5%" style="text-align: center;font-size: 20px;" >LastName</th>';
        html_code += '</tr>';
        html_code += '</thead>';
        html_code += '<tbody>';
        html_code += '<tr>';
        html_code += '<td style="text-align: center;font-size: 20px; height: 30px;">' + JSON_EMP['emp_code'] + '</td>';
        html_code += '<td style="font-size: 16px;" >' +
            "<input class='form-control' type='text' id = 'firstname' style='width: 100%;  text-align: center;font-size:20px;height: 30px; ' value='" +
            JSON_EMP[
                'emp_firstname'] + "'placeholder='Enter Name' >";
        html_code += '<td style="font-size: 16px;" >' +
            "<input type='text' class='form-control' id = 'lastname' style='width: 100%; text-align: center;font-size:20px;height: 30px;' value='" +
            JSON_EMP[
                'emp_lastname'] + "'placeholder='Enter Last name'>";
        html_code += '</tr>';
        html_code += '</tbody>';
        html_code += '</table>';

        if (JSON_EMP['emp_username'] != null && JSON_EMP['emp_password'] != null) {
            status_edit += "<input type ='checkbox' onclick='check_admin()' id ='edit_status' checked >";
        } else {
            status_edit += "<input type ='checkbox' onclick='check_admin()' id ='edit_status' >";
        }




        modal_footer +=
            '<button type="button" class="button-save" id="save" onclick="save_edit_employee(' +
            JSON_EMP[
                'emp_code'] + ')"> Save change </button>';
        //ปุ่มปิด modal
        modal_footer +=
            '<button type="button" class="button-cancel" data-dismiss="modal" id="close" onclick="reset()"> Close </button>';

        $('#EDIT').html(html_code);
        $('#status').html(status_edit);

        check_admin();
        if (JSON_EMP['emp_username'] == null) {
            admin_status +=
                "Username : <a size='10' id='username'><input type = 'text'  class='form-control' id = 'admin_username' style='width: 92%;margin-left:30px;margin-top:10px;margin-bottom:20px;margin-left:30px' value='' placeholder='Please enter Username'></a>";
        } else {
            admin_status +=
                "Username : <a size='10' id='username'><input type = 'text'  class='form-control 'id = 'admin_username' style='width:100%;max-width:92%;margin-left:30px;margin-top:10px;margin-bottom:20px;margin-left:30px ' value = '" +
                JSON_EMP['emp_username'] + "' placeholder='Please enter Username'></a>";

        }

        admin_pass +=
            "Password : <a size='10' id='password'><input type = 'password'  class='form-control' id = 'admin_pass'  style='width: 92%;margin-left:30px;margin-top:10px;margin-bottom:20px;margin-right:30px' value = '' placeholder='Please enter Password'></a>";
        admin_pass_con +=
            "Confirm Password : <a size='10' ><input type = 'password'  class='form-control' id = 'admin_pass_new_con' style='width: 92%;margin-left:30px;margin-top:10px;margin-left:30px' value = '' placeholder='Please enter Confirm Password' ></a> ";

        $('#user_admin').html(admin_status);
        $('#user_password').html(admin_pass);
        $('#user_password_con').html(admin_pass_con);
        $('#modal_footer').html(modal_footer);
        User_id = $('#admin_username').val();
        Pass = $('#admin_pass').val();

        if (JSON_EMP['emp_password'] != null) {
            Pass = JSON_EMP['emp_password'];

        }


    }


    /*
     * Check admin 
     * check_admin
     *@input -
     *@parameter -
     *output employee table
     *@author Wachiravit Pramjit 62160010
     *@Create Date 2564-05-13
     *@update Date 2564-05-13
     */

    function check_admin() {

        if (document.getElementById("edit_status").checked == true) {
            reset();
            $('#user_admin').show();
            $('#user_password').show();
            $('#user_password_con').show();
        } else if (document.getElementById("edit_status").checked == false) {
            $('#user_admin').hide();
            $('#user_password').hide();
            $('#user_password_con').hide();
            reset();
            $('#admin_pass_new_con').val('');
            $('#admin_username').val('');
            $('#admin_pass').val('');
        }
    }

    /*
     * reset data tag input 
     * reset
     *@input -
     *@parameter -
     *output employee table
     *@author Wachiravit Pramjit 62160010
     *@Create Date 2564-05-13
     *@update Date 2564-05-13
     */

    function reset() {

        $('#admin_username').val(User_id);
        $('#admin_pass').val('');
    }

    /*
     * reset data tag input 
     * reset_data
     *@input -
     *@parameter -
     *output employee table
     *@author Wachiravit Pramjit 62160010
     *@Create Date 2564-05-13
     *@update Date 2564-05-13
     */
    function reset_data() {
        $('#id').val('');
        $('#name').val('');
        $('#lname').val('');
        $('#pfatf2').html("");

    }

    /*
     * save_edit
     * save_edit_employee
     *@input  emp_code
     *@parameter -
     *output-
     *@author Ponprapai Atsawanurak 62160102
     *@Create Date 2564-04-10
     *@update Date 2564-05-13
     */

    function save_edit_employee(emp_code) {
        let check_pass = true;
        let firstname = $('#firstname').val();
        let lastname = $('#lastname').val();
        let user_id = '';
        let password = '';
        let con_pass = '';

        user_id = $('#admin_username').val();
        password = $('#admin_pass').val();
        con_pass = $('#admin_pass_new_con').val();

        let error = false;
        let not_equal = false;

        if ((document.getElementById("edit_status").checked == true && con_pass == '' || password == '' || user_id == '')) {
            error = true;
        }
        if (con_pass != password && document.getElementById("edit_status").checked == true) {
            not_equal = true;

        }


        if ($('#admin_pass').val() == '' && Pass != '') {
            password = Pass;
            check_pass = false;
        }
        let delete_user = false;
        if (document.getElementById("edit_status").checked != true) {
            delete_user = true;
            error = false;
            not_equal = false;
        }


        if (error == false && (firstname != "" && lastname != "") && not_equal == false) {
            $("#save").attr("disabled", "disabled");
            $.ajax({
                type: 'post',
                url: 'update_employee',
                dataType: "json",
                data: {
                    firstname: firstname,
                    lastname: lastname,
                    emp_code: emp_code,
                    user_id: user_id,
                    password: password,
                    check_pass: check_pass,
                    delete_user: delete_user
                },
                cache: false,
                success: function(json_data) {

                    $('#EditModal').modal('hide');
                    get_employees_information();
                }
            });
        } else if (error == true) {
            $("#Alert").html("* Please fill all the field !");

        } else if (not_equal == true) {
            $("#Alert").html("* Password not equal !");
        }

    }



    /*
     * Make table
     * confirm
     *@input get_employees_information
     *@parameter -
     *output employee table
     *@author Thanisorn thumsawanit 62160088
     *@Create Date 2564-04-11
     *@update Date 2564-05-12
     */

    function get_employees_information() {
        $.ajax({
            method: "POST",
            url: 'employees_list_show',
            dataType: 'JSON',
            data: {
                //emp_id: emp_id
            },
            success: function(json_data) {

                create_table(json_data['arr_emp']);
            }
        });
    }
</script>