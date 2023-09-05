<?php

/**
 * This is the model class for table "user".
 *
 * The followings are the available columns in table 'user':
 * @property integer $id
 * @property integer $user_type_id
 * @property string $code
 * @property string $photo
 * @property string $username
 * @property string $password
 * @property string $item
 * @property string $date_register
 * @property string $date_update
 * @property string $first_login
 * @property integer $status
 *
 * The followings are the available model relations:
 * @property GroupUser[] $groupUsers
 * @property Meeting[] $meetings
 * @property MeetingUser[] $meetingUsers
 * @property NotificationUser[] $notificationUsers
 * @property Publication[] $publications
 * @property PublicationSave[] $publicationSaves
 * @property PublicationUser[] $publicationUsers
 * @property UserType $userType
 * @property UserToken[] $userTokens
 */
class User extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'user';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_type_id, code, username, item, date_register, status', 'required'),
			array('user_type_id, status', 'numerical', 'integerOnly'=>true),
			array('code, password', 'length', 'max'=>150),
			array('photo', 'length', 'max'=>45),
			array('username', 'length', 'max'=>50),
			array('item', 'length', 'max'=>10),
			array('date_update, first_login', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, user_type_id, code, photo, username, password, item, date_register, date_update, first_login, status', 'safe', 'on'=>'search'),
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
			'groupUsers' => array(self::HAS_MANY, 'GroupUser', 'user_id'),
			'meetings' => array(self::HAS_MANY, 'Meeting', 'user_id'),
			'meetingUsers' => array(self::HAS_MANY, 'MeetingUser', 'user_id'),
			'notificationUsers' => array(self::HAS_MANY, 'NotificationUser', 'user_id'),
			'publications' => array(self::HAS_MANY, 'Publication', 'user_id'),
			'publicationSaves' => array(self::HAS_MANY, 'PublicationSave', 'user_id'),
			'publicationUsers' => array(self::HAS_MANY, 'PublicationUser', 'user_id'),
			'userType' => array(self::BELONGS_TO, 'UserType', 'user_type_id'),
			'userTokens' => array(self::HAS_MANY, 'UserToken', 'user_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'user_type_id' => 'User Type',
			'code' => 'Code',
			'photo' => 'Photo',
			'username' => 'Username',
			'password' => 'Password',
			'item' => 'Item',
			'date_register' => 'Date Register',
			'date_update' => 'Date Update',
			'first_login' => 'First Login',
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
		$criteria->compare('user_type_id',$this->user_type_id);
		$criteria->compare('code',$this->code,true);
		$criteria->compare('photo',$this->photo,true);
		$criteria->compare('username',$this->username,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('item',$this->item,true);
		$criteria->compare('date_register',$this->date_register,true);
		$criteria->compare('date_update',$this->date_update,true);
		$criteria->compare('first_login',$this->first_login,true);
		$criteria->compare('status',$this->status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return User the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
