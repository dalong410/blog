<section class="login-block">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-10 mx-auto login-sec">
                <h2 class="text-center">Admin Login Now</h2>
                <?= form_open('user/user_login_process', array('id' => 'user_login_process', 'name' => 'user_login_process')) ?>
                <?php
                echo "<div class='error_msg'>";
                if (isset($error_message)) {
                    echo $error_message;
                }
                echo validation_errors();
                echo "</div>";
                ?>
                    <div class="form-group">
                        <label for="exampleInputEmail1" class="text-uppercase">Username</label>
                        <input type="text" id="username" name="username" class="form-control" placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1" class="text-uppercase">Password</label>
                        <input type="password"  id="password" name="password" class="form-control" placeholder="">
                    </div>
                    <div class="form-check">
                        <button type="submit"  value=" Login " name="submit" class="btn btn-login float-right">Submit</button>
                    </div>
                <?= form_close() ?>
            </div>
        </div>
</section>