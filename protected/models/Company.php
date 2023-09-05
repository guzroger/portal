<?php

/**
 * This is the model class for table "company".
 *
 * The followings are the available columns in table 'company':
 * @property integer $id
 * @property string $code
 * @property string $photo
 * @property string $name
 * @property string $description
 * @property string $about
 * @property string $vision
 * @property string $diagram
 * @property string $benefit
 * @property string $address
 * @property string $email
 * @property string $phone
 * @property integer $status
 *
 * The followings are the available model relations:
 * @property CompanySocial[] $companySocials
 */
class Company extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'company';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('code, photo, name, about, vision, diagram, benefit', 'required'),
			array('status', 'numerical', 'integerOnly'=>true),
			array('code', 'length', 'max'=>50),
			array('photo', 'length', 'max'=>250),
			array('name', 'length', 'max'=>255),
			array('description, address, email, phone', 'length', 'max'=>450),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, code, photo, name, description, about, vision, diagram, benefit, address, email, phone, status', 'safe', 'on'=>'search'),
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
			'companySocials' => array(self::HAS_MANY, 'CompanySocial', 'company_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'code' => 'Code',
			'photo' => 'Photo',
			'name' => 'Name',
			'description' => 'Description',
			'about' => 'About',
			'vision' => 'Vision',
			'diagram' => 'Diagram',
			'benefit' => 'Benefit',
			'address' => 'Address',
			'email' => 'Email',
			'phone' => 'Phone',
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
		$criteria->compare('code',$this->code,true);
		$criteria->compare('photo',$this->photo,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('about',$this->about,true);
		$criteria->compare('vision',$this->vision,true);
		$criteria->compare('diagram',$this->diagram,true);
		$criteria->compare('benefit',$this->benefit,true);
		$criteria->compare('address',$this->address,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('status',$this->status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Company the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
