<?php

class PositionController extends Controller
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
				'actions'=>array('create','update','listPosition'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete', 'listPosition', 'deletePosition'),
				'users'=>array('admin', 'super admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	public function actionListPosition()
	{
		$listOfPositions = Position::model()->findAll();

		$this->render('listPosition',array(
			'listOfPositions'=>$listOfPositions,
		));
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
		$model=new Position;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Position']))
		{
			$model->attributes=$_POST['Position'];
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

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Position']))
		{
			$model->attributes=$_POST['Position'];
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

	public function actionDeletePosition($id)
	{
		// Load the position model
		$position = Position::model()->findByPk($id);
	
		// If Position Not Found
		if ($position === null) 
		{
			throw new CHttpException(404, 'The requested position does not exist.');
		}
	
		$transaction = Yii::app()->db->beginTransaction();
	
		try 
		{
			// Delete the position
			$position->delete(); 
	
			// If you have any associated data to delete, do it here
	
			$transaction->commit();
			Yii::app()->user->setFlash('success', 'Position deleted successfully.');
			$this->redirect(array('/position/listPosition')); // Redirect to the position list page
		} 
		catch (Exception $e) 
		{
			$transaction->rollback();
			Yii::log('Error deleting position: ' . $e->getMessage(), CLogger::LEVEL_ERROR);
			Yii::app()->user->setFlash('error', 'An error occurred while deleting the position.');
			$this->redirect(array('/position/listPosition')); // Redirect to the position list page
		}
	
		// Check if the request is AJAX (triggered by deletion via admin grid view)
		if (!isset($_GET['ajax'])) 
		{
			// If not AJAX, redirect to the admin page or any other desired page
			$this->redirect(array('/position/list'));
		}
	
		// If AJAX, you might want to return a success message or any other response
		echo 'Position deleted successfully.';
		Yii::app()->end();
	}
	
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
		$dataProvider=new CActiveDataProvider('Position');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Position('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Position']))
			$model->attributes=$_GET['Position'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Position the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Position::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Position $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='position-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
