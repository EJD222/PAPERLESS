<?php

/**
 * This is the model class for table "{{position}}".
 *
 * The followings are the available columns in table '{{position}}':
 * @property integer $id
 * @property string $position_name
 * @property integer $status
 *
 * The followings are the available model relations:
 * @property Account[] $accounts
 */
class Position extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{position}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('position_name', 'required'),
			array('status', 'numerical', 'integerOnly'=>true),
			array('position_name', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, position_name, status', 'safe', 'on'=>'search'),
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
			'accounts' => array(self::HAS_MANY, 'Account', 'position_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'position_name' => 'Position Name',
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
		$criteria->compare('position_name',$this->position_name,true);
		$criteria->compare('status',$this->status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Position the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public static function getAllPositions()
	{
		// retrieve the models from db
		$getPositions = self::model()->findAll();
		$listOfPositions = CHtml::listData($getPositions, 'id', 'position_name');
		return $listOfPositions;
	}

	public function getPositionStatus($id)
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
					return "Open";
					break;
				case '2':
					return "Closed";
					break;
				case '3':
					return "Pending Approval";
					break;
				case '4':
					return "Filled";
					break;

			}
		}
	}

	public static function getTotalPositionCount()
    {
        return self::model()->count(); 
    }
	
	// Inside your Position model class
	public static function getAccountCountByPosition($limit = 5)
	{
		$positions = self::model()->findAll(); 
		$accountTally = [];

		$totalAccounts = Account::model()->count();

		foreach ($positions as $position) {
			$count = Account::model()->countByAttributes(['position_id' => $position->id]);
			$percentage = round(($count / $totalAccounts) * 100);
			$accountTally[$position->position_name . " (" . $count . ")"] = $percentage;
		}

		// Sort the positions by count in descending order
		arsort($accountTally);

		// Take only the top positions based on the specified limit
		$accountTally = array_slice($accountTally, 0, $limit, true);

		return $accountTally;
	}


}
