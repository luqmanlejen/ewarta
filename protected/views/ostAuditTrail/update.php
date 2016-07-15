<?php
/* @var $this OstAuditTrailController */
/* @var $model OstAuditTrail */

$this->breadcrumbs=array(
	'Ost Audit Trails'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List OstAuditTrail', 'url'=>array('index')),
	array('label'=>'Create OstAuditTrail', 'url'=>array('create')),
	array('label'=>'View OstAuditTrail', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage OstAuditTrail', 'url'=>array('admin')),
);
?>

<h1>Update OstAuditTrail <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>