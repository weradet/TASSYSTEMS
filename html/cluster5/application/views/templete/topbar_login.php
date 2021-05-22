<!-- 
    topbar_admin
    @author Natsuda Kuhasak 62160085
    @update Date 2564-04-21 -->

<?php
if ($this->session->has_userdata("username")) {
    $path = site_url() . "Dashboard/Dashboard";
    header("Location: " . $path);
    exit();
}
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
</style>

<div class="main-content" id="panel">
    <!-- Topnav -->
    <nav class="navbar navbar-top navbar-expand navbar-dark border-bottom" style="background-color: #1f2421;">
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
            </div>
        </div>
    </nav>
</div>