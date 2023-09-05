<?php

/**
 * This is the model class for table "publication_file".
 *
 * The followings are the available columns in table 'publication_file':
 * @property integer $id
 * @property integer $publication_id
 * @property string $date_register
 * @property string $name
 * @property string $file
 * @property integer $status
 *
 * The followings are the available model relations:
 * @property Publication $publication
 */
class PublicationFile extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'publication_file';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('publication_id, date_register, name, file', 'required'),
			array('publication_id, status', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>100),
			array('file', 'length', 'max'=>450),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, publication_id, date_register, name, file, status', 'safe', 'on'=>'search'),
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
			'date_register' => 'Date Register',
			'name' => 'Name',
			'file' => 'File',
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
		$criteria->compare('date_register',$this->date_register,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('file',$this->file,true);
		$criteria->compare('status',$this->status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return PublicationFile the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
