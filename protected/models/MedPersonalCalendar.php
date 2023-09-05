<?php

/**
 * This is the model class for table "personal_calendar".
 *
 * The followings are the available columns in table 'personal_calendar':
 * @property integer $id
 * @property integer $personal_id
 * @property integer $time
 * @property string $start
 * @property string $end
 * @property integer $online
 * @property string $date_register
 * @property string $date_update
 * @property integer $status
 *
 * The followings are the available model relations:
 * @property CalendarDays[] $calendarDays
 * @property Personal $personal
 * @property Schedule[] $schedules
 */
class MedPersonalCalendar extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'personal_calendar';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('personal_id, time, start, end, date_register', 'required'),
			array('personal_id, time, online, status', 'numerical', 'integerOnly'=>true),
			array('start, end', 'length', 'max'=>45),
			array('date_update', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, personal_id, time, start, end, online, date_register, date_update, status', 'safe', 'on'=>'search'),
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
			'calendarDays' => array(self::HAS_MANY, 'CalendarDays', 'personal_calendar_id'),
			'personal' => array(self::BELONGS_TO, 'Personal', 'personal_id'),
			'schedules' => array(self::HAS_MANY, 'Schedule', 'personal_calendar_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'personal_id' => 'Personal',
			'time' => 'Time',
			'start' => 'Start',
			'end' => 'End',
			'online' => 'Online',
			'date_register' => 'Date Register',
			'date_update' => 'Date Update',
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
		$criteria->compare('personal_id',$this->personal_id);
		$criteria->compare('time',$this->time);
		$criteria->compare('start',$this->start,true);
		$criteria->compare('end',$this->end,true);
		$criteria->compare('online',$this->online);
		$criteria->compare('date_register',$this->date_register,true);
		$criteria->compare('date_update',$this->date_update,true);
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
	 * @return MedPersonalCalendar the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
