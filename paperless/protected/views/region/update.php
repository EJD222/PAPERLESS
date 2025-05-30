<?php
/* @var $this RegionController */
/* @var $model Region */

$this->breadcrumbs=array(
	'Regions'=>array('index'),
	$model->region_id=>array('view','id'=>$model->region_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Region', 'url'=>array('index')),
	array('label'=>'Create Region', 'url'=>array('create')),
	array('label'=>'View Region', 'url'=>array('view', 'id'=>$model->region_id)),
	array('label'=>'Manage Region', 'url'=>array('admin')),
);
?>

<h1>Update Region <?php echo $model->region_id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>