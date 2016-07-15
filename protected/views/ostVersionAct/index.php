<?php
/* @var $this OstVersionActController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Ost Version Acts',
);

$this->menu=array(
	array('label'=>'Create OstVersionAct', 'url'=>array('create')),
	array('label'=>'Manage OstVersionAct', 'url'=>array('admin')),
);
?>

<h1>Ost Version Acts</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
