<?php
/* @var $this TransactionController */
/* @var $model Transaction */

$this->breadcrumbs=array(
	'Transactions'=>array('index'),
	$model->id,
);

// $this->menu=array(
// 	array('label'=>'List Transaction', 'url'=>array('index')),
// 	array('label'=>'Create Transaction', 'url'=>array('create')),
// 	array('label'=>'Update Transaction', 'url'=>array('update', 'id'=>$model->id)),
// 	array('label'=>'Delete Transaction', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
// 	array('label'=>'Manage Transaction', 'url'=>array('admin')),
// );
// ?>

<!-- <h1>View Transaction #<?php //echo $model->id; ?></h1> -->

<!-- <?php //$this->widget('zii.widgets.CDetailView', array(
	// 'data'=>$model,
	// 'attributes'=>array(
	// 	'id',
	// 	'department_id',
	// 	'transaction',
	// 	'status',
	// ),
//)); ?> -->

<div class="row">
    <div class="col-xl-12 col-lg-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">View Transaction #<?php echo $model->id; ?></h6>
            </div>
            <div class="card-body">
                <?php if(Yii::app()->user->hasFlash('success')):?>
                    <div class="border-bottom-success ">
                        <?php echo Yii::app()->user->getFlash('success'); ?>
                    </div>
                <?php endif; ?>
                <?php if(Yii::app()->user->hasFlash('error')):?>
                    <div class="border-bottom-danger ">
                        <?php echo Yii::app()->user->getFlash('error'); ?>
                    </div>
                <?php endif; ?>
                <table class="table table-bordered" width="100%" cellspacing="0">
                <tbody>
                    <tr>
                        <th>ID</th>
                        <td><?php echo $model->id; ?></td>
                    </tr>
                    <tr>
                        <th>Department Name</th>
                        <td><?php echo $model->department->department_name; ?></td>
                    </tr>
                    <tr>
                        <th>Transaction</th>
                        <td><?php echo $model->transaction; ?></td>
                    </tr>

                    <tr>
                        <th>Status</th>
                        <td>
							<?php
								$transactionStatus = $model->getTransactionStatus($model->id);
								$badgeClass = '';

                                switch ($transactionStatus) {
                                    case 'Available':
                                        $badgeClass = 'badge-success';
                                        break;
                                    case 'Not Available':
                                        $badgeClass = 'badge-danger';
                                        break;
                                    case 'Pending':
                                        $badgeClass = 'badge-warning';
                                        break;
                                    case 'Deprecated':
                                        $badgeClass = 'badge-secondary';
                                        break;
                            }							?>
							<span class="badge rounded-pill <?php echo $badgeClass; ?>">
								<?php echo $transactionStatus; ?>
							</span>
						</td>
                    </tr>
                    </tbody>

                </table>
            </div>
        </div>
    </div>
</div>
