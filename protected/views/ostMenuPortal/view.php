<?php
/* @var $this OstMenuPortalController */
/* @var $model OstMenuPortal */

$this->breadcrumbs=array(
	'Ost Menu Portals'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'List OstMenuPortal', 'url'=>array('index')),
	array('label'=>'Create OstMenuPortal', 'url'=>array('create')),
	array('label'=>'Update OstMenuPortal', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete OstMenuPortal', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage OstMenuPortal', 'url'=>array('admin')),
);
?>

<h1>View OstMenuPortal #<?php echo $model->id; ?></h1>

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
