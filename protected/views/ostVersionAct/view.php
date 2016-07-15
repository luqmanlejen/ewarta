<?php
/* @var $this OstVersionActController */
/* @var $model OstVersionAct */

$this->breadcrumbs=array(
	'Ost Version Acts'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List OstVersionAct', 'url'=>array('index')),
	array('label'=>'Create OstVersionAct', 'url'=>array('create')),
	array('label'=>'Update OstVersionAct', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete OstVersionAct', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage OstVersionAct', 'url'=>array('admin')),
);
?>

<h1>View OstVersionAct #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'act_id',
		'version_act_id',
		'created_dt',
		'created_by',
		'updated_dt',
		'updated_by',
		'publish',
		'doc_name_bi',
		'doc_name_bm',
		'remarks',
		'isactive',
		'hits',
		'version_year',
	),
)); ?>
