<?php

/**
 * This is the model class for table "user_access".
 *
 * The followings are the available columns in table 'user_access':
 * @property integer $id
 * @property integer $user_id
 * @property integer $api_software_id
 * @property string $secure
 * @property string $date_register
 * @property string $date_execute
 * @property integer $status
 *
 * The followings are the available model relations:
 * @property ApiSoftware $apiSoftware
 * @property User $user
 */
class UserAccess extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'user_access';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id, api_software_id, secure, date_register', 'required'),
			array('user_id, api_software_id, status', 'numerical', 'integerOnly'=>true),
			array('secure', 'length', 'max'=>450),
			array('date_execute', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, user_id, api_software_id, secure, date_register, date_execute, status', 'safe', 'on'=>'search'),
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
			'apiSoftware' => array(self::BELONGS_TO, 'ApiSoftware', 'api_software_id'),
			'user' => array(self::BELONGS_TO, 'User', 'user_id'),
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
			'api_software_id' => 'Api Software',
			'secure' => 'Secure',
			'date_register' => 'Date Register',
			'date_execute' => 'Date Execute',
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
		$criteria->compare('api_software_id',$this->api_software_id);
		$criteria->compare('secure',$this->secure,true);
		$criteria->compare('date_register',$this->date_register,true);
		$criteria->compare('date_execute',$this->date_execute,true);
		$criteria->compare('status',$this->status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return UserAccess the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
