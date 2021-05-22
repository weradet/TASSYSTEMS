<!-- 
    topbar
    @author Natsuda Kuhasak 62160085
    @update Date 2564-04-21 -->


<!-- Security (ดัก path ไม่ให้เข้าถึงโดยตรง) -->
<?php
if (!$this->session->has_userdata("username")) {
    $path = site_url() . "Login_admin";
    header("Location: " . $path);
    exit();
}
?>


<style>
    a {
        color: #FFFFFF;
        margin-right: 10px;
    }

    a:hover {
        color: #78F2B3;
    }

    .navbar {

        font-family: 'Varela Round', sans-serif;
    }
</style>

<nav class="fixed-top" id="panel">
    <!-- Topnav -->
    <nav class="navbar navbar-top navbar-expand navbar-dark border-bottom " style="background-color: #1f2421;">
        <div class="container-fluid">
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <h1>
                            <a href="<?php echo base_url(); ?>" style="color: white; border-left: 4px solid #18d26e; padding-left: 10px;">
                                IV Soft
                            </a>
                        </h1>
                    </li>
                </ul>
                <!-- Admin bar -->
                <div class="navbar-nav align-items-center  ml-auto ml-md-auto ">
                    <div class="nav-link pr-0">
                        <div class="media align-items-center">
                            <span class="avatar avatar-sm rounded-circle">
                                 <i class="fas fa-user"></i>
                            </span>
                            <div class="media-body ml-2 d-lg-block">
                                <span class="mb-0 text-sm font-weight-bold">
                                    <?php echo $this->session->userdata("Admin_name") . " " . $this->session->userdata("Admin_lastname"); ?>
                                </span>
                                <br>
                                <a class="badge badge-pill btn btn-outline-danger btn-sm" href="<?php echo base_url() . 'Login_admin/logout' ?>">Logout</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>
    <!-- navbar -->
    <nav class="navbar navbar-top navbar-expand-md navbar-dark border-bottom " style="background-color: #6c757d;">
        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="navbar-nav">
                <li class="nav-item nav-link">
                    <a class="" href="<?php echo base_url() . 'Dashboard/Dashboard' ?>">Dashboard</a>
                </li>
                <li class="nav-item nav-link">
                    <a class="" href="<?php echo base_url() . 'Clockinginformation/Search_emp_timestamp/' ?>">Clocking
                        Information</a>
                </li>
                <li class="nav-item nav-link">
                    <a class="" href="<?php echo base_url() . 'Workstatus/Workstatus_output_ajax/show_list' ?>">Work
                        Status</a>
                </li>
                <li class="nav-item nav-link">
                    <a class="" href="<?php echo base_url() . 'Performance/Performance_result_ajax/' ?>">Performance
                        Results</a>
                </li>
                <li class="nav-item nav-link">
                    <a class="" href="<?php echo base_url() . 'employees_Management/Employees_list/' ?>">Employee
                        Management</a>
                </li>
            </ul>
        </div>
    </nav>
</nav>
<br>