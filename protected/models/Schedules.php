<?php

/**
 * This is the model class for table "schedules".
 *
 * The followings are the available columns in table 'schedules':
 * @property integer $id
 * @property string $schedule
 * @property string $entry
 * @property string $output
 * @property integer $order
 * @property string $turn
 * @property string $date_register
 * @property integer $status
 */
class Schedules extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'schedules';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('schedule, date_register, status', 'required'),
			array('order, status', 'numerical', 'integerOnly'=>true),
			array('schedule', 'length', 'max'=>10),
			array('entry, output', 'length', 'max'=>150),
			array('turn', 'length', 'max'=>100),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, schedule, entry, output, order, turn, date_register, status', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'schedule' => 'Schedule',
			'entry' => 'Entry',
			'output' => 'Output',
			'order' => 'Order',
			'turn' => 'Turn',
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
		$criteria->compare('schedule',$this->schedule,true);
		$criteria->compare('entry',$this->entry,true);
		$criteria->compare('output',$this->output,true);
		$criteria->compare('order',$this->order);
		$criteria->compare('turn',$this->turn,true);
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
	 * @return Schedules the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
