<?php
/* @var $this FileAssignmentController */
/* @var $model FileAssignment */
/* @var $form CActiveForm */
?>

<div class="form">
    <?php $form=$this->beginWidget('CActiveForm', array(
        'id'=>'file-assignment-form',
  		'enableAjaxValidation'=>false,
        'enableClientValidation' => false,
    )); ?>

    <p class="note">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->errorSummary($fileAssignment); ?>

    <div class="form-group row">
        <div class="col-sm-6 mb-6 mb-sm-0 ">
            <?php echo $form->labelEx($fileAssignment, 'department_id'); ?>
            <?php echo $form->dropDownList($fileAssignment, 'department_id', Department::getAllDepartments(), array(
            'empty' => 'Select Department',
            'class' => 'form-control',
            'id' => 'departmentDropdown',
            'ajax' => array(
                'type' => 'POST',
                'url' => $this->createUrl('account/getAccountsByDepartment'),
                'dataType' => 'json',
                'update' => '#employeeDropdown',
                'data' => array('department_id' => 'js:this.value'),
            ),
            )); ?>
            <?php echo $form->error($fileAssignment, 'department_id'); ?>
        </div>

        <div class="col-sm-6 mb-6 mb-sm-0 ">
            <?php echo $form->labelEx($fileAssignment, 'receiver_id'); ?>
            <?php echo $form->dropDownList($fileAssignment, 'receiver_id', array(), array(
            'empty' => 'Select Employee',
            'class' => 'form-control',
            'id' => 'employeeDropdown',
            )); ?>
            <?php echo $form->error($fileAssignment, 'receiver_id'); ?>
        </div>
    </div>
    
    <div class="form-group row">

        <div class="col-sm-6 mb-6 mb-sm-0 ">
            <?php echo $form->labelEx($fileAssignment,'remarks'); ?>
            <?php echo $form->textField($fileAssignment,'remarks',array('size'=>60,'maxlength'=>255, 'class' => 'form-control')); ?>
            <?php echo $form->error($fileAssignment,'remarks'); ?>
	    </div>
    
        <div class="col-sm-6 mb-6 mb-sm-0 ">
            <?php echo $form->labelEx($fileAssignment,'status'); ?>
            <?php echo $form->textField($fileAssignment,'status', array('size'=>60,'maxlength'=>255, 'class'=>'form-control')); ?>
            <?php echo $form->error($fileAssignment,'status'); ?>
	    </div>
    </div>

    <div class="form-group row">
        <div class="col-sm-12 d-flex justify-content-end">
			<div class="ml-auto mr-1">
                <?php echo CHtml::link('<span class="icon text-white-50"><i class="fas fa-user-times"></i></span><span class="text">Cancel</span>',$this->createAbsoluteUrl('file/listFile'), array('class'=>'btn btn-danger btn-icon-split', 'onclick'=>'return confirm("Are you sure you want to cancel assigning a file?")')); ?>
			</div>
            <div>
                <?php echo CHtml::link('<span class="icon text-white-50"><i class="fas fa-user-check"></i></span><span class="text">Save</span>', 'javascript:document.getElementById("file-assignment-form").submit();', array('class'=>'btn btn-success btn-icon-split')); ?>
            </div>
	    </div>
    </div>

    <?php $this->endWidget(); ?>
</div>


<?php 
/* @var $this FileAssignmentController */
/* @var $model FileAssignment */
/* @var $form CActiveForm */
?>

<!-- <div class="form"> -->

<?php /* $form=$this->beginWidget('CActiveForm', array(
	'id'=>'file-assignment-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'file_id'); ?>
		<?php echo $form->textField($model,'file_id'); ?>
		<?php echo $form->error($model,'file_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'department_id'); ?>
		<?php echo $form->textField($model,'department_id'); ?>
		<?php echo $form->error($model,'department_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'receiver_id'); ?>
		<?php echo $form->textField($model,'receiver_id'); ?>
		<?php echo $form->error($model,'receiver_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'remarks'); ?>
		<?php echo $form->textField($model,'remarks',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'remarks'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'date_created'); ?>
		<?php echo $form->textField($model,'date_created'); ?>
		<?php echo $form->error($model,'date_created'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'date_updated'); ?>
		<?php echo $form->textField($model,'date_updated'); ?>
		<?php echo $form->error($model,'date_updated'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'status'); ?>
		<?php echo $form->textField($model,'status'); ?>
		<?php echo $form->error($model,'status'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div>*/