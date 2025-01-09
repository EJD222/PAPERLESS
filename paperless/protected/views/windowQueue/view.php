<?php
/* @var $this WindowQueueController */
/* @var $model WindowQueue */

$this->breadcrumbs=array(
	'Window Queues'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List WindowQueue', 'url'=>array('index')),
	array('label'=>'Create WindowQueue', 'url'=>array('create')),
	array('label'=>'Update WindowQueue', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete WindowQueue', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage WindowQueue', 'url'=>array('admin')),
);
?>

<h1>View WindowQueue #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'account_id',
		'queue_id',
		'queue_counter',
	),
)); ?>
