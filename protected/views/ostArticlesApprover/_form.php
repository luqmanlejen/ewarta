<?php
$menu_type = 'header';
if (!$model->isNewRecord) {
    $modelmenu = OstMenuPortal::model()->findByPk($model->menu_id);
    if (sizeof($modelmenu) > 0)
        $menu_type = $modelmenu->menu_type;
}

$statusp = '';
$statust = '';

if ($model->isNewRecord) {
    $statusp = 'checked';
} else {
    if ($model->display_type == 'p')
        $statusp = 'checked';
    if ($model->display_type == 't')
        $statust = 'checked';
}

$daterange = '';

if (!$model->isNewRecord) {
    if ($model->display_type == 't') {
        if ($model->display_startdt != '0000-00-00 00:00:00' && $model->display_enddt != '0000-00-00 00:00:00') {
            $daterange = date("d/m/Y", strtotime($model->display_startdt)) . ' - ' . date("d/m/Y", strtotime($model->display_enddt));
        }
    }
}
?>

<link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/assets/css/jquery-ui.custom.css" />
<link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/assets/css/chosen.css" />
<link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/assets/css/datepicker.css" />
<link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/assets/css/bootstrap-timepicker.css" />
<link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/assets/css/daterangepicker.css" />
<link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/assets/css/bootstrap-datetimepicker.css" />
<link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/assets/css/colorpicker.css" />

<script src="<?php echo Yii::app()->baseUrl ?>/ckeditor/ckeditor.js"></script>
<script src="<?php echo Yii::app()->baseUrl ?>/ckeditor/ckfinder/ckfinder.js"></script>

<div class="form">

    <?php $form = $this->beginWidget('CActiveForm', array('id' => 'ost-articles-form', 'enableAjaxValidation' => false, 'htmlOptions' => array('class' => 'form-horizontal'))); ?>

    <div class="alert alert-danger"><i class="fa fa-info-circle"></i>&nbsp;&nbsp;Field with * are required</div>

    <div class="form-group">
        <div class="col-sm-2"><label class="control-label">Position</label></div>
        <div class="col-sm-10">
            <?php
            echo CHtml::dropDownList('menu_type', $menu_type, array('header' => 'Header', 'footer' => 'Footer', 'others' => 'Others'), array('class' => 'col-sm-2', 'ajax' => array(
                    'type' => 'POST',
                    'url' => CController::createUrl('ostArticles/changeparent'),
                    'success' => 'function(data){
                            $("#OstArticles_menu_id").html(data);
                        }'
                ,)));
            ?>
        </div>
    </div>
    <div class="space-4"></div>

    <div class="form-group">
        <div class="col-sm-2"><?php echo $form->labelEx($model, 'menu_id', array('class' => 'control-label')); ?></div>
        <div class="col-sm-10">
            <?php echo $form->dropdownlist($model, 'menu_id', OstMenuPortal::model()->getparent($menu_type), array('class' => 'col-sm-12')); ?>
            <?php echo $form->error($model, 'menu_id'); ?>
        </div>
    </div>
    <div class="space-4"></div>

    <div class="form-group">
        <div class="col-sm-2"><?php echo $form->labelEx($model, 'display_type', array('class' => 'control-label')); ?></div>
        <div class="col-sm-10">
            <div class="col-sm-2">
                <div class="radio">
                    <label class="no-padding">
                        <input name="OstArticles[display_type]" class="ace" type="radio" value="p" <?php echo $statusp; ?>>
                        <span class="lbl"> Permanent</span>
                    </label>
                </div>
            </div>
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-2">&nbsp;</div>
        <div class="col-sm-10">
            <div class="col-sm-2">
                <div class="radio">
                    <label class="no-padding">
                        <input name="OstArticles[display_type]" class="ace" type="radio" value="t" <?php echo $statust; ?>>
                        <span class="lbl"> Temporary : </span>
                    </label>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="fa fa-calendar bigger-110"></i>
                    </span>
                    <input class="form-control" type="text" name="daterange" placeholder="Display Date Range" value="<?php echo $daterange; ?>"/>
                </div>
            </div>
        </div>
    </div>
    <div class="space-4"></div>

    <div class="form-group">
        <div class="col-sm-2"><?php echo $form->labelEx($model, 'title', array('class' => 'control-label')); ?> (English Version)</div>
        <div class="col-sm-10">
            <?php echo $form->textField($model, 'title', array('maxlength' => 255, 'class' => 'col-sm-12')); ?>
            <?php echo $form->error($model, 'title'); ?>
        </div>
    </div>
    <div class="space-4"></div>

    <div class="form-group">
        <div class="col-sm-2"><label class="control-label">Title</label> (Malay Version)</div>
        <div class="col-sm-10"><?php echo CHtml::textField('title_my', $model2->title, array('maxlength' => 255, 'class' => 'col-sm-12')); ?></div>
    </div>
    <div class="space-4"></div>

    <div class="form-group">
        <div class="col-sm-2"><?php echo $form->labelEx($model, 'content', array('class' => 'control-label')); ?> <br>(English Version)</div>
        <div class="col-sm-10">
            <?php echo $form->textArea($model, 'content'); ?>
            <?php echo $form->error($model, 'content'); ?>
        </div>
    </div>
    <div class="space-4"></div>

    <div class="form-group">
        <div class="col-sm-2"><label class="control-label">Content</label> <br>(Malay Version)</div>
        <div class="col-sm-10"><?php echo CHtml::textArea('content_my', $model2->content); ?></div>
    </div>
    <div class="space-4"></div>

    <!-- Inform User -->

    <div class="form-group">
        <div class="col-sm-2"><?php echo $form->labelEx($model, 'inform_user', array('class' => 'control-label')); ?></div>
        <div class="col-sm-10">
            <?php echo $form->textArea($model, 'inform_user', array('rows' => 6, 'class' => 'col-sm-12')); ?>
            <?php echo $form->error($model, 'inform_user'); ?>
        </div>
    </div>
    <div class="space-4"></div>

    <div class="form-group">
        <div class="col-sm-2"><?php echo $form->labelEx($model, 'approval_sts', array('class' => 'control-label')); ?></div>
        <div class="col-sm-10">
            <?php echo $form->dropdownlist($model, 'approval_sts', array('publish' => 'Publish', 'rework' => 'Rework'), array('class' => 'col-sm-2')); ?>
            <?php echo $form->error($model, 'approval_sts'); ?>
        </div>
    </div>
    <div class="space-4"></div>

    <div class="clearfix form-actions no-margin">
        <a href="index.php?r=ostArticlesApprover/admin" class="btn btn-purple"><i class="ace-icon fa fa-arrow-left bigger-110s"></i>&nbsp;Back</a>&nbsp;&nbsp;
        <a href="<?php echo Yii::app()->request->getUrl(); ?>" class="btn btn-success"><i class="ace-icon fa fa-undo bigger-110"></i>&nbsp;Reset</a>&nbsp;&nbsp;
        <button class="btn btn-primary" type="submit"><i class="ace-icon fa fa-pencil bigger-110"></i>&nbsp;Update</button>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->

<script src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/js/date-time/bootstrap-datepicker.js"></script>
<script src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/js/date-time/bootstrap-timepicker.js"></script>
<script src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/js/date-time/moment.js"></script>
<script src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/js/date-time/daterangepicker.js"></script>

<script src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/js/jquery.hotkeys.js"></script>
<script src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/js/bootstrap-wysiwyg.js"></script>

<script>
    $(function() {

        CKEDITOR.replace('OstArticles_content', {height: 300});
        CKEDITOR.replace('content_my', {height: 300});

        $('input[name=daterange]').daterangepicker({
            format: 'DD/MM/YYYY',
            'applyClass': 'btn-sm btn-success',
            'cancelClass': 'btn-sm btn-default',
            locale: {
                applyLabel: 'Apply',
                cancelLabel: 'Cancel',
            }
        }).prev().on(ace.click_event, function() {
            $(this).next().focus();
        });

        $(document).one('ajaxloadstart.page', function(e) {
            $('textarea[class*=autosize]').trigger('autosize.destroy');
            $('.limiterBox,.autosizejs').remove();
            $('.daterangepicker.dropdown-menu,.colorpicker.dropdown-menu,.bootstrap-datetimepicker-widget.dropdown-menu').remove();
        });

    });

</script>