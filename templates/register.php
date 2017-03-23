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
                            <input type="text" name="kik_username" placeholder="Kik Username" class="form-control login-control">
                        </div>

                        <div class="form-group">
                            <select class="form-control input-lg" name="user_gender">
                                <option value="1" title="Male">Male</option>
                                <option value="2" title="Female">Female</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <input type="email" name="user_email" placeholder="Email" class="form-control login-control">
                            <small><i>That email will be shared with people you like, so their will be able to contact you back if their like you as well.</i></small>
                        </div>
                        <div class="form-group">
                            <input type="password" name="user_pass" placeholder="Password" class="form-control login-control">
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