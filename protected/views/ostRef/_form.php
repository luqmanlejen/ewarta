<script src="<?php echo Yii::app()->baseUrl ?>/ckeditor/ckeditor.js"></script>
<script src="<?php echo Yii::app()->baseUrl ?>/ckeditor/ckfinder/ckfinder.js"></script>

<div class="form">
    <?php $form = $this->beginWidget('CActiveForm', array('id' => 'ost-ref-form', 'enableAjaxValidation' => false, 'htmlOptions' => array('class' => 'form-horizontal',))); ?>
    <div class="alert alert-danger"><i class="fa fa-info-circle"></i>&nbsp;&nbsp;Field with * are required</div>

    <div class="form-group">
        <div class="col-sm-2"><?php echo $form->labelEx($model, 'code', array('class' => 'control-label')); ?></div>
        <div class="col-sm-10">
            <?php echo $form->textField($model, 'code', array('size' => 10, 'maxlength' => 10, 'class' => 'col-sm-5')); ?>
            <?php echo $form->error($model, 'code'); ?>
        </div>
    </div>
    <div class="space-4"></div>

    <div class="form-group">
        <div class="col-sm-2"><?php echo $form->labelEx($model, 'cat', array('class' => 'control-label')); ?></div>
        <div class="col-sm-10">
            <?php echo $form->textField($model, 'cat', array('size' => 60, 'maxlength' => 255, 'class' => 'col-sm-5')); ?>
            <?php echo $form->error($model, 'cat'); ?>
        </div>
    </div>
    <div class="space-4"></div>

    <div class="form-group">
        <div class="col-sm-2"><?php echo $form->labelEx($model, 'descr', array('class' => 'control-label')); ?></div>
        <div class="col-sm-10">
            <?php echo $form->hiddenField($model, 'descr'); ?>
            <?php echo $form->textArea($model, 'descr', array('class' => 'ckeditor', 'id'=>'ckeditor')); ?>
            <?php echo $form->error($model, 'descr'); ?>
        </div>
    </div>
    <div class="space-4"></div>

    <div class="clearfix form-actions no-margin">
        <a href="index.php?r=OstRef/admin" class="btn btn-purple"><i class="ace-icon fa fa-arrow-left bigger-110s"></i>&nbsp;Back</a>&nbsp;&nbsp;
        <button class="btn btn-success" type="button" onclick="window.location.reload()"><i class="ace-icon fa fa-undo bigger-110"></i>&nbsp;Reset</button>&nbsp;&nbsp;
        <button class="btn btn-primary" type="submit"><?php echo $model->isNewRecord ? '<i class="ace-icon fa fa-plus bigger-110"></i>&nbsp;Add' : '<i class="ace-icon fa fa-pencil bigger-110"></i>&nbsp;Update'; ?></button>
    </div>

    <?php $this->endWidget(); ?>
</div>

<script src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/js/jquery.hotkeys.js"></script>
<script src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/js/bootstrap-wysiwyg.js"></script>
<script type="text/javascript">
            jQuery(function($) {
                $('.editor1').ace_wysiwyg().prev().addClass('wysiwyg-style1');
            });
</script>

<script type="text/javascript">
    CKEDITOR.replace('ckeditor',{
        allowedContent: true,
        toolbar: 'Basic',
        height: 300,
        enterMode: CKEDITOR.ENTER_BR,
        shiftEnterMode: CKEDITOR.ENTER_P,
        filebrowserBrowseUrl: 'ckeditor/ckfinder/ckfinder.html',
        filebrowserImageBrowseUrl: 'ckeditor/ckfinder/ckfinder.html?Type=Images',
        filebrowserFlashBrowseUrl: 'ckeditor/ckfinder/ckfinder.html?Type=Flash',
        filebrowserUploadUrl: 'ckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
        filebrowserImageUploadUrl: 'ckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
        filebrowserFlashUploadUrl: 'ckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash'
    });
</script>