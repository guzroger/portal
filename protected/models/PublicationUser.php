<?php

/**
 * This is the model class for table "publication_user".
 *
 * The followings are the available columns in table 'publication_user':
 * @property integer $id
 * @property integer $publication_id
 * @property integer $user_id
 * @property string $date_register
 * @property integer $reaction
 * @property string $comment
 * @property integer $status
 *
 * The followings are the available model relations:
 * @property Publication $publication
 * @property User $user
 */
class PublicationUser extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'publication_user';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('publication_id, user_id, date_register, status', 'required'),
			array('publication_id, user_id, reaction, status', 'numerical', 'integerOnly'=>true),
			array('comment', 'length', 'max'=>150),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, publication_id, user_id, date_register, reaction, comment, status', 'safe', 'on'=>'search'),
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
			'publication' => array(self::BELONGS_TO, 'Publication', 'publication_id'),
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
			'publication_id' => 'Publication',
			'user_id' => 'User',
			'date_register' => 'Date Register',
			'reaction' => 'Reaction',
			'comment' => 'Comment',
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
		$criteria->compare('publication_id',$this->publication_id);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('date_register',$this->date_register,true);
		$criteria->compare('reaction',$this->reaction);
		$criteria->compare('comment',$this->comment,true);
		$criteria->compare('status',$this->status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return PublicationUser the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
