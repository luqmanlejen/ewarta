<?php
/* @var $this OstLomController */
/* @var $model OstLom */

$this->breadcrumbs=array(
	'Ost Loms'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List OstLom', 'url'=>array('index')),
	array('label'=>'Create OstLom', 'url'=>array('create')),
	array('label'=>'Update OstLom', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete OstLom', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage OstLom', 'url'=>array('admin')),
);
?>

<h1>View OstLom #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'lom_type',
		'lom_no',
		'lom_year',
		'lom_cat',
		'lom_title',
		'lom_doc',
		'lom_rev',
		'lom_year_rev',
		'lom_parent_act',
		'lom_parent_lang',
		'lom_lang',
		'created_dt',
		'created_by',
		'updated_dt',
		'updated_by',
	),
)); ?>
