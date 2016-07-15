<script src="<?php echo Yii::app()->baseUrl ?>/ckeditor/ckeditor.js"></script>
<script src="<?php echo Yii::app()->baseUrl ?>/ckeditor/ckfinder/ckfinder.js"></script>

<div class="form">
    <?php $form = $this->beginWidget('CActiveForm', array('id' => 'ost-poll-ans-form', 'enableAjaxValidation' => false, 'htmlOptions' => array('class' => 'form-horizontal',))); ?>
    <div class="alert alert-danger"><i class="fa fa-info-circle"></i>&nbsp;&nbsp;Field with * are required</div>

    <?php echo $form->hiddenField($model, 'id'); ?> 

    <div class="form-group">
        <div class="col-sm-3"><?php echo $form->labelEx($model, 'answer', array('class' => 'control-label')); ?> (English Version)</div>
        <div class="col-sm-9">
            <?php echo $form->textField($model, 'answer', array('class' => 'col-sm-12')); ?>
            <?php echo $form->error($model, 'answer'); ?>
        </div>
    </div>
    <div class="space-4"></div>        

    <div class="form-group">
        <div class="col-sm-3"><label class="control-label">Question</label> (Malay Version)</div>
        <div class="col-sm-9"><?php echo CHtml::textField('answer_my', $model2->answer, array('maxlength' => 255, 'class' => 'col-sm-12')); ?></div>
    </div>
    <div class="space-4"></div>
    
    <div class="clearfix form-actions no-margin">
        <?php if (Yii::app()->controller->action->id == 'update') { ?>
        <a href="index.php?r=OstPoll/update&id=<?php echo $_GET['question_id'] ?>" class="btn btn-purple"><i class="ace-icon fa fa-arrow-left bigger-110s"></i>&nbsp;Back</a>&nbsp;&nbsp;
        <?php } if (Yii::app()->controller->action->id == 'create') { ?>
            <a href="index.php?r=OstPoll/create&id=<?php echo $_GET['id'] ?>" class="btn btn-purple"><i class="ace-icon fa fa-arrow-left bigger-110s"></i>&nbsp;Back</a>&nbsp;&nbsp;
        <?php } ?>
        <button id="reset" class="btn btn-success" type="button" onclick="window.location.reload(true);"><i class="ace-icon fa fa-undo bigger-110"></i>&nbsp;Reset</button>&nbsp;&nbsp;
        <button class="btn btn-primary" type="submit"><?php echo $model->isNewRecord ? '<i class="ace-icon fa fa-plus bigger-110"></i>&nbsp;Add' : '<i class="ace-icon fa fa-pencil bigger-110"></i>&nbsp;Update'; ?></button>        
    </div>

    <?php $this->endWidget(); ?>
</div>

<script>
    $(function() {

        //CKEDITOR.replace('OstPollAns_answer', {height: 150});
        //CKEDITOR.replace('answer_my', {height: 150});
        
    });
</script>