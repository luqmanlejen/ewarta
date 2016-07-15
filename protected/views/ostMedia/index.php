<?php
/* @var $this OstMediaController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Ost Medias',
);

$this->menu=array(
	array('label'=>'Create OstMedia', 'url'=>array('create')),
	array('label'=>'Manage OstMedia', 'url'=>array('admin')),
);
?>

<h1>Ost Medias</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
