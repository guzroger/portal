<?php

/**
 * This is the model class for table "patient".
 *
 * The followings are the available columns in table 'patient':
 * @property integer $id
 * @property integer $parent_id
 * @property string $person_id
 * @property string $name
 * @property string $photo
 * @property string $item
 * @property integer $titular
 * @property string $company
 * @property string $date_register
 * @property string $date_update
 * @property string $patient_type
 * @property integer $patient_status_id
 * @property integer $employee
 * @property string $status_in
 * @property integer $status
 *
 * The followings are the available model relations:
 * @property History[] $histories
 * @property PatientStatus $patientStatus
 * @property PatientContact[] $patientContacts
 * @property PatientEmergency[] $patientEmergencies
 * @property Schedule[] $schedules
 */
class MedPatient extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'patient';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('person_id, name, photo, item, company, date_register, patient_type, patient_status_id, status_in', 'required'),
			array('parent_id, titular, patient_status_id, employee, status', 'numerical', 'integerOnly'=>true),
			array('person_id', 'length', 'max'=>50),
			array('name, photo', 'length', 'max'=>450),
			array('item', 'length', 'max'=>45),
			array('company', 'length', 'max'=>150),
			array('patient_type, status_in', 'length', 'max'=>250),
			array('date_update', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, parent_id, person_id, name, photo, item, titular, company, date_register, date_update, patient_type, patient_status_id, employee, status_in, status', 'safe', 'on'=>'search'),
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
			'histories' => array(self::HAS_MANY, 'History', 'patient_id'),
			'patientStatus' => array(self::BELONGS_TO, 'PatientStatus', 'patient_status_id'),
			'patientContacts' => array(self::HAS_MANY, 'PatientContact', 'patient_id'),
			'patientEmergencies' => array(self::HAS_MANY, 'PatientEmergency', 'patient_id'),
			'schedules' => array(self::HAS_MANY, 'Schedule', 'patient_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'parent_id' => 'Parent',
			'person_id' => 'Person',
			'name' => 'Name',
			'photo' => 'Photo',
			'item' => 'Item',
			'titular' => 'Titular',
			'company' => 'Company',
			'date_register' => 'Date Register',
			'date_update' => 'Date Update',
			'patient_type' => 'Patient Type',
			'patient_status_id' => 'Patient Status',
			'employee' => 'Employee',
			'status_in' => 'Status In',
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
		$criteria->compare('parent_id',$this->parent_id);
		$criteria->compare('person_id',$this->person_id,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('photo',$this->photo,true);
		$criteria->compare('item',$this->item,true);
		$criteria->compare('titular',$this->titular);
		$criteria->compare('company',$this->company,true);
		$criteria->compare('date_register',$this->date_register,true);
		$criteria->compare('date_update',$this->date_update,true);
		$criteria->compare('patient_type',$this->patient_type,true);
		$criteria->compare('patient_status_id',$this->patient_status_id);
		$criteria->compare('employee',$this->employee);
		$criteria->compare('status_in',$this->status_in,true);
		$criteria->compare('status',$this->status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * @return CDbConnection the database connection used for this class
	 */
	public function getDbConnection()
	{
		return Yii::app()->dbMedical;
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return MedPatient the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
