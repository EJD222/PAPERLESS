<?php
/* @var $this AccountController */
/* @var $model Account */

$this->breadcrumbs=array(
	'Accounts'=>array('index'),
	$model->id,
);

// $this->menu=array(
// 	array('label'=>'List Account', 'url'=>array('index')),
// 	array('label'=>'Create Account', 'url'=>array('create')),
// 	array('label'=>'Update Account', 'url'=>array('update', 'id'=>$model->id)),
// 	array('label'=>'Delete Account', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
// 	array('label'=>'Manage Account', 'url'=>array('admin')),
// );
?>

<!-- <h1>View Account #<?//php echo $model->id; ?></h1> -->

<!-- <?php //$this->widget('zii.widgets.CDetailView', array(
	// 'data'=>$model,
	// 'attributes'=>array(
	// 	'id',
	// 	'username',
	// 	'password',
	// 	'email_address',
	// 	'salt',
	// 	'account_type',
	// 	'department_id',
	// 	'position_id',
	// 	'status',
	// 	'date_created',
	// 	'date_updated',
	// ),
// )); ?> -->

<div class="row">
    <div class="col-xl-12 col-lg-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">View Account #<?php echo $model->id; ?></h6>
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
                    <?php
                    $attributes = $model->attributes;
                    $attributeOrder = ['id', 'username', 'password', 'email_address', 'salt', 'account_type', 'department_id', 'position_id', 'status', 'date_created', 'date_updated'];

                    
                    foreach ($attributeOrder as $attribute):
                        ?>
                        <tr>
                            <th><?php echo $model->getAttributeLabel($attribute); ?></th>
                            <td>
                                <?php
                                // Check if the current attribute is 'account_type'
                                if ($attribute === 'account_type') {
                                    echo isset($model->this) ? $model->account->getAccountType($model->this->account_id) : 'N/A';
                                }
                                // Check if the current attribute is 'department_id'
                                elseif ($attribute === 'department_id') {
                                    echo isset($model->department) ? Department::model()->getAllDepartments()[$model->department_id] : 'N/A';
                                }
                                // Check if the current attribute is 'position_id'
                                elseif ($attribute === 'position_id') {
                                    echo isset($model->position) ? Position::model()->getAllPositions()[$model->position_id] : 'N/A';
                                }
                                // Check if the current attribute is 'status'
                                elseif ($attribute === 'status') {
                                    echo isset($model->this) ? $model->getAccountStatus($model->account_id) : 'N/A';
                                } else {
                                    // Display other attributes as usual
                                    echo $model->$attribute;
                                }
                                ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                                        
                </table>
            </div>
        </div>
    </div>
</div>

