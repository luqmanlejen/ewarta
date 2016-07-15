<?php
Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#ost-audit-trail-grid').yiiGridView('update', {
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
                <li>CMS Administration</li>
                <li class="active">Audit Trail</li>
            </ul><!-- /.breadcrumb -->
        </div>
        <!-- /section:basics/content.breadcrumbs -->

        <div class="page-content">
            <?php include 'themes/admin/views/layouts/setting.php'; ?>
            <div class="page-header"><h1>Audit Trail</h1></div>
            <div class="row">
                <div class="col-xs-12">
                    <div class="dataTables_wrapper form-inline no-footer" id="dynamic-table_wrapper">
                        <?php $this->renderPartial('_search', array('model' => $model,)); ?>
                        <?php
                        $this->widget('zii.widgets.grid.CGridView', array(
                            'id' => 'ost-audit-trail-grid',
                            'dataProvider' => $model->search(),
                            'itemsCssClass' => 'table table-striped table-bordered table-hover',
                            'pagerCssClass' => 'dataTables_paginate',
                            'pager' => array('class' => 'PagerSA', 'header' => ''),
                            'summaryText' => '',
                            'emptyText' => 'No results found',
                            'columns' => array(
                                array('header' => 'No', 'value' => '($this->grid->dataProvider->pagination->offset+$row+1)', 'htmlOptions' => array('width' => '1', 'align' => 'center')),
                                array('name' => 'user_id', 'value' => '$data->reladmin->name'),
                                array('name' => 'menu_id', 'value' => '$data->displaydetail($data->menu_id)'),
                                array('name' => 'action_datetime', 'value' => '$data->action_datetime', 'htmlOptions' => array('width' => '150px')),
                                array('name' => 'action_type', 'value' => 'ucfirst($data->action_type)', 'htmlOptions' => array('width' => '150px')),
                                array('name' => 'data_id', 'value' => '$data->data_id', 'htmlOptions' => array('width' => '150px')),
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
        activemenu('1', '4');
    });


    function popupdelete(id) {
        alert(id);
    }
</script>

<!--<script type="text/javascript">
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