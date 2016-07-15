<?php
/* @var $this OstRelatedLegislationController */
/* @var $model OstRelatedLegislation */

$this->breadcrumbs=array(
	'Ost Related Legislations'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List OstRelatedLegislation', 'url'=>array('index')),
	array('label'=>'Create OstRelatedLegislation', 'url'=>array('create')),
	array('label'=>'Update OstRelatedLegislation', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete OstRelatedLegislation', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage OstRelatedLegislation', 'url'=>array('admin')),
);
?>

<h1>View OstRelatedLegislation #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'gn_no',
		'related_id',
		'related_type',
		'title_bm',
		'title_bi',
		'date_proclamation',
		'date_effective',
		'doc_name_bm',
		'doc_name_bi',
		'remarks_bm',
		'remarks_bi',
		'publish',
		'created_dt',
		'created_by',
		'updated_dt',
		'updated_by',
		'hits',
	),
)); ?>
