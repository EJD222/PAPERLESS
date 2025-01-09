<?php
/* @var $this WindowQueueController */
/* @var $model WindowQueue */

$this->breadcrumbs=array(
	'Window Queues'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List WindowQueue', 'url'=>array('index')),
	array('label'=>'Manage WindowQueue', 'url'=>array('admin')),
);
?>

<!-- <h1>Create Window Queue</h1> -->

<!-- <?php //$this->renderPartial('showWindowQueue', array('windowQueue'=>$windowQueue, 'model'=>$model, 'queue' => $queue)); ?> -->

<div class = "row">
	<div class="col-xl-12 col-lg-12">
		<div class="card shadow mb-4">
			<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
		        <h6 class="m-0 font-weight-bold text-primary">Window Queue Information</h6>
		    </div>
		    <div class="card-body">
			 <?php $this->renderPartial('showWindowQueue', array('windowQueue'=>$windowQueue, 'model'=>$model, 'queue' => $queue)); ?>
			</div>
		</div>
	</div>
</div>