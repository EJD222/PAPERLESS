<?php
/* @var $this AccountController */
/* @var $model Account */

$this->breadcrumbs=array(
	'Accounts'=>array('index'),
	'Create',
);

/* $this->menu=array(
	array('label'=>'List Account', 'url'=>array('index')),
	array('label'=>'Manage Account', 'url'=>array('admin')),
); */
?>

<!-- <h1>Create Account</h1> -->
<?php //$this->renderPartial('_form', array('model'=>$model)); ?>

<div class="row">
	<div class="col-xl-12 col-lg-12">
		<div class="card shadow mb-4">
			<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
		        <h6 class="m-0 font-weight-bold text-primary">Create Account</h6>
		    </div>
		    <div class="card-body">
				<?php echo $this->renderPartial('_form', array('account' => $account, 'user' => $user)); ?>
			</div>
		</div>
	</div>