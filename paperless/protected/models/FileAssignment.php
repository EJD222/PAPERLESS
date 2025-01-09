<?php

/**
 * This is the model class for table "{{file_assignment}}".
 *
 * The followings are the available columns in table '{{file_assignment}}':
 * @property integer $id
 * @property integer $file_id
 * @property integer $department_id
 * @property integer $receiver_id
 * @property string $remarks
 * @property string $date_created
 * @property string $date_updated
 * @property integer $status
 *
 * The followings are the available model relations:
 * @property Account $receiver
 * @property Department $department
 * @property File $file
 */
class FileAssignment extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{file_assignment}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('file_id, department_id, remarks, date_created, date_updated', 'required'),
			array('file_id, department_id, receiver_id, status', 'numerical', 'integerOnly'=>true),
			array('remarks', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, file_id, department_id, receiver_id, remarks, date_created, date_updated, status', 'safe', 'on'=>'search'),
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
			'receiver' => array(self::BELONGS_TO, 'Account', 'receiver_id'),
			'department' => array(self::BELONGS_TO, 'Department', 'department_id'),
			'file' => array(self::BELONGS_TO, 'File', 'file_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'file_id' => 'File',
			'department_id' => 'Department',
			'receiver_id' => 'Receiver',
			'remarks' => 'Remarks',
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
		$criteria->compare('file_id',$this->file_id);
		$criteria->compare('department_id',$this->department_id);
		$criteria->compare('receiver_id',$this->receiver_id);
		$criteria->compare('remarks',$this->remarks,true);
		$criteria->compare('date_created',$this->date_created,true);
		$criteria->compare('date_updated',$this->date_updated,true);
		$criteria->compare('status',$this->status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return FileAssignment the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function getFileAssignmentStatus($id)
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
					return "Returned";
					break;
				case '2':
					return "Rejected";
					break;
				case '3':
					return "Passed";
					break;
				case '4':
					return "Approved";
					break;
			}
		}
	}
	
}
