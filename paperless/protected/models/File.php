<?php

/**
 * This is the model class for table "{{file}}".
 *
 * The followings are the available columns in table '{{file}}':
 * @property integer $id
 * @property string $record_num
 * @property integer $uploader_id
 * @property string $original_filename
 * @property string $file_extension
 * @property string $e_filename
 * @property string $file_path
 * @property integer $status
 *
 * The followings are the available model relations:
 * @property Account $uploader
 * @property FileAssignment[] $fileAssignments
 * @property FileHistory[] $fileHistories
 */
class File extends CActiveRecord
{

	public $file; // Virtual attribute to handle file upload
	public $parent_file_id;

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{file}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		return array(
			array('uploader_id, status', 'numerical', 'integerOnly' => true),
			array('record_num', 'length', 'max' => 128),
			array('original_filename, e_filename, file_path', 'length', 'max' => 255),
			array('file_extension', 'length', 'max' => 10),
			// Validation rule for file when creating a new file
			array('file', 'file', 'types' => 'pdf, doc, docx', 'allowEmpty' => false, 'on' => 'createFile'),
			// Validation rule for file when updating a file (optional)
			array('file', 'file', 'types' => 'pdf, doc, docx', 'allowEmpty' => true, 'on' => 'updateFile'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, record_num, uploader_id, original_filename, file_extension, e_filename, file_path, status', 'safe', 'on' => 'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		return array(
			'uploader' => array(self::BELONGS_TO, 'Account', 'uploader_id'),
			'fileAssignments' => array(self::HAS_MANY, 'FileAssignment', 'file_id'),
			'fileHistories' => array(self::HAS_MANY, 'FileHistory', 'parent_file_id'),
			'uploaderUser' => array(self::BELONGS_TO, 'User', 'uploader_id'),
			'uploaderDepartment' => array(self::BELONGS_TO, 'Department', 'uploader_id'),
			'parentFile' => array(self::BELONGS_TO, 'File', 'parent_file_id'),
			'fileAssignment' => array(self::HAS_ONE, 'FileAssignment', 'file_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'record_num' => 'Record Number',
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
		$criteria->compare('record_num',$this->record_num,true);
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
	 * @return File the static model class
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
					return "Not Downloadable";
					break;
				case '2':
					return "Downloadable";
					break;
			}
		}
	}

	/* 	
	public function beforeSave()
    {
        // Handle file upload before saving
		if ($this->file instanceof CUploadedFile) {
            $this->file->saveAs('path/to/upload/directory/' . $this->file->name);
            $this->file = $this->file->name; // Save file name to the database
        }

        return parent::beforeSave();
    }  */

	public function beforeSave()
	{
		$file = CUploadedFile::getInstance($this, 'file');
	
		if ($file instanceof CUploadedFile) {
			$this->original_filename = $file->name;
			$this->file_extension = pathinfo($file->name, PATHINFO_EXTENSION);
			$this->e_filename = $this->generateHashedFilename($file->name);
	
			$destination = 'protected/fileUploads/' . $this->original_filename;
			$this->file_path = $destination;

			$this->status = 1;
		}
		
		$this->record_num = $this->generateUniqueRecordNumber();
		$this->uploader_id = Yii::app()->user->id; 
	
		return parent::beforeSave();
	}	

	 public static function generateHashedFilename($originalFilename)
    {
        $hashedFilename = md5($originalFilename . time());
        return $hashedFilename;
    }

	public static function generateUniqueRecordNumber()
	{
		$timestamp = time();
		$randomNumber1 = mt_rand(1000, 9999);
		$randomNumber2 = mt_rand(100000, 999999);
		$hash = sha1($timestamp);
		$uniqueRecordNumber = $randomNumber1 . '-' . $randomNumber2 . '-' . substr($hash, 0, 6);

		return $uniqueRecordNumber;
	}

	public static function countFilesForRegularUser($userId)
    {
        $userAccount = Account::model()->findByPk($userId);

        if ($userAccount === null) {
            // Handle the case where the user account is not found
            return 0; // or throw an exception, depending on your preference
        }

        $departmentId = $userAccount->department_id;

        $criteria = new CDbCriteria();
        $criteria->addCondition('uploader_id IN (SELECT id FROM tbl_account WHERE department_id = :departmentId)');
        $criteria->params = array(':departmentId' => $departmentId);

        return self::model()->count($criteria);
    }

    public static function countAllFilesForAdmin()
    {
        return self::model()->count();
    }

	public static function getAssignedFileTallyForUser($userId)
	{
		$userAccount = Account::model()->findByPk($userId);
	
		if ($userAccount === null) {
			// Handle the case where the user account is not found
			return 0; // or throw an exception, depending on your preference
		}
	
		$departmentId = $userAccount->department_id;
	
		$assignedFileTally = FileAssignment::model()
			->findAllByAttributes(array('receiver_id' => $userId, 'department_id' => $departmentId));
	
		return count($assignedFileTally);
	}
}
