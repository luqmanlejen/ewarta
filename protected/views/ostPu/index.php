<?php
/* @var $this OstPuController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Ost Pus',
);

$this->menu=array(
	array('label'=>'Create OstPu', 'url'=>array('create')),
	array('label'=>'Manage OstPu', 'url'=>array('admin')),
);
?>

<h1>Ost Pus</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
