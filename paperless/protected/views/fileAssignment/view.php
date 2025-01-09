<?php
/* @var $this FileAssignmentController */
/* @var $model FileAssignment */

$this->breadcrumbs=array(
	'File Assignments'=>array('index'),
	$model->id,
);

// $this->menu=array(
// 	array('label'=>'List FileAssignment', 'url'=>array('index')),
// 	array('label'=>'Create FileAssignment', 'url'=>array('create')),
// 	array('label'=>'Update FileAssignment', 'url'=>array('update', 'id'=>$model->id)),
// 	array('label'=>'Delete FileAssignment', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
// 	array('label'=>'Manage FileAssignment', 'url'=>array('admin')),
// );
?>

<!-- <h1>View File Assignment #<?php// echo $model->id; ?></h1> -->

<!-- <?php //$this->widget('zii.widgets.CDetailView', array(
	// 'data'=>$model,
	// 'attributes'=>array(
	// 	'id',
	// 	'file_id',
	// 	'department_id',
	// 	'receiver_id',
	// 	'remarks',
	// 	'date_created',
	// 	'date_updated',
	// 	'status',
//	),
//)); ?> -->

<div class="row">
    <div class="col-xl-12 col-lg-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">View File Assignment #<?php echo $model->id; ?></h6>
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
                        <th>File</th>
                        <td><?php echo $model->file_id; ?></td>
                    </tr>
                    <tr>
                        <th>Department</th>
                        <td><?php echo $model->department->department_name; ?></td>
                    </tr>
                    <tr>
                        <th>Receiver</th>
                        <td><?php echo $model->receiver->username; ?></td>
                    </tr>
                    <tr>
                        <th>Remarks</th>
                        <td><?php echo $model->remarks; ?></td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <td>
                            <?php
                            $fileAssignmentStatus = $model->getFileAssignmentStatus($model->id);
                            $badgeClass = '';

                            switch ($fileAssignmentStatus) {
                                case 'Returned':
                                    $badgeClass = 'badge-danger';
                                    break;
                                case 'Rejected':
                                    $badgeClass = 'badge-warning'; // You can choose a different color for rejected status
                                    break;
                                case 'Passed':
                                    $badgeClass = 'badge-info'; // You can choose a different color for passed status
                                    break;
                                case 'Approved':
                                    $badgeClass = 'badge-success';
                                    break;
                                default:
                                    $badgeClass = 'badge-secondary';
                                    break;
                            }
                            ?>
                            <span class="badge rounded-pill <?php echo $badgeClass; ?>">
                                <?php echo $fileAssignmentStatus; ?>
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
