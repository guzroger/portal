<?php

/**
 * This is the model class for table "employee_public".
 *
 * The followings are the available columns in table 'employee_public':
 * @property integer $id
 * @property integer $employee_id
 * @property string $date_register
 * @property string $item
 * @property string $email
 * @property string $phone_direct
 * @property string $phone_corp
 * @property string $phone_int
 * @property string $charge
 * @property string $area
 * @property string $building
 * @property string $building_flat
 * @property integer $status
 *
 * The followings are the available model relations:
 * @property Employee $employee
 */
class EmployeePublic extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'employee_public';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('employee_id, date_register, item, status', 'required'),
			array('employee_id, status', 'numerical', 'integerOnly'=>true),
			array('item', 'length', 'max'=>10),
			array('email, charge, area, building', 'length', 'max'=>250),
			array('phone_direct, phone_corp, phone_int', 'length', 'max'=>100),
			array('building_flat', 'length', 'max'=>50),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, employee_id, date_register, item, email, phone_direct, phone_corp, phone_int, charge, area, building, building_flat, status', 'safe', 'on'=>'search'),
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
			'employee' => array(self::BELONGS_TO, 'Employee', 'employee_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'employee_id' => 'Employee',
			'date_register' => 'Date Register',
			'item' => 'Item',
			'email' => 'Email',
			'phone_direct' => 'Phone Direct',
			'phone_corp' => 'Phone Corp',
			'phone_int' => 'Phone Int',
			'charge' => 'Charge',
			'area' => 'Area',
			'building' => 'Building',
			'building_flat' => 'Building Flat',
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
		$criteria->compare('employee_id',$this->employee_id);
		$criteria->compare('date_register',$this->date_register,true);
		$criteria->compare('item',$this->item,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('phone_direct',$this->phone_direct,true);
		$criteria->compare('phone_corp',$this->phone_corp,true);
		$criteria->compare('phone_int',$this->phone_int,true);
		$criteria->compare('charge',$this->charge,true);
		$criteria->compare('area',$this->area,true);
		$criteria->compare('building',$this->building,true);
		$criteria->compare('building_flat',$this->building_flat,true);
		$criteria->compare('status',$this->status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return EmployeePublic the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
