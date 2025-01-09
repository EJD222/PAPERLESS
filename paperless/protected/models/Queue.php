<?php

/**
 * This is the model class for table "{{queue}}".
 *
 * The followings are the available columns in table '{{queue}}':
 * @property integer $id
 * @property integer $transaction_id
 * @property string $queue_no
 * @property string $date_created
 * @property string $date_updated
 * @property integer $type
 * @property integer $status
 *
 * The followings are the available model relations:
 * @property Transaction $transaction
 * @property WindowQueue[] $windowQueues
 */
class Queue extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{queue}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('transaction_id, queue_no, date_created, type, status', 'required'),
			array('transaction_id, type, status', 'numerical', 'integerOnly'=>true),
			array('queue_no', 'length', 'max'=>128),
			array('date_updated', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, transaction_id, queue_no, date_created, date_updated, type, status', 'safe', 'on'=>'search'),
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
			'transaction' => array(self::BELONGS_TO, 'Transaction', 'transaction_id'),
			'windowQueues' => array(self::HAS_MANY, 'WindowQueue', 'queue_id'),
			'department' => array(self::BELONGS_TO, 'Department', 'department_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'transaction_id' => 'Transaction',
			'queue_no' => 'Queue No',
			'date_created' => 'Date Created',
			'date_updated' => 'Date Updated',
			'type' => 'Type',
			'status' => 'Status',
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
		$criteria->compare('transaction_id',$this->transaction_id);
		$criteria->compare('queue_no',$this->queue_no,true);
		$criteria->compare('date_created',$this->date_created,true);
		$criteria->compare('date_updated',$this->date_updated,true);
		$criteria->compare('type',$this->type);
		$criteria->compare('status',$this->status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Queue the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	protected function beforeSave()
	{
		if(parent::beforeSave())
		{
			Yii::log('Before Save - queue_no: ' . $this->queue_no, 'info', 'application.models.Queue');
			if($this->isNewRecord)
			{
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

	public function getQueueStatus($id)
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
					return "Queued";
					break;
				case '2':
					return "In Progress";
					break;
				case '3':
					return "Completed";
					break;
				case '4':
					return "On Hold";
					break;
			}
		}
	}

	public function getQueueType($id)
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
					return "Regular";
					break;
				case '2':
					return "PWD";
					break;
				case '3':
					return "Pregnant";
					break;
				case '4':
					return "Senior Citizen";
					break;
			}
		}
	}

	public static function getQueueCountForUser($userId)
    {
        $userAccount = Account::model()->findByPk($userId);

        if ($userAccount === null) {
            throw new CHttpException(404, 'User not found.');
        }

        $isAdmin = $userAccount->account_type == 1;

        if ($isAdmin) {
            return self::model()->count();
        } else {
            $departmentId = $userAccount->department_id;

            return self::model()->count(array(
                'with' => array('transaction'),
                'condition' => 'transaction.department_id = :departmentId',
                'params' => array(':departmentId' => $departmentId),
            ));
        }
    }

}