<?php
/* @var $this OstArchivesController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Ost Archives',
);

$this->menu=array(
	array('label'=>'Create OstArchives', 'url'=>array('create')),
	array('label'=>'Manage OstArchives', 'url'=>array('admin')),
);
?>

<h1>Ost Archives</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
