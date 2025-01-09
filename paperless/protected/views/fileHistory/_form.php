<?php
/* @var $this FileHistoryController */
/* @var $model FileHistory */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form = $this->beginWidget('CActiveForm', array(
    'id' => 'file-history-form',
    'enableAjaxValidation' => false,
)); ?>

    <p class="note">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->errorSummary($model); ?>
    
    <?php echo CHtml::hiddenField(Yii::app()->getRequest()->csrfTokenName, Yii::app()->getRequest()->getCsrfToken()); ?>

    <div class="form-group row">
        <div class="col-sm-6">
            <?php echo $form->labelEx($model, 'parent_file_id'); ?>
            <?php
            // Use dropDownList or hiddenField for parent_file_id
            echo $form->dropDownList($model, 'parent_file_id', CHtml::listData(File::model()->findAll(), 'id', 'original_filename'), array('prompt' => 'Select Parent File', 'class'=>'form-control'));
            // Alternatively, you can use hiddenField
            // echo $form->hiddenField($model, 'parent_file_id');
            ?>
            <?php echo $form->error($model, 'parent_file_id'); ?>
        </div>
    
        <div class="col-sm-6">
            <?php echo $form->labelEx($model, 'uploader_id'); ?>
            <?php
            // Use dropDownList or hiddenField for uploader_id
            echo $form->dropDownList($model, 'uploader_id', CHtml::listData(User::model()->findAll(), 'id', 'username'), array('prompt' => 'Select Uploader', 'class'=>'form-control'));
            // Alternatively, you can use hiddenField
            // echo $form->hiddenField($model, 'uploader_id');
            ?>
            <?php echo $form->error($model, 'uploader_id'); ?>
        </div>    
    </div>

    <!-- <div class="form-group row">
        <div class="col-sm-12 d-flex justify-content-end">
            <div class="ml-auto mr-1">
                <?php //echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
            </div>
        </div>
    </div> -->

    
    <div class="form-group row">
        <div class="col-sm-12 d-flex justify-content-end">
            <div class="ml-auto mr-1">
                <?php echo CHtml::link('<span class="icon text-white-50"><i class="fas fa-user-check"></i></span><span class="text">Save</span>', 'javascript:document.getElementById("file-history-form").submit();', array('class'=>'btn btn-success btn-icon-split')); ?>
            </div>
        </div>
    </div>
    

<?php $this->endWidget(); ?>

</div><!-- form -->