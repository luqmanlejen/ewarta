<?php
/* @var $this OstMenuController */
/* @var $model OstMenu */

$this->breadcrumbs=array(
	'Ost Menus'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'List OstMenu', 'url'=>array('index')),
	array('label'=>'Create OstMenu', 'url'=>array('create')),
	array('label'=>'Update OstMenu', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete OstMenu', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage OstMenu', 'url'=>array('admin')),
);
?>

<h1>View OstMenu #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'title',
		'parent_menu',
		'sort',
		'url',
		'menu_type',
		'parent_lang',
		'lang',
		'hide_ind',
		'required_approval',
		'created_dt',
		'created_by',
		'updated_dt',
		'updated_by',
	),
)); ?>
