<?php
/* @var $this PositionController */
/* @var $model Position */

$this->breadcrumbs=array(
	'Positions'=>array('index'),
	$model->id,
);

// $this->menu=array(
// 	array('label'=>'List Position', 'url'=>array('index')),
// 	array('label'=>'Create Position', 'url'=>array('create')),
// 	array('label'=>'Update Position', 'url'=>array('update', 'id'=>$model->id)),
// 	array('label'=>'Delete Position', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
// 	array('label'=>'Manage Position', 'url'=>array('admin')),
// );
// ?>

<!-- <h1>View Position #<?php// echo $model->id; ?></h1> -->

<?php //$this->widget('zii.widgets.CDetailView', array(
	// 'data'=>$model,
	// 'attributes'=>array(
	// 	'id',
	// 	'position_name',
	// 	'status',
	// ),
// )); ?>

<div class="row">
    <div class="col-xl-12 col-lg-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">View Position #<?php echo $model->id; ?></h6>
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
                <tr>
                    <th>ID</th>
                    <th>Position Name</th>
                    <th>Status</th>
                </tr>
                <tbody>
                    <tr>
                    <td><?php echo $model->id; ?></td>
                    <td><?php echo $model->position_name; ?></td>
                    <td>
                        <?php
                        $positionStatus = $model->getPositionStatus($model->id);
                        $badgeClass = '';

                        switch ($positionStatus) {
                            case 'Open':
                                $badgeClass = 'badge-success';
                                break;
                            case 'Closed':
                                $badgeClass = 'badge-danger';
                                break;
                            case 'Pending Approval':
                                $badgeClass = 'badge-warning';
                                break;
                            case 'Filled':
                                $badgeClass = 'badge-info';
                                break;
                        }
                        ?>
                        <span class="badge rounded-pill <?php echo $badgeClass; ?>">
                        <?php echo $positionStatus; ?>
                        </span>
                                </td>
                    </tr>
                </tbody>
                </table>

            </div>
        </div>
    </div>
</div>