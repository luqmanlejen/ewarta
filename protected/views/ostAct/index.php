<?php
/* @var $this OstActController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Ost Acts',
);

$this->menu=array(
	array('label'=>'Create OstAct', 'url'=>array('create')),
	array('label'=>'Manage OstAct', 'url'=>array('admin')),
);
?>

<h1>Ost Acts</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
