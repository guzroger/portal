<?php

/**
 * This is the model class for table "api_software".
 *
 * The followings are the available columns in table 'api_software':
 * @property integer $id
 * @property string $key
 * @property string $code
 * @property string $software
 * @property string $url
 * @property string $date_register
 * @property string $date_update
 * @property integer $public
 * @property integer $status
 *
 * The followings are the available model relations:
 * @property UserToken[] $userTokens
 */
class ApiSoftware extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'api_software';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('key, code, software, url, date_register', 'required'),
			array('public, status', 'numerical', 'integerOnly'=>true),
			array('key, url', 'length', 'max'=>450),
			array('code', 'length', 'max'=>10),
			array('software', 'length', 'max'=>250),
			array('date_update', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, key, code, software, url, date_register, date_update, public, status', 'safe', 'on'=>'search'),
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
			'userTokens' => array(self::HAS_MANY, 'UserToken', 'api_software_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'key' => 'Key',
			'code' => 'Code',
			'software' => 'Software',
			'url' => 'Url',
			'date_register' => 'Date Register',
			'date_update' => 'Date Update',
			'public' => 'Public',
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
		$criteria->compare('key',$this->key,true);
		$criteria->compare('code',$this->code,true);
		$criteria->compare('software',$this->software,true);
		$criteria->compare('url',$this->url,true);
		$criteria->compare('date_register',$this->date_register,true);
		$criteria->compare('date_update',$this->date_update,true);
		$criteria->compare('public',$this->public);
		$criteria->compare('status',$this->status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ApiSoftware the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
