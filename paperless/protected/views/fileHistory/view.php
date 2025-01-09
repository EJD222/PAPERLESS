<?php
/* @var $this FileHistoryController */
/* @var $model FileHistory */

$this->breadcrumbs=array(
	'File Histories'=>array('index'),
	$model->id,
);

// $this->menu=array(
// 	array('label'=>'List FileHistory', 'url'=>array('index')),
// 	array('label'=>'Create FileHistory', 'url'=>array('create')),
// 	array('label'=>'Update FileHistory', 'url'=>array('update', 'id'=>$model->id)),
// 	array('label'=>'Delete FileHistory', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
// 	array('label'=>'Manage FileHistory', 'url'=>array('admin')),
// );
?>

<!-- <h1>View File History #<?php //echo $model->id; ?></h1> -->

<!-- <?php //$this->widget('zii.widgets.CDetailView', array(
	// 'data'=>$model,
	// 'attributes'=>array(
	// 	'id',
	// 	'parent_file_id',
	// 	'uploader_id',
	// 	'original_filename',
	// 	'file_extension',
	// 	'e_filename',
	// 	'file_path',
	// 	'status',
	// ),
//)); ?> -->

<div class="row">
    <div class="col-xl-12 col-lg-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">View File History #<?php echo $model->id; ?></h6>
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
                    <?php foreach ($model->attributes as $attribute => $value): ?>
                        <tr>
                           <th><?php echo $model->getAttributeLabel($attribute); ?></th>
                           <td><?php echo $value; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            </div>
        </div>
    </div>
</div>