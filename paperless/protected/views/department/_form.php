<?php
/* @var $this DepartmentController */
/* @var $model Department */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'department-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="form-group row">
		<div class="col-sm-6">
			<?php echo $form->labelEx($model,'department_name'); ?>
			<?php echo $form->textField($model,'department_name', array('size'=>60,'maxlength'=>255, 'class'=>'form-control')); ?>
			<!-- <?php //echo $form->error($model,'department_name'); ?> -->
		</div>

		<div class="col-sm-6">
			<?php echo $form->labelEx($model,'status'); ?>
			<?php echo $form->DropdownList($model,'status', array('' => 'Select Status', '1' => 'Active', '2' => 'Inactive', '3' => 'Under Review', '4' => 'Archived'), array('class' => 'form-control', 'value' => '')); ?>
			<!-- <?php //echo $form->error($model,'status'); ?> -->
		</div>
	</div>
	
	<div class="form-group row">
		<div class="col-sm-12 d-flex justify-content-end">
			<div class="ml-auto mr-1">
				<?php echo CHtml::link('<span class="icon text-white-50"><i class="fas fa-user-times"></i></span><span class="text">Cancel</span>',$this->createAbsoluteUrl('department/listDepartment'), array('class'=>'btn btn-danger btn-icon-split', 'onclick'=>'return confirm("Are you sure you want to cancel creating a department?")')); ?>
			</div>
			<div>
				<?php echo CHtml::link('<span class="icon text-white-50"><i class="fas fa-user-check"></i></span><span class="text">Save</span>', 'javascript:document.getElementById("department-form").submit();', array('class'=>'btn btn-success btn-icon-split')); ?>
			</div>
    	</div>
	</div>

	<!-- <div class="row buttons">
		<?php //echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div> -->


<?php $this->endWidget(); ?>

</div><!-- form -->