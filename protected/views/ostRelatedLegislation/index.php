<?php
/* @var $this OstRelatedLegislationController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Ost Related Legislations',
);

$this->menu=array(
	array('label'=>'Create OstRelatedLegislation', 'url'=>array('create')),
	array('label'=>'Manage OstRelatedLegislation', 'url'=>array('admin')),
);
?>

<h1>Ost Related Legislations</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
