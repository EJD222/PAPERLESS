<?php
/* @var $this FileHistoryController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'File Histories',
);

$this->menu=array(
	array('label'=>'Create FileHistory', 'url'=>array('create')),
	array('label'=>'Manage FileHistory', 'url'=>array('admin')),
);
?>

<h1>File Histories</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
