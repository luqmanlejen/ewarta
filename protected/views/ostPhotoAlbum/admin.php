<?php
Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#ost-photo-album-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<div class="main-content">
    <div class="main-content-inner">

        <!-- #section:basics/content.breadcrumbs -->
        <div class="breadcrumbs" id="breadcrumbs">
            <script type="text/javascript">
                try {
                    ace.settings.check('breadcrumbs', 'fixed')
                } catch (e) {
                }
            </script>
            <ul class="breadcrumb">
                <li><i class="ace-icon fa fa-home home-icon"></i>&nbsp;<a href="index.php?r=site/index">Dashboard</a></li>
                <li>Media Administration</li>
                <li class="active">Photo Gallery</li>
            </ul><!-- /.breadcrumb -->
        </div>
        <!-- /section:basics/content.breadcrumbs -->

        <div class="page-content">
            <?php include 'themes/admin/views/layouts/setting.php'; ?>
            <div class="page-header"><h1>Photo Gallery</h1></div>
            <div class="row">
                <div class="col-xs-12">
                    <div class="dataTables_wrapper form-inline no-footer" id="dynamic-table_wrapper">
                        <?php $this->renderPartial('_search', array('model' => $model)); ?>
                        <?php
                        $this->widget('zii.widgets.grid.CGridView', array(
                            'id' => 'ost-publication-grid',
                            'dataProvider' => $model->search(),
                            'itemsCssClass' => 'table table-striped table-bordered table-hover',
                            'pagerCssClass' => 'dataTables_paginate',
                            'pager' => array('class' => 'PagerSA', 'header' => ''),
                            'summaryText' => '',
                            'emptyText' => 'No results found',
                            'columns' => array(
                                array('header' => 'No', 'value' => '($this->grid->dataProvider->pagination->offset+$row+1)', 'htmlOptions' => array('width' => '1', 'align' => 'center')),
                                array('name' => 'title', 'value' => '$data->title'),
                                'sort',
                                array('name' => 'status', 'value' => '$data->displaystatus($data->id)'),
                                array('name' => 'event_dt', 'value' => 'Yii::app()->dateFormatter->format("dd/MM/y", strtotime($data->event_dt))', 'htmlOptions' => array('width' => '150', 'align' => 'center')),
                                array('name' => 'updated_dt', 'value' => '$data->updated_dt', 'htmlOptions' => array('width' => '150', 'align' => 'center')),
                                array('name' => 'updated_by', 'value' => '$data->reladmin->name'),
                                array('name' => 'lang', 'value' => '$data->displayLang()', 'htmlOptions' => array('width' => '100', 'align' => 'center'),),
                                array('header' => 'Action', 'class' => 'CButtonColumn',
                                    'template' => '{update}&nbsp;&nbsp;{delete}&nbsp;&nbsp;{archive}{unarchive}',
                                    'htmlOptions' => array('width' => '150', 'align' => 'center'),
                                    'buttons' =>
                                    array(
                                        'archive' => array(
                                            'options' => array('rel' => 'tooltip', 'data-toggle' => 'tooltip', 'title' => 'Archive', 'class' => 'btn btn-xs btn-success btn-action'),
                                            'label' => '<i class="ace-icon fa fa-download bigger-120"></i>',
                                            'url' => 'Yii::app()->createUrl("ostPhotoAlbum/archive&id=$data->id")',
                                            'imageUrl' => false,
                                            'visible' => '$data->status=="psh"'
                                        ),
                                        'unarchive' => array(
                                            'options' => array('rel' => 'tooltip', 'data-toggle' => 'tooltip', 'title' => 'Unarchive', 'class' => 'btn btn-xs btn-warning btn-action'),
                                            'label' => '<i class="ace-icon fa fa-upload bigger-120"></i>',
                                            'url' => 'Yii::app()->createUrl("ostPhotoAlbum/unarchive&id=$data->id")',
                                            'imageUrl' => false,
                                            'visible' => '$data->status=="arc"'
                                        ),
                                        'update' => array(
                                            'options' => array('rel' => 'tooltip', 'data-toggle' => 'tooltip', 'title' => 'Update', 'class' => 'btn btn-xs btn-info'),
                                            'label' => '<i class="ace-icon fa fa-pencil bigger-120"></i>',
                                            'url' => 'Yii::app()->createUrl("ostPhotoAlbum/update&id=".$data->id)',
                                            'imageUrl' => false,
                                            'visible' => '1'
                                        ),
                                        'delete' => array(
                                            'options' => array('rel' => 'tooltip', 'data-toggle' => 'tooltip', 'title' => 'Delete', 'class' => 'btn btn-xs btn-danger',),
                                            'label' => '<i class="ace-icon fa fa-trash-o bigger-120"></i>',
                                            'imageUrl' => false,
                                            'url' => 'Yii::app()->createUrl("ostPhotoAlbum/delete&id=".$data->id)',
                                            'visible' => '1'
                                        ),
                                    ),
                                ),
                            ),
                        ));
                        ?>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/assets/css/jquery-ui.css" />
<script src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/js/jquery-ui.js"></script>
<script src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/js/jquery.ui.touch-punch.js"></script>

<script>
    $(function() {
        activemenu('15', '16');
    });
</script>