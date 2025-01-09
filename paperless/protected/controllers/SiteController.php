<?php

class SiteController extends Controller
{
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
				'actions'=>array('index','view','sbadmin', 'services', 'getQueue', 'viewQueue'),
				'users'=>array('admin'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update', 'getQueue', 'viewQueue'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete', 'services', 'getQueue', 'viewQueue'),
				'users'=>array('admin'),
			),
			array('allow', 'actions' => array('logout'), 'users' => array('@')),
		);
	}


	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */

	 /*
	public function actionIndex()
	{
		
		//$user = new User;
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		//$this->layout = '//layouts/main';
		//$this->render('index',array(
			//'user' => $user,
		//));
	}
	*/

	public function actionIndex()
	{
		// Check if the user is logged in
		if (Yii::app()->user->isGuest) {
			// Redirect to the login page or handle the case when the user is not logged in
			$this->redirect(array('/site/home'));
		} else {
			// Get the logged-in user
			$loggedInUser = User::model()->findByPk(Yii::app()->user->id);
			$userId = $loggedInUser->id;

			if ($loggedInUser !== null && isset($loggedInUser->account->account_type)) {
				$accountType = $loggedInUser->account->account_type;

				// Render the corresponding dashboard based on the account type
				if ($accountType == 1) { // Admin
					$totalDepartmentCount = Department::getTotalDepartmentCount();
					$totalAccountCount = Account::getTotalAccountCount();
					$totalPositionCount = Position::getTotalPositionCount();
					$totalFileCount = File::countAllFilesForAdmin();
					$departmentTally = Account::getAccountCountByDepartment();
					$positionTally = Position::getAccountCountByPosition();

					return $this->render('dashboardAdmin', 
						array(
							'totalDepartmentCount' => $totalDepartmentCount,
							'totalAccountCount' => $totalAccountCount,
							'totalPositionCount' => $totalPositionCount,
							'totalFileCount' => $totalFileCount,
							'departmentTally' => $departmentTally,
							'positionTally' => $positionTally,
						));
				} elseif ($accountType == 2) { // City Official
					$totalDepartmentCount = Department::getTotalDepartmentCount();
					$totalAccountCount = Account::getTotalAccountCount();
					$totalFileCount = File::countFilesForRegularUser($userId);
					$getAssignedFileTallyForUser = File::getAssignedFileTallyForUser($userId);
					$departmentTally = Account::getAccountCountByDepartment();
					$positionTally = Position::getAccountCountByPosition();

					return $this->render('dashboardDepartmentHead', 
						array(
							'totalDepartmentCount' => $totalDepartmentCount,
							'totalAccountCount' => $totalAccountCount,
							'totalFileCount' => $totalFileCount,
							'getAssignedFileTallyForUser' => $getAssignedFileTallyForUser,
							'departmentTally' => $departmentTally,
							'positionTally' => $positionTally,
						));
				} elseif ($accountType == 3) { // Department Head
					$totalDepartmentCount = Department::getTotalDepartmentCount();
					$totalAccountCount = Account::getTotalAccountCount();
					$totalFileCount = File::countFilesForRegularUser($userId);
					$getAssignedFileTallyForUser = File::getAssignedFileTallyForUser($userId);
					$departmentTally = Account::getAccountCountByDepartment();
					$positionTally = Position::getAccountCountByPosition();

					return $this->render('dashboardDepartmentHead', 
						array(
							'totalDepartmentCount' => $totalDepartmentCount,
							'totalAccountCount' => $totalAccountCount,
							'totalFileCount' => $totalFileCount,
							'getAssignedFileTallyForUser' => $getAssignedFileTallyForUser,
							'departmentTally' => $departmentTally,
							'positionTally' => $positionTally,
						));
				} elseif ($accountType == 4) { // Employee
					$totalDepartmentCount = Department::getTotalDepartmentCount();
					$totalQueueCount = Queue::getQueueCountForUser($userId);
					$totalFileCount = File::countFilesForRegularUser($userId);
					$getAssignedFileTallyForUser = File::getAssignedFileTallyForUser($userId);
					$departmentTally = Account::getAccountCountByDepartment();
					$positionTally = Position::getAccountCountByPosition();

					return $this->render('dashboardEmployee', 
						array(
							'totalDepartmentCount' => $totalDepartmentCount,
							'totalQueueCount' => $totalQueueCount,
							'totalFileCount' => $totalFileCount,
							'getAssignedFileTallyForUser' => $getAssignedFileTallyForUser,
							'departmentTally' => $departmentTally,
							'positionTally' => $positionTally,
						));
				} else {
					return $this->render('dashboardAdmin');
				}
			} else {
				return $this->render('dashboardAdmin');
			}
		}
	}
	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}

	/**
	 * Displays the contact page
	 */
	public function actionContact()
	{
		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{
				$name='=?UTF-8?B?'.base64_encode($model->name).'?=';
				$subject='=?UTF-8?B?'.base64_encode($model->subject).'?=';
				$headers="From: $name <{$model->email}>\r\n".
					"Reply-To: {$model->email}\r\n".
					"MIME-Version: 1.0\r\n".
					"Content-Type: text/plain; charset=UTF-8";

				mail(Yii::app()->params['adminEmail'],$subject,$model->body,$headers);
				Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
				$this->refresh();
			}
		}
		$this->render('contact',array('model'=>$model));
	}
	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{

    	$model = new LoginForm;

    // If it is an Ajax validation request
    if (isset($_POST['ajax']) && $_POST['ajax'] === 'login-form')
    {
        echo CActiveForm::validate($model);
        Yii::app()->end();
    }

    // Collect user input data
    if (isset($_POST['LoginForm']))
    {
        $model->attributes = $_POST['LoginForm'];
        // Validate user input and redirect to the previous page if valid
        if ($model->validate() && $model->login())
        {
            $this->redirect(Yii::app()->user->returnUrl);
        }
    }

    // Display the login form
	$this->layout = '//layouts/loginPage2'; // Adjust the layout as needed
    $this->render('login', array('model' => $model));
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()	
	{	
    	Yii::app()->user->logout();
		Yii::log('User logged out.', CLogger::LEVEL_INFO, 'application');
    	// $this->redirect(Yii::app()->homeUrl);
		 $this->render('//site/pages/home');
	}

	public function actionAbout()
	{
		$this->render('//site/pages/about');
	}
	
	public function actionHome()
	{
		$this->render('/site/pages/home');
	}

	public function actionServices()
	{

    $queue = new Queue;
    $department = new Department;
    $windowQueue = new WindowQueue;

    try {
        if (isset($_POST['Queue'], $_POST['Department'])) {
            $queue->transaction_id = $_POST['Queue']['transaction_id'];
            $selectedDepartmentId = $_POST['Department']['id'];

            $lastQueue = Queue::model()->find(array(
                'condition' => 'transaction_id = :transaction_id',
                'params' => array(':transaction_id' => $_POST['Queue']['transaction_id']),
                'order' => 'id DESC',
            ));
            $lastQueueNo = ($lastQueue) ? substr($lastQueue->queue_no, -5) : 0;

            $selectedDepartment = Department::model()->findByPk($selectedDepartmentId);

            $acronym = ($selectedDepartment !== null) ? strtoupper(substr($selectedDepartment->department_name, 0, 2)) : '';
            $queue->queue_no = $acronym . str_pad(++$lastQueueNo, 5, '0', STR_PAD_LEFT);

            $dateCreated = date('Y-m-d H:i:s');
            $queue->date_created = $dateCreated;
            $queue->date_updated = null; 
            $queue->type = $_POST['Queue']['type'];
            $queue->status = 1; 

            if ($queue->save()) {
                $queueNumber = $queue->queue_no;
                $this->renderPartial('printQueue', ['queueNumber' => $queueNumber]);
            } else {
                echo 'Error saving queue information: ' . CHtml::errorSummary($queue);
            }
        }
    } catch (Exception $e) {
        echo 'Error: ' . $e->getMessage();
    }
		$this->render('services', array(
			'queue' => $queue,
			'department' => $department,
		));
	}

	public function actionGetQueue()
	{
		$latestQueue = WindowQueue::model()->with('queue')->find(array(
			'order' => 't.id DESC', 
			'limit' => 1,
		));

		$response = [
			'data' => $latestQueue !== null ? [
				'queue_no' => $latestQueue->queue->queue_no,
				'queue_counter' => $latestQueue->queue_counter,
			] : null,
		];

		echo CJSON::encode($response);
		Yii::app()->end();
	}
  
	public function actionViewQueue()
	{
	  $latestQueue = WindowQueue::model()->find(array(
		'order' => 'id DESC',
		'limit' => 1,
	  ));
	
	  if (Yii::app()->request->isAjaxRequest) {
		echo CJSON::encode(['data' => $latestQueue->attributes]);
	  } else {
		$this->render('queue', ['latestQueue' => $latestQueue]);
	  }
	}

	public function actionSearch()
	{
		$recordNumber = Yii::app()->request->getPost('record_number');
		$file = File::model()->find(array(
			'select' => 't.id, t.record_num',
			'condition' => 't.record_num=:recordNumber',
			'params' => array(':recordNumber' => $recordNumber),
		));
	
		$status = $formattedDateTime = $deptId = $fullname = $remarks = null;
		$fileAssignments = array(); 
	
		if ($file) {
	
			$fileAssignments = FileAssignment::model()->findAll(array(
				'condition' => 'file_id=:fileId',
				'params' => array(':fileId' => $file->id),
				'order' => 'date_updated DESC', 
			));
	
			if ($fileAssignments) {
				foreach ($fileAssignments as $fileAssignment) {
	
					$status = $fileAssignment->status;
					$dateUpdated = $fileAssignment->date_updated;
					$deptId = $fileAssignment->department_id;
					$fullname = $fileAssignment->department ? $fileAssignment->department->department_name : null;
					$remarks = $fileAssignment->remarks;
	
					$formattedDateTime = Yii::app()->dateFormatter->formatDateTime($dateUpdated, 'medium', 'short');
				}
			} else {
				echo "FileAssignment records not found.";
			}
		}

		$this->render('fileTracking', array(
			'status' => $status,
			'formattedDateTime' => $formattedDateTime,
			'deptId' => $deptId,
			'fullname' => $fullname,
			'remarks' => $remarks,
			'recordNumber' => $recordNumber,
			'fileAssignments' => $fileAssignments,
		));
	}	
}