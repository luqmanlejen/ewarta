<?php
/* @var $this OstPerundanganController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Ost Perundangans',
);

$this->menu=array(
	array('label'=>'Create OstPerundangan', 'url'=>array('create')),
	array('label'=>'Manage OstPerundangan', 'url'=>array('admin')),
);
?>

<h1>Ost Perundangans</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
