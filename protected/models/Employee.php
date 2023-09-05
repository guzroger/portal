<?php

/**
 * This is the model class for table "employee".
 *
 * The followings are the available columns in table 'employee':
 * @property integer $id
 * @property string $date_register
 * @property string $name
 * @property string $item
 * @property string $company
 * @property string $area
 * @property string $photo
 * @property string $date_update
 * @property integer $status
 *
 * The followings are the available model relations:
 * @property EmployeePersonal[] $employeePersonals
 * @property EmployeePublic[] $employeePublics
 */
class Employee extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'employee';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('date_register, name, item, company, area, photo', 'required'),
			array('status', 'numerical', 'integerOnly'=>true),
			array('name, area, photo', 'length', 'max'=>450),
			array('item', 'length', 'max'=>10),
			array('company', 'length', 'max'=>150),
			array('date_update', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, date_register, name, item, company, area, photo, date_update, status', 'safe', 'on'=>'search'),
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
			'employeePersonals' => array(self::HAS_MANY, 'EmployeePersonal', 'employee_id'),
			'employeePublics' => array(self::HAS_MANY, 'EmployeePublic', 'employee_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'date_register' => 'Date Register',
			'name' => 'Name',
			'item' => 'Item',
			'company' => 'Company',
			'area' => 'Area',
			'photo' => 'Photo',
			'date_update' => 'Date Update',
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
		$criteria->compare('date_register',$this->date_register,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('item',$this->item,true);
		$criteria->compare('company',$this->company,true);
		$criteria->compare('area',$this->area,true);
		$criteria->compare('photo',$this->photo,true);
		$criteria->compare('date_update',$this->date_update,true);
		$criteria->compare('status',$this->status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Employee the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
