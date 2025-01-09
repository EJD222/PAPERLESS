<?php
/* @var $this QueueController */
/* @var $model Queue */

$this->breadcrumbs=array(
	'Queues'=>array('index'),
	$model->id,
);

// $this->menu=array(
// 	array('label'=>'List Queue', 'url'=>array('index')),
// 	array('label'=>'Create Queue', 'url'=>array('create')),
// 	array('label'=>'Update Queue', 'url'=>array('update', 'id'=>$model->id)),
// 	array('label'=>'Delete Queue', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
// 	array('label'=>'Manage Queue', 'url'=>array('admin')),
// );
?>

<!-- <h1>View Queue #<?php //echo $model->id; ?></h1> -->

<!-- <?php //$this->widget('zii.widgets.CDetailView', array(
	// 'data'=>$model,
	// 'attributes'=>array(
	// 	'id',
	// 	'transaction_id',
	// 	'queue_no',
	// 	'date_created',
	// 	'date_updated',
	// 	'type',
	// 	'status',
	// ),
//)); ?> -->

<div class="row">
    <div class="col-xl-12 col-lg-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">View Queue #<?php echo $model->id; ?></h6>
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
                        <th>Transaction</th>
                        <td><?php echo $model->transaction->transaction; ?></td>
                    </tr>
                    <tr>
                        <th>Queue Number</th>
                        <td><?php echo $model->queue_no; ?></td>
                    </tr>
                    <tr>
                        <th>Type</th>
                        <td><?php echo $model->getQueueType($model->id); ?></td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <td>
							<?php
								$queueStatus = $model->getQueueStatus($model->id);
								$badgeClass = '';

                                switch ($queueStatus) {
                                    case 'Queued':
                                        $badgeClass = 'badge-primary';
                                        break;
                                    case 'In Progress':
                                        $badgeClass = 'badge-warning';
                                        break;
                                    case 'Completed':
                                        $badgeClass = 'badge-success';
                                        break;
                                    case 'On Hold':
                                        $badgeClass = 'badge-secondary';
                                        break;
                            }
							?>
							<span class="badge rounded-pill <?php echo $badgeClass; ?>">
								<?php echo $queueStatus; ?>
							</span>
						</td>
                    </tr>

                    <tr>
                        <th>Date Created</th>
                        <td><?php echo $model->date_created; ?></td>
                    </tr>
                    <tr>
                        <th>Date Updated</th>
                        <td><?php echo $model->date_updated; ?></td>
                    </tr>
                </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
                    <?php
                    $attributeOrder = ['id', 'transaction_id', 'queue_no', 'type', 'status', 'date_created','date_updated',];
