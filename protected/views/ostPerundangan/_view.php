<?php
/* @var $this OstPerundanganController */
/* @var $data OstPerundangan */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('no_act')); ?>:</b>
	<?php echo CHtml::encode($data->no_act); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('act_name_bi')); ?>:</b>
	<?php echo CHtml::encode($data->act_name_bi); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('act_name_bm')); ?>:</b>
	<?php echo CHtml::encode($data->act_name_bm); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('doc_name_bi')); ?>:</b>
	<?php echo CHtml::encode($data->doc_name_bi); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('doc_name_bm')); ?>:</b>
	<?php echo CHtml::encode($data->doc_name_bm); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('remarks_bm')); ?>:</b>
	<?php echo CHtml::encode($data->remarks_bm); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('pages')); ?>:</b>
	<?php echo CHtml::encode($data->pages); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('publish')); ?>:</b>
	<?php echo CHtml::encode($data->publish); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('user_id')); ?>:</b>
	<?php echo CHtml::encode($data->user_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('created_by')); ?>:</b>
	<?php echo CHtml::encode($data->created_by); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('created_dt')); ?>:</b>
	<?php echo CHtml::encode($data->created_dt); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('updated_by')); ?>:</b>
	<?php echo CHtml::encode($data->updated_by); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('updated_dt')); ?>:</b>
	<?php echo CHtml::encode($data->updated_dt); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('remarks_bi')); ?>:</b>
	<?php echo CHtml::encode($data->remarks_bi); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('hits')); ?>:</b>
	<?php echo CHtml::encode($data->hits); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('year')); ?>:</b>
	<?php echo CHtml::encode($data->year); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('isactive')); ?>:</b>
	<?php echo CHtml::encode($data->isactive); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('idasal')); ?>:</b>
	<?php echo CHtml::encode($data->idasal); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('act_type')); ?>:</b>
	<?php echo CHtml::encode($data->act_type); ?>
	<br />

	*/ ?>

</div>