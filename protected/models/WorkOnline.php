<?php

/**
 * This is the model class for table "work_online".
 *
 * The followings are the available columns in table 'work_online':
 * @property integer $id
 * @property integer $user_id
 * @property string $item
 * @property string $name
 * @property integer $team_id
 * @property string $team_name
 * @property string $team_url
 * @property string $date_register
 * @property string $date_online
 * @property integer $status
 */
class WorkOnline extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'work_online';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id, item, name, team_id, team_name, team_url, date_register, date_online', 'required'),
			array('user_id, team_id, status', 'numerical', 'integerOnly'=>true),
			array('item', 'length', 'max'=>50),
			array('name, team_name, team_url', 'length', 'max'=>450),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, user_id, item, name, team_id, team_name, team_url, date_register, date_online, status', 'safe', 'on'=>'search'),
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
			'user_id' => 'User',
			'item' => 'Item',
			'name' => 'Name',
			'team_id' => 'Team',
			'team_name' => 'Team Name',
			'team_url' => 'Team Url',
			'date_register' => 'Date Register',
			'date_online' => 'Date Online',
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
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('item',$this->item,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('team_id',$this->team_id);
		$criteria->compare('team_name',$this->team_name,true);
		$criteria->compare('team_url',$this->team_url,true);
		$criteria->compare('date_register',$this->date_register,true);
		$criteria->compare('date_online',$this->date_online,true);
		$criteria->compare('status',$this->status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return WorkOnline the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
