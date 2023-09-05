<?php

/**
 * This is the model class for table "publication".
 *
 * The followings are the available columns in table 'publication':
 * @property integer $id
 * @property integer $user_id
 * @property string $date_register
 * @property string $date_update
 * @property string $title
 * @property string $description
 * @property string $document
 * @property string $video
 * @property integer $image
 * @property integer $files
 * @property integer $send_email
 * @property integer $send_whatsapp
 * @property integer $priority
 * @property integer $status
 *
 * The followings are the available model relations:
 * @property User $user
 * @property PublicationFile[] $publicationFiles
 * @property PublicationGroup[] $publicationGroups
 * @property PublicationImage[] $publicationImages
 * @property PublicationUser[] $publicationUsers
 */
class Publication extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'publication';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id, date_register, title', 'required'),
			array('user_id, image, files, send_email, send_whatsapp, priority, status', 'numerical', 'integerOnly'=>true),
			array('title', 'length', 'max'=>150),
			array('description, video', 'length', 'max'=>450),
			array('date_update, document', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, user_id, date_register, date_update, title, description, document, video, image, files, send_email, send_whatsapp, priority, status', 'safe', 'on'=>'search'),
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
			'user' => array(self::BELONGS_TO, 'User', 'user_id'),
			'publicationFiles' => array(self::HAS_MANY, 'PublicationFile', 'publication_id'),
			'publicationGroups' => array(self::HAS_MANY, 'PublicationGroup', 'publication_id'),
			'publicationImages' => array(self::HAS_MANY, 'PublicationImage', 'publication_id'),
			'publicationUsers' => array(self::HAS_MANY, 'PublicationUser', 'publication_id'),
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
			'date_register' => 'Date Register',
			'date_update' => 'Date Update',
			'title' => 'Title',
			'description' => 'Description',
			'document' => 'Document',
			'video' => 'Video',
			'image' => 'Image',
			'files' => 'Files',
			'send_email' => 'Send Email',
			'send_whatsapp' => 'Send Whatsapp',
			'priority' => 'Priority',
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
		$criteria->compare('date_register',$this->date_register,true);
		$criteria->compare('date_update',$this->date_update,true);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('document',$this->document,true);
		$criteria->compare('video',$this->video,true);
		$criteria->compare('image',$this->image);
		$criteria->compare('files',$this->files);
		$criteria->compare('send_email',$this->send_email);
		$criteria->compare('send_whatsapp',$this->send_whatsapp);
		$criteria->compare('priority',$this->priority);
		$criteria->compare('status',$this->status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Publication the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
