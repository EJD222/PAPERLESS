<?php
/* @var $this WindowQueueController */
/* @var $data WindowQueue */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('account_id')); ?>:</b>
	<?php echo CHtml::encode($data->account_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('queue_id')); ?>:</b>
	<?php echo CHtml::encode($data->queue_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('queue_counter')); ?>:</b>
	<?php echo CHtml::encode($data->queue_counter); ?>
	<br />


</div>