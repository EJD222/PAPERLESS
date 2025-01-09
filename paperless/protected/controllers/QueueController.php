<?php

class QueueController extends Controller
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
				'actions'=>array('create','update', 'showQueue'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete', 'showQueue', 'deleteQueue', 'updateQueue'),
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
		$model=new Queue;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Queue']))
		{
			$model->attributes=$_POST['Queue'];
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
	/* 	
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Queue']))
		{
			$model->attributes=$_POST['Queue'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	} */

	public function actionUpdateQueue($id)
	{
		$model=$this->loadModel($id);
		$department = new Department;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Queue']))
		{
			$model->attributes=$_POST['Queue'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
			'department' => $department,
		));
	}
	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */

	public function actionDeleteQueue($id)
	{
		$queue = Queue::model()->findByPk($id);
	
		if ($queue === null) 
		{
			throw new CHttpException(404, 'The requested queue does not exist.');
		}
	
		$queue->delete();
	
		Yii::app()->user->setFlash('success', 'Queue deleted successfully.');
	
		$this->redirect(array('/queue/showQueue')); 
	
		if (!isset($_GET['ajax'])) 
		{
			$this->redirect(array('/queue/showQueue'));
		}
			echo 'Queue deleted successfully.';
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

	public function actionshowQueue()
	{
		$userId = Yii::app()->user->id;
		$userAccount = Account::model()->findByPk($userId);

		if ($userAccount === null) {
			throw new CHttpException(404, 'User not found.');
		}

		$isAdmin = $userAccount->account_type == 1; // Check if the User has an Admin Account Type

		if ($isAdmin) {
			$listOfQueues = Queue::model()->findAll();
			$this->render('showQueue', array(
				'listOfQueues' => $listOfQueues,
			));
		} else {
			
			$departmentId = $userAccount->department_id;

			$criteria = new CDbCriteria();
			$criteria->with = array('transaction'); 
			$criteria->addCondition('transaction.department_id = :departmentId');
			$criteria->params = array(':departmentId' => $departmentId);
			$listOfQueues = Queue::model()->findAll($criteria);
			
			$this->render('showQueue', array(
				'listOfQueues' => $listOfQueues,
			));
		}
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Queue');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}
	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Queue('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Queue']))
			$model->attributes=$_GET['Queue'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}
	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Queue the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Queue::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
	/**
	 * Performs the AJAX validation.
	 * @param Queue $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='queue-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
