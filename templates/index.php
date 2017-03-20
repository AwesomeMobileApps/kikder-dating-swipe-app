<?php echo User::getAvatar('kik');?>
<nav class="navbar navbar-inverse navbar-static-top nav-trans">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#"><img src="assets/img/logo.png"></a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <form class="navbar-form navbar-right">
            <a href="/signin" class="btn btn-success btn-signin">Login</a>
          </form>
        </div><!--/.navbar-collapse -->
      </div>
    </nav>
    <div class="home hero">
<div class="container">

        <div class="hero-text">
            <h1>The best way to find kik users!</h1>
            <p>Play hot-or-not & browse kik usernames</p>
            <a href="<?php echo site_url('create');?>" class="btn btn-hot">Create an account!</a>
        </div>
    </div>
</div>
    <div class="home_about">
        <div class="container">
            <div class="text-center">
                <h2></h2>
                <p>Swipe right if you'd Kik, or left if you will not!</p><br />
                <small>Desktop users can use swipe with the mouse!</small>
            </div>

        </div>
    </div>
    <div class="home_stats">
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-md-offset-4">
                <div class="row">
                <div class="col-md-6">
                <span class="num"><?php echo number_format($users);?></span>
                Kik Users
                </div>
                <div class="col-md-6">
                <span class="num"><?php echo number_format($swipes);?></span>
                Swipes
                </div>
            </div>
            </div>
            </div>
        </div>
    </div>
<div class="home_latest">
        <div class="container">
<h2>Latest Users</h2>
            <?php foreach($recent as $luser) {
echo '<div class="avatar"><img src="' . $luser->user_picture  . '"></div>';

}

?>
            </div>
            </div>
        </div>
    </div>
    <!-- Login Modal -->
    <div class="modal fade" id="signInModal" tabindex="-1" role="dialog" aria-labelledby="signInModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Sign in</h4>
                </div>
                <div class="modal-body">
                    <form class="form form-signIn" action="<?php echo site_url(); ?>/signin" method="POST">
                        <div class="form-group">
                            <input type="text" name="user_email" class="form-control login-control" placeholder="Email">
                        </div>
                        <div class="form-group">
                            <input type="password" name="user_password" class="form-control login-control" placeholder="Password">
                        </div>
                        <div class="clearfix">
                            <input type="submit" name="signIn" class="btn btn-signin pull-left" value="Sign in">
                            <a href="<?php echo site_url('forgot');?>" class="btn pull-right btn-forgot">Forgot Password?</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

