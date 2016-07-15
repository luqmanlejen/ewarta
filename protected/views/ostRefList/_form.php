<?php $oRef = new OstRef(); ?>

<script src="<?php echo Yii::app()->baseUrl ?>/ckeditor/ckeditor.js"></script>
<script src="<?php echo Yii::app()->baseUrl ?>/ckeditor/ckfinder/ckfinder.js"></script>

<div class="form">
    <?php $form = $this->beginWidget('CActiveForm', array('id' => 'ost-ref-list-form', 'enableAjaxValidation' => false, 'htmlOptions' => array('class' => 'form-horizontal',))); ?>
    <div class="alert alert-danger"><i class="fa fa-info-circle"></i>&nbsp;&nbsp;Field with * are required</div>
    
    
    <div class="form-group">
        <div class="col-sm-10">
            
            <input type="hidden" name="cat_id" value="<?php echo $_GET['cat_id'] ?>"/>
            <?php //echo $form->error($model, 'cat_id'); ?>
        </div>
    </div>
    <div class="space-4"></div>
    
    <div class="form-group">
        <div class="col-sm-2"><?php echo $form->labelEx($model, 'code', array('class' => 'control-label')); ?></div>
        <div class="col-sm-10">
            <?php echo $form->textField($model, 'code', array('size' => 10, 'maxlength' => 10, 'class' => 'col-sm-5')); ?>
            <?php echo $form->error($model, 'code'); ?>
        </div>
    </div>
    <div class="space-4"></div>

    <div class="form-group">
        <div class="col-sm-2"><?php echo $form->labelEx($model, 'label', array('class' => 'control-label')); ?> (English version)</div>
        <div class="col-sm-10">
            <?php echo $form->textField($model, 'label', array('size' => 60, 'maxlength' => 255, 'class' => 'col-sm-5')); ?>
            <?php echo $form->error($model, 'label'); ?>
        </div>
    </div>
    <div class="space-4"></div>
    
    <div class="form-group">
        <div class="col-sm-2"><label>Label</label> (Malay version)</div>
        <div class="col-sm-10">
            <?php echo CHtml::textField('label_malay', $model2->label, array('class' => 'col-sm-5')); ?>
        </div>
    </div>
    <div class="space-4"></div>

    <div class="form-group">
        <div class="col-sm-2"><?php echo $form->labelEx($model, 'sort', array('class' => 'control-label')); ?></div>
        <div class="col-sm-10">
            <?php echo $form->textField($model, 'sort', array('size' => 60, 'maxlength' => 255, 'class' => 'col-sm-5')); ?>
            <?php echo $form->error($model, 'sort'); ?>
        </div>
    </div>
    <div class="space-4"></div>
    
<!--    <div class="form-group">
        <div class="col-sm-2"><?php //echo $form->labelEx($model, 'cat_id', array('class' => 'control-label')); ?></div>
        <div class="col-sm-10">
            <?php //echo $form->textField($model, 'cat_id', array('class' => 'col-sm-5')); ?>
            <?php // echo $form->error($model, 'cat_id'); ?>
        </div>
    </div>
    <div class="space-4"></div>-->
    
<!--    <div class="form-group">
        <div class="col-sm-2"><?php // echo $form->labelEx($model, 'parent_id', array('class' => 'control-label')); ?></div>
        <div class="col-sm-10">
            <?php // echo $form->textField($model, 'parent_id', array('class' => 'col-sm-5')); ?>
            <?php // echo $form->error($model, 'parent_id'); ?>
        </div>
    </div>
    <div class="space-4"></div>-->
    
<!--    <div class="form-group">
        <div class="col-sm-2"><?php // echo $form->labelEx($model, 'lang', array('class' => 'control-label')); ?></div>
        <div class="col-sm-10">
            <?php // echo $form->textField($model, 'lang', array('size' => 10, 'maxlength' => 10, 'class' => 'col-sm-5')); ?>
            <?php // echo $form->error($model, 'lang'); ?>
        </div>
    </div>
    <div class="space-4"></div>-->

    <div class="clearfix form-actions no-margin">
        <a href="index.php?r=OstRefList/list&cat_id=<?php echo $_GET['cat_id']; ?>" class="btn btn-purple"><i class="ace-icon fa fa-arrow-left bigger-110s"></i>&nbsp;Back</a>&nbsp;&nbsp;
        <button class="btn btn-success" type="button" onclick="window.location.reload()"><i class="ace-icon fa fa-undo bigger-110"></i>&nbsp;Reset</button>&nbsp;&nbsp;
        <button class="btn btn-primary" type="submit"><?php echo $model->isNewRecord ? '<i class="ace-icon fa fa-plus bigger-110"></i>&nbsp;Add' : '<i class="ace-icon fa fa-pencil bigger-110"></i>&nbsp;Update'; ?></button>
    </div>

    <?php $this->endWidget(); ?>
</div>

<script src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/js/jquery.hotkeys.js"></script>
<script src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/js/bootstrap-wysiwyg.js"></script>
<script type="text/javascript">
            jQuery(function($) {
                $('.editor1').ace_wysiwyg().prev().addClass('wysiwyg-style2');
            });
</script>

<script type="text/javascript">
    CKEDITOR.replace('ckeditor');
</script>