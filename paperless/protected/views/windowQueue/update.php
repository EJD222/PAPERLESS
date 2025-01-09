<?php
/* @var $this WindowQueueController */
/* @var $model WindowQueue */

$this->breadcrumbs=array(
	'Window Queues'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List WindowQueue', 'url'=>array('index')),
	array('label'=>'Create WindowQueue', 'url'=>array('create')),
	array('label'=>'View WindowQueue', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage WindowQueue', 'url'=>array('admin')),
);
?>

<h1>Update WindowQueue <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>