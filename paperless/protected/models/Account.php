<?php

/**
 * This is the model class for table "{{account}}".
 *
 * The followings are the available columns in table '{{account}}':
 * @property integer $id
 * @property string $username
 * @property string $password
 * @property string $email_address
 * @property string $salt
 * @property integer $account_type
 * @property integer $status
 * @property string $date_created
 * @property string $date_updated
 * @property string $expiration_date
 *
 * The followings are the available model relations:

 * @property User[] $users
 * @property Department $department_id
 * @property Position $position_id
 */
class Account extends CActiveRecord
{
	public $retypepassword;
	public $oldpassword;
	public $newpassword;
	public $confirmnew;
	public $retypeemail;

	public $position_id;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{account}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('username, password, retypepassword, account_type, position, department, status', 'required', 'on'=>'createNewAccount'),
			//array('username, password, retypepassword, account_type, status', 'required', 'on'=>'createNewAccount'),
			array('username, password, account_type, position, department, status', 'required', 'on'=>'updateAccount'),
			array('username, password, salt', 'length', 'max'=>128),
			array('username', 'length', 'min'=>4),
			array('username', 'match', 'pattern'=>'/^[A-Za-z0-9]+$/u', 'message'=>Yii::t('default','Special characters are not permitted on Username.')),
			array('username', 'validateNewUsername', 'on'=>'createNewAccount'),
			array('username', 'validateAccountUsername', 'on'=>'updateAccount'),
			array('password, retypepassword', 'match', 'pattern'=>'/^[A-Za-z0-9]+$/u', 'message'=>Yii::t('default', 'Special characters are not permitted on Password.')),
			array('password', 'length', 'max'=>255),
			array('password', 'compare', 'compareAttribute'=>'retypepassword', 'on'=>'createNewAccount'),
			array('password, retypepassword, newpassword', 'length', 'min'=>8),
			array('retypepassword, oldpassword, newpassword', 'length', 'max'=>255),
			array('email_address', 'length', 'max'=>255),
			array('email_address', 'validateNewEmailAddress', 'on'=>'createNewAccount'),
			array('email_address', 'validateAccountEmailAddress', 'on'=>'updateAccount'),
			array('account_type, status', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, username, password, email_address, salt, account_type, department_id, postion_id, status, date_created, date_updated, expiration_date', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'department' => array(self::BELONGS_TO, 'Department', 'department_id'),
			'position' => array(self::BELONGS_TO, 'Position', 'position_id'),
			'users' => array(self::HAS_MANY, 'User', 'account_id'),
			'user' => array(self::HAS_ONE, 'User', 'account_id'),
			'files' => array(self::HAS_MANY, 'File', 'uploader_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'username' => 'Username',
			'password' => 'Password',
			'email_address' => 'Email Address',
			'salt' => 'Salt',
			'account_type' => 'Account Type',
			'department_id' => 'Department ID',
			'position_id' => 'Position ID',
			'status' => 'Status',
			'date_created' => 'Date Created',
			'date_updated' => 'Date Updated',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('username',$this->username,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('email_address',$this->email_address,true);
		$criteria->compare('salt',$this->salt,true);
		$criteria->compare('account_type',$this->account_type);
		$criteria->compare('status',$this->status);
		$criteria->compare('date_created',$this->date_created,true);
		$criteria->compare('date_updated',$this->date_updated,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	protected function beforeSave()
	{
		if(parent::beforeSave())
		{
			Yii::log('Before Save - department_id: ' . $this->department_id, 'info', 'application.models.Account');
			if($this->isNewRecord)
			{
				$this->salt=$this->generateSalt();
				$this->password=$this->hashPassword($this->password,$this->salt);
				$this->date_created = date('Y-m-d H:i:s');
				$this->date_updated = date('Y-m-d H:i:s');
				/* 	$this->status_id = 1; */
				/* $this->expiration_date = date('Y-m-d H:i:s', strtotime(' + 3 months')); */
			}
			else
			{
				$this->date_updated = date('Y-m-d H:i:s');
			}
			return true;
		}
		else
		{
			return false;
		}
	}

	/**
	 * Validates user login password entered
	 */
	public function validatePassword($password)
	{
		return $this->hashPassword($password,$this->salt)===$this->password;
	}
	
	/*
	 * Generate salt
	 */
	public function generateSalt()
	{
		// Simple timestamp. Needs to be worked on to make site more secure
		return time();
	}
	
	/*
	 * Create hashed password
	 */
	public function hashPassword($password,$salt)
	{
		// Use sha1
		return sha1($password.$salt);
	}
	
	/**
	 * Validates username entry in plant a vine.
	 * Only usernames not found in database allowed
	 */
	public function validateNewUsername($attribute,$params)
	{
		if(!$this->hasErrors())
		{
			if($this->username==$this->password)
			{
				$this->addError('password', 'Username and password should not be the same!');
			}
			else
			{
				$account=Account::model()->find('username=?',array($this->username));
				if($account !== null)
					$this->addError('username','Username entered is already in use.');
			}
		}
	}
	
	/**
	 * Validates username when updating your account.
	 */
	public function validateAccountUsername($attribute,$params)
	{
		if(!$this->hasErrors())
		{
			if($this->hashPassword($this->username,$this->salt)==$this->password)
			{
				$this->addError('username', 'Username and password should not be the same!');
			}
			else
			{
				$account=Account::model()->find(array(
					'condition'=>'username=:username AND id<>:id',
					'params'=>array(
						':username'=>$this->username,
						':id'=>$this->id,
					)
				));
				//print_r($account->attributes);
				//exit;
				if($account !== null)
					$this->addError('username','Username entered is already in use.');
			}
		}
	}
	
	/**
	 * Validate your old account password when updating account
	 */
	public function validateAccountPassword($attribute,$params)
	{
		if(!$this->hasErrors())
		{
			if(trim($this->oldpassword)!='' || trim($this->password)!='')
			{
				$hashed_password=$this->hashPassword($this->oldpassword,$this->salt);
				$account=Account::model()->find(array(
					'condition'=>'password=:password AND id=:id',
					'params'=>array(
						':password'=>$hashed_password,
						':id'=>Yii::app()->user->id,
					)
				));
				if($account===null)
					$this->addError('oldpassword','You have entered your account password incorrectly.');
				else
				{
					if($this->password==='')
						$this->addError('password','Please do not leave the new password field empty.');
				}
			}
		}
	}

	/**
	 * Validates email entry.
	 * Only email addresses not found in database allowed
	 */
	public function validateNewEmailAddress($attribute,$params)
	{
		if(!$this->hasErrors())
		{
			if($this->email_address!=='')
			{
				if(!filter_var($this->email_address,FILTER_VALIDATE_EMAIL))
				{
					$this->addError('email_address','Please use a valid email address.');
				}
				else
				{
					$account=Account::model()->find(array(
						'condition'=>'email_address=:email_address',
						'params'=>array(
							':email_address'=>$this->email_address
						)
					));
					if($account !== null)
						$this->addError('email_address','Email address entered is already in use.');	
				}
			}
		}
	}
	
	public function validateAccountEmailAddress($attribute,$params)
	{
		if(!$this->hasErrors())
		{
			if($this->email_address!=='')
			{
				if(!filter_var($this->email_address,FILTER_VALIDATE_EMAIL))
				{
					$this->addError('email_address','Please use a valid email address.');
				}
				else
				{
					$account=Account::model()->find(array(
						'condition'=>'email_address=:email_address AND id<>:id',
						'params'=>array(
							':email_address'=>$this->email_address,
							':id'=>$this->id,
						)
					));
					if($account !== null)
						$this->addError('email_address','Email address entered is already in use.');	
				}
			}
			/*
			else
			{
				$account=Account::model()->find(array(
					'condition'=>'email_address=:email_address AND id=:id',
					'params'=>array(
						':email_address'=>$this->email_address,
						':id'=>Yii::app()->user->id,
					)
				));
				if($account===null)
					$this->addError('email_address','Please retype your new email address correctly.');
			}*/
		}
	}

	public function getAccountStatus($id)
	{
		$model=$this->find(array(
			'condition'=>'id=:id',
			'params'=>array(
				':id'=>$id,
			)
		));
		
		if($model!==null) 
		{
			switch($model->status)
			{
				case '1':
					return "Active";
					break;
				case '2':
					return "Locked";
					break;
				case '3':
					return "Deleted";
					break;
			}
		}
	}

	public function getAccountType($id)
	{
		$model=$this->find(array(
			'condition'=>'id=:id',
			'params'=>array(
				':id'=>$id,
			)
		));
		
		if($model!==null) 
		{
			switch($model->account_type)
			{
				case '1':
					return "Admin";
					break;
				case '2':
					return "City Official";
					break;
				case '3':
					return "Department Head";
					break;
				case '4':
					return "Employee";
					break;

			}
		}
	}

	public static function getTotalAccountCount()
    {
        return self::model()->count(); 
    }

	public static function getAccountCountByDepartment()
	{
		$departments = Department::model()->findAll(); 
		$accountTally = [];
	
		$totalAccounts = self::model()->count();
	
		foreach ($departments as $department) {
			$count = self::model()->countByAttributes(['department_id' => $department->id]);
			$percentage = round(($count / $totalAccounts) * 100);
			$accountTally[$department->department_name . " (" . $count . ")"] = $percentage;
		}
	
		return $accountTally;
	}	
	
	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Account the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}