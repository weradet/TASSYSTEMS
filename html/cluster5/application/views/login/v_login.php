<!-- 
    v_login
    Show Login
    @author Natsuda Kuhasak 62160085
    @update Date 2564-04-21 -->

<!-- header -->
<?php
  $warning = $warning ?? '';
?>

<div class="header py-5 py-lg-5">
    <div class="container">
        <div class="header-body text-center mb-7">
            <div class="justify-content-center row">
                <div class="col-md-6 col-lg-5">
                    <h1 class="text-white">Time Adtendance System!</h1>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Page Login -->
<div class="main-content container mt--8 pb-5">
    <div class="row justify-content-center">
        <div class="col-lg-5 col-md-7">
            <div class="card bg-secondary border-0 mb-0">
                <div class="card-body px-lg-5 py-lg-5">
                    <div class="text-center text-muted mb-4">
                        <h1>Admin Login</h1>
                    </div>

                    <form role="form" action="<?php echo site_url() . 'Login_admin/input_login_form'; ?>" method="POST">
                        <div class="form-group mb-3">
                            <div class="input-group input-group-merge input-group-alternative">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ni ni-single-02"></i></span>
                                </div>
                                <input class="form-control" placeholder="Admin ID" type="text" name="username">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="input-group input-group-merge input-group-alternative">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                                </div>
                                <input class="form-control" placeholder="Password" type="password" name="password">
                            </div>
                        </div>
                        <span style="color: red;">
                        <?php 
                            if($warning != NULL){
                                echo $warning;
                            }
                        ?>
                        </span>

                        <div class="text-center">
                            <button type="submit" class="btn btn-primary my-4" id="signin" name="signin">Log in</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>