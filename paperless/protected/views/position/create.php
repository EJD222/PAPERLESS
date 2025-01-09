<?php
/* @var $this PositionController */
/* @var $model Position */

$this->breadcrumbs=array(
	'Positions'=>array('index'),
	'Create',
);

// $this->menu=array(
// 	array('label'=>'List Position', 'url'=>array('index')),
// 	array('label'=>'Manage Position', 'url'=>array('admin')),
// );
?>

<!-- <h1>Create Position</h1>

<?php //$this->renderPartial('_form', array('model'=>$model)); ?> -->

<div class = "row">
	<div class="col-xl-12 col-lg-12">
		<div class="card shadow mb-4">
			<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
		        <h6 class="m-0 font-weight-bold text-primary">Create Position</h6>
		    </div>
		    <div class="card-body">
				<?php $this->renderPartial('_form', array('model'=>$model)); ?>
			</div>
		</div>
	</div>
</div>