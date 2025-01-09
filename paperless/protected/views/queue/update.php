<?php
/* @var $this QueueController */
/* @var $model Queue */

$this->breadcrumbs=array(
	'Queues'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

// $this->menu=array(
// 	// array('label'=>'List Queue', 'url'=>array('index')),
// 	// array('label'=>'Create Queue', 'url'=>array('create')),
// 	// array('label'=>'View Queue', 'url'=>array('view', 'id'=>$model->id)),
// 	// array('label'=>'Manage Queue', 'url'=>array('admin')),
// );
?>

<!-- <h1>Update Queue <?php echo $model->id; ?></h1>

<?php //$this->renderPartial('_form', array('model'=>$model)); ?> -->

<div class = "row">
	<div class="col-xl-12 col-lg-12">
		<div class="card shadow mb-4">
			<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
		        <h6 class="m-0 font-weight-bold text-primary">Update Queue <?php echo $model->id; ?></h6>
		    </div>
		    <div class="card-body">
				<?php $this->renderPartial('_form', array('model'=>$model)); ?>
			</div>
		</div>
	</div>
</div>