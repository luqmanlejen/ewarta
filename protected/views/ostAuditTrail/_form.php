<?php
/* @var $this OstAuditTrailController */
/* @var $model OstAuditTrail */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'ost-audit-trail-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'user_id'); ?>
		<?php echo $form->textField($model,'user_id',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'user_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'action_datetime'); ?>
		<?php echo $form->textField($model,'action_datetime'); ?>
		<?php echo $form->error($model,'action_datetime'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'menu_id'); ?>
		<?php echo $form->textField($model,'menu_id'); ?>
		<?php echo $form->error($model,'menu_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'action_type'); ?>
		<?php echo $form->textField($model,'action_type',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'action_type'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'data_id'); ?>
		<?php echo $form->textField($model,'data_id'); ?>
		<?php echo $form->error($model,'data_id'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->