<?php
/* @var $this OstActController */
/* @var $model OstAct */

$this->breadcrumbs=array(
	'Ost Acts'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List OstAct', 'url'=>array('index')),
	array('label'=>'Create OstAct', 'url'=>array('create')),
	array('label'=>'Update OstAct', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete OstAct', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage OstAct', 'url'=>array('admin')),
);
?>

<h1>View OstAct #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'date_proclamation_bi',
		'date_proclamation_bm',
		'highlight_act',
		'no_act',
		'act_name_bi',
		'act_name_bm',
		'doc_name_bi',
		'doc_name_bm',
		'date_consent',
		'date_effective_bi',
		'date_effective_bm',
		'pages',
		'date_received',
		'publish',
		'user_id',
		'ministry_id',
		'unit_id',
		'created_by',
		'created_dt',
		'updated_by',
		'updated_dt',
		'remarks',
		'hits',
		'year',
		'isactive',
	),
)); ?>
