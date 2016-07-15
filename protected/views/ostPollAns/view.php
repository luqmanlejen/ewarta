<?php
/* @var $this OstPollAnsController */
/* @var $model OstPollAns */

$this->breadcrumbs=array(
	'Ost Poll Ans'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List OstPollAns', 'url'=>array('index')),
	array('label'=>'Create OstPollAns', 'url'=>array('create')),
	array('label'=>'Update OstPollAns', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete OstPollAns', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage OstPollAns', 'url'=>array('admin')),
);
?>

<h1>View OstPollAns #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'question_id',
		'answer',
		'parent_id',
		'lang',
	),
)); ?>
