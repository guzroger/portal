<?php

/**
 * This is the model class for table "personal".
 *
 * The followings are the available columns in table 'personal':
 * @property integer $id
 * @property integer $personal_type_id
 * @property integer $clinic_id
 * @property integer $user_id
 * @property string $code
 * @property string $name
 * @property string $photo
 * @property string $firm
 * @property string $email
 * @property string $cellphone
 * @property string $phone
 * @property string $company
 * @property string $date_register
 * @property string $date_update
 * @property integer $doctor
 * @property integer $assistance
 * @property integer $visible
 * @property integer $status
 *
 * The followings are the available model relations:
 * @property Attention[] $attentions
 * @property Clinic $clinic
 * @property PersonalType $personalType
 * @property PersonalAssistance[] $personalAssistances
 * @property PersonalAssistance[] $personalAssistances1
 * @property PersonalCalendar[] $personalCalendars
 */
class MedPersonal extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'personal';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('personal_type_id, clinic_id, user_id, code, name, photo, company, date_register, status', 'required'),
			array('personal_type_id, clinic_id, user_id, doctor, assistance, visible, status', 'numerical', 'integerOnly'=>true),
			array('code, phone', 'length', 'max'=>50),
			array('name, firm, email', 'length', 'max'=>450),
			array('photo', 'length', 'max'=>250),
			array('cellphone', 'length', 'max'=>150),
			array('company', 'length', 'max'=>45),
			array('date_update', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, personal_type_id, clinic_id, user_id, code, name, photo, firm, email, cellphone, phone, company, date_register, date_update, doctor, assistance, visible, status', 'safe', 'on'=>'search'),
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
			'attentions' => array(self::HAS_MANY, 'Attention', 'personal_id'),
			'clinic' => array(self::BELONGS_TO, 'Clinic', 'clinic_id'),
			'personalType' => array(self::BELONGS_TO, 'PersonalType', 'personal_type_id'),
			'personalAssistances' => array(self::HAS_MANY, 'PersonalAssistance', 'personal_id'),
			'personalAssistances1' => array(self::HAS_MANY, 'PersonalAssistance', 'assistance_id'),
			'personalCalendars' => array(self::HAS_MANY, 'PersonalCalendar', 'personal_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'personal_type_id' => 'Personal Type',
			'clinic_id' => 'Clinic',
			'user_id' => 'User',
			'code' => 'Code',
			'name' => 'Name',
			'photo' => 'Photo',
			'firm' => 'Firm',
			'email' => 'Email',
			'cellphone' => 'Cellphone',
			'phone' => 'Phone',
			'company' => 'Company',
			'date_register' => 'Date Register',
			'date_update' => 'Date Update',
			'doctor' => 'Doctor',
			'assistance' => 'Assistance',
			'visible' => 'Visible',
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
		$criteria->compare('personal_type_id',$this->personal_type_id);
		$criteria->compare('clinic_id',$this->clinic_id);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('code',$this->code,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('photo',$this->photo,true);
		$criteria->compare('firm',$this->firm,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('cellphone',$this->cellphone,true);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('company',$this->company,true);
		$criteria->compare('date_register',$this->date_register,true);
		$criteria->compare('date_update',$this->date_update,true);
		$criteria->compare('doctor',$this->doctor);
		$criteria->compare('assistance',$this->assistance);
		$criteria->compare('visible',$this->visible);
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
	 * @return MedPersonal the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
