<?php
/* @var $this FileAssignmentController */
/* @var $model FileAssignment */

$this->breadcrumbs=array(
	'File Assignments'=>array('index'),
	'Create',
);

// $this->menu=array(
// 	array('label'=>'List FileAssignment', 'url'=>array('index')),
// 	array('label'=>'Manage FileAssignment', 'url'=>array('admin')),
// );
?>

<!-- <h1>File Assignment</h1> -->

<div class = "row">
	<div class="col-xl-12 col-lg-12">
		<div class="card shadow mb-4">
			<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
		        <h6 class="m-0 font-weight-bold text-primary">Assign File</h6>
		    </div>
		    <div class="card-body">
				<?php $this->renderPartial('_form', array('fileAssignment'=>$fileAssignment)); ?>
			</div>
		</div>
	</div>
</div>