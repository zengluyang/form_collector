<?php
/* @var $this WsnRecordController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Wsn Records',
);

$this->menu=array(
	array('label'=>'Create WsnRecord', 'url'=>array('create')),
	array('label'=>'Manage WsnRecord', 'url'=>array('admin')),
);
?>

<h1>Wsn Records</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
