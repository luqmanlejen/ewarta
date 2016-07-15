<?php
Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#ost-ref-list-grid').yiiGridView('update', {
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
                <li><i class="ace-icon fa fa-home home-icon"></i>&nbsp;<a href="index.php?r=site/index">Main</a></li>
                <li>CMS Administration</li>
                <li><a href="index.php?r=ostRef/admin">Manage Category Parameter</a></li>
                <li class="active">Manage Parameter</li>
            </ul><!-- /.breadcrumb -->
        </div>
        <!-- /section:basics/content.breadcrumbs -->

        <div class="page-content">
            <?php include 'themes/admin/views/layouts/setting.php'; ?>
            <div class="page-header"><h1><i class="menu-icon fa fa-database"></i>Manage Parameter</h1></div>
            <div class="row">
                <div class="col-xs-12">
                    <div class="dataTables_wrapper form-inline no-footer" id="dynamic-table_wrapper">
                        <?php $this->renderPartial('_search', array('model' => $model,)); ?>
                        <?php
                        $this->widget('zii.widgets.grid.CGridView', array(
                            'id' => 'ost-ref-list-grid',
                            'dataProvider' => $model->search(),
                            'itemsCssClass' => 'table table-striped table-bordered table-hover',
                            'pagerCssClass' => 'dataTables_paginate',
                            'pager' => array('class' => 'PagerSA', 'header' => ''),
                            'summaryText' => '',
                            'emptyText' => 'Tiada data dijumpai',
                            'columns' => array(
                                array('header' => 'No', 'value' => '($this->grid->dataProvider->pagination->offset+$row+1)', 'htmlOptions' => array('width' => '1', 'align' => 'center')),
                                //'cat',
                                array('name' => 'code', 'value' => '$data->getdescr()'),
                                array('name' => 'label', 'value' => '$data->label'),
                                array('name' => 'sort', 'value' => '$data->sort'),
                                array('name' => 'updated_dt', 'value' => '$data->updated_dt', 'htmlOptions' => array('width' => '150')),
                                array('name' => 'updated_by', 'value' => '$data->updated_by', 'htmlOptions' => array('width' => '150')),
                                array('name' => 'lang', 'value' => '$data->lang'),
                                array('header' => 'Action', 'class' => 'CButtonColumn',
                                    'template' => '{update}&nbsp;&nbsp;{delete}',
                                    'htmlOptions' => array('width' => '150', 'align' => 'center'),
                                    'buttons' =>
                                    array(
                                        'update' => array(
                                            'options' => array('rel' => 'tooltip', 'data-toggle' => 'tooltip', 'title' => 'Update', 'class' => 'btn btn-xs btn-info'),
                                            'label' => '<i class="ace-icon fa fa-pencil bigger-120"></i>',
                                            'url' => 'Yii::app()->createUrl("ostRefList/update&cat_id=".$data->cat_id."&id=".$data->id)',
                                            'imageUrl' => false,
                                        ),
                                        'delete' => array(
                                            'options' => array('rel' => 'tooltip', 'data-toggle' => 'tooltip', 'title' => 'Delete', 'class' => 'btn btn-xs btn-danger',),
                                            'label' => '<i class="ace-icon fa fa-trash-o bigger-120"></i>',
                                            'imageUrl' => false,
                                            'url' => 'Yii::app()->createUrl("ostRefList/delete&cat_id=".$data->cat_id."&id=".$data->id)',
                                            //'click' => 'function() {var id = $(this).attr("href"); popupdelete(id);return false;}',
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

<!--<div id="dialog-confirm" class="hide">
    <div class="space-8"></div>
    <div class="alert alert-info bigger-110">This data will be deleted and cannot recover in the future</div>
    <div class="bigger-110 bolder center grey"><i class="ace-icon fa fa-hand-o-right blue bigger-120"></i>Are you sure to delete this data?</div>
    <div class="space-4"></div>
</div>

<script type="text/javascript">
    function popupdelete(id) {
        $("#dialog-confirm").removeClass('hide').dialog({
            resizable: false,
            width: '320',
            modal: true,
            title: '<h4 class="smaller red"><i class="ace-icon fa fa-exclamation-triangle"></i>&nbsp;&nbsp;Hapuskan Data</h4>',
            title_html: true,
            buttons: [{
                    html: "<i class='ace-icon fa fa-trash-o bigger-110'></i>&nbsp;Hapus&nbsp;",
                    "class": "btn btn-danger btn-xs",
                    click: function() {
                        location.href = "index.php?r=refCat/delete&id=" + id;
                    }
                }, {
                    html: "<i class='ace-icon fa fa-times bigger-110'></i>&nbsp;Batal&nbsp;",
                    "class": "btn btn-xs",
                    click: function() {
                        $(this).dialog("close");
                    }
                }
            ]
        });
    }

    jQuery(function($) {
        //override dialog's title function to allow for HTML titles
        $.widget("ui.dialog", $.extend({}, $.ui.dialog.prototype, {
            _title: function(title) {
                var $title = this.options.title || '&nbsp;'
                if (("title_html" in this.options) && this.options.title_html == true)
                    title.html($title);
                else
                    title.text($title);
            }
        }));
    });
</script>-->