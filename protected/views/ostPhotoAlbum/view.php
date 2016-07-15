<?php
/* @var $this OstPhotoAlbumController */
/* @var $model OstPhotoAlbum */

$this->breadcrumbs=array(
	'Ost Photo Albums'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'List OstPhotoAlbum', 'url'=>array('index')),
	array('label'=>'Create OstPhotoAlbum', 'url'=>array('create')),
	array('label'=>'Update OstPhotoAlbum', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete OstPhotoAlbum', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage OstPhotoAlbum', 'url'=>array('admin')),
);
?>

<h1>View OstPhotoAlbum #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'title',
		'descr',
		'event_dt',
		'parent_id',
		'lang',
		'created_dt',
		'created_by',
		'updated_dt',
		'updated_by',
	),
)); ?>
