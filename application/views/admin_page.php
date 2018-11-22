<?php
if (isset($this->session->userdata['logged_in'])) {
    $username = ($this->session->userdata['logged_in']['username']);
} else {
    header("location: login");
}
echo $username;
?>
<section class="container">
    <div class="row">
        <div class="col-lg-12 col-md-10 mx-auto">
            <div class="clearfix">
                <a class="btn btn-primary float-right" href="/saebom/user/logout">LOGOUT</a>
            </div>
        </div>
    </div>
</section>
