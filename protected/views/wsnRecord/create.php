<?php
/* @var $this WsnRecordController */
/* @var $model WsnRecord */

$this->breadcrumbs=array(
	'Wsn Records'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List WsnRecord', 'url'=>array('index')),
	array('label'=>'Manage WsnRecord', 'url'=>array('admin')),
);
?>

<h1>Create WsnRecord</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>