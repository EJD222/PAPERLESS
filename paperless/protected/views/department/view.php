<?php
/* @var $this DepartmentController */
/* @var $model Department */

$this->breadcrumbs=array(
	'Departments'=>array('index'),
	$model->id,
);

// $this->menu=array(
// 	array('label'=>'List Department', 'url'=>array('index')),
// 	array('label'=>'Create Department', 'url'=>array('create')),
// 	array('label'=>'Update Department', 'url'=>array('update', 'id'=>$model->id)),
// 	array('label'=>'Delete Department', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
// 	array('label'=>'Manage Department', 'url'=>array('admin')),
// );
?>

<!-- <h1>View Department #<?php// echo $model->id; ?></h1>

<?php //$this->widget('zii.widgets.CDetailView', array(
	// 'data'=>$model,
	// 'attributes'=>array(
	// 	'id',
	// 	'department_name',
	// 	'status',
	// ),
//)); ?> -->

<div class="row">
    <div class="col-xl-12 col-lg-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">View Department #<?php echo $model->id; ?></h6>
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
                        <td><?php echo $model->department_name; ?></td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <td>
							<?php
								$departmentStatus = $model->getDepartmentStatus($model->id);
								$badgeClass = '';

								switch ($departmentStatus) {
									case 'Active':
										$badgeClass = 'badge-primary';
										break;
									case 'Inactive':
										$badgeClass = 'badge-secondary';
										break;
									case 'Under Review':
										$badgeClass = 'badge-warning';
										break;
									case 'Archived':
										$badgeClass = 'badge-danger';
										break;
								}
							?>
							<span class="badge rounded-pill <?php echo $badgeClass; ?>">
								<?php echo $departmentStatus; ?>
							</span>
						</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


