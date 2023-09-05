<?php

/**
 * This is the model class for table "employee_schedule".
 *
 * The followings are the available columns in table 'employee_schedule':
 * @property integer $id
 * @property integer $employee_id
 * @property string $schedule
 * @property string $code_license
 * @property string $license
 * @property string $error
 * @property string $error_message
 * @property string $date_register
 * @property integer $status
 *
 * The followings are the available model relations:
 * @property Employee $employee
 */
class EmployeeSchedule extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'employee_schedule';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('employee_id, schedule, code_license, license, date_register', 'required'),
			array('employee_id, status', 'numerical', 'integerOnly'=>true),
			array('schedule, error', 'length', 'max'=>10),
			array('code_license', 'length', 'max'=>20),
			array('license', 'length', 'max'=>150),
			array('error_message', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, employee_id, schedule, code_license, license, error, error_message, date_register, status', 'safe', 'on'=>'search'),
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
			'schedule' => 'Schedule',
			'code_license' => 'Code License',
			'license' => 'License',
			'error' => 'Error',
			'error_message' => 'Error Message',
			'date_register' => 'Date Register',
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
		$criteria->compare('schedule',$this->schedule,true);
		$criteria->compare('code_license',$this->code_license,true);
		$criteria->compare('license',$this->license,true);
		$criteria->compare('error',$this->error,true);
		$criteria->compare('error_message',$this->error_message,true);
		$criteria->compare('date_register',$this->date_register,true);
		$criteria->compare('status',$this->status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return EmployeeSchedule the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
