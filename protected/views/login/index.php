<div class="main-container">
    <div class="main-content">
        <div class="row">
		 <div class="center">
                        <h2>

                            <!--<span class="red">Ace</span>-->
                            <span class="grey" id="id-text2"><i class="ace-icon fa fa-cogs"></i>Federal Gazette  and Law of Malaysia</span> <br/>
							<span class="grey" id="id-text2">Official Portal</span>
                        </h2>
                        <h4 class="blue" id="id-company-text">(Administration)</h4>
                    </div>
            <div class="col-sm-10 col-sm-offset-1">
                <div class="login-container">
                   

                    <div class="space-6"></div>

                    <div class="position-relative">
                        <div id="login-box" class="login-box visible widget-box no-border">
                            <div class="widget-body">
                                <div class="widget-main">
                                    <h4 class="header green lighter bigger">
                                        <i class="ace-icon fa fa-info-circle"></i>
                                        Please Enter Your Information
                                    </h4>

                                    <div class="space-6"></div>

                                    <!--<form method="post" action="index.php?r=login/handler">-->
                                    <?php
                                    $form = $this->beginWidget('CActiveForm', array(
                                        'id' => 'login-form',
                                        'enableClientValidation' => true,
                                        'clientOptions' => array('validateOnSubmit' => true,),
                                    ));
                                    ?>
                                    <fieldset>
                                        <label class="block clearfix">
                                            <span class="block input-icon input-icon-right">
                                                <?php echo $form->textField($model, 'username', array('class' => 'form-control', 'placeholder' => 'Email AGC', 'value' => '')); ?>
                                                <!--<input type="text" name="email" class="form-control" placeholder="Email AGC" >-->
                                                <i class="ace-icon fa fa-envelope"></i>
                                            </span>
                                            <?php echo $form->error($model, 'username', array('class'=>'text-danger', 'style'=>'font-size:13px')); ?>
                                            <?php
                                                //if (isset($_GET['error']) && $_GET['error'] == 1)
                                                //    echo '<p class="text-danger"><b>Email AGC cannot be blank</b></p>';  
//                                                if (isset($_GET['error']) && $_GET['error'] == 1)
//                                                    echo '<p class="text-danger">Email AGC cannot be blank</p>';
                                            ?>
                                        </label>

                                        <label class="block clearfix">
                                            <span class="block input-icon input-icon-right">
                                                <!--<input type="password" name="pwd" class="form-control" placeholder="Password" >-->
                                                <?php echo $form->passwordField($model, 'password', array('class' => 'form-control', 'placeholder' => 'Password', 'value' => '')); ?>
                                                <i class="ace-icon fa fa-lock"></i>
                                            </span>
                                            <?php echo $form->error($model, 'password', array('class'=>'text-danger', 'style'=>'font-size:13px')); ?>
                                            <?php
                                                //if (isset($_GET['error']) && $_GET['error'] == 1)
                                                //    echo '<p class="text-danger"><b>Password cannot be blank</b></p>';
//                                                if (isset($_GET['error']) && $_GET['error'] == 1)
//                                                    echo '<p class="text-danger">Invalid email AGC and password</p>';
                                                ?>
                                        </label>

                                        <div class="space"></div>
                                        <div class="clearfix">
                                            
                                            <!--<label class="inline">-->
                                                <?php echo $form->error($model, 'error', array('class'=>'text-danger width-105 pull-left', 'style'=>'font-size:13px')); ?>
<!--                                                <input type="checkbox" class="ace" />
                                                <span class="lbl"> Remember Me</span>-->
                                            <!--</label>-->

<!--                                            <button type="submit" class="width-35 pull-right btn btn-sm btn-primary"> 
                                                onclick="js:location.href='index.php?r=site/index'">
                                                <i class="ace-icon fa fa-key"></i>
                                                <span class="bigger-110">Login</span>
                                            </button>-->
                                            <?php echo CHtml::submitButton('Login', array('class' => 'width-35 pull-right btn btn-sm btn-primary')); ?>
                                        </div>
                                        <div class="space-4"></div>
                                    </fieldset>
                                    </form>
                                    <?php $this->endWidget(); ?>

                                    <!--<div class="social-or-login center">
                                            <span class="bigger-110">Or Login Using</span>
                                        </div>

                                        <div class="space-6"></div>

                                        <div class="social-login center">
                                            <a class="btn btn-primary">
                                                <i class="ace-icon fa fa-facebook"></i>
                                            </a>

                                            <a class="btn btn-info">
                                                <i class="ace-icon fa fa-twitter"></i>
                                            </a>

                                            <a class="btn btn-danger">
                                                <i class="ace-icon fa fa-google-plus"></i>
                                            </a>
                                        </div>-->
                                </div><!-- /.widget-main -->

                                <!--<div class="toolbar clearfix">
                                    <div>
                                        <a href="#" data-target="#forgot-box" class="forgot-password-link">
                                            <i class="ace-icon fa fa-arrow-left"></i>
                                            I forgot my password
                                        </a>
                                    </div>

                                    <div>
                                        <a href="#" data-target="#signup-box" class="user-signup-link">
                                            I want to register
                                            <i class="ace-icon fa fa-arrow-right"></i>
                                        </a>
                                    </div>
                                </div>-->
                            </div><!-- /.widget-body -->
                        </div><!-- /.login-box -->

                        <!--<div id="forgot-box" class="forgot-box widget-box no-border">
                            <div class="widget-body">
                                <div class="widget-main">
                                    <h4 class="header red lighter bigger">
                                        <i class="ace-icon fa fa-key"></i>
                                        Retrieve Password
                                    </h4>

                                    <div class="space-6"></div>
                                    <p>
                                        Enter your email and to receive instructions
                                    </p>

                                    <form>
                                        <fieldset>
                                            <label class="block clearfix">
                                                <span class="block input-icon input-icon-right">
                                                    <input type="email" class="form-control" placeholder="Email" />
                                                    <i class="ace-icon fa fa-envelope"></i>
                                                </span>
                                            </label>

                                            <div class="clearfix">
                                                <button type="button" class="width-35 pull-right btn btn-sm btn-danger">
                                                    <i class="ace-icon fa fa-lightbulb-o"></i>
                                                    <span class="bigger-110">Send Me!</span>
                                                </button>
                                            </div>
                                        </fieldset>
                                    </form>
                                </div> /.widget-main 

                                <div class="toolbar center">
                                    <a href="#" data-target="#login-box" class="back-to-login-link">
                                        Back to login
                                        <i class="ace-icon fa fa-arrow-right"></i>
                                    </a>
                                </div>
                            </div> /.widget-body 
                        </div> /.forgot-box -->

                        <div id="signup-box" class="signup-box widget-box no-border">
                            <div class="widget-body">
                                <div class="widget-main">
                                    <h4 class="header green lighter bigger">
                                        <i class="ace-icon fa fa-users blue"></i>
                                        New User Registration
                                    </h4>

                                    <div class="space-6"></div>
                                    <p> Enter your details to begin: </p>

                                    <form>
                                        <fieldset>
                                            <label class="block clearfix">
                                                <span class="block input-icon input-icon-right">
                                                    <input type="email" class="form-control" placeholder="Email" />
                                                    <i class="ace-icon fa fa-envelope"></i>
                                                </span>
                                            </label>

                                            <label class="block clearfix">
                                                <span class="block input-icon input-icon-right">
                                                    <input type="text" class="form-control" placeholder="Username" />
                                                    <i class="ace-icon fa fa-user"></i>
                                                </span>
                                            </label>

                                            <label class="block clearfix">
                                                <span class="block input-icon input-icon-right">
                                                    <input type="password" class="form-control" placeholder="Password" />
                                                    <i class="ace-icon fa fa-lock"></i>
                                                </span>
                                            </label>

                                            <label class="block clearfix">
                                                <span class="block input-icon input-icon-right">
                                                    <input type="password" class="form-control" placeholder="Repeat password" />
                                                    <i class="ace-icon fa fa-retweet"></i>
                                                </span>
                                            </label>

                                            <label class="block">
                                                <input type="checkbox" class="ace" />
                                                <span class="lbl">
                                                    I accept the
                                                    <a href="#">User Agreement</a>
                                                </span>
                                            </label>

                                            <div class="space-24"></div>

                                            <div class="clearfix">
                                                <button type="reset" class="width-30 pull-left btn btn-sm">
                                                    <i class="ace-icon fa fa-refresh"></i>
                                                    <span class="bigger-110">Reset</span>
                                                </button>

                                                <button type="button" class="width-65 pull-right btn btn-sm btn-success">
                                                    <span class="bigger-110">Register</span>

                                                    <i class="ace-icon fa fa-arrow-right icon-on-right"></i>
                                                </button>
                                            </div>
                                        </fieldset>
                                    </form>
                                </div>

                                <div class="toolbar center">
                                    <a href="#" data-target="#login-box" class="back-to-login-link">
                                        <i class="ace-icon fa fa-arrow-left"></i>
                                        Back to login
                                    </a>
                                </div>
                            </div><!-- /.widget-body -->
                        </div><!-- /.signup-box -->
                    </div><!-- /.position-relative -->

                    <div class="navbar-fixed-top align-right">
                        <br />
                        &nbsp;
                        <a id="btn-login-dark" href="#">Dark</a>
                        &nbsp;
                        <span class="blue">/</span>
                        &nbsp;
                        <a id="btn-login-blur" href="#">Blur</a>
                        &nbsp;
                        <span class="blue">/</span>
                        &nbsp;
                        <a id="btn-login-light" href="#">Light</a>
                        &nbsp; &nbsp; &nbsp;
                    </div>
                </div>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.main-content -->
</div><!-- /.main-container -->