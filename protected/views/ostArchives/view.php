<?php
/* @var $this OstArchivesController */
/* @var $model OstArchives */

$this->breadcrumbs=array(
	'Ost Archives'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List OstArchives', 'url'=>array('index')),
	array('label'=>'Create OstArchives', 'url'=>array('create')),
	array('label'=>'Update OstArchives', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete OstArchives', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage OstArchives', 'url'=>array('admin')),
);
?>

<h1>View OstArchives #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'value',
	),
)); ?>
