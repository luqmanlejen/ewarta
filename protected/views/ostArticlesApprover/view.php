<?php
/* @var $this OstArticlesApproverController */
/* @var $model OstArticles */

$this->breadcrumbs=array(
	'Ost Articles'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'List OstArticles', 'url'=>array('index')),
	array('label'=>'Create OstArticles', 'url'=>array('create')),
	array('label'=>'Update OstArticles', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete OstArticles', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage OstArticles', 'url'=>array('admin')),
);
?>

<h1>View OstArticles #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'menu_id',
		'approval_sts',
		'title',
		'content',
		'display_type',
		'display_startdt',
		'display_enddt',
		'inform_user',
		'parent_id',
		'lang',
		'created_dt',
		'created_by',
		'updated_dt',
		'updated_by',
	),
)); ?>
