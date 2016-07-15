<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta charset="iso-8859-1">
        <meta name=viewport content="width=device-width, initial-scale=1">

        <title>e-Federal Gazette & Law Of Malaysia Portal</title>

        <meta name="description" content="e-Federal Gazette & Law Of Malaysia Portal">
        <meta name="keywords" content="html5, template, website, responsive, bootstrap">
        <meta name="author" content="OST">

        <!-- CSS -->
        <link href="<?php echo Yii::app()->theme->baseUrl; ?>/assets/vendor/bootstrap/css/bootstrap.min.css"        property='stylesheet' rel="stylesheet" type="text/css" media="screen"/>
        <link href="<?php echo Yii::app()->theme->baseUrl; ?>/assets/vendor/fontawesome/css/font-awesome.min.css"   property='stylesheet' rel="stylesheet" type="text/css" media="screen"/>
        <link href="<?php echo Yii::app()->theme->baseUrl; ?>/assets/vendor/flaticons/flaticon.css"                 property='stylesheet' rel="stylesheet" type="text/css" media="screen"/>
        <link href="<?php echo Yii::app()->theme->baseUrl; ?>/assets/vendor/hover/css/hover-min.css"                property='stylesheet' rel="stylesheet" type="text/css" media="screen"/>
        <link href="<?php echo Yii::app()->theme->baseUrl; ?>/assets/vendor/wow/animate.css"                        property='stylesheet' rel="stylesheet" type="text/css" media="screen"/>
        <link href="<?php echo Yii::app()->theme->baseUrl; ?>/assets/vendor/mfp/css/magnific-popup.css"             property='stylesheet' rel="stylesheet" type="text/css" media="screen"/>

        <!-- Remove this for disable demo panel styles -->
        <link href="<?php echo Yii::app()->theme->baseUrl; ?>/assets/vendor/styleselector/styleselector.css"        property='stylesheet' rel="stylesheet" type="text/css" media="screen"/>

        <!-- Custom styles -->
        <!--<link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/assets/custom/css/reset-font-min.css">-->
        <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/assets/custom/css/clearfix.css">
        <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/assets/custom/css/jquery.newsticker.css">

        <link href="<?php echo Yii::app()->theme->baseUrl; ?>/assets/custom/css/style.css" property='stylesheet' rel="stylesheet" type="text/css" media="screen"/>
        <style>
            #preloader {
                position: fixed;
                left: 0;
                top: 0;
                z-index: 99999;
                width: 100%;
                height: 100%;
                overflow: visible;
                background: #666666 url("<?php echo Yii::app()->theme->baseUrl; ?>/assets/custom/images/preloader.gif") no-repeat center center; }

            ul li a{
                color:white;
            }
        </style>

    </head>

    <body class="boxed">

        <!--Pre-Loader-->
        <div id="preloader"></div>

        <section id="top-navigation" class="container-fluid nopadding">
            <div class="row nopadding ident">
                <div class="col-md-5 col-lg-4 vc-name nopadding">
                    <ul class="list-inline lang">
                        <!--<li><a onclick="location.href = 'index.php?r=portal/setlang&lang=my'"><i class="flaticon-insignia"></i><span> Malay</span></a></li>-->
                        <li><a onclick="location.href = 'index.php?r=portal/setlang&lang=my'"><img src="images/lang/MY.png"><span>  Malay</span></a></li>
                        <li><a onclick="location.href = 'index.php?r=portal/setlang&lang=en'"><img src="images/lang/SH.png"></i><span>  English</span></a></li>
                    </ul>
                </div>
                <div class="col-md-7 col-lg-8 vc-name nopadding">
                    <!-- Main Navigation -->
                    <?php include 'navigation.php'; ?>
                    <!-- /Main Navigation -->
                </div>
            </div>
        </section>

        <!--        <div class="row personalisation">        
                    <div class="col-md-4">
                        <ul class="list-inline">
                            <li><a href="#">BM</a></li>
                            <li><a href="#">BI</a></li>
                        </ul>
                    </div>
                    <div class="col-md-8">
        <?php include 'navigation.php'; ?>
                    </div>
                </div>-->

        <header>

            <section id="top-navigation" class="container-fluid nopadding">

                <!--<div class="row nopadding ident e-bg-light-texture">-->
                <div class="row nopadding ident">

                    <!-- Photo -->
                    <!--                    <a href="#!">
                                            <div class="col-md-5 col-lg-4 vc-photo">&nbsp;</div>
                                        </a>-->
                    <!-- /Photo -->

                    <div class="col-md-12 col-lg-12 vc-name nopadding">
                        <!-- Name-Position -->
                        <div class="row nopadding name">
                            <div class="col-md-12 name-title">

                                <h2 class="font-accident-two-light uppercase">
                                    <img src="images/Coat of Arms Malaysia.png" alt="logo_jata" height="50" width="50"/>
                                    <img src="images/logo_agc.png" alt="logo_agc" height="50" width="50"/>
                                    <?php if(Yii::app()->session['lang'] == 'my'){?>
                                        Warta Persekutuan & Undang-undang Malaysia
                                    <?php } else { ?>
                                        e-Federal Gazette & Law of Malaysia
                                    <?php } ?>
                                </h2>
                                <div class="hidden-lg hidden-md dividewhite2"></div>
                            </div>

                            <!--                            <div class="col-md-2 nopadding name-pdf">
                                                            <a href="#" class="hvr-sweep-to-right"><i class="flaticon-download149" title="Download CV.pdf"></i></a>
                                                        </div>-->
                        </div>
                        <div class="row nopadding position">
                            <div class="col-md-12 position-title">

                                <section class="cd-intro">
                                    <h4 class="cd-headline clip is-full-width font-accident-two-normal uppercase">
                                        <!--<span>The experienced </span>-->
                                        <span class="cd-words-wrapper">
                                            <?php if(Yii::app()->session['lang'] == 'en'){?>
                                                <b class="is-visible">Laman Web Rasmi</b>
                                                <b>Warta Persekutuan &</b>
                                                <b>Undang-undang Malaysia</b>
                                            <?php } else { ?>
                                                <b class="is-visible">Official Portal of</b>
                                                <b>Federal Gazette &</b>
                                                <b>Law of Malaysia</b>
                                            <?php } ?>
                                        </span>
                                    </h4>
                                </section>

                            </div>
                            <!--                            <div class="col-md-2 nopadding pdf">
                            <?php if (Yii::app()->session['lang'] == 'en') { ?>
                                                                    <a onclick="location.href = 'index.php?r=portal/setlang&lang=my'" class="hvr-sweep-to-bottom"><i class="flaticon-insignia"></i><span>Malay</span></a>
                            <?php } else { ?>
                                                                    <a onclick="location.href = 'index.php?r=portal/setlang&lang=en'" class="hvr-sweep-to-bottom"><i class="flaticon-insignia"></i><span>English</span></a>
                            <?php } ?>
                                                        </div>-->
                        </div>
                        <!-- /Name-Position -->

                        <!-- Main Navigation -->
                        <?php // include 'navigation.php'; ?>
                        <!-- /Main Navigation -->

                    </div>
                </div>
            </section>

        </header>

        <!-- Container -->
        <div class="content-wrap">

            <section id="homesection" class="container-fluid nopadding">

                <?php echo $content; ?>

            </section>

        </div>

        <?php include 'footer.php'; ?>

        <div id="image-cache" class="hidden"></div>

        <!-- JS -->
        <script src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/vendor/jquery/js/jquery-2.2.0.min.js"            type="text/javascript"></script>
        <script src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/vendor/bootstrap/js/bootstrap.min.js"            type="text/javascript"></script>
        <script src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/vendor/imagesloaded/js/imagesloaded.pkgd.min.js" type="text/javascript"></script>
        <script src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/vendor/isotope/js/isotope.pkgd.min.js"           type="text/javascript"></script>
        <script src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/vendor/mfp/js/jquery.magnific-popup.min.js"      type="text/javascript"></script>
        <script src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/vendor/circle-progress/circle-progress.js"       type="text/javascript"></script>
        <script src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/vendor/waypoints/waypoints.min.js"               type="text/javascript"></script>
        <script src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/vendor/anicounter/jquery.counterup.min.js"       type="text/javascript"></script>
        <script src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/vendor/wow/wow.min.js"                           type="text/javascript"></script>
        <script src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/vendor/pjax/jquery.pjax.js"                      type="text/javascript"></script>
        <!--<script src="https://maps.google.com/maps/api/js" type="text/javascript"></script>-->
        <!-- Remove this for disable demo panel script -->
        <!--<script src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/vendor/styleselector/styleselector.js"           type="text/javascript"></script>-->
        <!-- Custom scripts -->        
        <script src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/custom/js/custom.js"                             type="text/javascript"></script>
        <script src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/custom/js/jquery.newsTicker.js"></script>
        <!--<script src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/custom/js/jquery.newsticker.js"></script>-->
        <script>
                            // start
//            $(function () {
//                $('.newsticker').newsticker({
//                    height: 40 //default: 30
//                });
//            });

                            var nt_example1 = $('#nt-example1').newsTicker({
                                row_height: 190,
                                max_rows: 3,
                                duration: 4000,
                                prevButton: $('#nt-example1-prev'),
                                nextButton: $('#nt-example1-next')
                            });

                            var today = $('#today').newsTicker({
                                row_height: 140,
                                max_rows: 1,
                                duration: 6000,
                            });
        </script>
    </body>

</html>