<?php

/**
 * This is the model class for table "employee_personal".
 *
 * The followings are the available columns in table 'employee_personal':
 * @property integer $id
 * @property integer $employee_id
 * @property string $date_register
 * @property string $item
 * @property string $nationality
 * @property string $civil_status
 * @property string $gender
 * @property string $birthdate
 * @property string $document
 * @property string $document_type
 * @property string $document_emi
 * @property string $document_photo
 * @property string $document_url
 * @property string $passport
 * @property string $passport_photo
 * @property string $passport_url
 * @property string $driver_license
 * @property string $driver_license_photo
 * @property string $driver_license_url
 * @property string $address
 * @property string $phone
 * @property string $cellphone
 * @property string $email
 * @property integer $status
 *
 * The followings are the available model relations:
 * @property Employee $employee
 */
class EmployeePersonal extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'employee_personal';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('employee_id, date_register, item, status', 'required'),
			array('employee_id, status', 'numerical', 'integerOnly'=>true),
			array('item', 'length', 'max'=>10),
			array('nationality, civil_status, gender, document, passport, driver_license, phone, cellphone', 'length', 'max'=>150),
			array('document_type, document_emi', 'length', 'max'=>50),
			array('document_photo, passport_photo, driver_license_photo, email', 'length', 'max'=>250),
			array('document_url, passport_url, driver_license_url, address', 'length', 'max'=>450),
			array('birthdate', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, employee_id, date_register, item, nationality, civil_status, gender, birthdate, document, document_type, document_emi, document_photo, document_url, passport, passport_photo, passport_url, driver_license, driver_license_photo, driver_license_url, address, phone, cellphone, email, status', 'safe', 'on'=>'search'),
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
			'employee' => array(self::BELONGS_TO, 'Employee', 'employee_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'employee_id' => 'Employee',
			'date_register' => 'Date Register',
			'item' => 'Item',
			'nationality' => 'Nationality',
			'civil_status' => 'Civil Status',
			'gender' => 'Gender',
			'birthdate' => 'Birthdate',
			'document' => 'Document',
			'document_type' => 'Document Type',
			'document_emi' => 'Document Emi',
			'document_photo' => 'Document Photo',
			'document_url' => 'Document Url',
			'passport' => 'Passport',
			'passport_photo' => 'Passport Photo',
			'passport_url' => 'Passport Url',
			'driver_license' => 'Driver License',
			'driver_license_photo' => 'Driver License Photo',
			'driver_license_url' => 'Driver License Url',
			'address' => 'Address',
			'phone' => 'Phone',
			'cellphone' => 'Cellphone',
			'email' => 'Email',
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
		$criteria->compare('employee_id',$this->employee_id);
		$criteria->compare('date_register',$this->date_register,true);
		$criteria->compare('item',$this->item,true);
		$criteria->compare('nationality',$this->nationality,true);
		$criteria->compare('civil_status',$this->civil_status,true);
		$criteria->compare('gender',$this->gender,true);
		$criteria->compare('birthdate',$this->birthdate,true);
		$criteria->compare('document',$this->document,true);
		$criteria->compare('document_type',$this->document_type,true);
		$criteria->compare('document_emi',$this->document_emi,true);
		$criteria->compare('document_photo',$this->document_photo,true);
		$criteria->compare('document_url',$this->document_url,true);
		$criteria->compare('passport',$this->passport,true);
		$criteria->compare('passport_photo',$this->passport_photo,true);
		$criteria->compare('passport_url',$this->passport_url,true);
		$criteria->compare('driver_license',$this->driver_license,true);
		$criteria->compare('driver_license_photo',$this->driver_license_photo,true);
		$criteria->compare('driver_license_url',$this->driver_license_url,true);
		$criteria->compare('address',$this->address,true);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('cellphone',$this->cellphone,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('status',$this->status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return EmployeePersonal the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
