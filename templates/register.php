    <div class="createAcc">
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="panel">
                    <h4><img src="assets/img/logo-dark.png"></h4>
                    <hr />
                    <?php echo $error; ?>
                    <form class="form" method="POST" action="<?php echo site_url('create');?>">
                        <div class="form-group">
                            <label for="kik">Kik Username:</label>
                            <input type="text" name="kik_username" class="form-control login-control">
                        </div>

                        <div class="form-group">
                            <label for="email">Your gender:</label>
<select class="form-control input-lg" name="user_gender">
<option value="1" title="Male">Male</option>
<option value="2" title="Female">Female</option>
</select>
                        </div>
                        <div class="form-group">
                            <label for="email">Your email:</label>
                            <input type="email" name="user_email" class="form-control login-control">
                        </div>
                        <div class="form-group">
                            <label for="password">Your password:</label>
                            <input type="password" name="user_pass" class="form-control login-control">
                        </div>
                        <div class="text-center"><div class="g-recaptcha" data-sitekey="6LeRGxcTAAAAAO_qGJGcQs6aPu8kbcELfIIlqBnA"></div></div>
                        <br />
                        <input type="submit" name="createAcc" value="Create my account!" class="btn btn-kik btn-block">
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>