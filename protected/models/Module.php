<?php

/**
 * This is the model class for table "module".
 *
 * The followings are the available columns in table 'module':
 * @property integer $id
 * @property integer $module_type_id
 * @property string $name
 * @property string $description
 * @property string $date_register
 * @property string $date_update
 * @property integer $status
 *
 * The followings are the available model relations:
 * @property ModuleType $moduleType
 * @property ModuleSub[] $moduleSubs
 */
class Module extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'module';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('module_type_id, name, date_register', 'required'),
			array('module_type_id, status', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>150),
			array('description', 'length', 'max'=>450),
			array('date_update', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, module_type_id, name, description, date_register, date_update, status', 'safe', 'on'=>'search'),
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
			'moduleType' => array(self::BELONGS_TO, 'ModuleType', 'module_type_id'),
			'moduleSubs' => array(self::HAS_MANY, 'ModuleSub', 'module_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'module_type_id' => 'Module Type',
			'name' => 'Name',
			'description' => 'Description',
			'date_register' => 'Date Register',
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
		$criteria->compare('module_type_id',$this->module_type_id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('date_register',$this->date_register,true);
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
	 * @return Module the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
