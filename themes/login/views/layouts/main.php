<?php
$baseUrl = Yii::app()->theme->baseUrl;
$cs = Yii::app()->getClientScript();
Yii::app()->clientScript->registerCoreScript('jquery');

//if (isset(Yii::app()->session['user_id']))
//    header('Location: index.php?r=site/index');
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <meta charset="utf-8" />
        <title>Welcome to AGC's Official Portal (Administration)</title>

        <meta name="description" content="User login page" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
        <link rel="icon" type="image/jpeg" href="images/Peguam.jpg" sizes="10x10"/>

        <!-- bootstrap & fontawesome -->
        <link rel="stylesheet" href="<?php echo $baseUrl; ?>/assets/css/bootstrap.css" />
        <link rel="stylesheet" href="<?php echo $baseUrl; ?>/assets/css/font-awesome.css" />

        <!-- text fonts -->
        <link rel="stylesheet" href="<?php echo $baseUrl; ?>/assets/css/ace-fonts.css" />

        <!-- ace styles -->
        <link rel="stylesheet" href="<?php echo $baseUrl; ?>/assets/css/ace.css" />

        <!--[if lte IE 9]>
                <link rel="stylesheet" href="<?php echo $baseUrl; ?>/assets/css/ace-part2.css" />
        <![endif]-->
        <link rel="stylesheet" href="<?php echo $baseUrl; ?>/assets/css/ace-rtl.css" />

        <!--[if lte IE 9]>
          <link rel="stylesheet" href="<?php echo $baseUrl; ?>/assets/css/ace-ie.css" />
        <![endif]-->

        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->

        <!--[if lt IE 9]>
        <script src="<?php echo $baseUrl; ?>/assets/js/html5shiv.js"></script>
        <script src="<?php echo $baseUrl; ?>/assets/js/respond.js"></script>
        <![endif]-->
    </head>

    <body class="login-layout">
        <?php echo $content; ?>

        <!-- basic scripts -->

        <!--[if !IE]> -->
        <script type="text/javascript">
            window.jQuery || document.write("<script src='<?php echo $baseUrl; ?>/assets/js/jquery.js'>" + "<" + "/script>");
        </script>

        <!-- <![endif]-->

        <!--[if IE]>
<script type="text/javascript">
window.jQuery || document.write("<script src='<?php echo $baseUrl; ?>/assets/js/jquery1x.js'>"+"<"+"/script>");
</script>
<![endif]-->
        <script type="text/javascript">
            if ('ontouchstart' in document.documentElement)
                document.write("<script src='<?php echo $baseUrl; ?>/assets/js/jquery.mobile.custom.js'>" + "<" + "/script>");
        </script>

        <!-- inline scripts related to this page -->
        <script type="text/javascript">
            jQuery(function($) {
                $(document).on('click', '.toolbar a[data-target]', function(e) {
                    e.preventDefault();
                    var target = $(this).data('target');
                    $('.widget-box.visible').removeClass('visible');//hide others
                    $(target).addClass('visible');//show target
                });
            });



            //you don't need this, just used for changing background
            jQuery(function($) {
                $('#btn-login-dark').on('click', function(e) {
                    $('body').attr('class', 'login-layout');
                    $('#id-text2').attr('class', 'white');
                    $('#id-company-text').attr('class', 'blue');

                    e.preventDefault();
                });
                $('#btn-login-light').on('click', function(e) {
                    $('body').attr('class', 'login-layout light-login');
                    $('#id-text2').attr('class', 'grey');
                    $('#id-company-text').attr('class', 'blue');

                    e.preventDefault();
                });
                $('#btn-login-blur').on('click', function(e) {
                    $('body').attr('class', 'login-layout blur-login');
                    $('#id-text2').attr('class', 'white');
                    $('#id-company-text').attr('class', 'light-blue');

                    e.preventDefault();
                });
                $('#btn-login-light').click();
            });
        </script>
    </body>
</html>
