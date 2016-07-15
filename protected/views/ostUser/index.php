<?php
/* @var $this OstUserController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Ost Users',
);

$this->menu=array(
	array('label'=>'Create OstUser', 'url'=>array('create')),
	array('label'=>'Manage OstUser', 'url'=>array('admin')),
);
?>

<h1>Ost Users</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
