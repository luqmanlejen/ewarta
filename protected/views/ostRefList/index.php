<?php
/* @var $this RefCatController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Ref Cats',
);

$this->menu=array(
	array('label'=>'Create RefCat', 'url'=>array('create')),
	array('label'=>'Manage RefCat', 'url'=>array('admin')),
);
?>

<h1>Ref Cats</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
