<div class="home hero" style="padding: 37px;">
    <div class="logo">
        <a href="<?php echo site_url(); ?>">kik or not</a>
    </div>
    <div class="menu">
        <a href="<?php echo site_url('create'); ?>">Create an account</a>
    </div>
</div>

<div class="createAcc">
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="panel">
                    <h4>Forgot Password</h4>
                    <hr/>
                    <?php if (!empty($error)): ?>
                        <p class="red"><?php echo $error; ?></p>
                    <?php endif; ?>

                    <?php if (!empty($success)): ?>
                        <p class="green"><?php echo $success; ?></p>
                    <?php endif; ?>

                    <form class="form form-signIn" action="<?php echo site_url('forgot'); ?>" method="post">
                        <div class="form-group">
                            <input type="email" name="user_email" class="form-control login-control"
                                   placeholder="Email">
                        </div>
                        <div class="clearfix">
                            <input type="submit" name="forgot" class="btn btn-block btn-signin pull-left"
                                   value="Reset my password!">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>