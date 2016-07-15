<?php
/* @var $this OstPerundanganController */
/* @var $model OstPerundangan */

$this->breadcrumbs=array(
	'Ost Perundangans'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List OstPerundangan', 'url'=>array('index')),
	array('label'=>'Create OstPerundangan', 'url'=>array('create')),
	array('label'=>'Update OstPerundangan', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete OstPerundangan', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage OstPerundangan', 'url'=>array('admin')),
);
?>

<h1>View OstPerundangan #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'no_act',
		'act_name_bi',
		'act_name_bm',
		'doc_name_bi',
		'doc_name_bm',
		'remarks_bm',
		'pages',
		'publish',
		'user_id',
		'created_by',
		'created_dt',
		'updated_by',
		'updated_dt',
		'remarks_bi',
		'hits',
		'year',
		'isactive',
		'idasal',
		'act_type',
	),
)); ?>
