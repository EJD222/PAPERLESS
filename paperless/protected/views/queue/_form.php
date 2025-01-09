<?php
/* @var $this QueueController */
/* @var $model Queue */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'queue-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<!-- <div class="form-group row">
		<div class="col-sm-6">
			<?php //echo $form->labelEx($model,'transaction'); ?>
			<?php //echo $form->dropDownList($model, 'id', Transaction::getAllTransactions(), array('empty' => 'Select Department', 'class' => 'form-control', 'id' => 'departmentDropdown')); ?>
			<?php //echo $form->error($model,'id'); ?>
		</div>

		<div class="col-sm-6">
			<?php //echo $form->labelEx($model,'queue_no'); ?>
			<?php //echo $form->textField($model,'queue_no',array('size'=>60,'maxlength'=>128, 'class' => 'form-control')); ?>
			<?php //echo $form->error($model,'queue_no'); ?>
		</div>
	</div> -->

	<!-- <div class="form-group row">
		<div class="col-sm-6">
			<?php //echo $form->labelEx($model,'date_created'); ?>
			<?php //echo $form->hiddenField($model,'date_created', array('class' => 'form-control')); ?>
			<?php //echo $form->error($model,'date_created'); ?>
		</div>

		<div class="col-sm-6">
			<?php //echo $form->labelEx($model,'date_updated'); ?>
			<?php //echo $form->hiddenField($model,'date_updated', array('class' => 'form-control')); ?>
			<?php //echo $form->error($model,'date_updated'); ?>
		</div>
	</div>

	<div class="form-group row">
		<div class="col-sm-6">
			<?php //echo $form->labelEx($model,'type'); ?>
			<?php //echo $form->DropdownList($model,'type', array('' => 'Select Type', '1' => 'Regular', '2' => 'PWD', '3' => 'Pregnant', '4' => 'Senior Citizen'), array('class' => 'form-control', 'value' => '')); ?>
			<?php //echo $form->error($model,'type'); ?>
		</div> -->
	
	<div class="form-group row">
		<div class="col-sm-6">
			<?php echo $form->labelEx($model,'status'); ?>
			<?php echo $form->DropdownList($model,'status', array('' => 'Select Status', '1' => 'Queued', '2' => 'In Progress', '3' => 'Completed', '4' => 'On Hold'), array('class' => 'form-control', 'value' => '')); ?>
			<!-- <?php //echo $form->error($model,'status'); ?> -->
		</div>
	</div>

	<!-- <div class="form-group row buttons">
		<?php// echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div> -->

	<div class="form-group row">
    	<div class="col-sm-12 d-flex justify-content-start">
        	<div class="mr-1">
            <?php echo CHtml::link('<span class="icon text-white-50"><i class="fas fa-user-times"></i></span><span class="text">Cancel</span>', $this->createAbsoluteUrl('queue/showQueue'), array('class' => 'btn btn-danger btn-icon-split', 'onclick' => 'return confirm("Are you sure you want to cancel updating a queue?")')); ?>
        	</div>
        	<div>
            <?php echo CHtml::link('<span class="icon text-white-50"><i class="fas fa-user-check"></i></span><span class="text">Save</span>', 'javascript:document.getElementById("queue-form").submit();', array('class' => 'btn btn-success btn-icon-split')); ?>
			</div>
    	</div>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->