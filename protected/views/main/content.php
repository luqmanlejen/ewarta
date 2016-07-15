<?php
$baseUrl = Yii::app()->theme->baseUrl;
$cs = Yii::app()->getClientScript();
Yii::app()->clientScript->registerCoreScript('jquery');
?>

<div class="container">
    <div class="col-md-12">
        <div class="row">
            <div class="col-sm-6 col-md-8 alert" style="background-color: #27AE60;">
                Box 1
            </div>
            <div class="col-sm-6 col-md-4">
                <div class="input-group">
                    <input type="text" class="form-control " placeholder="Search" id="search-query-3">
                    <span class="input-group-btn">
                        <button type="submit" class="btn btn-success btn-sm">Search</button>
                    </span>
                </div>
            </div>
        </div>

        <div class="row" style="font-size: 12px">
            
            <div class="col-sm-6 col-md-6">
                <div class="alert alert-info">
                    <?php
                        include("nivoslider.php");
                        $nivo=new NivoSlider('nivoslider',535,250);     // base path is same directory

                        //$nivo->add_slide(ImagePath,URL,Caption);
                        $nivo->add_slide('images/nemo.jpg','','');
                        $nivo->add_slide('images/toystory.jpg','http://www.google.com','Awesome JQuery Slider');   
                        $nivo->add_slide('images/up.jpg','','');
                        $nivo->add_slide('images/walle.jpg','','');
                        $nivo->render_includes();
                        $nivo->render_slides();
                    ?>
                </div>
            </div>
            <div class="col-sm-6 col-md-6">
                <div class="alert alert-info">
                    <h1 style="font-size: 20px">Events</h1>
                    <p>
                        Lorem Ipsum is simply dummy text of the printing and typesetting industry. 
                        Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, 
                        when an unknown printer took a galley of type and scrambled it to make a type specimen book
                    </p>
                </div>
            </div>
        </div>

        <div class="row" style="font-size: 12px">
            <div class="col-sm-6 col-md-4">
                <div class="alert alert-info">
                    <h1 style="font-size: 20px">Event</h1>
                    <p>
                        Lorem Ipsum is simply dummy text of the printing and typesetting industry. 
                        Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, 
                        when an unknown printer took a galley of type and scrambled it to make a type specimen book
                    </p>
                </div>
            </div>
            <div class="col-sm-6 col-md-4">
                <div class="alert alert-info">
                    <h1 style="font-size: 20px">Law Related To Foreign Investment</h1>
                    <p>
                        Lorem Ipsum is simply dummy text of the printing and typesetting industry. 
                        Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, 
                        when an unknown printer took a galley of type and scrambled it to make a type specimen book
                    </p>
                </div>
            </div>
            <div class="col-sm-6 col-md-4">
                <div class="alert alert-info">
                    <h1 style="font-size: 20px">International Trade and Finance Related Legistlation</h1>
                    <p>
                        Lorem Ipsum is simply dummy text of the printing and typesetting industry. 
                        Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, 
                        when an unknown printer took a galley of type and scrambled it to make a type specimen book
                    </p>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-4 col-md-1" style="background-color: #27AE60;">
                Icon1
            </div>
            <div class="col-sm-4 col-md-1" style="background-color: #2ECD89">
                Icon2
            </div>
            <div class="col-sm-4 col-md-1" style="background-color: #1ABC9C">
                Icon3
            </div>
            <div class="col-sm-4 col-md-1" style="background-color: #3498DB">
                Icon4
            </div>
            <div class="col-sm-4 col-md-1" style="background-color: #9B59B6">
                Icon5
            </div>
            <div class="col-sm-4 col-md-1" style="background-color: #F1C40F">
                Icon6
            </div>
            <div class="col-sm-4 col-md-1" style="background-color: #E67E22">
                Icon7
            </div>
            <div class="col-sm-4 col-md-1" style="background-color: #E74C3C">
                Icon8
            </div>
        </div>
    </div>
</div>

<!-- Scripts -->
<script src="http://code.jquery.com/jquery-latest.min.js"></script>
<script src="http://code.jquery.com/ui/1.10.1/jquery-ui.min.js"></script>
<script>window.jQuery || document.write('<script src="layout/scripts/jquery-latest.min.js"><\/script>\
<script src="layout/scripts/jquery-ui.min.js"><\/script>')</script>
<script>jQuery(document).ready(function($){ $('img').removeAttr('width height'); });</script>
<script src="<?php echo $baseUrl; ?>/js/responsiveslides.min.js"></script>
<script src="<?php echo $baseUrl; ?>/js/jquery-mobilemenu.min.js"></script>
<script src="<?php echo $baseUrl; ?>/js/custom.js"></script>