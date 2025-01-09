<?php

/**
 * This is the model class for table "{{transaction}}".
 *
 * The followings are the available columns in table '{{transaction}}':
 * @property integer $id
 * @property integer $department_id
 * @property string $transaction
 * @property integer $status
 *
 * The followings are the available model relations:
 * @property Queue[] $queues
 * @property Department $department
 */
class Transaction extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{transaction}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('department_id, transaction, status', 'required'),
			array('department_id, status', 'numerical', 'integerOnly'=>true),
			array('transaction', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, department_id, transaction, status', 'safe', 'on'=>'search'),
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
			'queues' => array(self::HAS_MANY, 'Queue', 'transaction_id'),
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
			'department_id' => 'Department',
			'transaction' => 'Transaction',
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
		$criteria->compare('department_id',$this->department_id);
		$criteria->compare('transaction',$this->transaction,true);
		$criteria->compare('status',$this->status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Transaction the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public static function getAllTransactions()
    {
        $getTransactions = self::model()->findAll(); 
        $listOfTransactions = CHtml::listData($getTransactions, 'id', 'transaction');
        return $listOfTransactions;
    }

	 public function getTransactionStatus($id)
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
					 return "Available";
					 break;
				 case '2':
					 return "Not Available";
					 break;
				 case '3':
					 return "Pending";
					 break;
				 case '4':
					 return "Deprecated";
					 break;
 
			 }
		 }
	 }
 
}