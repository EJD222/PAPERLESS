<?php
/* @var $this DepartmentController */
/* @var $model Department */

$this->breadcrumbs=array(
	'Departments'=>array('index'),
	'Create',
);

// $this->menu=array(
// 	array('label'=>'List Department', 'url'=>array('index')),
// 	array('label'=>'Manage Department', 'url'=>array('admin')),
// );
?>

<!-- <h1>Create Department</h1>
<?php //$this->renderPartial('_form', array('model'=>$model)); ?>
 -->

<div class = "row">
	<div class="col-xl-12 col-lg-12">
		<div class="card shadow mb-4">
			<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
		        <h6 class="m-0 font-weight-bold text-primary">Create Department</h6>
		    </div>
		    <div class="card-body">
				<?php $this->renderPartial('_form', array('model'=>$model)); ?>
			</div>
		</div>
	</div>
</div>




