<?php

/**
 * This is the model class for table "log_authenticate".
 *
 * The followings are the available columns in table 'log_authenticate':
 * @property integer $id
 * @property string $token
 * @property string $date_log
 * @property string $date_register
 * @property string $username
 * @property string $code
 * @property string $error_code
 * @property string $error_message
 * @property string $ip_address
 */
class LogAuthenticate extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'log_authenticate';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('token, date_log, date_register, username, code, ip_address', 'required'),
			array('token', 'length', 'max'=>250),
			array('username, code', 'length', 'max'=>50),
			array('error_code', 'length', 'max'=>10),
			array('error_message', 'length', 'max'=>450),
			array('ip_address', 'length', 'max'=>100),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, token, date_log, date_register, username, code, error_code, error_message, ip_address', 'safe', 'on'=>'search'),
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
			'token' => 'Token',
			'date_log' => 'Date Log',
			'date_register' => 'Date Register',
			'username' => 'Username',
			'code' => 'Code',
			'error_code' => 'Error Code',
			'error_message' => 'Error Message',
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
		$criteria->compare('token',$this->token,true);
		$criteria->compare('date_log',$this->date_log,true);
		$criteria->compare('date_register',$this->date_register,true);
		$criteria->compare('username',$this->username,true);
		$criteria->compare('code',$this->code,true);
		$criteria->compare('error_code',$this->error_code,true);
		$criteria->compare('error_message',$this->error_message,true);
		$criteria->compare('ip_address',$this->ip_address,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return LogAuthenticate the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
