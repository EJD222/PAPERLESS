<?php
/* @var $this FileController */
/* @var $model File */

$this->breadcrumbs=array(
	'Files'=>array('index'),
	'Create',
);

// $this->menu=array(
// 	array('label'=>'List File', 'url'=>array('index')),
// 	array('label'=>'Manage File', 'url'=>array('admin')),
// );
?>

<!-- <h1>Create File</h1>

<?php //$this->renderPartial('_form', array('model'=>$model)); ?> -->

<div class = "row">
	<div class="col-xl-12 col-lg-12">
		<div class="card shadow mb-4">
			<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
		        <h6 class="m-0 font-weight-bold text-primary">Upload File</h6>
		    </div>
		    <div class="card-body">
				<?php $this->renderPartial('uploadFileForm', array('model'=>$model)); ?>
			</div>
		</div>
	</div>
</div>