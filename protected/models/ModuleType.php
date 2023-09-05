<?php

/**
 * This is the model class for table "module_type".
 *
 * The followings are the available columns in table 'module_type':
 * @property integer $id
 * @property string $date_register
 * @property string $code
 * @property string $name
 * @property string $folder
 * @property integer $status
 *
 * The followings are the available model relations:
 * @property Module[] $modules
 */
class ModuleType extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'module_type';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('date_register, code, name, folder', 'required'),
			array('status', 'numerical', 'integerOnly'=>true),
			array('code', 'length', 'max'=>100),
			array('name', 'length', 'max'=>150),
			array('folder', 'length', 'max'=>50),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, date_register, code, name, folder, status', 'safe', 'on'=>'search'),
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
			'modules' => array(self::HAS_MANY, 'Module', 'module_type_id'),
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
			'code' => 'Code',
			'name' => 'Name',
			'folder' => 'Folder',
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
		$criteria->compare('code',$this->code,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('folder',$this->folder,true);
		$criteria->compare('status',$this->status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ModuleType the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
