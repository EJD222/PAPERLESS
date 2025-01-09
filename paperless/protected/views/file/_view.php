<?php
/* @var $this FileController */
/* @var $data File */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('record_num')); ?>:</b>
	<?php echo CHtml::encode($data->record_num); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('uploader_id')); ?>:</b>
	<?php echo CHtml::encode($data->uploader_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('original_filename')); ?>:</b>
	<?php echo CHtml::encode($data->original_filename); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('file_extension')); ?>:</b>
	<?php echo CHtml::encode($data->file_extension); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('e_filename')); ?>:</b>
	<?php echo CHtml::encode($data->e_filename); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('file_path')); ?>:</b>
	<?php echo CHtml::encode($data->file_path); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('status')); ?>:</b>
	<?php echo CHtml::encode($data->status); ?>
	<br />

	*/ ?>

</div>