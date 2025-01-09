<?php
/* @var $this PositionController */
/* @var $model Position */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'position-form',
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
			<?php echo $form->labelEx($model,'position_name'); ?>
			<?php echo $form->textField($model,'position_name', array('size'=>60,'maxlength'=>255, 'class'=>'form-control')); ?>
			<!-- <?php //echo $form->error($model,'position_name'); ?> -->
		</div>

		<div class="col-sm-6">
			<?php echo $form->labelEx($model,'status'); ?>
			<?php echo $form->DropdownList($model,'status', array('' => 'Select Status', '1' => 'Open', '2' => 'Closed', '3' => 'Pending Approval', '4' => 'Filled'), array('class' => 'form-control', 'value' => '')); ?>
			<!-- <?php //echo $form->error($model,'status'); ?> -->
		</div>
	</div>

	<div class="form-group row">
		<div class="col-sm-12 d-flex justify-content-end">
			<div class="ml-auto mr-1">
				<?php echo CHtml::link('<span class="icon text-white-50"><i class="fas fa-user-times"></i></span><span class="text">Cancel</span>',$this->createAbsoluteUrl('position/listPosition'), array('class'=>'btn btn-danger btn-icon-split', 'onclick'=>'return confirm("Are you sure you want to cancel creating a position?")')); ?>
			</div>
			<div>
				<?php echo CHtml::link('<span class="icon text-white-50"><i class="fas fa-user-check"></i></span><span class="text">Save</span>', 'javascript:document.getElementById("position-form").submit();', array('class'=>'btn btn-success btn-icon-split')); ?>
			</div>
    	</div>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->