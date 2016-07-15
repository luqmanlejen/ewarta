<?php
/* @var $this RefCatController */
/* @var $model RefCat */

$this->breadcrumbs=array(
	'Ref Cats'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List RefCat', 'url'=>array('index')),
	array('label'=>'Create RefCat', 'url'=>array('create')),
	array('label'=>'Update RefCat', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete RefCat', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage RefCat', 'url'=>array('admin')),
);
?>

<h1>View RefCat #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'code',
		'cat',
		'descr',
		'created_dt',
		'created_by',
		'updated_dt',
		'updated_by',
	),
)); ?>
