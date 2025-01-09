<?php
/* @var $this FileAssignmentController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'File Assignments',
);

$this->menu=array(
	array('label'=>'Create FileAssignment', 'url'=>array('create')),
	array('label'=>'Manage FileAssignment', 'url'=>array('admin')),
);
?>

<h1>File Assignments</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
