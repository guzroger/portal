<?php

/**
 * This is the model class for table "license".
 *
 * The followings are the available columns in table 'license':
 * @property integer $id
 * @property integer $supervisor_id
 * @property integer $employee_id
 * @property string $type
 * @property string $code
 * @property string $name
 * @property string $item
 * @property string $date_register
 * @property string $date
 * @property string $date_start
 * @property string $date_end
 * @property string $date_return
 * @property integer $days
 * @property integer $hours
 * @property integer $minutes
 * @property string $observation_sol
 * @property string $observation_auth
 * @property string $date_auth
 * @property string $date_start_auth
 * @property string $date_end_auth
 * @property string $date_return_auth
 * @property integer $days_auth
 * @property integer $hours_auth
 * @property integer $minutes_auth
 * @property integer $status_auth
 * @property integer $status
 *
 * The followings are the available model relations:
 * @property Employee $employee
 * @property Supervisor $supervisor
 */
class License extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'license';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('supervisor_id, employee_id, type, code, name, item, date_register, days', 'required'),
			array('supervisor_id, employee_id, days, hours, minutes, days_auth, hours_auth, minutes_auth, status_auth, status', 'numerical', 'integerOnly'=>true),
			array('type', 'length', 'max'=>150),
			array('code', 'length', 'max'=>50),
			array('name, observation_sol, observation_auth', 'length', 'max'=>450),
			array('item', 'length', 'max'=>45),
			array('date, date_start, date_end, date_return, date_auth, date_start_auth, date_end_auth, date_return_auth', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, supervisor_id, employee_id, type, code, name, item, date_register, date, date_start, date_end, date_return, days, hours, minutes, observation_sol, observation_auth, date_auth, date_start_auth, date_end_auth, date_return_auth, days_auth, hours_auth, minutes_auth, status_auth, status', 'safe', 'on'=>'search'),
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
			'supervisor' => array(self::BELONGS_TO, 'Supervisor', 'supervisor_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'supervisor_id' => 'Supervisor',
			'employee_id' => 'Employee',
			'type' => 'Type',
			'code' => 'Code',
			'name' => 'Name',
			'item' => 'Item',
			'date_register' => 'Date Register',
			'date' => 'Date',
			'date_start' => 'Date Start',
			'date_end' => 'Date End',
			'date_return' => 'Date Return',
			'days' => 'Days',
			'hours' => 'Hours',
			'minutes' => 'Minutes',
			'observation_sol' => 'Observation Sol',
			'observation_auth' => 'Observation Auth',
			'date_auth' => 'Date Auth',
			'date_start_auth' => 'Date Start Auth',
			'date_end_auth' => 'Date End Auth',
			'date_return_auth' => 'Date Return Auth',
			'days_auth' => 'Days Auth',
			'hours_auth' => 'Hours Auth',
			'minutes_auth' => 'Minutes Auth',
			'status_auth' => 'Status Auth',
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
		$criteria->compare('supervisor_id',$this->supervisor_id);
		$criteria->compare('employee_id',$this->employee_id);
		$criteria->compare('type',$this->type,true);
		$criteria->compare('code',$this->code,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('item',$this->item,true);
		$criteria->compare('date_register',$this->date_register,true);
		$criteria->compare('date',$this->date,true);
		$criteria->compare('date_start',$this->date_start,true);
		$criteria->compare('date_end',$this->date_end,true);
		$criteria->compare('date_return',$this->date_return,true);
		$criteria->compare('days',$this->days);
		$criteria->compare('hours',$this->hours);
		$criteria->compare('minutes',$this->minutes);
		$criteria->compare('observation_sol',$this->observation_sol,true);
		$criteria->compare('observation_auth',$this->observation_auth,true);
		$criteria->compare('date_auth',$this->date_auth,true);
		$criteria->compare('date_start_auth',$this->date_start_auth,true);
		$criteria->compare('date_end_auth',$this->date_end_auth,true);
		$criteria->compare('date_return_auth',$this->date_return_auth,true);
		$criteria->compare('days_auth',$this->days_auth);
		$criteria->compare('hours_auth',$this->hours_auth);
		$criteria->compare('minutes_auth',$this->minutes_auth);
		$criteria->compare('status_auth',$this->status_auth);
		$criteria->compare('status',$this->status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return License the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
