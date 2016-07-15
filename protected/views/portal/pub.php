<?php
Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#ost-pu-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<div id="feedback" class="inner-content">

    <section id="page-title" class="inner-section">
        <div class="container-fluid nopadding wow fadeInRight" data-wow-delay="0.4s" data-wow-offset="10">
            <h2 class="font-accident-two-normal uppercase">P.U. (B)</h2><hr>
            <span>
                <div class="box">
                    <div class="container alert-danger">
                        <?php echo Yii::app()->user->getFlash('alert'); ?>
                    </div>
                </div>
            </span>
        </div>
    </section>

    <section class="inner-section feedback feedback-light">
        <?php
        //$gridDataProvider = new CArrayDataProvider($model);
        $this->renderPartial('_searchpub', array('model' => $model));

        $dataProvider = $model->search_portal2();
        $dataProvider->pagination = array('pageSize' => 10);

        $this->widget(
                'booster.widgets.TbExtendedGridView', array(
                'fixedHeader' => false,
                'headerOffset' => 40,
                'type' => 'striped bordered',
                'dataProvider' => $dataProvider,
                'responsiveTable' => true,
                'template' => "{items}{pager}",
                'columns' => array(
                    array('header' => '#', 'value' => '($this->grid->dataProvider->pagination->offset+$row+1)', 'htmlOptions' => array('style' => 'width: 60px')),
                    array('name' => OstRefList::model()->getTranslation("01"), 'value' => '$data->displayDate($data->date_proclamation)'),
                    array('name' => OstRefList::model()->getTranslation("02"), 'value' => '$data->pu_no'),
                    array('name' => OstRefList::model()->getTranslation("08"), 'value' => '$data->displayPortalActTitle($data->id)', 'htmlOptions' => array('style' => 'color:#337ab7')),
                    array('name' => OstRefList::model()->getTranslation("05"), 'value' => '$data->displayRelatedLegislation($data->id)'),
                    array('name' => OstRefList::model()->getTranslation("10"), 'value' => '$data->displayDownload($data->id)'),
//                    array(
//                        'header' => OstRefList::model()->getTranslation("10"),
//                        'class' => 'booster.widgets.TbButtonColumn',
//                        'template' => '{download}',
//                        'buttons' => array(
//                            'download' => array(
//                                'options' => array('rel' => 'tooltip', 'data-toggle' => 'tooltip', 'title' => OstRefList::model()->getTranslation("10")),
//                                'label' => '<i class="fa fa-file fa-2x"></i>'.OstRefList::model()->getTranslation("lang"),
//                                'url' => 'Yii::app()->createUrl("ostPu/download", array("id"=>$data->id))',
//                                'imageUrl' => false,
//                            ),
//                        )
//                    ),
                ),
            )
        );
        ?>
    </section>
</div>