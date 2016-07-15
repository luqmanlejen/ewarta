<?php
/* @var $this OstAuditTrailController */
/* @var $dataProvider CActiveDataProvider */

//$this->breadcrumbs=array(
//	'Ost Audit Trails',
//);

//$this->menu=array(
//	array('label'=>'Create OstAuditTrail', 'url'=>array('create')),
//	array('label'=>'Manage OstAuditTrail', 'url'=>array('admin')),
//);
?>

<h1>Ost Audit Trails</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
