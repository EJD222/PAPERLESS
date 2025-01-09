<?php
/* @var $this FileHistoryController */
/* @var $model FileHistory */

$this->breadcrumbs=array(
	'File Histories'=>array('index'),
	$file->id=>array('view','id'=>$file->id),
	'Update',
);

// $this->menu=array(
// 	array('label'=>'List FileHistory', 'url'=>array('index')),
// 	array('label'=>'Create FileHistory', 'url'=>array('create')),
// 	array('label'=>'View FileHistory', 'url'=>array('view', 'id'=>$model->id)),
// 	array('label'=>'Manage FileHistory', 'url'=>array('admin')),
// );
?>

<!-- <h1>Update File History <?php //echo $model->id; ?></h1> -->

<!-- <?php// $this->renderPartial('_form', array('model'=>$model)); ?> -->

<div class = "row">
	<div class="col-xl-12 col-lg-12">
		<div class="card shadow mb-4">
			<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
		        <h6 class="m-0 font-weight-bold text-primary">Update File <?php echo $file->id; ?></h6>
		    </div>
		    <div class="card-body">
				<?php $this->renderPartial('updateFile', array('file'=>$file)); ?>
			</div>
		</div>
	</div>
</div>

<!-- changed attribute $model to $file -->