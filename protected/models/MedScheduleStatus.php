<?php

/**
 * This is the model class for table "schedule_status".
 *
 * The followings are the available columns in table 'schedule_status':
 * @property integer $id
 * @property string $name
 * @property string $color
 * @property string $date_register
 * @property string $date_update
 * @property integer $status
 *
 * The followings are the available model relations:
 * @property Schedule[] $schedules
 */
class MedScheduleStatus extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'schedule_status';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, color, date_register', 'required'),
			array('status', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>450),
			array('color', 'length', 'max'=>45),
			array('date_update', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, name, color, date_register, date_update, status', 'safe', 'on'=>'search'),
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
			'schedules' => array(self::HAS_MANY, 'Schedule', 'schedule_status_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => 'Name',
			'color' => 'Color',
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
		$criteria->compare('name',$this->name,true);
		$criteria->compare('color',$this->color,true);
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
	 * @return MedScheduleStatus the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
