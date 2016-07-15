<?php
/* @var $this OstMenuController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Ost Menus',
);

$this->menu=array(
	array('label'=>'Create OstMenu', 'url'=>array('create')),
	array('label'=>'Manage OstMenu', 'url'=>array('admin')),
);
?>

<h1>Ost Menus</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
