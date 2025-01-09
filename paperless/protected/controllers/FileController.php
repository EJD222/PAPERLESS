<?php

class FileController extends Controller
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
				'actions'=>array('create','update', 'uploadFile', 'listFile', 'viewFileWithHistory', 'departmentFiles'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete', 'uploadFile', 'listFile', 'deleteFile', 'viewFileWithHistory', 'departmentFiles'),
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

	public function actionViewFileWithHistory($id)
	{
		// Load the File model with the specified ID
		$file = $this->loadModel($id);
	
		// Load related FileHistory models based on the parent_file_id
		$fileHistory = FileHistory::model()->findAllByAttributes(array('parent_file_id' => $file->id));
	
		$this->render('viewFileWithHistory', array(
			'file' => $file,
			'fileHistory' => $fileHistory,
		));
	}
	
	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */

	public function actionUploadFile()
	{
		$model = new File;

		if (isset($_POST['File'])) {
		$model->attributes = $_POST['File'];
		$model->setScenario('createFile');
		$model->file = CUploadedFile::getInstance($model, 'file');
		
			if ($model->validate()) {
				
				$model->file->saveAs('protected/fileUploads/' . $model->file->name);
				
				try
				{
					if ($model->save()) {
						Yii::app()->user->setFlash('success','You have successfully uploaded a file!');
						$this->redirect(array('/file/departmentFiles'));
					}
				}
				catch (Exception $e)
				{  
					Yii::app()->user->setFlash('error', 'An error occured while trying to upload a file! Please try again later.');
					$this->redirect(array('/file/departmentFiles'));
				} 
			}
		}

		$this->render('create', array('model' => $model));
	}

	public function actionListFile()
	{
		$listOfFiles = File::model()->findAll();

		$this->render('listFile',array(
			'listOfFiles'=>$listOfFiles,
		));
	}

	public function actionDepartmentFiles()
	{
		$userId = Yii::app()->user->id;
		$userAccount = Account::model()->findByPk($userId);
	
		if ($userAccount === null) {
			throw new CHttpException(404, 'User not found.');
		}
	
		$isAdmin = $userAccount->account_type == 1; 
	
		if (!$isAdmin) {

			$departmentId = $userAccount->department_id;
	
			$criteria = new CDbCriteria();
			$criteria->addCondition('uploader_id IN (SELECT id FROM tbl_account WHERE department_id = :departmentId)');
			$criteria->params = array(':departmentId' => $departmentId);
			$filesForUser = File::model()->findAll($criteria);
	
			$this->render('/file/departmentFiles', array(
				'filesForUser' => $filesForUser,
			));
		} else {
	
			$listOfFiles = File::model()->findAll();

			$this->render('/file/listFile', array(
				'listOfFiles' => $listOfFiles,
			));
		}
	}

	public function actionCreate()
	{
		$model=new File;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['File']))
		{
			$model->attributes=$_POST['File'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}  

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */

	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);
		
		$model->setScenario('updateFile');

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['File']))
		{
			$model->attributes=$_POST['File'];
			if($model->save())
				//$this->redirect(array('view','id'=>$model->id));
				$this->redirect(array('/file/departmentFiles'));
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
	
	 /* 
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	} 
	*/

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('File');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new File('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['File']))
			$model->attributes=$_GET['File'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return File the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=File::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param File $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='file-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

	public function actionDeleteFile($id)
	{
		$file = File::model()->findByPk($id);
	
		if ($file === null) {
			throw new CHttpException(404, 'The requested file does not exist.');
		}
	
		$transaction = Yii::app()->db->beginTransaction();
	 
		try { 
			
			$fileHistory = FileHistory::model()->findAllByAttributes(array('parent_file_id' => $file->id));
			foreach ($fileHistory as $history) {
				$history->delete();
			}
	
			$filePath = $file->file_path; 
			if (file_exists($filePath)) {
				unlink($filePath);
			}
	
			$file->delete();
	
			$transaction->commit();
			Yii::app()->user->setFlash('success', 'File deleted successfully.');
			$this->redirect(array('/file/listFile'));
		} catch (Exception $e) {
			$transaction->rollback();
			Yii::log('Error deleting file: ' . $e->getMessage(), CLogger::LEVEL_ERROR);
			Yii::app()->user->setFlash('error', 'An error occurred while deleting the file.');
			$this->redirect(array('/file/listFile'));
		} 
	
		if (!isset($_GET['ajax'])) {
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('/file/listFile'));
		}
	
		echo 'File deleted successfully.';
		Yii::app()->end();
	}

}