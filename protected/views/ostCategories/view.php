<?php
/* @var $this OstCategoriesController */
/* @var $model OstCategories */

$this->breadcrumbs=array(
	'Ost Categories'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'List OstCategories', 'url'=>array('index')),
	array('label'=>'Create OstCategories', 'url'=>array('create')),
	array('label'=>'Update OstCategories', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete OstCategories', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage OstCategories', 'url'=>array('admin')),
);
?>

<h1>View OstCategories #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'title',
		'type',
		'parent_cat',
		'sort',
		'parent_lang',
		'lang',
		'created_dt',
		'created_by',
		'updated_dt',
		'updated_by',
	),
)); ?>
