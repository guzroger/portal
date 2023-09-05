<?php

/**
 * This is the model class for table "module_data_files".
 *
 * The followings are the available columns in table 'module_data_files':
 * @property integer $id
 * @property integer $module_data_id
 * @property string $name
 * @property string $file
 * @property string $date_register
 * @property integer $deleted
 * @property integer $status
 *
 * The followings are the available model relations:
 * @property ModuleData $moduleData
 */
class ModuleDataFiles extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'module_data_files';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('module_data_id, name, file, date_register, status', 'required'),
			array('module_data_id, deleted, status', 'numerical', 'integerOnly'=>true),
			array('name, file', 'length', 'max'=>150),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, module_data_id, name, file, date_register, deleted, status', 'safe', 'on'=>'search'),
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
			'moduleData' => array(self::BELONGS_TO, 'ModuleData', 'module_data_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'module_data_id' => 'Module Data',
			'name' => 'Name',
			'file' => 'File',
			'date_register' => 'Date Register',
			'deleted' => 'Deleted',
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
		$criteria->compare('module_data_id',$this->module_data_id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('file',$this->file,true);
		$criteria->compare('date_register',$this->date_register,true);
		$criteria->compare('deleted',$this->deleted);
		$criteria->compare('status',$this->status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ModuleDataFiles the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
