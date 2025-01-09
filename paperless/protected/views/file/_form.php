<?php
/* @var $this FileController */
/* @var $model File */
/* @var $form CActiveForm */

?>


<div class="form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'file-form',
        'enableAjaxValidation' => false,
    ));
    ?>

    <p class="note">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->errorSummary($model); ?>

	<!-- <div class="row">
		<?php //echo CHtml::fileField('uploaded_file', '', array('accept' => '.pdf, .doc, .docx')); ?>
    </div>

    <div class="row">
        <?php //echo $form->labelEx($model, 'record_num'); ?>
        <?php //echo $form->textField($model, 'record_num', array('size' => 60, 'maxlength' => 128)); ?>
        <?php //echo $form->error($model, 'record_num'); ?>
    </div>

    <div class="row">
        <?php //echo $form->labelEx($model, 'uploader_id'); ?>
        <?php //echo $form->textField($model, 'uploader_id'); ?>
        <?php //echo $form->error($model, 'uploader_id'); ?>
    </div>

    <div class="row">
        <?php //echo $form->labelEx($model, 'original_filename'); ?>
        <?php //echo $form->textField($model, 'original_filename', array('size' => 60, 'maxlength' => 255)); ?>
        <?php //echo $form->error($model, 'original_filename'); ?>
    </div>

    <div class="row">
        <?php //echo $form->labelEx($model, 'file_extension'); ?>
        <?php //echo $form->textField($model, 'file_extension', array('size' => 10, 'maxlength' => 10)); ?>
        <?php //echo $form->error($model, 'file_extension'); ?>
    </div>

    <div class="row">
        <?php //echo $form->labelEx($model, 'e_filename'); ?>
        <?php //echo $form->textField($model, 'e_filename', array('size' => 60, 'maxlength' => 255)); ?>
        <?php //echo $form->error($model, 'e_filename'); ?>
    </div>

	<div class="row">
        <?php //echo $form->labelEx($model, 'e_filename'); ?>
        <?php //echo $form->textField($model, 'e_filename', array('id' => 'File_e_filename', 'size' => 60, 'maxlength' => 255)); ?>
        <?php echo $form->error($model, 'e_filename'); ?>
    </div>
 -->
 	
    <div class="form-group row">
        <div class="col-sm-6">
            <?php echo $form->labelEx($model, 'status'); ?>
                <?php echo $form->dropDownList( 
                    $model,
                    'status',
                    array(
                        '1' => 'Not Downloadable',
                        '2' => 'Downloadable',
                    ),
                    array('class' => 'form-control', 'value' => '')
                ); ?>
            <?php echo $form->error($model,'status'); ?>
        </div>
    </div>
    
    <div class="form-group row">
        <div class="col-sm-12 d-flex justify-content-start">
            <div class="mr-1">
                <?php echo CHtml::link('<span class="icon text-white-50"><i class="fas fa-user-times"></i></span><span class="text">Cancel</span>', $this->createAbsoluteUrl('file/departmentFiles'), array('class' => 'btn btn-danger btn-icon-split', 'onclick' => 'return confirm("Are you sure you want to cancel updating a file?")')); ?>
            </div>
            <div>
                <?php echo CHtml::link('<span class="icon text-white-50"><i class="fas fa-user-check"></i></span><span class="text">Save</span>', 'javascript:document.getElementById("file-form").submit();', array('class'=>'btn btn-success btn-icon-split')); ?>
			</div>
        </div>
    </div>

    <?php $this->endWidget(); ?>
</div><!-- form -->