<?php
/* @var $this OstAmendingActController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Ost Amending Acts',
);

$this->menu=array(
	array('label'=>'Create OstAmendingAct', 'url'=>array('create')),
	array('label'=>'Manage OstAmendingAct', 'url'=>array('admin')),
);
?>

<h1>Ost Amending Acts</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
