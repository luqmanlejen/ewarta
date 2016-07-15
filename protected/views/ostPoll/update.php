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
                <li>Manage Poll</li>
                <li class="active">Update Poll</li>
            </ul><!-- /.breadcrumb -->
        </div>
        <!-- /section:basics/content.breadcrumbs -->

        <div class="page-content no-padding-bottom">
            <?php include 'themes/admin/views/layouts/setting.php'; ?>
            <div class="page-header"><h1>Update Poll</h1></div>
            <div class="row">
                <div class="col-xs-12">
                    <?php $this->renderPartial('_form', array('model' => $model, 'model2' => $model2, 'model3' => $model3)); ?>



                    <?php if (Yii::app()->controller->action->id == 'update') { ?>

                        <div class="title">

                            <div class="page-header"><h1>Poll Answers</h1></div>

                        </div>
                    
                        <div class="row">
                        
                        <?php
                        $this->widget('zii.widgets.grid.CGridView', array(
                            'id' => 'ost-poll-ans-grid',
                            'dataProvider' => $model2->search(),
                            'itemsCssClass' => 'table table-striped table-hover table-admin table-bordered',
                            'columns' => array(
                                array('header' => 'No', 'value' => '($this->grid->dataProvider->pagination->offset+$row+1)."."', 'htmlOptions' => array('width' => '50', 'align' => 'center')),
                                'answer',
                                array('name' => 'Language', 'value' => '$data->displayLang($data->id)', 'htmlOptions' => array('width' => '120', 'align' => 'center'),),
                                array('header' => 'Action', 'class' => 'CButtonColumn',
                                    'deleteConfirmation' => "js:'Are you sure that you want to delete this record?'",
                                    'template' => '{update}{delete}',
                                    'htmlOptions' => array('width' => '150', 'align' => 'center'),
                                    'buttons' =>
                                    array(
                                        'update' => array(
                                            'options' => array('rel' => 'tooltip', 'data-toggle' => 'tooltip', 'title' => 'Update', 'class' => 'btn btn-xs btn-info'),
                                            'label' => '<i class="ace-icon fa fa-pencil bigger-120"></i>',
                                            'url' => 'Yii::app()->createUrl("ostPollAns/update&id=".$data->id."&question_id=".$_GET["id"])',
                                            'imageUrl' => false,
                                            'visible' => '1'
                                        ),
                                        'delete' => array(
                                            'options' => array('rel' => 'tooltip', 'data-toggle' => 'tooltip', 'title' => 'Delete', 'class' => 'btn btn-xs btn-danger',),
                                            'label' => '<i class="ace-icon fa fa-trash-o bigger-120"></i>',
                                            'imageUrl' => false,
                                            'url' => 'Yii::app()->createUrl("OstPollAns/delete&id=".$data->id)',
                                            'visible' => '1'
                                        ),
                                    ),
                                ),
                            ),
                        ));
                    }
                    ?>


</div>
                </div>
            </div>
        </div>

    </div>
</div>

<script>
    $(function () {
        activemenu('7', '14');
    });
</script>