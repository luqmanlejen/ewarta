<style>
.checkboxgroup{
        overflow:auto;
}
.checkboxgroup div{
        width:30%;
        float:left;
}
</style>
    
<?php
/* @var $this OstArchivesController */
/* @var $model OstArchives */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array('id'=>'ost-archives-form', 'enableAjaxValidation'=>false, 'htmlOptions' => array('class' => 'form-horizontal'))); ?>

	<div class="alert alert-info"><i class="fa fa-info-circle"></i>&nbsp;&nbsp;Tick the following list for auto-archives</div>

	<?php echo $form->errorSummary($model); ?>

	<div class="form-group">
<!--            <div class="col-sm-2"><?php echo $form->labelEx($model,'value'); ?></div>-->
            <div class="col-sm-12">
                <div class="checkboxgroup">
                    <?php 
                    //echo $form->textField($model,'value',array('size'=>60,'maxlength'=>100, 'class' => 'col-sm-7')); 
                    $type_list = CHtml::listData(OstRefList::model()->findAll(array('condition' => 'cat_id=10')), 'label', 'label');
                    $select_list = CHtml::listData(OstArchives::model()->findAll(), 'id', 'value');
                    echo CHtml::checkBoxList('OstArchives[value]', $select_list, $type_list, array('checked' => $model->value,'template' => "<div>{input}&nbsp;{label}</div>", 'separator'=>'',));
                    
                    //echo OstArchives::model()->displaylist($model->id, '10');
                    ?>
                    </div>
		<?php echo $form->error($model,'value'); ?>
            </div>
	</div>

	<div class="clearfix form-actions no-margin">
            <a href="index.php?r=ostArchives/admin" class="btn btn-purple"><i class="ace-icon fa fa-arrow-left bigger-110s"></i>&nbsp;Back</a>&nbsp;&nbsp;
            <a href="<?php echo Yii::app()->request->getUrl(); ?>" class="btn btn-success"><i class="ace-icon fa fa-undo bigger-110"></i>&nbsp;Reset</a>&nbsp;&nbsp;
            <?php 
            if ($model->isNewRecord)
                echo '<button class="btn btn-primary" type="submit"><i class="ace-icon fa fa-plus bigger-110"></i>&nbsp;Add</button>&nbsp;&nbsp;';
            else
                echo '<button class="btn btn-primary" type="submit"><i class="ace-icon fa fa-pencil bigger-110"></i>&nbsp;Update</button>&nbsp;&nbsp;';
            ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->