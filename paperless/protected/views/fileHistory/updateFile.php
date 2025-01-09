<?php
/* @var $this FileHistoryController */
/* @var $model FileHistory */
/* @var $form CActiveForm */
?>

<div class="form">

    <?php $form = $this->beginWidget('CActiveForm', array(
        'id' => 'file-history-form',
        'enableAjaxValidation' => false,
        'htmlOptions' => array('enctype' => 'multipart/form-data'), // Enable file uploads
    )); ?>

    <p class="note">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->errorSummary($file); ?>

    <?php echo CHtml::activeHiddenField($file, 'parent_file_id'); ?>
    <?php echo CHtml::activeHiddenField($file, 'uploader_id'); ?>

    <div class="form-group row">
        <div class="col-sm-6">
            <?php echo $form->labelEx($file, 'file'); ?>
            <?php
            // Use fileField for file uploads
            echo $form->fileField($file, 'file', array(
                'class' => 'form-control',
                'style' => 'padding-bottom: 35px;'
            ));
            ?>
            <?php echo $form->error($file, 'file'); ?>
        </div>
        
        <div class="col-sm-6">
            <?php echo $form->labelEx($file, 'status'); ?>
            <?php echo $form->dropDownList( 
                $file,
                'status',
                array(
                    '1' => 'Active',
                    '2' => 'Draft',  
                    '3' => 'Versioned', 
                    '4' => 'Approved', 
                    '5' => 'Rejected'
                ),
                array('class' => 'form-control')
            ); ?>
            <?php echo $form->error($file, 'status');?>
        </div>
    </div>

    <!-- <div class="row buttons">
        <?php //echo CHtml::submitButton($file->isNewRecord ? 'Create' : 'Save'); ?>
    </div> -->

    <div class="form-group row">
        <div class="col-sm-12 d-flex justify-content-end">
        <div class="ml-auto mr-1">		
                <?php echo CHtml::link('<span class="icon text-white-50"><i class="fas fa-user-times"></i></span><span class="text">Cancel</span>',$this->createAbsoluteUrl('file/departmentFiles'), array('class'=>'btn btn-danger btn-icon-split', 'onclick'=>'return confirm("Are you sure you want to cancel updating a file?")')); ?>
            </div>
            <div>		
                <?php echo CHtml::link('<span class="icon text-white-50"><i class="fas fa-user-check"></i></span><span class="text">Save</span>', 'javascript:document.getElementById("file-history-form").submit();', array('class'=>'btn btn-success btn-icon-split')); ?>
            </div>
        </div>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->

<!-- Display Flash Messages -->
<?php
if (Yii::app()->user->hasFlash('success')) {
    echo '<div class="flash-success">' . Yii::app()->user->getFlash('success') . '</div>';
}
if (Yii::app()->user->hasFlash('error')) {
    echo '<div class="flash-error">' . Yii::app()->user->getFlash('error') . '</div>';
}
?>