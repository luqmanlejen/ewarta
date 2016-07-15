<?php
/* @var $this OstUserController */
/* @var $model OstUser */

$this->breadcrumbs=array(
	'Ost Users'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List OstUser', 'url'=>array('index')),
	array('label'=>'Create OstUser', 'url'=>array('create')),
	array('label'=>'Update OstUser', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete OstUser', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage OstUser', 'url'=>array('admin')),
);
?>

<h1>View OstUser #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'hrstafperibadi_id',
		'name',
		'ic_no',
		'email',
		'pwd',
		'status',
		'notes',
		'created_dt',
		'created_by',
		'updated_dt',
		'updated_by',
	),
)); ?>
