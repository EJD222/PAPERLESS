<?php

/**
 * This is the model class for table "{{file_history}}".
 *
 * The followings are the available columns in table '{{file_history}}':
 * @property integer $id
 * @property integer $parent_file_id
 * @property integer $uploader_id
 * @property string $original_filename
 * @property string $file_extension
 * @property string $e_filename
 * @property string $file_path
 * @property integer $status
 *
 * The followings are the available model relations:
 * @property Account $uploader
 * @property File $parentFile
 */
class FileHistory extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{file_history}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('parent_file_id, uploader_id, original_filename, file_extension, e_filename, file_path, status', 'required'),
			array('parent_file_id, uploader_id, status', 'numerical', 'integerOnly'=>true),
			array('original_filename, e_filename, file_path', 'length', 'max'=>255),
			array('file_extension', 'length', 'max'=>10),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, parent_file_id, uploader_id, original_filename, file_extension, e_filename, file_path, status', 'safe', 'on'=>'search'),
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
			'uploader' => array(self::BELONGS_TO, 'Account', 'uploader_id'),
			'parentFile' => array(self::BELONGS_TO, 'File', 'parent_file_id'),
			'uploaderUser' => array(self::BELONGS_TO, 'User', 'uploader_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'parent_file_id' => 'Parent File',
			'uploader_id' => 'Uploader',
			'original_filename' => 'Original Filename',
			'file_extension' => 'File Extension',
			'e_filename' => 'E Filename',
			'file_path' => 'File Path',
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
		$criteria->compare('parent_file_id',$this->parent_file_id);
		$criteria->compare('uploader_id',$this->uploader_id);
		$criteria->compare('original_filename',$this->original_filename,true);
		$criteria->compare('file_extension',$this->file_extension,true);
		$criteria->compare('e_filename',$this->e_filename,true);
		$criteria->compare('file_path',$this->file_path,true);
		$criteria->compare('status',$this->status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return FileHistory the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function getFileStatus($id)
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
					return "Draft";
					break;
				case '3':
					return "Versioned";
					break;
				case '4':
					return "Approved";
					break;
				case '5':
					return "Rejected";
					break;
			}
		}
	}
}
