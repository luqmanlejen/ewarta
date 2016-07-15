<?php
Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#ost-articles-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
include 'header.php';
?>

<style>
    .btn-action{margin-right:5px;}
</style>

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
                <li>Portal Administration</li>
                <li class="active">Manage <?php echo $title; ?></li>
            </ul><!-- /.breadcrumb -->
        </div>
        <!-- /section:basics/content.breadcrumbs -->

        <div class="page-content">
            <?php include 'themes/admin/views/layouts/setting.php'; ?>
            <div class="page-header"><h1>Manage <?php echo $title; ?></h1></div>
            <div class="row">
                <div class="col-xs-12">
                    <div class="dataTables_wrapper form-inline no-footer" id="dynamic-table_wrapper">
                        <?php $this->renderPartial('_search', array('model' => $model, 'exturl' => $exturl,)); ?>
                        <?php
                        $this->widget('zii.widgets.grid.CGridView', array(
                            'id' => 'ost-articles-grid',
                            'dataProvider' => $model->search(),
                            'itemsCssClass' => 'table table-striped table-bordered table-hover',
                            'pagerCssClass' => 'dataTables_paginate',
                            'pager' => array('class' => 'PagerSA', 'header' => ''),
                            'summaryText' => '',
                            'emptyText' => 'No results found',
                            'columns' => array(
                                array('header' => 'No', 'value' => '($this->grid->dataProvider->pagination->offset+$row+1)', 'htmlOptions' => array('width' => '1', 'align' => 'center')),
                                array('name' => 'title', 'value' => '$data->displaytitleNbreadcrumbs()'),
                                //array('name' => 'menu_id', 'value' => '$data->relmenu->title'),
                                //array('name' => 'display_type', 'value' => '$data->displaytype()', 'htmlOptions' => array('width' => '1', 'align' => 'center'),),
                                array('name' => 'approval_sts', 'value' => 'ucfirst($data->approval_sts)', 'htmlOptions' => array('width' => '100', 'align' => 'center')),
                                array('name' => 'updated_dt', 'value' => '$data->updated_dt', 'htmlOptions' => array('width' => '100', 'align' => 'center')),
                                array('name' => 'updated_by', 'value' => '$data->reladmin->name'),
                                array('name' => 'lang', 'value' => '$data->displayLang()', 'htmlOptions' => array('width' => '100', 'align' => 'center'),),
                                array('header' => 'Action', 'class' => 'CButtonColumn',
                                    'template' => '{archive}{unarchive}{sendforapproval}{update}{delete}',
                                    'htmlOptions' => array('width' => '150', 'align' => 'center'),
                                    'buttons' =>
                                    array(
                                        'archive' => array(
                                            'options' => array('rel' => 'tooltip', 'data-toggle' => 'tooltip', 'title' => 'Archive', 'class' => 'btn btn-xs btn-success btn-action'),
                                            'label' => '<i class="ace-icon fa fa-download bigger-120"></i>',
                                            'url' => 'Yii::app()->createUrl("ostArticles/archive&id=$data->id' . $exturl . '")',
                                            'imageUrl' => false,
                                            'visible' => '$data->approval_sts=="publish"'
                                        ),
                                        'unarchive' => array(
                                            'options' => array('rel' => 'tooltip', 'data-toggle' => 'tooltip', 'title' => 'Unarchive', 'class' => 'btn btn-xs btn-warning btn-action'),
                                            'label' => '<i class="ace-icon fa fa-upload bigger-120"></i>',
                                            'url' => 'Yii::app()->createUrl("ostArticles/unarchive&id=$data->id' . $exturl . '")',
                                            'imageUrl' => false,
                                            'visible' => '$data->approval_sts=="archive"'
                                        ),
                                        'sendforapproval' => array(
                                            'options' => array('rel' => 'tooltip', 'data-toggle' => 'tooltip', 'title' => 'Send For Approval', 'class' => 'btn btn-xs btn-purple btn-action'),
                                            'label' => '<i class="ace-icon fa fa-paper-plane bigger-120"></i>',
                                            'url' => 'Yii::app()->createUrl("ostArticles/sendforapproval&id=$data->id' . $exturl . '")',
                                            'imageUrl' => false,
                                            'visible' => '$data->approval_sts=="draft" || $data->approval_sts=="rework"'
                                        ),
                                        'update' => array(
                                            'options' => array('rel' => 'tooltip', 'data-toggle' => 'tooltip', 'title' => 'Update', 'class' => 'btn btn-xs btn-info btn-action'),
                                            'label' => '<i class="ace-icon fa fa-pencil bigger-120"></i>',
                                            'url' => 'Yii::app()->createUrl("ostArticles/update&id=$data->id' . $exturl . '")',
                                            'imageUrl' => false,
                                            'visible' => 'OstArticles::model()->chckupdate($data->approval_sts)=="y"'
                                        ),
                                        'delete' => array(
                                            'options' => array('rel' => 'tooltip', 'data-toggle' => 'tooltip', 'title' => 'Delete', 'class' => 'btn btn-xs btn-danger btn-action',),
                                            'label' => '<i class="ace-icon fa fa-trash-o bigger-120"></i>',
                                            'imageUrl' => false,
                                            'url' => 'Yii::app()->createUrl("ostArticles/delete&id=$data->id' . $exturl . '")',
                                            'visible' => 'OstArticles::model()->chckdvsn()=="n"'
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