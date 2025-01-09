<?php
/* @var $this DepartmentController */
/* @var $model Department */

$this->breadcrumbs=array(
	'Departments'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

// $this->menu=array(
// 	array('label'=>'List Department', 'url'=>array('index')),
// 	array('label'=>'Create Department', 'url'=>array('create')),
// 	array('label'=>'View Department', 'url'=>array('view', 'id'=>$model->id)),
// 	array('label'=>'Manage Department', 'url'=>array('admin')),
// );
?>

<!-- <h1>Update Department <?php echo $model->id; ?></h1>

<?php //$this->renderPartial('_form', array('model'=>$model)); ?> -->


<div class = "row">
	<div class="col-xl-12 col-lg-12">
		<div class="card shadow mb-4">
			<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
		        <h6 class="m-0 font-weight-bold text-primary">Update Department</h6>
		    </div>
		    <div class="card-body">
				<?php $this->renderPartial('_form', array('model'=>$model)); ?>
			</div>
		</div>
	</div>
</div>
