<div class="home hero">
    <div class="logo">
        <a href="<?php echo site_url(); ?>">kik or not</a>
    </div>
    <div class="menu">
        <a href="<?php echo site_url('signin'); ?>">Sign in</a>
    </div>
</div>
<div class="createAcc">
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="panel">
                    <h4>We sent a new password!</h4>
                    <hr/>
                    <?php echo $error; ?>
                    <?php echo $success; ?>
                </div>
            </div>
        </div>
    </div>
</div>