<?php
/* @var $this OstArticlesApproverController */
/* @var $model OstArticles */

$this->breadcrumbs=array(
	'Ost Articles'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List OstArticles', 'url'=>array('index')),
	array('label'=>'Manage OstArticles', 'url'=>array('admin')),
);
?>

<h1>Create OstArticles</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>