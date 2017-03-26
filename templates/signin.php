    <div class="home hero" style="padding: 37px;">
        <div class="logo">
            <a href="<?php echo site_url();?>">kik or not</a>
        </div>
        <div class="menu">
            <a href="<?php echo site_url('create');?>">Create an account</a>
        </div>
    </div>
    <div class="createAcc">
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="panel">
 <?php if(isset($_GET['msg'])) { echo '<div class="alert alert-success">Signup success! You can now login with your details</div>'; } ?>
                    <h4>Sign in!</h4>
                    <hr />
                    <?php if (!empty($error)): ?>
                        <p class="red"><?php echo $error; ?></p>
                    <?php endif; ?>
                    <form class="form form-signIn" action="<?php echo site_url('signin'); ?>" method="post">
                        <div class="form-group">
                            <input type="email" name="user_email" class="form-control login-control" placeholder="Email">
                        </div>
                        <div class="form-group">
                            <input type="password" name="user_password" class="form-control login-control" placeholder="Password">
                        </div>
                        <div class="clearfix">
                            <input type="submit" name="signIn" class="btn btn-signin pull-left" value="Sign in">
                            <a href="<?php echo site_url('create');?>" class="btn pull-right btn-forgot">Not Registered?</a><br />
                        </div>
                      <div class="clearfix">
                            <a href="<?php echo site_url('forgot');?>" class="btn pull-right">Forgot Password?</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>