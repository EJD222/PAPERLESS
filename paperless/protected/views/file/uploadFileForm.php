<?php
/* @var $this FileController */
/* @var $model File */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form = $this->beginWidget('CActiveForm', array(
	'id' => 'upload-form',
	'enableAjaxValidation' => false,
	'htmlOptions' => array('enctype' => 'multipart/form-data'),
)); ?>

<div class="form-group row">
	<div class="col-sm-5">
		<?php echo $form->labelEx($model, 'file'); ?>
		<?php echo $form->fileField($model, 'file', array(
			'class' => 'form-control',
			'style' => 'padding-bottom: 35px;'
)); ?>
		<?php echo $form->error($model, 'file'); ?>
	</div>
</div>

<div class="form-group row">
	<div class="col-sm-12 justify-content-end">
		<div class="ml-auto mr-1">		
			<?php echo CHtml::link('<span class="icon text-white-50"><i class="fas fa-upload"></i></span><span class="text">Upload</span>', 'javascript:document.getElementById("upload-form").submit();', array('class'=>'btn btn-success btn-icon-split')); ?>
		</div>
   </div>
</div>

<?php $this->endWidget();?>

</div><!-- form -->


