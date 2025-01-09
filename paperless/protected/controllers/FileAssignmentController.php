<?php

class FileAssignmentController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update', 'assignToDepartment', 'departmentFiles', 'assignFiles'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete', 'assignToDepartment', 'departmentFiles', 'assignFiles'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new FileAssignment;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['FileAssignment']))
		{
			$model->attributes=$_POST['FileAssignment'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	public function actionAssignToDepartment($fileId)
	{
		// Retrieve the file and department models
		$file = File::model()->findByPk($fileId);
		/* $department = Department::model()->findByPk($departmentId); */

		 // Check if both file and department are not null
		 if ($file !== null) {
			// Check if the form is submitted
			$fileAssignment = new FileAssignment();
			if (isset($_POST['FileAssignment'])) {
				$fileAssignment->attributes = $_POST['FileAssignment'];
				$fileAssignment->file_id = $file->id;
 				$fileAssignment->department_id = $_POST['FileAssignment']['department_id'];
				$fileAssignment->receiver_id = $_POST['FileAssignment']['receiver_id']; 
	
				$fileAssignment->remarks;
				$fileAssignment->date_created = date('Y-m-d H:i:s');
				$fileAssignment->date_updated = date('Y-m-d H:i:s');
				$fileAssignment->status;
	
				if ($fileAssignment->save()) {
					$this->redirect(array('view', 'id' => $fileAssignment->id));
					Yii::app()->user->setFlash('success', 'File assigned to department. Assignment ID: ' . $fileAssignment->id);
				} else {
					Yii::app()->user->setFlash('error', 'Failed to assign file to department.');
				}
			} else {
				// Render the form view
				$this->render('assignToDepartmentForm', 
				array(
					'file' => $file, 
			/* 		'department' => $department, */
					'fileAssignment' => $fileAssignment));
			}
		} else {
			// File or department not found
			echo 'File or department not found.';
		}
	}

	public function actionAssignFiles()
	{
		$userId = Yii::app()->user->id;
		$userAccount = Account::model()->findByPk($userId);
	
		if ($userAccount === null) {
			throw new CHttpException(404, 'User not found.');
		}
	
		$isAdmin = $userAccount->account_type == 1; 
	
		$criteria = new CDbCriteria();
	
		if (!$isAdmin) {

			$departmentId = $userAccount->department_id;
		
			$criteria = new CDbCriteria();
			$criteria->with = array('file');
			$criteria->addCondition('t.receiver_id = :userId AND t.department_id = :departmentId');
			$criteria->params = array(':userId' => $userId, ':departmentId' => $departmentId);
			$assignedFiles = FileAssignment::model()->findAll($criteria);
		
			$filesForUser = array_map(function ($fileAssignment) {
				return $fileAssignment->file;
			}, $assignedFiles);
		
			$this->render('/file/assignedFiles', array(
				'assignedFiles' => $assignedFiles,
				'filesForUser' => $filesForUser,
			));	
		} else {
			$listOfFiles = File::model()->findAll();
			
			$this->render('/file/listFile', array(
				'listOfFiles' => $listOfFiles,
			));
		}
	}	
	
	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['FileAssignment']))
		{
			$model->attributes=$_POST['FileAssignment'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('FileAssignment');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new FileAssignment('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['FileAssignment']))
			$model->attributes=$_GET['FileAssignment'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return FileAssignment the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=FileAssignment::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param FileAssignment $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='file-assignment-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
