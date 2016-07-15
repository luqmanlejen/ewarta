<?php
/* @var $this OstMediaController */
/* @var $model OstMedia */

$this->breadcrumbs=array(
	'Ost Medias'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'List OstMedia', 'url'=>array('index')),
	array('label'=>'Create OstMedia', 'url'=>array('create')),
	array('label'=>'Update OstMedia', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete OstMedia', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage OstMedia', 'url'=>array('admin')),
);
?>

<h1>View OstMedia #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'media_type',
		'title',
		'img',
		'url',
		'parent_id',
		'lang',
		'created_dt',
		'created_by',
		'updated_dt',
		'updated_by',
	),
)); ?>
