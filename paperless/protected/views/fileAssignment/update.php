<?php
/* @var $this FileAssignmentController */
/* @var $model FileAssignment */

$this->breadcrumbs=array(
	'File Assignments'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List FileAssignment', 'url'=>array('index')),
	array('label'=>'Create FileAssignment', 'url'=>array('create')),
	array('label'=>'View FileAssignment', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage FileAssignment', 'url'=>array('admin')),
);
?>

<!-- <h1>Update File Assignment <?php //echo $model->id; ?></h1>

<?php //$this->renderPartial('assgnToDepartmentForm', array('model'=>$model)); ?> -->

<div class = "row">
	<div class="col-xl-12 col-lg-12">
		<div class="card shadow mb-4">
			<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
	            <h6 class="m-0 font-weight-bold text-primary">Update File Assignment<?php echo $file->id; ?></h6>
	        </div>
	        <div class="card-body">
				<?php echo $this->renderPartial('assignToDepartmentForm', array('file' => $file, 'department' => $department, 'fileAssignment' => $fileAssignment)); ?>
			</div>
		</div>
		<br/>
	</div>
</div>