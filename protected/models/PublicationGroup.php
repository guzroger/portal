<?php

/**
 * This is the model class for table "publication_group".
 *
 * The followings are the available columns in table 'publication_group':
 * @property integer $id
 * @property integer $publication_id
 * @property integer $group_id
 * @property string $date_register
 * @property integer $status
 *
 * The followings are the available model relations:
 * @property Group $group
 * @property Publication $publication
 */
class PublicationGroup extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'publication_group';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('publication_id, group_id, date_register, status', 'required'),
			array('publication_id, group_id, status', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, publication_id, group_id, date_register, status', 'safe', 'on'=>'search'),
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
			'group' => array(self::BELONGS_TO, 'Group', 'group_id'),
			'publication' => array(self::BELONGS_TO, 'Publication', 'publication_id'),
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
			'group_id' => 'Group',
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
		$criteria->compare('publication_id',$this->publication_id);
		$criteria->compare('group_id',$this->group_id);
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
	 * @return PublicationGroup the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
