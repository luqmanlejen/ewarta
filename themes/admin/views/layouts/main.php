<?php
$baseUrl = Yii::app()->theme->baseUrl;
$cs = Yii::app()->getClientScript();
Yii::app()->clientScript->registerCoreScript('jquery');

if (!isset(Yii::app()->session['user_id']) || Yii::app()->session['user_id'] == '')
    header('Location: index.php?r=site/logout');
?>
<!DOCTYPE html>
<html lang="en">
    <head>

        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <meta charset="utf-8" />
        <title>Welcome to Federal Gazette and Law of Malaysia Official Portal (Administration)</title>
        <link rel="icon" type="image/jpeg" href="images/Peguam.jpg" sizes="10x10"/>
        <meta name="description" content="overview &amp; stats" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

        <!-- bootstrap & fontawesome -->
        <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/assets/css/bootstrap.css" />
        <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/assets/css/font-awesome.css" />

        <!-- text fonts -->
        <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/assets/css/ace-fonts.css" />

        <!-- ace styles -->
        <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/assets/css/ace.css" class="ace-main-stylesheet" id="main-ace-style" />

        <!--[if lte IE 9]><link rel="stylesheet" href="../assets/css/ace-part2.css" class="ace-main-stylesheet" /><![endif]-->
        <!--[if lte IE 9]><link rel="stylesheet" href="../assets/css/ace-ie.css" /><![endif]-->
        <!-- inline styles related to this page -->

        <!-- ace settings handler -->
        <script src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/js/ace-extra.js"></script>

        <!-- HTML5shiv and Respond.js for IE8 to support HTML5 elements and media queries -->
        <!--[if lte IE 8]>
        <script src="../assets/js/html5shiv.js"></script>
        <script src="../assets/js/respond.js"></script>
        <![endif]-->
        <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/assets/css/custom.css" />
    </head>
    <body class="no-skin">
        <!-- #section:basics/navbar.layout -->
        <div id="navbar" class="navbar navbar-default">                    
            <script type="text/javascript">
                try {
                    ace.settings.check('navbar', 'fixed')
                } catch (e) {
                }
            </script>

            <div class="navbar-container" id="navbar-container">
                <!-- #section:basics/sidebar.mobile.toggle -->
                <button type="button" class="navbar-toggle menu-toggler pull-left" id="menu-toggler" data-target="#sidebar">
                    <span class="sr-only">Toggle sidebar</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- /section:basics/sidebar.mobile.toggle -->
                <div class="navbar-header pull-left">
                    <!-- #section:basics/navbar.layout.brand -->
                    <a href="index.php?r=site/index" class="navbar-brand">
                        <small>
                            <i class="fa fa-cogs"></i>
                            Federal Gazette and Law of Malaysia Official Portal (Administration)
                        </small>
                    </a>
                </div>

                <!-- #section:basics/navbar.dropdown -->
                <div class="navbar-buttons navbar-header pull-right" role="navigation">
                    <ul class="nav ace-nav">

                        <!-- #section:basics/navbar.user_menu -->
                        <li class="light-blue">
                            <a data-toggle="dropdown" href="#" class="dropdown-toggle">
                                <img class="nav-user-photo" src="<?php echo $baseUrl; ?>/assets/avatars/fb_image.jpg" alt="Admin's Photo" />
                                <span class="user-info">
                                    <small>Welcome,</small>
                                    <?php echo Yii::app()->session['name']; //echo 'Admin'; ?>
                                </span>

                                <i class="ace-icon fa fa-caret-down"></i>
                            </a>

                            <ul class="user-menu dropdown-menu-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
<!--                                <li>
                                    <a href="#"><i class="ace-icon fa fa-user"></i>Profile</a>
                                </li>-->

                                <!--<li class="divider"></li>-->

                                <li> 
                                    <a href="index.php?r=site/logout"><i class="ace-icon fa fa-power-off"></i>Logout</a>
                                </li>
                            </ul>
                        </li>

                        <!-- /section:basics/navbar.user_menu -->
                    </ul>
                </div>

                <!-- /section:basics/navbar.dropdown -->
            </div><!-- /.navbar-container -->
        </div>

        <!-- /section:basics/navbar.layout -->
        <div class="main-container" id="main-container">
            <script type="text/javascript">
                try {
                    ace.settings.check('main-container', 'fixed')
                } catch (e) {
                }
            </script>

            <!-- #section:basics/sidebar -->
            <div id="sidebar" class="sidebar responsive">
                <script type="text/javascript">
                    try {
                        ace.settings.check('sidebar', 'fixed')
                    } catch (e) {
                    }
                </script>

                <?php include 'navbar.php'; ?>

            </div>

            <!-- /section:basics/sidebar -->
            <div class="main-content">
                <div class="main-content-inner">
                    <div class="main-content">
                        <?php //include 'setting.php'; ?>
                        <div><?php echo $content; ?></div>
                    </div><!-- /.page-content -->
                </div>
            </div><!-- /.main-content -->

            <?php include 'footer.php'; ?>

            <a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
                <i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
            </a>
        </div><!-- /.main-container -->

        <!-- basic scripts -->

        <!--[if !IE]> -->
        <script type="text/javascript">
            window.jQuery || document.write("<script src='<?php echo $baseUrl; ?>/js/jquery.js'>" + "<" + "/script>");
        </script>
        <!-- <![endif]-->

        <script type="text/javascript">
            if ('ontouchstart' in document.documentElement)
                document.write("<script src='<?php echo $baseUrl; ?>/js/jquery.mobile.custom.js'>" + "<" + "/script>");
        </script>
        <script src="<?php echo $baseUrl; ?>/js/bootstrap.js"></script>

        <!-- page specific plugin scripts -->
        <!--[if lte IE 8]>
          <script src="../assets/js/excanvas.js"></script>
        <![endif]-->
        <script src="<?php echo $baseUrl; ?>/js/jquery-ui.custom.js"></script>
        <script src="<?php echo $baseUrl; ?>/js/jquery.ui.touch-punch.js"></script>
        <script src="<?php echo $baseUrl; ?>/js/jquery.easypiechart.js"></script>
        <script src="<?php echo $baseUrl; ?>/js/jquery.sparkline.js"></script>
        <script src="<?php echo $baseUrl; ?>/js/flot/jquery.flot.js"></script>
        <script src="<?php echo $baseUrl; ?>/js/flot/jquery.flot.pie.js"></script>
        <script src="<?php echo $baseUrl; ?>/js/flot/jquery.flot.resize.js"></script>

        <!-- ace scripts -->
        <script src="<?php echo $baseUrl; ?>/js/ace/elements.scroller.js"></script>
        <script src="<?php echo $baseUrl; ?>/js/ace/elements.colorpicker.js"></script>
        <script src="<?php echo $baseUrl; ?>/js/ace/elements.fileinput.js"></script>
        <script src="<?php echo $baseUrl; ?>/js/ace/elements.typeahead.js"></script>
        <script src="<?php echo $baseUrl; ?>/js/ace/elements.wysiwyg.js"></script>
        <script src="<?php echo $baseUrl; ?>/js/ace/elements.spinner.js"></script>
        <script src="<?php echo $baseUrl; ?>/js/ace/elements.treeview.js"></script>
        <script src="<?php echo $baseUrl; ?>/js/ace/elements.wizard.js"></script>
        <script src="<?php echo $baseUrl; ?>/js/ace/elements.aside.js"></script>
        <script src="<?php echo $baseUrl; ?>/js/ace/ace.js"></script>
        <script src="<?php echo $baseUrl; ?>/js/ace/ace.ajax-content.js"></script>
        <script src="<?php echo $baseUrl; ?>/js/ace/ace.touch-drag.js"></script>
        <script src="<?php echo $baseUrl; ?>/js/ace/ace.sidebar.js"></script>
        <script src="<?php echo $baseUrl; ?>/js/ace/ace.sidebar-scroll-1.js"></script>
        <script src="<?php echo $baseUrl; ?>/js/ace/ace.submenu-hover.js"></script>
        <script src="<?php echo $baseUrl; ?>/js/ace/ace.widget-box.js"></script>
        <script src="<?php echo $baseUrl; ?>/js/ace/ace.settings.js"></script>
        <script src="<?php echo $baseUrl; ?>/js/ace/ace.settings-rtl.js"></script>
        <script src="<?php echo $baseUrl; ?>/js/ace/ace.settings-skin.js"></script>
        <script src="<?php echo $baseUrl; ?>/js/ace/ace.widget-on-reload.js"></script>
        <script src="<?php echo $baseUrl; ?>/js/ace/ace.searchbox-autocomplete.js"></script>

        <!-- the following scripts are used in demo only for onpage help and you don't need them -->
        <link rel="stylesheet" href="<?php echo $baseUrl; ?>/css/ace.onpage-help.css" />
        <link rel="stylesheet" href="<?php echo $baseUrl; ?>/js/sunburst.css" />

        <script type="text/javascript"> ace.vars['base'] = '..';</script>
        <script src="<?php echo $baseUrl; ?>/js/ace/elements.onpage-help.js"></script>
        <script src="<?php echo $baseUrl; ?>/js/ace/ace.onpage-help.js"></script>
        <script src="<?php echo $baseUrl; ?>/js/rainbow.js"></script>
        <script src="<?php echo $baseUrl; ?>/js/language/generic.js"></script>
        <script src="<?php echo $baseUrl; ?>/js/language/html.js"></script>
        <script src="<?php echo $baseUrl; ?>/js/language/css.js"></script>
        <script src="<?php echo $baseUrl; ?>/js/language/javascript.js"></script>
    </body>
</html>