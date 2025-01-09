<?php

class FileHistoryController extends Controller
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
				'actions'=>array('create','update', 'showFileHistory', 'updateFileHistory','viewFileWithHistory'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete', 'showFileHistory', 'updateFileHistory', 'deleteFileHistory', 'viewFileWithHistory'),
				'users'=>array('*'),
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
	
	 /* 	
	public function actionView($id)
	{
		$this->render('File',array(
			'model'=>$this->loadModel($id),
		));
	} */

	// FileHistoryController.php

	/* 	
	public function actionUpdateFileHistory($id)
	{
		// Retrieve the file model
		$file = File::model()->findByPk($id);

		if ($file !== null) {
			// Create or update file history
			$fileHistory = FileHistory::model()->findByAttributes(array('parent_file_id' => $file->id));

			if ($fileHistory === null) {
				$fileHistory = new FileHistory();
				$fileHistory->parent_file_id = $file->id;
				// Set other attributes as needed
			}

			// Update file history attributes
			$fileHistory->original_filename = $file->original_filename;
			$fileHistory->file_extension = $file->file_extension;
			$fileHistory->e_filename = $file->e_filename;
			$fileHistory->file_path = $file->file_path;
			$fileHistory->status = '1'; // Set the appropriate statuss
			$fileHistory->uploader_id = $file->uploader_id; // Set the uploader_id

			if ($fileHistory->save()) {
				// File history updated successfully
				echo 'File history updated. History ID: ' . $fileHistory->id;
			} else {
				Yii::log('Error updating file history: ' . CHtml::errorSummary($fileHistory), CLogger::LEVEL_ERROR, 'application.controllers.FileHistoryController');
				// Error in updating file history
				echo 'Error updating file history: ' . CHtml::errorSummary($fileHistory);
			}
		} else {
			// File not found
			echo 'File not found.';
		}
	} */

	public function actionUpdateFileHistory($id)
	{
		$file = File::model()->findByPk($id);

		if ($file !== null) {
			if (isset($_POST['File'])) {
				$file->attributes = $_POST['File'];
	
				if ($file->validate()) {
					$newFileUploaded = CUploadedFile::getInstance($file, 'file');
	
					if ($newFileUploaded !== null) {
						// Handle the file upload for the revised file
						$fileHistory = new FileHistory();
						$fileHistory->parent_file_id = $file->id;
						// Retain original attributes
						$fileHistory->original_filename = $file->original_filename;
						$fileHistory->file_extension = $file->file_extension;
						$fileHistory->e_filename = $file->e_filename;
						$fileHistory->file_path = 'protected/fileUploads/' . $newFileUploaded->name; // Update the file path
						$fileHistory->status = $_POST['File']['status'];
						$fileHistory->uploader_id = $file->uploader_id;
	
						// Save the revised file in file history
						$newFileUploaded->saveAs($fileHistory->file_path);
						$fileHistory->save();
	
						// Update specific attributes in tbl_file without changing the original_filename
						$file->file_path = $fileHistory->file_path; // Update the file path in tbl_file
	
						if ($file->save(false, array('file_path'))) { // Save without validating, only update file_path
							Yii::app()->user->setFlash('success', 'File and history updated successfully. History ID: ' . $fileHistory->id);
							$this->redirect(array('/file/viewFileWithHistory', 'id' => $file->id));
						} else {
							Yii::log('Error updating file: ' . CHtml::errorSummary($file), CLogger::LEVEL_ERROR, 'application.controllers.FileHistoryController');
							Yii::app()->user->setFlash('error', 'Error updating file: ' . CHtml::errorSummary($file));
						}
					} else {
						Yii::app()->user->setFlash('warning', 'No new file uploaded. File details remain unchanged.');
					}
				}
			} else {
				$this->render('update', array('file' => $file));
			}
		} else {
			Yii::app()->user->setFlash('error', 'File not found.');
		}
	}
	
	public function actionShowFileHistory()
	{
		$showFileHistories = FileHistory::model()->findAll();

		$this->render('showFileHistory',array(
			'showTheFileHistories'=>$showFileHistories,
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new FileHistory;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['FileHistory']))
		{
			$model->attributes=$_POST['FileHistory'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
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
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['FileHistory']))
		{
			$model->attributes=$_POST['FileHistory'];
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

	/* 
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}
 	*/
	 public function actionDeleteFileHistory($id)
	 {
		 $file = File::model()->findByPk($id);
		 $fileHistory = FileHistory::model()->findByPk($id);
	 
		 // Debug information
		 var_dump($file);
		 var_dump($fileHistory);
	 
		 if ($fileHistory === null) {
			 throw new CHttpException(404, 'The requested file history record does not exist.');
		 }
	 
		 try {
			 // Delete the file history record
			 $fileHistory->delete();
	 
			 // Set a flash message to indicate successful deletion
			 Yii::app()->user->setFlash('success', 'File history deleted successfully.');
	 
			 // Redirect to the file history view
			 /* $this->redirect(array('file/viewFileWithHistory', 'id' => $file->id)); */
			 $this->redirect(array('file/departmentFiles'));

	 
		 } catch (Exception $e) {
			 // Log the error (optional)
			 Yii::log('Error deleting file history: ' . $e->getMessage(), CLogger::LEVEL_ERROR);
	 
			 // Set a flash message for error
			 Yii::app()->user->setFlash('error', 'Error deleting file history.');
	 
			 // Redirect or handle error response
			/*  $this->redirect(array('file/viewFileWithHistory', 'id' => $file->id)); */

			$this->redirect(array('file/departmentFiles'));

	 
		 }
	 }
	 	
	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('FileHistory');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new FileHistory('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['FileHistory']))
			$model->attributes=$_GET['FileHistory'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return FileHistory the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=FileHistory::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param FileHistory $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='file-history-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
		
}
