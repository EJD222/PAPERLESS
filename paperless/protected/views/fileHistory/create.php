<?php
/* @var $this FileHistoryController */
/* @var $model FileHistory */

$this->breadcrumbs=array(
	'File Histories'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List FileHistory', 'url'=>array('index')),
	array('label'=>'Manage FileHistory', 'url'=>array('admin')),
);
?>

<h1>Create File History</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>