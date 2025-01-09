<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle=Yii::app()->name . ' - Login';
$this->breadcrumbs=array(
	'Login',
);
?>

<div class="form-group row">
    <h1 style="font-weight: bold;">Log in</h1>
</div>

<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'login-form',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>

	<div class="form-group row">
		<?php echo $form->labelEx($model,'username'); ?>
		<?php echo $form->textField($model,'username', array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'username'); ?>
	</div>

	<div class="form-group row">
    <?php echo $form->labelEx($model,'password'); ?>
    <?php echo $form->passwordField($model,'password', array('class'=>'form-control')); ?>
    <?php echo $form->error($model,'password'); ?>
    <p class="hint py-3 small">
        <br />
    </p> 

    <div class="form-group rememberMe form-check">
        <?php echo $form->checkBox($model,'rememberMe', ['class' => 'form-check-input']); ?>
        <?php echo $form->label($model,'rememberMe', ['class' => 'form-check-label']); ?>
        <?php echo $form->error($model,'rememberMe'); ?>
    </div>
</div>


	<div class="form-group row">
    <?php echo CHtml::submitButton('Login', array('class' => 'btn btn-md btn-block', 'style' => 'background-color: #004160; color: white; width: 450px;')); ?>
</div>

<?php $this->endWidget(); ?>
</div><!-- form -->
