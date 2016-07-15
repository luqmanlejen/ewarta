<?php
/* @var $this OstPollAnsController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Ost Poll Ans',
);

$this->menu=array(
	array('label'=>'Create OstPollAns', 'url'=>array('create')),
	array('label'=>'Manage OstPollAns', 'url'=>array('admin')),
);
?>

<h1>Ost Poll Ans</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
