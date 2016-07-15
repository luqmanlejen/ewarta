<?php
/* @var $this OstLomController */
/* @var $data OstLom */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('lom_type')); ?>:</b>
	<?php echo CHtml::encode($data->lom_type); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('lom_no')); ?>:</b>
	<?php echo CHtml::encode($data->lom_no); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('lom_year')); ?>:</b>
	<?php echo CHtml::encode($data->lom_year); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('lom_cat')); ?>:</b>
	<?php echo CHtml::encode($data->lom_cat); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('lom_title')); ?>:</b>
	<?php echo CHtml::encode($data->lom_title); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('lom_doc')); ?>:</b>
	<?php echo CHtml::encode($data->lom_doc); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('lom_rev')); ?>:</b>
	<?php echo CHtml::encode($data->lom_rev); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('lom_year_rev')); ?>:</b>
	<?php echo CHtml::encode($data->lom_year_rev); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('lom_parent_act')); ?>:</b>
	<?php echo CHtml::encode($data->lom_parent_act); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('lom_parent_lang')); ?>:</b>
	<?php echo CHtml::encode($data->lom_parent_lang); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('lom_lang')); ?>:</b>
	<?php echo CHtml::encode($data->lom_lang); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('created_dt')); ?>:</b>
	<?php echo CHtml::encode($data->created_dt); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('created_by')); ?>:</b>
	<?php echo CHtml::encode($data->created_by); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('updated_dt')); ?>:</b>
	<?php echo CHtml::encode($data->updated_dt); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('updated_by')); ?>:</b>
	<?php echo CHtml::encode($data->updated_by); ?>
	<br />

	*/ ?>

</div>