<?php
/* @var $this OstPollController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Ost Polls',
);

$this->menu=array(
	array('label'=>'Create OstPoll', 'url'=>array('create')),
	array('label'=>'Manage OstPoll', 'url'=>array('admin')),
);
?>

<h1>Ost Polls</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
