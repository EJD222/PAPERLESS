<?php

class AccountController extends Controller
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
			'actions'=>array('create','update', 'delete', 'createAccount', 'updateAccount', 'listAccount','getAccountsByDepartment', 'viewAccountAndUser'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','create','update', 'delete', 'createAccount', 'updateAccount', 'deleteAccount', 'listAccount', 'getAccountsByDepartment', 'ViewAccountAndUser'),
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
	// public function actionView($id)
	// {
	// 	$this->render('view',array(
	// 		'model'=>$this->loadModel($id),
	// 	));
	// }

	public function actionViewAccountAndUser($id)
	{
		// Load the Account model with the specified ID
		$account = Account::model()->findByPk($id);

		// Load related User model based on the account_id
		$user = User::model()->find(array(
			'condition' => 'account_id=:account_id',
			'params' => array(
				':account_id' => $account->id,
			),
		));

		$this->render('viewAccountAndUser', array(
			'account' => $account,
			'user' => $user,
		));
	}

	public function actionCreateAccount()
	{
		/*
 		$listOfAccounts = Account::model()->findAll(array(
			'condition'=>'account_type=:account_type',
			'params'=>array(
				':account_type'=>1,
			),
		)); 
		*/
		$listOfAccounts = Account::model()->findAll(); 
		$account = new Account;
		$user = new User;
		$account->setScenario('createNewAccount');
		$user->setScenario('createNewUser');

		
		if ((isset($_POST['Account'])) AND (isset($_POST['User'])))
		{
			$account->attributes = $_POST['Account'];
			$user->attributes = $_POST['User'];
			/*$account->account_type_id = 3; */
			$account->position_id = $_POST['Account']['position_id'];
			$account->department_id = $_POST['Account']['department_id'];

			$valid = $account->validate();
			$valid = $user->validate() && $valid;
			
			if ($valid)
			{	
				$connection = Yii::app()->db;
				$transaction = $connection->beginTransaction();
				
				try
				{ 
					if ($account->save())
					{
						$account_id = $account->getPrimaryKey();
						$user->account_id = $account_id;

						if ($user->save(false))
						{
							$transaction->commit();
							Yii::app()->user->setFlash('success','You have successfully registered for an account!');
							$this->redirect(array('/account/listAccount'));
						} 
					}
				} 
				catch (Exception $e)
				{	
					$transaction->rollback();
					Yii::app()->user->setFlash('error', 'An error occured while trying to add an account! Please try again later');
					$this->redirect(array('/account/listAccount'));
				} 
			} 
		}

		$this->render('create',array(
			'account' => $account,
			'user' => $user,
			'listOfAccounts' => $listOfAccounts,
		));
	}

	public function actionUpdateAccount($id)
	{
		/* 		
		$listOfAccounts = Account::model()->findAll(array(
			'condition'=>'account_type_id=:account_type_id',
			'params'=>array(
				':account_type_id'=>3,
			),
		)); 
		*/
		$listOfAccounts = Account::model()->findAll(); 
		$account = $this->loadModel($id);
		$user = $account->user;
		$account->setScenario('updateAccount');
		$user->setScenario('updateAccount');
		
		
		if ((isset($_POST['Account'])) AND (isset($_POST['User'])))
		{
			$account->attributes = $_POST['Account'];
			$user->attributes = $_POST['User'];
			/* $account->account_type_id = 3; */
			$account->position_id = $_POST['Account']['position_id'];
			$account->department_id = $_POST['Account']['department_id']; 

			$valid = $account->validate();
			
			if ($valid)
			{	
				$connection = Yii::app()->db;
				$transaction = $connection->beginTransaction();

				try
				{
					if ($account->save())
					{
						if ($user->save(false))
						{
							$transaction->commit();
							Yii::app()->user->setFlash('success','You have successfully updated the account!');
							$this->redirect(array('/account/listAccount'));
						}
					}
				}
				catch (Exception $e)
				{
					$transaction->rollback();
					Yii::app()->user->setFlash('error', 'An error occured while trying to update the account! Please try again later.');
				}
			}
		}

		$this->render('update',array(
			'account' => $account,
			'user' => $user,
			'listOfAccounts' => $listOfAccounts,
		));
	}

	public function actionDeleteAccount($id)
	{
		$account = Account::model()->findByPk($id);

		if ($account === null) {
			throw new CHttpException(404, 'The requested account does not exist.');
		}

		$transaction = Yii::app()->db->beginTransaction();

		try {
			$users = User::model()->findAllByAttributes(array('account_id' => $account->id));

			foreach ($users as $user) {
				$user->delete();
			}
			$account->delete();
			$transaction->commit();
			Yii::app()->user->setFlash('success', 'Account deleted successfully.');
			$this->redirect(array('/account/listAccount'));
		} catch (Exception $e) {
			$transaction->rollback();
			Yii::log('Error deleting account: ' . $e->getMessage(), CLogger::LEVEL_ERROR);
			Yii::app()->user->setFlash('error', 'An error occurred while deleting the account.');
			$this->redirect(array('/account/listAccount'));
		}
		
		if (!isset($_GET['ajax'])) {
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('/account/listAccount'));
		}

		echo 'Account deleted successfully.';
		Yii::app()->end();
	}

	public function actionListAccount()
	{
		$listOfAccounts = Account::model()->findAll();

		$this->render('listAccount',array(
			'listOfAccounts'=>$listOfAccounts,
		));
	}

	public function actionGetAccountsByDepartment()
	{
		$data = Account::model()->findAll('department_id=:department_id', array(':department_id' => (int)$_POST['department_id']));
		$accountOptions = "<option value=''>Select Employee</option>";

		foreach ($data as $account) {
			$fullName = $account->user->getFullname($account->id);
			$accountOptions .= CHtml::tag('option', array('value' => $account->id), CHtml::encode($fullName), true);
		}

		echo CJSON::encode($accountOptions);
	}
	
	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */

	/* 	
	public function actionCreate()
	{
		$model=new Account;

		// Uncomment the following line if AJAX validation is needed
		//$this->performAjaxValidation($model);

		if(isset($_POST['Account']))
		{
			$model->attributes=$_POST['Account'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	} 
	*/

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
		//$this->performAjaxValidation($model);

		if(isset($_POST['Account']))
		{
			$model->attributes=$_POST['Account'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	} 
	*/

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
		$dataProvider=new CActiveDataProvider('Account');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Account('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Account']))
			$model->attributes=$_GET['Account'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Account the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Account::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Account $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='account-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}