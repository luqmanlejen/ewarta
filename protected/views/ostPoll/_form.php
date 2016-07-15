<script src="<?php echo Yii::app()->baseUrl ?>/ckeditor/ckeditor.js"></script>
<script src="<?php echo Yii::app()->baseUrl ?>/ckeditor/ckfinder/ckfinder.js"></script>

<div class="form">
    <?php $form = $this->beginWidget('CActiveForm', array('id' => 'ost-poll-form', 'enableAjaxValidation' => false, 'htmlOptions' => array('class' => 'form-horizontal',))); ?>
    <div class="alert alert-danger"><i class="fa fa-info-circle"></i>&nbsp;&nbsp;Field with * are required</div>

    <?php echo $form->hiddenField($model, 'id'); ?> 

    <div class="form-group">
        <div class="col-sm-3"><?php echo $form->labelEx($model, 'question', array('class' => 'control-label')); ?> (English Version)</div>
        <div class="col-sm-9">
            <?php echo $form->textField($model, 'question', array('class' => 'col-sm-12')); ?>
            <?php echo $form->error($model, 'question'); ?>
        </div>
    </div>
    <div class="space-4"></div>        

    <div class="form-group">
        <div class="col-sm-3"><label class="control-label">Question</label> (Malay Version)</div>
        <div class="col-sm-9"><?php echo CHtml::textField('question_my', $model3->question, array('maxlength' => 255, 'class' => 'col-sm-12')); ?></div>
    </div>
    <div class="space-4"></div>
    
    
    <div class="form-group">
        <div class="col-sm-3"><?php echo $form->labelEx($model, 'status', array('class' => 'control-label')); ?></div>
        <div class="col-sm-9">
            <?php echo $form->dropdownlist($model, 'status', array('0' => 'Not Active', '1' => 'Active',), array('class' => 'col-sm-2')); ?>
            <?php echo $form->error($model, 'status'); ?>
        </div>
    </div>
    <div class="space-4"></div>
    
    <div class="clearfix form-actions no-margin">
        <a href="index.php?r=OstPoll/admin" class="btn btn-purple"><i class="ace-icon fa fa-arrow-left bigger-110s"></i>&nbsp;Back</a>&nbsp;&nbsp;
        <button id="reset" class="btn btn-success" type="button" onclick="window.location.reload(true);"><i class="ace-icon fa fa-undo bigger-110"></i>&nbsp;Reset</button>&nbsp;&nbsp;
        <button class="btn btn-primary" type="submit"><?php echo $model->isNewRecord ? '<i class="ace-icon fa fa-plus bigger-110"></i>&nbsp;Add' : '<i class="ace-icon fa fa-pencil bigger-110"></i>&nbsp;Update'; ?></button>&nbsp;&nbsp;
        
        <?php if (Yii::app()->controller->action->id == 'update') { ?>
            <a href="index.php?r=OstPollAns/create&id=<?php echo $_GET['id'] ?>" class="btn btn-grey width-11"><i class="ace-icon fa fa-plus"></i>&nbsp;Add Answer</a>
        <?php } ?>
    </div>

    <?php $this->endWidget(); ?>
</div>