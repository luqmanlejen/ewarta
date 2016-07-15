<?php
/* @var $this OstAuditTrailController */
/* @var $model OstAuditTrail */

$this->breadcrumbs=array(
	'Ost Audit Trails'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List OstAuditTrail', 'url'=>array('index')),
	array('label'=>'Create OstAuditTrail', 'url'=>array('create')),
	array('label'=>'Update OstAuditTrail', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete OstAuditTrail', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage OstAuditTrail', 'url'=>array('admin')),
);
?>

<h1>View OstAuditTrail #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'user_id',
		'action_datetime',
		'menu_id',
		'action_type',
		'data_id',
	),
)); ?>
