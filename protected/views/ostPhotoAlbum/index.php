<?php
/* @var $this OstPhotoAlbumController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Ost Photo Albums',
);

$this->menu=array(
	array('label'=>'Create OstPhotoAlbum', 'url'=>array('create')),
	array('label'=>'Manage OstPhotoAlbum', 'url'=>array('admin')),
);
?>

<h1>Ost Photo Albums</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
