<?php
/*
* v_performance_result_ajax
* Display Performance results
* @input Array of emp (arr_emp) , Array of Chart (CHART)
* @output Input form of date and/or employee id
* @author Wachiravit Pramjit 62160010
* @Create Date 2564-04-19
*/
?>


<head>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
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
<br>
<br>
<br>
<br>
<br>
<br>

<div class="container-fluid">
    <p class="header-text">&nbsp;&nbsp;Performance Results</p>
    <div class="shadow card">
        <div class="border-0 card-header">
            <!-- <p class="header-text">Performance Results</p> -->
            <br>
            <!-- /* Start Form input of position */ -->
            <form>
                <!-- <div class="row"> -->
                Employee ID : <input type="text" name="emp_id" id="emp_id" placeholder="Please enter Employee ID">
                &nbsp;Choose Date :
                <input type="text" class="calendar-grid-58" name="daterange" id="date" placeholder="Choose Date" value="<?php echo get_date_mouth() . '-01 - ' . get_date_today() ?>">
                &nbsp;<input type="button" id="submit" name="submit" value="Search" class="btn btn-info btn-fill pull-right">
                <!-- <br> -->
            </form>
            <!-- /* End Form input of position */ -->
            <p></p>
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
                    <div class="row" style="width: 100%;">
                        <div class="col">
                            <h3 class=" mb-0 text-white" style="margin-top: 7px;">Performance Results Table</h3>
                        </div>
                        <div class="col" style="float: right;">
                            <!-- <div class=" nav nav-pills justify-content-end" style="margin-top: 25px;"> -->
                            <button class="btn btn-white" style="float: right;" id="export">
                                <span class="fas fa-download mr-2"></span> Export Excel File
                            </button>
                            <!-- </div> -->
                        </div>
                    </div>
                </div>
                <div class="table-responsive" style="margin-top: 20px;" id="table_count">
                </div>
            </div>
        </div>
    </div>
</div>




<div class="container-fluid">
    <div class="card">
        <br>
        <br>
        <div class="container">
            <div id="chart">
                <div class="card table" style=" height :550px; background-color: #e2eafc;">
                    <div class="card-header bg-transparent">
                        <div class="row align-items-center">
                            <div class="col">
                                <h6 class="text-black text-uppercase ls-1 mb-1">Overview</h6>
                                <h5 class="h3 text-black mb-0" id="title">Number of days to work</h5>
                            </div>
                            <div class="col">
                                <div class="nav nav-pills justify-content-end">
                                    <div class="dropdown" data-toggle="chart">
                                        <button class="filter btn btn-default  dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false" id="work">
                                            Work<span class="caret"></span></button>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" onclick="check_chart('Number of days to work')">
                                                    Work</a>
                                            </li>
                                            <li><a class="dropdown-item" onclick="check_chart('Number of days that are late')">
                                                    Late</a>
                                            </li>

                                            <li><a class="dropdown-item" onclick="check_chart('Number of days not signing in')">
                                                    Not sign in
                                                </a></li>
                                            <li><a class="dropdown-item" onclick="check_chart('Number of days not signing out')">
                                                    Not sign out
                                                </a></li>
                                            <li><a class="dropdown-item" onclick="check_chart('Number of days Leave early')">
                                                    Leave early
                                                </a></li>
                                    </div>
                                    </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <!-- Chart -->
                        <div class="chart" style="width:100%;max-width:1000px;height:100%;max-height:1000px;">
                            <div class="chartjs-size-monitor">
                                <div class="chartjs-size-monitor-expand">
                                    <div class="">
                                    </div>
                                </div>
                                <div class="chartjs-size-monitor-shrink">
                                    <div class="">
                                    </div>
                                </div>
                            </div>
                            <!-- Chart wrapper -->
                            <canvas id="myChart_working" style="width:100%;max-width:1000px;height:100%;max-height:567px;"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br><br>

    </div>
</div>

<br>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
<script>
    var date_first = "";
    var date_secon = "";
    var emp_id = "";
    date_secon = $('#date').val().substring(13, 23);
    date_first = $('#date').val().substring(0, 10);
    var clear;

    $(document).ready(function() {

        $(function() {
            $('#date').daterangepicker({
                opens: 'left',
                cancelButtonClasses: "cancel",
                autoUpdateInput: false,
                applyButtonClasses: "button-apply",
                locale: {
                    format: "YYYY-MM-DD",
                    cancelLabel: 'Clear'
                }
            }, function(start, end) {
                date_first = start.format('YYYY-MM-DD');
                date_secon = end.format('YYYY-MM-DD');
            });
            $('#date').on('cancel.daterangepicker', function(ev, picker) {
                if ($('#date').val() != '') {
                    clear = $('#date').val();
                }
                $('#date').val('');
                date_first = '';
                date_secon = '';
            });
            $('#date').on('apply.daterangepicker', function(ev, picker) {
                if ($('#date').val() == '' && date_first == "" && date_secon == "") {
                    date_first = clear.substring(0, 10);
                    date_secon = clear.substring(13, 23);
                    $('#date').val(date_first + ' - ' + date_secon);
                } else {
                    $('#date').val(date_first + ' - ' + date_secon);
                }
            });


            // restore date value
            if ($('#date').val() == '') {
                $('#date').val('');
                $('#date').val(date_first + ' - ' + date_secon);
            } else {
                $('#date').val(date_first + ' - ' + date_secon);
            }
        });

        $("#submit").click(function() {
            emp_id = $('#emp_id').val();
            get_data();
        });

        emp_id = $('#emp_id').val();
        get_data();

        date_secon = $('#date').val().substring(13, 23);
        date_first = $('#date').val().substring(0, 10);
        $("#export").click(function() {
            if (emp_id == "") {
                emp_id = true;
            }
            if (date_first == "") {
                date_first = true;
            }
            if (date_secon == "") {
                date_secon = true;
            }

            window.location.href = 'export_excel/' + date_first + '/' + date_secon + '/' + emp_id;

        });
    });







    /*
     * get data for table
     * get_data
     *@input date_first,date_secon,emp_id
     *@parameter -
     *@output data json
     *@author Wachiravit Pramjit 62160010
     *@Create Date 2564-04-25
     *@update Date 2564-05-05
     */
    function get_data() {
        check_chart();
        $.ajax({
            type: 'post',
            url: 'show_table_by_date',
            data: {
                date_first: date_first,
                date_secon: date_secon,
                emp_id: emp_id
            },
            dataType: 'json',
            success: function(json_data) {

                create_table((json_data)["arr_emp"]);
            },
            error: function() {
                alert("wow");
            }
        });

    };


    /*
     * Make table
     * create_table
     *@input - 
     *@parameter array_count_employee
     *@output table
     *@author Wachiravit Pramjit 62160010
     *@Create Date 2564-04-25
     *@update Date 2564-05-05
     */
    function create_table(array_count_employee) {
        let check = false;
        let html_code = "";
        html_code += '<table id="All_member_table" class="table table-hover">';
        html_code += '<thead class="thead-light" style="text-align: center;">';
        html_code += '<tr>';
        html_code += '<th style="font-size: 20px;">No </th>';
        html_code += '<th style="font-size: 20px;">ID </th>';
        html_code += '<th style="font-size: 20px;">Name </th>';
        html_code += '<th style="font-size: 20px;">work</th>';
        html_code += '<th style="font-size: 20px;">late</th>';
        html_code += '<th style="font-size: 20px;">not sign in</th>';
        html_code += '<th style="font-size: 20px;">not sign out</th>';
        html_code += '<th style="font-size: 20px;">Leave early</th>';

        html_code += '</tr>';
        html_code += '</thead>';
        html_code += '<tbody>';
        array_count_employee.forEach((row, index) => {
            html_code += '<tr>';
            html_code += '<td style="font-size: 20px;"width="2%"><center>' + (index + 1) + '</center></td>';
            html_code += '<td style="font-size: 20px;text-align: center;" >' + (row["emp_code"]) + '</td>';
            html_code += '<td style="font-size: 20px;">' + (row["emp_firstname"]) + ' ' + (row["emp_lastname"]) +
                '</td>';
            html_code += '<td style="font-size: 20px;text-align: center;" >' + (row["Work_Time"]) + '</td>';
            html_code += '<td style="font-size: 20px;text-align: center;" >' + (row["Late"]) + '</td>';
            html_code += '<td style="font-size: 20px;text-align: center;" >' + (row["No_Time_Stamp"]) + '</td>';
            html_code += '<td style="font-size: 20px;text-align: center;" >' + (row["No_Time_Stamp_Out"]) + '</td>';
            html_code += '<td style="font-size: 20px;text-align: center;" >' + (row["Leave_early"]) + '</td>';
            html_code += '</tr>';
            check = true;
        });
        html_code += '</tbody>';
        html_code += '</table>';

        $('#table_count').html(html_code);
        convert_datatable('All_member_table', check);
    };



    /*
     * Check data chart
     * create_table
     *@input - 
     *@parameter titles
     *@output data_if for make chart
     *@author Wachiravit Pramjit 62160010
     *@Create Date 2564-04-27
     *@update Date 2564-04-27
     */

    function check_chart(titles = "Number of days to work") {
        let data_if = "working";
        if (titles == "Number of days to work") {
            data_if = "working";
            document.getElementById("title").innerHTML = "Number of days to work";
            document.getElementById("work").innerHTML = "Work";
        } else if (titles == "Number of days that are late") {
            data_if = "late";
            document.getElementById("title").innerHTML = "Number of days that are late";
            document.getElementById("work").innerHTML = "Late";
        } else if (titles == "Number of days not signing in") {
            data_if = "no_timestamp";
            document.getElementById("title").innerHTML = "Number of days not signing in";
            document.getElementById("work").innerHTML = "Not sign in";
        } else if (titles == "Number of days not signing out") {
            data_if = "no_timestamp_out";
            document.getElementById("title").innerHTML = "Number of days not signing out";
            document.getElementById("work").innerHTML = "Not sign out";
        } else if (titles == "Number of days Leave early") {
            data_if = "Leave_early";
            document.getElementById("title").innerHTML = "Number of days Leave early";
            document.getElementById("work").innerHTML = "Leave early";
        }
        chart(data_if);


    }

    /*
     * make Check 
     * chart
     *@input - 
     *@parameter data_if
     *@output chart 
     *@author Wachiravit Pramjit 62160010
     *@Create Date 2564-04-28
     *@update Date 2564-05-11
     */
    function chart(data_if = "working") {

        // //ajax then
        $.ajax({
            type: 'post',
            url: 'get_data_chart',
            data: {
                date_first: date_first,
                date_secon: date_secon
            },
            dataType: 'json',

            success: function() {

            }
        }).then(function(json_data) {

            let array_date = [];
            let array_data = [];
            if (data_if == "working") {
                json_data['CHART'].forEach((row, index) => {
                    array_date.push(row['tsm_date']);

                    array_data.push(row['Work_Time']);
                });
            } else if (data_if == 'late') {
                json_data['CHART'].forEach((row, index) => {
                    array_date.push(row['tsm_date']);

                    array_data.push(row['Late']);
                });
            } else if (data_if == 'no_timestamp') {
                json_data['CHART'].forEach((row, index) => {
                    array_date.push(row['tsm_date']);

                    array_data.push(row['No_Time_Stamp']);
                });
            } else if (data_if == 'no_timestamp_out') {
                json_data['CHART'].forEach((row, index) => {
                    array_date.push(row['tsm_date']);

                    array_data.push(row['No_Time_Stamp_Out']);
                });
            } else if (data_if == 'Leave_early') {
                json_data['CHART'].forEach((row, index) => {
                    array_date.push(row['tsm_date']);

                    array_data.push(row['Leave_early']);
                });
            }
            let Max = 10;
            array_data.forEach((row, index) => {

                if (Max < row && row > 10) {
                    Max = parseInt(row);
                }
            });
            if (Max > 10) {
                Max += 2;
            }


            let xValues = array_date;
            new Chart("myChart_working", {
                type: "line",
                data: {
                    labels: xValues,
                    datasets: [{
                        data: array_data,
                        borderColor: "red",
                        fill: true
                    }]
                },
                options: {
                    legend: {
                        display: false
                    },
                    scales: {
                        xAxes: [{
                            display: true,
                            scaleLabel: {
                                display: true,
                                labelString: 'Days',
                                fontColor: '#000000',
                                fontSize: 20
                            },
                            ticks: {
                                fontColor: "black",
                                fontSize: 14

                            }
                        }],
                        yAxes: [{
                            display: true,
                            scaleLabel: {
                                display: true,
                                labelString: 'Number of People',
                                fontColor: '#000000',
                                fontSize: 20
                            },
                            ticks: {
                                fontColor: "black",
                                fontSize: 14,
                                min: 0,
                                max: Max,
                                stepSize: 1
                            },

                        }]
                    }
                }
            });
        }); //ส่วนทำงาน
    }
</script>