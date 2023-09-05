<?php

/**
 * This is the model class for table "log_register".
 *
 * The followings are the available columns in table 'log_register':
 * @property integer $id
 * @property integer $user_id
 * @property string $username
 * @property string $date_log
 * @property string $date_register
 * @property string $url
 * @property string $param_in
 * @property string $param_out
 * @property string $time_execute
 * @property string $ip_address
 */
class LogRegister extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'log_register';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id, username, date_log, date_register, url, time_execute, ip_address', 'required'),
			array('user_id', 'numerical', 'integerOnly'=>true),
			array('username, time_execute', 'length', 'max'=>50),
			array('url, param_in, param_out', 'length', 'max'=>450),
			array('ip_address', 'length', 'max'=>150),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, user_id, username, date_log, date_register, url, param_in, param_out, time_execute, ip_address', 'safe', 'on'=>'search'),
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
			'username' => 'Username',
			'date_log' => 'Date Log',
			'date_register' => 'Date Register',
			'url' => 'Url',
			'param_in' => 'Param In',
			'param_out' => 'Param Out',
			'time_execute' => 'Time Execute',
			'ip_address' => 'Ip Address',
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
		$criteria->compare('username',$this->username,true);
		$criteria->compare('date_log',$this->date_log,true);
		$criteria->compare('date_register',$this->date_register,true);
		$criteria->compare('url',$this->url,true);
		$criteria->compare('param_in',$this->param_in,true);
		$criteria->compare('param_out',$this->param_out,true);
		$criteria->compare('time_execute',$this->time_execute,true);
		$criteria->compare('ip_address',$this->ip_address,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return LogRegister the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
