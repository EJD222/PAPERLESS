<?php

class WindowQueueController extends Controller
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
				'actions'=>array('index','view', 'updateWindowQueue'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update', 'showWindowQueue', 'updateWindowQueue'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete', 'showWindowQueue', 'updateWindowQueue'),
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
		$model=new WindowQueue;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['WindowQueue']))
		{
			$model->attributes=$_POST['WindowQueue'];
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

		if(isset($_POST['WindowQueue']))
		{
			$model->attributes=$_POST['WindowQueue'];
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
		$dataProvider=new CActiveDataProvider('WindowQueue');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new WindowQueue('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['WindowQueue']))
			$model->attributes=$_GET['WindowQueue'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return WindowQueue the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=WindowQueue::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param WindowQueue $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='window-queue-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

	public function actionShowWindowQueue()
	{
		$loggedInAccountId = Yii::app()->user->id;
		$loggedInAccount = Account::model()->findByPk($loggedInAccountId);

		if ($loggedInAccount !== null) {
			$departmentId = $loggedInAccount->department_id;

			$transactionsForDepartment = Transaction::model()->findAllByAttributes(array('department_id' => $departmentId));

			$queuesForAccount = array();

			foreach ($transactionsForDepartment as $transaction) {
				$queuesForTransaction = Queue::model()->findAllByAttributes(array('transaction_id' => $transaction->id));
				$queuesForAccount = array_merge($queuesForAccount, $queuesForTransaction);
			}

			$queueDetails = array();
			foreach ($queuesForAccount as $queue) {

				$existingRecord = WindowQueue::model()->findByAttributes(['queue_id' => $queue->id]);

				if (!$existingRecord) {
					$queueDetails[] = array(
						'id' => $queue->id,
						'queue_no' => $queue->queue_no,
						'date_created' => $queue->date_created,
						'date_updated' => $queue->date_updated,
						'type' => $queue->getQueueType($queue->id), 
						'status' => $queue->getQueueStatus($queue->id), 
					);
				}
			}
			$this->render('showWindowQueue', array(
				'queueDetails' => $queueDetails,
			));
		}
	}

	public function actionUpdateWindowQueue()
	{
		if (Yii::app()->request->isAjaxRequest) {
			$queueId = Yii::app()->request->getPost('queueId');
		
			Yii::log('Received queueId: ' . $queueId, 'info', 'application.controller');
	
			$existingRecord = WindowQueue::model()->findByAttributes(['queue_id' => $queueId]);
		
			if (!$existingRecord) {
				$accountId = Yii::app()->user->id;
				$account = Account::model()->findByPk($accountId);
				
				if (!$account) {
					Yii::log('Error updating window queue: Account not found for account_id ' . $accountId, 'error', 'application.controller');
					echo json_encode(['error' => 'Account not found']);
					Yii::app()->end();
				}

				$deptId = $account->department_id;
				switch ($deptId) {
					case 2:
						$queueCounter = 'Window 1';
						break;
					case 3:
						$queueCounter = 'Window 2';
						break;
					case 4:
						$queueCounter = 'Window 3';
						break;
					case 5:
						$queueCounter = 'Window 4';
						break;
					case 6:
						$queueCounter = 'Window 5';
						break;
					default:
						$queueCounter = 'Default Window';
						break;
				}
				
				$windowQueue = new WindowQueue();
				$windowQueue->account_id = $accountId;
				$windowQueue->queue_id = $queueId;
				$windowQueue->queue_counter = $queueCounter;
		
				Yii::log('Update data: ' . CVarDumper::dumpAsString($windowQueue->getAttributes()), 'info', 'application.controller');
		
				if ($windowQueue->save()) {
					Yii::log('Window queue updated successfully.', 'info', 'application.controller');
					echo json_encode(['success' => true]);
				} else {
					Yii::log('Error updating window queue: ' . CVarDumper::dumpAsString($windowQueue->getErrors()), 'error', 'application.controller');
					echo json_encode(['error' => 'Error updating window queue']);
				}
			} else {
			
				Yii::log('Error updating window queue: Record with the same queue_id already exists.', 'error', 'application.controller');
				echo json_encode(['error' => 'Record with the same queue_id already exists']);
			}
		
			Yii::app()->end();
		} else {
			echo json_encode(['error' => 'Invalid request']);
			Yii::app()->end();
		}
	}
}