<?php

/**
 * This is the model class for table "{{user}}".
 *
 * The followings are the available columns in table '{{user}}':
 * @property integer $id
 * @property integer $account_id
 * @property string $firstname
 * @property string $middlename
 * @property string $lastname
 * @property string $qualifier
 * @property string $dob
 * @property integer $gender
 * @property string $local_address
 * @property integer $barangay_id
 * @property integer $city_id
 * @property integer $province_id
 * @property integer $region_id
 * @property integer $zip_code
 *
 * The followings are the available model relations:
 * @property Account $account
 * @property Barangay $barangay
 * @property City $city
 * @property Province $province
 * @property Region $region
 */
class User extends CActiveRecord
{
	public $city;
	public $qualifier;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{user}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('firstname, lastname, dob, gender', 'required'),
			array('barangay_id, city_id, province_id, region_id', 'required', 'on'=>'createNewUser'),
			array('barangay_id, city_id, province_id, region_id', 'required', 'on'=>'updateAccount'),
			array('gender, barangay_id, city_id, province_id, region_id, zip_code', 'numerical', 'integerOnly'=>true),
			array('firstname, middlename, lastname, qualifier', 'length', 'max'=>128),
			array('local_address', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, firstname, middlename, lastname, qualifier, dob, gender, local_address, barangay_id, city_id, province_id, region_id, zip_code', 'safe', 'on'=>'search'),
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
			'account' => array(self::BELONGS_TO, 'Account', 'account_id'),
			'barangay' => array(self::BELONGS_TO, 'Barangay', 'barangay_id'),
			'city' => array(self::BELONGS_TO, 'City', 'city_id'),
			'province' => array(self::BELONGS_TO, 'Province', 'province_id'),
			'region' => array(self::BELONGS_TO, 'Region', 'region_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'account_id' => 'Account',
			'firstname' => 'Firstname',
			'middlename' => 'Middlename',
			'lastname' => 'Lastname',
			'qualifier' => 'Qualifier',
			'dob' => 'Date of Birth',
			'gender' => 'Gender',
			'local_address' => 'Local Address',
			'barangay_id' => 'Barangay',
			'city_id' => 'City',
			'province_id' => 'Province',
			'region_id' => 'Region',
			'zip_code' => 'Zip Code',
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
		$criteria->compare('account_id',$this->account_id);
		$criteria->compare('firstname',$this->firstname,true);
		$criteria->compare('middlename',$this->middlename,true);
		$criteria->compare('lastname',$this->lastname,true);
		$criteria->compare('qualifier',$this->qualifier,true);
		$criteria->compare('dob',$this->dob,true);
		$criteria->compare('gender',$this->gender);
		$criteria->compare('local_address',$this->local_address,true);
		$criteria->compare('barangay_id',$this->barangay_id);
		$criteria->compare('city_id',$this->city_id);
		$criteria->compare('province_id',$this->province_id);
		$criteria->compare('region_id',$this->region_id);
		$criteria->compare('zip_code',$this->zip_code);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	protected function beforeSave()
	{
		if(parent::beforeSave())
		{
			if($this->dob == '')
				$this->dob = null;
			else
				$this->dob=date('Y-m-d', strtotime($this->dob));
			
			return true;
		}
		else
		{
			return false;
		}
	}
	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return User the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function getFullname($id)
	{
		$model=$this->find(array(
			'condition'=>'account_id=:account_id',
			'params'=>array(
				':account_id'=>$id,
			)
		));
		
		if($model!==null)
		{
			if($model->middlename == null)
				return $model->firstname." ".$model->lastname." ".$model->qualifier;
			else
				return $model->firstname." ".substr($model->middlename, 0,1).". ".$model->lastname." ".$model->qualifier;
		}
	}

	public function getCityName()
	{
    	$city = City::model()->findByPk($this->city_id);

    	return $city !== null ? $city->city_name : 'N/A';
	}

	public function getGender($id)
	{
		$model=$this->find(array(
			'condition'=>'id=:id',
			'params'=>array(
				':id'=>$id,
			)
		));
		
		if($model!==null) 
		{
			switch($model->gender)
			{
				case '1':
					return "Male";
					break;
				case '2':
					return "Female";
					break;
			}
		}
	}
	
}
