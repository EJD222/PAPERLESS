<?php
/* @var $this TransactionController */
/* @var $model Transaction */

$this->breadcrumbs=array(
	'Transactions'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

// $this->menu=array(
// 	array('label'=>'List Transaction', 'url'=>array('index')),
// 	array('label'=>'Create Transaction', 'url'=>array('create')),
// 	array('label'=>'View Transaction', 'url'=>array('view', 'id'=>$model->id)),
// 	array('label'=>'Manage Transaction', 'url'=>array('admin')),
// );
?>


<div class = "row">
	<div class="col-xl-12 col-lg-12">
		<div class="card shadow mb-4">
			<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
		        <h6 class="m-0 font-weight-bold text-primary">Update Transaction</h6>
		    </div>
		    <div class="card-body">
				<?php $this->renderPartial('_form', array('model'=>$model)); ?>
			</div>
		</div>
	</div>
</div>