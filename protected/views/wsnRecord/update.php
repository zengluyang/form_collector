<?php
/* @var $this WsnRecordController */
/* @var $model WsnRecord */

$this->breadcrumbs=array(
	'Wsn Records'=>array('index'),
	$model->NUMSEQ=>array('view','id'=>$model->NUMSEQ),
	'Update',
);

$this->menu=array(
	array('label'=>'List WsnRecord', 'url'=>array('index')),
	array('label'=>'Create WsnRecord', 'url'=>array('create')),
	array('label'=>'View WsnRecord', 'url'=>array('view', 'id'=>$model->NUMSEQ)),
	array('label'=>'Manage WsnRecord', 'url'=>array('admin')),
);
?>

<h1>Update WsnRecord <?php echo $model->NUMSEQ; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>