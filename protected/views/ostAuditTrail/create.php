<?php
/* @var $this OstAuditTrailController */
/* @var $model OstAuditTrail */

$this->breadcrumbs=array(
	'Ost Audit Trails'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List OstAuditTrail', 'url'=>array('index')),
	array('label'=>'Manage OstAuditTrail', 'url'=>array('admin')),
);
?>

<h1>Create OstAuditTrail</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>