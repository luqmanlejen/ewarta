<?php
/* @var $this OstLomController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Ost Loms',
);

$this->menu=array(
	array('label'=>'Create OstLom', 'url'=>array('create')),
	array('label'=>'Manage OstLom', 'url'=>array('admin')),
);
?>

<h1>Ost Loms</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
