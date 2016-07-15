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
                <li>Manage PU</li>
                <li class="active">PU</li>
            </ul><!-- /.breadcrumb -->
        </div>
        <!-- /section:basics/content.breadcrumbs -->
        <div class="page-content">
            <?php include 'themes/admin/views/layouts/setting.php'; ?>
            <div class="page-header"><h1>PU</h1></div>
            <div class="row">
                <div class="col-xs-12">
                    <div class="dataTables_wrapper form-inline no-footer" id="dynamic-table_wrapper">
                        <?php $this->renderPartial('_search', array('model' => $model)); ?>
                        <?php
                        $this->widget('zii.widgets.grid.CGridView', array(
                            'id' => 'ost-pu-grid',
                            'dataProvider' => $model->search(),
                            'itemsCssClass' => 'table table-striped table-bordered table-hover',
                            'pagerCssClass' => 'dataTables_paginate',
                            'pager' => array('class' => 'PagerSA', 'header' => ''),
                            'summaryText' => '',
                            'emptyText' => 'No results found',
                            'columns' => array(
                                array('header' => 'No', 'value' => '($this->grid->dataProvider->pagination->offset+$row+1)', 'htmlOptions' => array('width' => '1', 'align' => 'center')),
                                'pu_no',
                                'sub_act_name_bi',
                                array('name' => 'date_proclamation', 'value' => '$data->date_proclamation', 'htmlOptions' => array('width' => '150', 'align' => 'center')),
                                //array('name' => 'updated_by', 'value' => '$data->reladmin->name'),
                                //array('name' => 'language', 'value' => '$data->displayLang($data->id)', 'htmlOptions' => array('width' => '100', 'align' => 'center'),),
                                array('header' => 'Action', 'class' => 'CButtonColumn',
                                    'template' => '{view}&nbsp;&nbsp;{update}&nbsp;&nbsp;{flag}',
                                    'htmlOptions' => array('width' => '150', 'align' => 'center'),
                                    'buttons' =>
                                    array(
                                        'view' => array(
                                            'options' => array('rel' => 'tooltip', 'data-toggle' => 'tooltip', 'title' => 'View', 'class' => 'btn btn-xs btn-purple'),
                                            'label' => '<i class="ace-icon fa fa-search bigger-120"></i>',
                                            'url' => 'Yii::app()->createUrl("ostPu/view&id=".$data->id)',
                                            'imageUrl' => false,
                                            'visible' => '1'
                                        ),
                                        'update' => array(
                                            'options' => array('rel' => 'tooltip', 'data-toggle' => 'tooltip', 'title' => 'Update', 'class' => 'btn btn-xs btn-info'),
                                            'label' => '<i class="ace-icon fa fa-pencil bigger-120"></i>',
                                            'url' => 'Yii::app()->createUrl("ostPu/update&id=".$data->id)',
                                            'imageUrl' => false,
                                            'visible' => '(Yii::app()->session["user_id"] == 42) ? 0 : 1'
                                        ),
                                        'flag' => array(
                                            'options' => array('rel' => 'tooltip', 'data-toggle' => 'tooltip', 'title' => 'Delete', 'class' => 'btn btn-xs btn-danger',),
                                            'label' => '<i class="ace-icon fa fa-trash-o bigger-120"></i>',
                                            'imageUrl' => false,
                                            'url' => 'Yii::app()->createUrl("ostPu/flagDelete&id=".$data->id)',
                                            'visible' => '(Yii::app()->session["user_id"] == 42) ? 0 : 1'
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
        activemenu('12', '11');
    });
</script>