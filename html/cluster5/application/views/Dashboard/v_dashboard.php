<header>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
</header>
<br>
<br>
<br>
<br>
<br>
<br>
<div class="container-fluid">
    <p class="header-text">&nbsp;&nbsp;Dashboard</p>
    <div class="shadow card">
        <div class="border-0 card-header">

            <h1 style="margin-left: 4px;" id="date_today_show"></h1>
            <h2></h2>
            <!-- Card stats -->
            <div class="row">
                <div class="col-xl-3 col-md-6">
                    <div class="card card-stats">
                        <!-- Card body -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title text-uppercase text-muted mb-0">Today Timestamp</h5>
                                    <span class="h2 font-weight-bold mb-0" id="today_timestamp"></span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-gradient-green text-white rounded-circle shadow">
                                        <i class="ni ni-like-2"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card card-stats">
                        <!-- Card body -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title text-uppercase text-muted mb-0">Today late</h5>
                                    <span class="h2 font-weight-bold mb-0" id="today_late"></span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-gradient-red text-white rounded-circle shadow">
                                        <i class="ni ni-user-run"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6">
                    <div class="card card-stats">
                        <!-- Card body -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title text-uppercase text-muted mb-0">Today Sign In</h5>
                                    <span class="h2 font-weight-bold mb-0" id="today_in"></span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-gradient-orange text-white rounded-circle shadow">
                                        <i class="ni ni-check-bold"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6">
                    <div class="card card-stats">
                        <!-- Card body -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title text-uppercase text-muted mb-0">Today Sign Out</h5>
                                    <span class="h2 font-weight-bold mb-0" id="today_out"></span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-gradient-info text-white rounded-circle shadow">
                                        <i class="ni ni-fat-delete"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- chart -->
<div class="container-fluid">
    <div class="card">
        <br>
        <br>
        <div class="container">
            <div id="chart">
                <div class="card table" style="height :550px; background-color: #e2eafc">
                    <div class="card-header bg-transparent">
                        <div class="row align-items-center">
                            <div class="col">
                                <h6 class="text-black text-uppercase ls-1 mb-1">Dashboard</h6>
                                <h3 class="text-black mb-0" id="title">Show Time Attendance Last 15 Days </h3>
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
                            <canvas id="chart_dashboard"
                                style="width:100%;max-width:1000px;height:100%;max-height:567px;"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br><br>
    </div>
</div>

<div class="container-fluid table-show">
    <div class="row">
        <div class="col">
            <div class="card">
                <!-- Card header -->
                <div class="card-header card-header-bg border-0">
                    <h3 class="mb-0 text-white">Show Time Attendance Last 15 Days Table</h3>
                </div>
                <div class="table-responsive" style="margin-top: 20px;" id="table_count">


                </div>
            </div>
        </div>
    </div>
</div>


<script>
$(document).ready(function() {

    MyChart(); //cal function chart
    get_data_timestamp_ajax();
    get_data_timestamp_card();
    show_date_today();
});
/*
 * show_date_today
 * Show date today 
 *@input -
 * output  time 
 *@author Weradet Nopsombun 62160110
 *@Create Date 2564-05-04
 */

function show_date_today() {

    let monthNames = ["January", "February", "March", "April", "May", "June",
        "July", "August", "September", "October", "November", "December"
    ];
    let today = new Date();
    let year_now = today.getFullYear();
    let day_now = today.getDate();

    day_now = checkTime(day_now);

    $("#date_today_show").text(year_now + " " + monthNames[today.getMonth()] + " " + day_now);

    setTimeout(show_date_today, 1000);


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
 * Function : get_data_timestamp_ajax
 * get data to display table
 * @input -
 * @author Sjita Maneechot 62160114
 * @Create Date 2564-05-10
 */

function get_data_timestamp_ajax() {
    $.ajax({
        type: 'post',
        dataType: "JSON",
        url: 'Dashboard/show_table_timestamp_ajax',
        success: function(json_data) {
            //  console.log(json_data);
            create_table(json_data['json_member']);
        }
    });

}



/*
 * get_data_timestamp_card
 * get data to display gard
 *@input -
 * output  time 
 *@author Weradet Nopsombun 62160110
 *@Create Date 2564-05-04
 */
function get_data_timestamp_card() {
    $.ajax({
        type: 'post',
        url: 'Dashboard/get_data_card_dashboard_ajax',
        dataType: "JSON",
        success: function(json_data) {
            // console.log(json_data);

            $("#today_timestamp").text(json_data[0].Work_Time);
            $("#today_late").text(json_data[0].Late);
            $("#today_in").text(json_data[0].TodaySigingin);
            $("#today_out").text(json_data[0].Time_Stamp_out);
        }
    });
    setTimeout(get_data_timestamp_card, 3000);
}

/*
 * Make Chart
 * chart
 *@input - 
 *@parameter -
 *@output chart 
 *@author Ponprapai Atsawanurak
 *@Create Date 2564-05-1
 *@update Date 2564-05-14
 */

function MyChart() {

    $.ajax({
        type: 'POST',
        url: 'Dashboard/chart_dashboard',

        success: function() {

            // console.log((json_dashboard));
        }
    }).then(function(json_dashboard) {
        let array_date = [];
        let array_data = [];
        let array_data2 = [];
        let array_data3 = [];
        let array_data4 = [];
        let array_data5 = [];

        json_dashboard['CHART'].forEach((row, index) => {
            array_date.push(row['tsm_date']);
            console.log(index, array_date);
            array_data.push(row['Work_Time']);
            array_data2.push(row['Late']);
            array_data5.push(row['Live_early']);
            array_data3.push(row['NotSigingin']);
            array_data4.push(row['NotSignigout']);


        });

        // alert('ooooo');

        let xValues = array_date;
        new Chart("chart_dashboard", {
            type: "line",
            data: {
                labels: xValues,
                datasets: [{
                    label: 'Worktime',
                    data: array_data,
                    borderColor: "#2a9d8f",
                    backgroundColor: "#2a9d8f",
                    fill: false,
                }, {
                    label: 'Late',
                    data: array_data2,
                    borderColor: "#f15152",
                    backgroundColor: "#f15152",
                    fill: false
                }, {
                    label: 'Leave Early',
                    data: array_data5,
                    borderColor: "#9d4edd",
                    backgroundColor: "#9d4edd",
                    fill: false
                }, {
                    label: 'Not Sign-in',
                    data: array_data3,
                    borderColor: "#ebb45c",
                    backgroundColor: "#ebb45c",
                    fill: false
                }, {
                    label: 'Not Sign-out',
                    data: array_data4,
                    borderColor: "#007ea7",
                    backgroundColor: "#007ea7",
                    fill: false
                }]
            },
            options: {
                legend: {
                    display: true,
                    labels: {
                        color: 'rgb(255, 99, 132)'
                    }
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
                            fontSize: 14,
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
                            stepSize: 1
                        }
                    }]
                }
            }
        });
    }); //ส่วนทำงาน

}



/*
 * Function : create_table
 *  display table
 * @input -
 * @author Sjita Maneechot 62160114
 * @Create Date 2564-05-02
 */
function create_table(arr_timestamp) {

    let html_code = '';


    html_code += '<table class="table table-hover" id="table_count_tb">';
    html_code += '<thead class="thead-light" style="text-align: center;">';
    html_code += '<tr>';
    html_code += '<th style="font-size: 20px;"> Date </th>';
    html_code += '<th style="font-size: 20px;">Work </th>';
    html_code += '<th style="font-size: 20px;">Late </th>';
    html_code += '<th style="font-size: 20px;">Leave early </th>';
    html_code += '<th style="font-size: 20px;">Not Sign in</th>';
    html_code += '<th style="font-size: 20px;">not sign out</th>';
    html_code += '</tr>';
    html_code += '</thead>';
    html_code += '<tbody>';

    console.log(arr_timestamp);
    // /*
    arr_timestamp.forEach((row_stts) => {

        html_code += '<tr>';
        // html_code +='<td>' + (index_stts+1) + '</td>';
        html_code += '<td style="font-size: 20px; text-align: center;" >' + row_stts['tsm_date'] + '</td>';
        html_code += '<td style="font-size: 20px; text-align: center;" >' + row_stts['Work_Time'] + '</td>';
        html_code += '<td style="font-size: 20px; text-align: center;" >' + row_stts['Late'] + '</td>';
        html_code += '<td style="font-size: 20px; text-align: center;" >' + row_stts['Live_early'] + '</td>';
        html_code += '<td style="font-size: 20px; text-align: center;" >' + row_stts['NotSigingin'] + '</td>';
        html_code += '<td style="font-size: 20px; text-align: center;" >' + row_stts['NotSignigout'] + '</td>';

        html_code += '</tr>';

    });

    html_code += '</tbody>';

    html_code += '</table>';

    $('#table_count').html(html_code);
    $('#table_count_tb').dataTable({
        "bLengthChange": false,
        "lengthMenu": [
            [15],
            [15]
        ]
    });
}
</script>