<?php
/* @var $this FileAssignmentController */
/* @var $model FileAssignment */

$this->breadcrumbs=array(
	'File Assignments'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List FileAssignment', 'url'=>array('index')),
	array('label'=>'Create FileAssignment', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#file-assignment-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage File Assignments</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'file-assignment-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'file_id',
		'department_id',
		'receiver_id',
		'remarks',
		'date_created',
		/*
		'date_updated',
		'status',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
