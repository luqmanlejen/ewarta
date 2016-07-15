<?php
/* @var $this OstArticlesController */
/* @var $data OstArticles */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('menu_id')); ?>:</b>
	<?php echo CHtml::encode($data->menu_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('approval_sts')); ?>:</b>
	<?php echo CHtml::encode($data->approval_sts); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('title')); ?>:</b>
	<?php echo CHtml::encode($data->title); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('content')); ?>:</b>
	<?php echo CHtml::encode($data->content); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('display_type')); ?>:</b>
	<?php echo CHtml::encode($data->display_type); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('display_startdt')); ?>:</b>
	<?php echo CHtml::encode($data->display_startdt); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('display_enddt')); ?>:</b>
	<?php echo CHtml::encode($data->display_enddt); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('inform_user')); ?>:</b>
	<?php echo CHtml::encode($data->inform_user); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('parent_id')); ?>:</b>
	<?php echo CHtml::encode($data->parent_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('lang')); ?>:</b>
	<?php echo CHtml::encode($data->lang); ?>
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