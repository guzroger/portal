<?php

/**
 * This is the model class for table "supervisor".
 *
 * The followings are the available columns in table 'supervisor':
 * @property integer $id
 * @property string $name
 * @property string $item
 * @property string $area
 * @property string $date_register
 * @property string $status
 *
 * The followings are the available model relations:
 * @property License[] $licenses
 */
class Supervisor extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'supervisor';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, item, area, date_register', 'required'),
			array('name', 'length', 'max'=>450),
			array('item, status', 'length', 'max'=>45),
			array('area', 'length', 'max'=>250),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, name, item, area, date_register, status', 'safe', 'on'=>'search'),
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
			'licenses' => array(self::HAS_MANY, 'License', 'supervisor_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => 'Name',
			'item' => 'Item',
			'area' => 'Area',
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
		$criteria->compare('name',$this->name,true);
		$criteria->compare('item',$this->item,true);
		$criteria->compare('area',$this->area,true);
		$criteria->compare('date_register',$this->date_register,true);
		$criteria->compare('status',$this->status,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Supervisor the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
