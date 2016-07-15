<?php
/* @var $this OstPollController */
/* @var $model OstPoll */

$this->breadcrumbs=array(
	'Ost Polls'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List OstPoll', 'url'=>array('index')),
	array('label'=>'Create OstPoll', 'url'=>array('create')),
	array('label'=>'Update OstPoll', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete OstPoll', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage OstPoll', 'url'=>array('admin')),
);
?>

<h1>View OstPoll #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'question',
		'status',
		'parent_id',
		'lang',
		'created_dt',
		'created_by',
		'updated_dt',
		'updated_by',
	),
)); ?>
