<?php
/* @var $this OstRelatedLegislationController */
/* @var $data OstRelatedLegislation */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('gn_no')); ?>:</b>
	<?php echo CHtml::encode($data->gn_no); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('related_id')); ?>:</b>
	<?php echo CHtml::encode($data->related_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('related_type')); ?>:</b>
	<?php echo CHtml::encode($data->related_type); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('title_bm')); ?>:</b>
	<?php echo CHtml::encode($data->title_bm); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('title_bi')); ?>:</b>
	<?php echo CHtml::encode($data->title_bi); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('date_proclamation')); ?>:</b>
	<?php echo CHtml::encode($data->date_proclamation); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('date_effective')); ?>:</b>
	<?php echo CHtml::encode($data->date_effective); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('doc_name_bm')); ?>:</b>
	<?php echo CHtml::encode($data->doc_name_bm); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('doc_name_bi')); ?>:</b>
	<?php echo CHtml::encode($data->doc_name_bi); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('remarks_bm')); ?>:</b>
	<?php echo CHtml::encode($data->remarks_bm); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('remarks_bi')); ?>:</b>
	<?php echo CHtml::encode($data->remarks_bi); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('publish')); ?>:</b>
	<?php echo CHtml::encode($data->publish); ?>
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

	<b><?php echo CHtml::encode($data->getAttributeLabel('hits')); ?>:</b>
	<?php echo CHtml::encode($data->hits); ?>
	<br />

	*/ ?>

</div>