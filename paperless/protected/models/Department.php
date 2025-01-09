<?php

/**
 * This is the model class for table "{{department}}".
 *
 * The followings are the available columns in table '{{department}}':
 * @property integer $id
 * @property string $department_name
 * @property integer $status
 *
 * The followings are the available model relations:
 * @property Account[] $accounts
 * @property FileAssignment[] $fileAssignments
 * @property Transaction[] $transactions
 */
class Department extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{department}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('department_name', 'required'),
			array('status', 'numerical', 'integerOnly'=>true),
			array('department_name', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, department_name, status', 'safe', 'on'=>'search'),
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
			'accounts' => array(self::HAS_MANY, 'Account', 'department_id'),
			'fileAssignments' => array(self::HAS_MANY, 'FileAssignment', 'department_id'),
			'transactions' => array(self::HAS_MANY, 'Transaction', 'department_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'department_name' => 'Department Name',
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
		$criteria->compare('department_name',$this->department_name,true);
		$criteria->compare('status',$this->status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Department the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public static function getAllDepartments()
    {
        $getDeparments = self::model()->findAll(); 
        $listOfRegions = CHtml::listData($getDeparments, 'id', 'department_name');
        return $listOfRegions;
    }

	// Method to get accounts by department ID
    public static function getAccountsByDepartment($departmentId)
    {
        $criteria = new CDbCriteria;
        $criteria->select = 'id, username'; // Adjust the fields you need
        $criteria->condition = 'department_id = :departmentId';
        $criteria->params = array(':departmentId' => $departmentId);

        $accounts = Account::model()->findAll($criteria);

        $accountList = array();
        foreach ($accounts as $account) {
            $accountList[$account->id] = $account->username;
        }

        return $accountList;
    }

	 public function getDepartmentStatus($id)
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
					 return "Inactive";
					 break;
				 case '3':
					 return "Under Review";
					 break;
				 case '4':
					 return "Archived";
					 break;
			 }
		 }
	 }
	public static function getTotalDepartmentCount()
	{
		return self::model()->count(); 
	}

}
