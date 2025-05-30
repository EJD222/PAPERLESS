<?php
/* @var $this WindowQueueController */
/* @var $model WindowQueue */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'window-queue-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'account_id'); ?>
		<?php echo $form->textField($model,'account_id'); ?>
		<?php echo $form->error($model,'account_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'queue_id'); ?>
		<?php echo $form->textField($model,'queue_id'); ?>
		<?php echo $form->error($model,'queue_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'queue_counter'); ?>
		<?php echo $form->textField($model,'queue_counter',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'queue_counter'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->