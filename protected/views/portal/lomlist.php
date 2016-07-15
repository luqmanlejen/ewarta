<?php
Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#ost-version-act-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>


<!--<div class="content-wrap">-->

<div id="feedback" class="inner-content">

    <section id="page-title" class="inner-section">
        <div class="container-fluid nopadding wow fadeInRight" data-wow-delay="0.4s" data-wow-offset="10">
            <h2 class="font-accident-two-normal uppercase">LOM</h2><hr>
            <!--<h5 class="font-accident-one-bold hovercolor uppercase">Hard-working person on the way to the success...</h5>-->
            <span>
                <div class="box">
                    <div class="container alert-danger">
                        <?php echo Yii::app()->user->getFlash('alert'); ?>
                    </div>
                </div>
            </span>
        </div>
    </section>
    
    
    
    <!-- Feedback Block -->
    <section class="inner-section feedback feedback-light">

        <?php
        //$gridDataProvider = new CArrayDataProvider($model);
        $this->renderPartial('_searchlom', array('model' => $model));

        $dataProvider = $model->search_portal();
        $dataProvider->pagination = array('pageSize' => 10);

        $this->widget(
                'booster.widgets.TbExtendedGridView', array(
            'fixedHeader' => false,
            'headerOffset' => 40,
            'type' => 'striped bordered',
            //'summaryText'=>'Displaying {start}-{end} of {count} results.',
            'dataProvider' => $dataProvider,
            'responsiveTable' => true,
            //'template' => "{items}",
            'template' => "{items}{pager}",
            'columns' => array(
                array('header' => '#', 'value' => '($this->grid->dataProvider->pagination->offset+$row+1)', 'htmlOptions' => array('style' => 'width: 60px')),
                    array('name' => OstRefList::model()->getTranslation("02"), 'value' => '$data->act_id'),
                    array('name' => OstRefList::model()->getTranslation("03"), 'value' => '$data->displayPortalActTitle($data->act_id)'),
//                    array('name' => OstRefList::model()->getTranslation("11"), 'value' => '$data->getVersionActType($data->version_act_id)'),
                    array(
                        'header' => OstRefList::model()->getTranslation("10"),
                        'class' => 'booster.widgets.TbButtonColumn',
                        'template' => '{download_en}&nbsp;&nbsp;{download_bm}',
                        'htmlOptions' => array('style' => 'width: 100px'),
                        'buttons' => array(
                            'download_en' => array(
                                'options' => array('rel' => 'tooltip', 'data-toggle' => 'tooltip', 'title' => OstRefList::model()->getTranslation("10")),
                                'label' => '<i class="fa fa-file-pdf-o fa-2x"></i> English<br><br>',
                                'url' => 'Yii::app()->createUrl("ostVersionAct/download", array("id"=>$data->id,"type"=>1))',
                                'imageUrl' => false,
                            ),
                            'download_bm' => array(
                                'options' => array('rel' => 'tooltip', 'data-toggle' => 'tooltip', 'title' => OstRefList::model()->getTranslation("10")),
                                'label' => '<br><i class="fa fa-file-pdf-o fa-2x"></i> Malay',
                                'url' => 'Yii::app()->createUrl("ostVersionAct/download", array("id"=>$data->id,"type"=>2))',
                                'imageUrl' => false,
                            ),
                        )
                    ),
                ),
            )
        );
        ?>


        <!-- Result -->


    </section>
    <!-- /Feedback Block -->

    <!-- Testmonials Block -->
<!--    <section id="testmonials" class="inner-section color01">
        <div class="container-fluid nopadding">

            <div class="wow fadeInDown" data-wow-delay="0.4s" data-wow-offset="10">
                <h3 class="font-accident-two-normal uppercase text-center">Testmonials</h3>
                <h5 class="font-accident-one-bold uppercase hovercolor text-center">Working hard and making the success</h5>
                <div class="dividewhite1"></div>
                <p class="small fontcolor-medium text-center">
                    Customize your website as you want using different colors and 100% free fonts. Build it from pieces and
                    blocks as simple as Lego. <br>
                    Electronic Website Template is fully responsive, looks and works perfect on any device.
                </p>
            </div>

            <div class="dividewhite4"></div>

            <div class="row">
                <div class="col-md-4 wow fadeInLeft" data-wow-delay="0.5s" data-wow-offset="10">
                    <div class="row">
                        <div class="col-xs-3">
                            <img src="assets/custom/images/userpic04.jpg" alt="Rachel James Johnes" class="img-responsive img-circle author-userpic">
                        </div>
                        <div class="col-xs-9">
                            <h5 class="font-accident-one-bold text-left uppercase">Hans Zimmer</h5>
                            <p class="small hovercolor">Apple Inc.</p>
                            <p class="text-left small">
                                With more devices come varying screen resolutions, definitions and orientations. New devices
                                with new screen sizes are being developed every day, and each of these devices may be able...
                            </p>
                        </div>
                    </div>
                    <div class="divider-dynamic"></div>
                </div>
                <div class="col-md-4 wow fadeInUp" data-wow-delay="0.5s" data-wow-offset="10">
                    <div class="row">
                        <div class="col-xs-3">
                            <img src="assets/custom/images/userpic02.jpg" alt="Rachel James Johnes" class="img-responsive img-circle author-userpic">
                        </div>
                        <div class="col-xs-9">
                            <h5 class="font-accident-one-bold text-left uppercase">Mario Quinn</h5>
                            <p class="small hovercolor">Adobe</p>
                            <p class="text-left small">
                                With more devices come varying screen resolutions, definitions and orientations. New devices
                                with new screen sizes are being developed every day, and each of these devices
                            </p>
                        </div>
                    </div>
                    <div class="divider-dynamic"></div>
                </div>
                <div class="col-md-4 wow fadeInRight" data-wow-delay="0.5s" data-wow-offset="10">
                    <div class="row">
                        <div class="col-xs-3">
                            <img src="assets/custom/images/userpic03.jpg" alt="Rachel James Johnes" class="img-responsive img-circle author-userpic">
                        </div>
                        <div class="col-xs-9">
                            <h5 class="font-accident-one-bold text-left uppercase">Karl Romm</h5>
                            <p class="small hovercolor">BMW</p>
                            <p class="text-left small">
                                With more devices come varying screen resolutions, definitions and orientations. New devices
                                with new screen sizes are being developed every day, and each of these devices
                            </p>
                        </div>
                    </div>
                    <div class="divider-dynamic"></div>
                </div>
            </div>

            <div class="dividewhite6"></div>

        </div>
    </section>-->
    <!-- /Testmonials Block -->
</div>




<link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/assets/css/jquery-ui.css" />
<script src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/js/jquery-ui.js"></script>
<script src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/js/jquery.ui.touch-punch.js"></script>