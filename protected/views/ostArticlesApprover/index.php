<?php
/* @var $this OstArticlesApproverController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Ost Articles',
);

$this->menu=array(
	array('label'=>'Create OstArticles', 'url'=>array('create')),
	array('label'=>'Manage OstArticles', 'url'=>array('admin')),
);
?>

<h1>Ost Articles</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
