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
                <li>Publication</li>
                <li>Laws of Malaysia</li>
                <li class="active">Update Laws of Malaysia</li>
            </ul><!-- /.breadcrumb -->
        </div>
        <!-- /section:basics/content.breadcrumbs -->

        <div class="page-content no-padding-bottom">
            <?php include 'themes/admin/views/layouts/setting.php'; ?>
            <div class="page-header"><h1>Update Laws of Malaysia</h1></div>
            <div class="row">
                <div class="col-xs-12">
                    <?php 
//                    if($model->lom_type === '57'){
//                        $this->renderPartial('_form_act', array('model'=>$model, 'model2'=>$model2,));
//                    }else if($model->lom_type === '75'){
//                        $this->renderPartial('_form_cit', array('model'=>$model, 'model2'=>$model2,));
//                    }else{
                        $this->renderPartial('_form', array('model'=>$model, 'model2'=>$model2,));
//                    } 
                    ?>
                    <?php //$this->renderPartial('_form', array('model' => $model, 'model2' => $model2)); ?>
                </div>
            </div>
        </div>

    </div>
</div>

<script>
    $(function() {
        activemenu('20', '21');
    });
</script>