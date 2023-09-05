<?php

/**
 * This is the model class for table "covid".
 *
 * The followings are the available columns in table 'covid':
 * @property integer $id
 * @property string $date_register
 * @property string $date_update
 * @property string $item
 * @property integer $patient_id
 * @property integer $is_titular
 * @property string $name
 * @property string $document
 * @property string $birthday
 * @property string $age
 * @property string $phone
 * @property string $sick
 * @property integer $status
 */
class Covid extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'covid';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('date_register, item, name, document, birthday, age, phone', 'required'),
			array('patient_id, is_titular, status', 'numerical', 'integerOnly'=>true),
			array('item, document', 'length', 'max'=>50),
			array('name, sick', 'length', 'max'=>450),
			array('age', 'length', 'max'=>11),
			array('phone', 'length', 'max'=>100),
			array('date_update', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, date_register, date_update, item, patient_id, is_titular, name, document, birthday, age, phone, sick, status', 'safe', 'on'=>'search'),
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
			'date_update' => 'Date Update',
			'item' => 'Item',
			'patient_id' => 'Patient',
			'is_titular' => 'Is Titular',
			'name' => 'Name',
			'document' => 'Document',
			'birthday' => 'Birthday',
			'age' => 'Age',
			'phone' => 'Phone',
			'sick' => 'Sick',
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
		$criteria->compare('date_update',$this->date_update,true);
		$criteria->compare('item',$this->item,true);
		$criteria->compare('patient_id',$this->patient_id);
		$criteria->compare('is_titular',$this->is_titular);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('document',$this->document,true);
		$criteria->compare('birthday',$this->birthday,true);
		$criteria->compare('age',$this->age,true);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('sick',$this->sick,true);
		$criteria->compare('status',$this->status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * @return CDbConnection the database connection used for this class
	 */
	public function getDbConnection()
	{
		return Yii::app()->dbMedical;
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Covid the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
