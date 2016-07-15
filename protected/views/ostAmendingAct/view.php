<?php
/* @var $this OstAmendingActController */
/* @var $model OstAmendingAct */

$this->breadcrumbs=array(
	'Ost Amending Acts'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List OstAmendingAct', 'url'=>array('index')),
	array('label'=>'Create OstAmendingAct', 'url'=>array('create')),
	array('label'=>'Update OstAmendingAct', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete OstAmendingAct', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage OstAmendingAct', 'url'=>array('admin')),
);
?>

<h1>View OstAmendingAct #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'date_effective',
		'highlight_act',
		'no_act',
		'act_name_bi',
		'act_name_bm',
		'doc_name_bi',
		'doc_name_bm',
		'date_consent',
		'date_proclamation',
		'remarks_bm',
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
		'remarks_bi',
		'hits',
		'year',
		'isactive',
		'idasal',
	),
)); ?>
