<?php
/* @var $this WindowQueueController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Window Queues',
);

$this->menu=array(
	array('label'=>'Create WindowQueue', 'url'=>array('create')),
	array('label'=>'Manage WindowQueue', 'url'=>array('admin')),
);
?>

<h1>Window Queues</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
