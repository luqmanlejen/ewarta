<?php
/* @var $this OstMenuPortalController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Ost Menu Portals',
);

$this->menu=array(
	array('label'=>'Create OstMenuPortal', 'url'=>array('create')),
	array('label'=>'Manage OstMenuPortal', 'url'=>array('admin')),
);
?>

<h1>Ost Menu Portals</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
