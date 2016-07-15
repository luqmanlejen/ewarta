<div class="form">

    <?php $form = $this->beginWidget('CActiveForm', array('id' => 'ost-categories-form', 'enableAjaxValidation' => false, 'htmlOptions' => array('class' => 'form-horizontal'))); ?>

    <div class="alert alert-danger"><i class="fa fa-info-circle"></i>&nbsp;&nbsp;Field with * are required</div>

    <div class="form-group">
        <div class="col-sm-2"><?php echo $form->labelEx($model, 'title', array('class' => 'control-label')); ?> (English Version)</div>
        <div class="col-sm-10">
            <?php echo $form->textField($model, 'title', array('maxlength' => 255, 'class' => 'col-sm-7')); ?>
            <?php echo $form->error($model, 'title'); ?>
        </div>
    </div>
    <div class="space-4"></div>

    <div class="form-group">
        <div class="col-sm-2"><label class="control-label required">Title</label> (Malay Version)</div>
        <div class="col-sm-10"><?php echo CHtml::textField('title_my', $model2->title, array('maxlength' => 255, 'class' => 'col-sm-7')); ?></div>
    </div>
    <div class="space-4"></div>

    <div class="form-group">
        <div class="col-sm-2"><?php echo $form->labelEx($model, 'type', array('class' => 'control-label')); ?></div>
        <div class="col-sm-10">
            <?php echo $form->dropdownlist($model, 'type', $model->gettype(), array('prompt'=>'--Please Choose--', 'class' => 'col-sm-7')); ?>
            <?php echo $form->error($model, 'type'); ?>
        </div>
    </div>
    <div class="space-4"></div>

    <div class="form-group">
        <div class="col-sm-2"><?php echo $form->labelEx($model, 'parent_cat', array('class' => 'control-label')); ?></div>
        <div class="col-sm-10">
            <?php echo $form->dropdownlist($model, 'parent_cat', $model->getparent(), array('class'=>'col-sm-7')); ?>
            <?php echo $form->error($model, 'parent_cat'); ?>
        </div>
    </div>
    <div class="space-4"></div>

    <div class="form-group">
        <div class="col-sm-2"><?php echo $form->labelEx($model, 'sort', array('class' => 'control-label')); ?></div>
        <div class="col-sm-10">
            <?php echo $form->textField($model, 'sort', array('class' => 'col-sm-2')); ?>
            <?php echo $form->error($model, 'sort'); ?>
        </div>
    </div>
    <div class="space-4"></div>

    <div class="clearfix form-actions no-margin">
        <a href="index.php?r=ostCategories/admin" class="btn btn-purple"><i class="ace-icon fa fa-arrow-left bigger-110s"></i>&nbsp;Back</a>&nbsp;&nbsp;
        <button class="btn btn-success" type="button" onclick="window.location.reload()"><i class="ace-icon fa fa-undo bigger-110"></i>&nbsp;Reset</button>&nbsp;&nbsp;
        <button class="btn btn-primary" type="submit"><?php echo $model->isNewRecord ? '<i class="ace-icon fa fa-plus bigger-110"></i>&nbsp;Add' : '<i class="ace-icon fa fa-pencil bigger-110"></i>&nbsp;Update'; ?></button>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->