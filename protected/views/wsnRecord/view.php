<?php
/* @var $this WsnRecordController */
/* @var $model WsnRecord */

$this->breadcrumbs=array(
	'Wsn Records'=>array('index'),
	$model->NUMSEQ,
);

$this->menu=array(
	array('label'=>'List WsnRecord', 'url'=>array('index')),
	array('label'=>'Create WsnRecord', 'url'=>array('create')),
	array('label'=>'Update WsnRecord', 'url'=>array('update', 'id'=>$model->NUMSEQ)),
	array('label'=>'Delete WsnRecord', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->NUMSEQ),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage WsnRecord', 'url'=>array('admin')),
);
?>

<h1>View WsnRecord #<?php echo $model->NUMSEQ; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'NUMSEQ',
		'NODEID',
		'TYPE',
		'TYPENOTE',
		'VALUE',
		'SENDTIME',
		'RECVTIME',
		'LOCALTION',
	),
)); ?>
