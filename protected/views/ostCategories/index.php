<?php
/* @var $this OstCategoriesController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Ost Categories',
);

$this->menu=array(
	array('label'=>'Create OstCategories', 'url'=>array('create')),
	array('label'=>'Manage OstCategories', 'url'=>array('admin')),
);
?>

<h1>Ost Categories</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
