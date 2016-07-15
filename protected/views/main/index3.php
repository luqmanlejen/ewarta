
                <?php
                $baseUrl = Yii::app()->theme->baseUrl;
                $cs = Yii::app()->getClientScript();
                Yii::app()->clientScript->registerCoreScript('jquery');
                ?>

    
    <!-- it works the same with all jquery version from 1.x to 2.x -->
    <script type="text/javascript" src="<?php  echo $baseUrl; ?>/js/jquery-1.9.1.min.js"></script>
    <!-- use jssor.slider.mini.js (40KB) instead for release -->
    <!-- jssor.slider.mini.js = (jssor.js + jssor.slider.js) -->
    <script type="text/javascript" src="<?php  echo $baseUrl; ?>/js/jssor.js"></script>
    <script type="text/javascript" src="<?php  echo $baseUrl; ?>/js/jssor.slider.js"></script>
    <script>

        jQuery(document).ready(function ($) {

            var _SlideshowTransitions2 = [
            //Fade
            { $Duration: 1200, $Opacity: 2 }
            ];

            var options = {
                $AutoPlay: true,                                    //[Optional] Whether to auto play, to enable slideshow, this option must be set to true, default value is false
                $AutoPlaySteps: 1,                                  //[Optional] Steps to go for each navigation request (this options applys only when slideshow disabled), the default value is 1
                $AutoPlayInterval: 3000,                            //[Optional] Interval (in milliseconds) to go for next slide since the previous stopped if the slider is auto playing, default value is 3000
                $PauseOnHover: 0,                               //[Optional] Whether to pause when mouse over if a slider is auto playing, 0 no pause, 1 pause for desktop, 2 pause for touch device, 3 pause for desktop and touch device, 4 freeze for desktop, 8 freeze for touch device, 12 freeze for desktop and touch device, default value is 1

                $ArrowKeyNavigation: true,   			            //[Optional] Allows keyboard (arrow key) navigation or not, default value is false
                $SlideDuration: 500,                                //[Optional] Specifies default duration (swipe) for slide in milliseconds, default value is 500
                $MinDragOffsetToSlide: 20,                          //[Optional] Minimum drag offset to trigger slide , default value is 20
                //$SlideWidth: 600,                                 //[Optional] Width of every slide in pixels, default value is width of 'slides' container
                //$SlideHeight: 300,                                //[Optional] Height of every slide in pixels, default value is height of 'slides' container
                $SlideSpacing: 0, 					                //[Optional] Space between each slide in pixels, default value is 0
                $DisplayPieces: 1,                                  //[Optional] Number of pieces to display (the slideshow would be disabled if the value is set to greater than 1), the default value is 1
                $ParkingPosition: 0,                                //[Optional] The offset position to park slide (this options applys only when slideshow disabled), default value is 0.
                $UISearchMode: 1,                                   //[Optional] The way (0 parellel, 1 recursive, default value is 1) to search UI components (slides container, loading screen, navigator container, arrow navigator container, thumbnail navigator container etc).
                $PlayOrientation: 1,                                //[Optional] Orientation to play slide (for auto play, navigation), 1 horizental, 2 vertical, 5 horizental reverse, 6 vertical reverse, default value is 1
                $DragOrientation: 3,                                //[Optional] Orientation to drag slide, 0 no drag, 1 horizental, 2 vertical, 3 either, default value is 1 (Note that the $DragOrientation should be the same as $PlayOrientation when $DisplayPieces is greater than 1, or parking position is not 0)

                $SlideshowOptions: {                                //[Optional] Options to specify and enable slideshow or not
                    $Class: $JssorSlideshowRunner$,                 //[Required] Class to create instance of slideshow
                    $Transitions: _SlideshowTransitions2,            //[Required] An array of slideshow transitions to play slideshow
                    $TransitionsOrder: 1,                           //[Optional] The way to choose transition to play slide, 1 Sequence, 0 Random
                    $ShowLink: true                                    //[Optional] Whether to bring slide link on top of the slider when slideshow is running, default value is false
                },

                $ArrowNavigatorOptions: {
                    $Class: $JssorArrowNavigator$,              //[Requried] Class to create arrow navigator instance
                    $ChanceToShow: 2,                               //[Required] 0 Never, 1 Mouse Over, 2 Always
                    $Steps: 1                                       //[Optional] Steps to go for each navigation request, default value is 1
                }
            };
            var jssor_slider2 = new $JssorSlider$("slider2_container", options);

            //responsive code begin
            //you can remove responsive code if you don't want the slider scales while window resizes
            function ScaleSlider2() {
                var parentWidth = jssor_slider2.$Elmt.parentNode.clientWidth;
                if (parentWidth)
                    jssor_slider2.$ScaleWidth(Math.min(parentWidth, 590));
                else
                    window.setTimeout(ScaleSlider2, 10);
            }
            ScaleSlider2();

            $(window).bind("load", ScaleSlider2);
            $(window).bind("resize", ScaleSlider2);
            $(window).bind("orientationchange", ScaleSlider2);
            //responsive code end
        });
    </script>
    <!-- Jssor Slider Begin -->
    <!-- To move inline styles to css file/block, please specify a class name for each element. --> 
    <div id="slider2_container" style="position: relative; top: 0px; left: 0px; width: 300px; height: 130px; overflow: hidden; ">


        <!-- Slides Container -->
        <div u="slides" style="cursor: move; position: absolute; left: 0px; top: 0px; width: 300px; height: 130px; overflow: hidden;">
            <div>
                <img u="image" src="<?php  echo $baseUrl; ?>/img/bg/002.jpg" />
                <div style="position: absolute; width: 50px; height: 50px; top: 30px; left: 130px; padding: 5px;
                    text-align: left; line-height: 20px; text-transform: uppercase; font-size: 10px;
                        color: #FFFFFF; background-color: pink">
                    <a href="http://www.google.com">Google</a>
                </div>
                <div style="position: absolute; width: 50px; height: 50px; top: 30px; left: 50px; padding: 5px;
                    text-align: left; line-height: 60px; text-transform: uppercase; font-size: 10px;
                        color: #FFFFFF; background-color: green">green
                </div>
            </div>
            <div style="width: 100px; height: 50px; background-color: pink">
                <div class="news" style="width: 10px; height: 10px; background-color: red; position: absolute;">
                    <h3>News</h3>
                    <ul>
                        <li>
                            <div class="news_img"><a href="#"><img src="<?php echo $baseUrl; ?>/images/news_img.jpg" alt="" /></a></div>
                            <div class="news_desc">
                                <h4><a href="#">Lorem ipsum dolor</a></h4>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do labore et dolore sed do eiusmod</p>
                            </div>
                            <div class="clear"> </div>
                        </li>
                        <li>
                            <div class="news_img"><a href="#"><img src="<?php echo $baseUrl; ?>/images/news_img.jpg" alt="" /></a></div>
                            <div class="news_desc">
                                <h4><a href="#">Lorem ipsum dolor</a></h4>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do labore et dolore sed do eiusmod</p>
                            </div>
                            <div class="clear"> </div>
                        </li>
                    </ul>
                </div>
            </div>
            <div>
                <img u="image" src="<?php  echo $baseUrl; ?>/img/bg/004.jpg" />
            </div>
            <div>
                <img u="image" src="<?php  echo $baseUrl; ?>/img/bg/005.jpg" />
            </div>
        </div>
        
        <!--#region Arrow Navigator Skin Begin -->
        <!-- Help: http://www.jssor.com/development/slider-with-arrow-navigator-jquery.html -->
        <style>
            /* jssor slider arrow navigator skin 12 css */
            /*
            .jssora12l                  (normal)
            .jssora12r                  (normal)
            .jssora12l:hover            (normal mouseover)
            .jssora12r:hover            (normal mouseover)
            .jssora12l.jssora12ldn      (mousedown)
            .jssora12r.jssora12rdn      (mousedown)
            */
            .jssora12l, .jssora12r {
                display: block;
                position: absolute;
                /* size of arrow element */
                width: 30px;
                height: 46px;
                cursor: pointer;
                background: url(<?php  echo $baseUrl; ?>/img/a02.png) no-repeat;
                overflow: hidden;
            }
            .jssora12l { background-position: -16px -37px; }
            .jssora12r { background-position: -75px -37px; }
            .jssora12l:hover { background-position: -136px -37px; }
            .jssora12r:hover { background-position: -195px -37px; }
            .jssora12l.jssora12ldn { background-position: -256px -37px; }
            .jssora12r.jssora12rdn { background-position: -315px -37px; }
        </style>
        <!-- Arrow Left -->
        <span u="arrowleft" class="jssora12l" style="top: 123px; left: 0px;">
        </span>
        <!-- Arrow Right -->
        <span u="arrowright" class="jssora12r" style="top: 123px; right: 0px;">
        </span>
        <!--#endregion Arrow Navigator Skin End -->        
    </div>
    <!-- Jssor Slider End -->
