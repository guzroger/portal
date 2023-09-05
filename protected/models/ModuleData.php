<?php

/**
 * This is the model class for table "module_data".
 *
 * The followings are the available columns in table 'module_data':
 * @property integer $id
 * @property integer $module_sub_id
 * @property string $title
 * @property string $description
 * @property string $information
 * @property string $file
 * @property string $deleted_file
 * @property integer $deleted
 * @property integer $files
 * @property string $date_register
 * @property string $date_update
 * @property string $approved
 * @property string $version
 * @property string $date_approved
 * @property string $code_module
 * @property integer $status
 *
 * The followings are the available model relations:
 * @property ModuleSub $moduleSub
 * @property ModuleDataFiles[] $moduleDataFiles
 */
class ModuleData extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'module_data';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('module_sub_id, title, date_register', 'required'),
			array('module_sub_id, deleted, files, status', 'numerical', 'integerOnly'=>true),
			array('title', 'length', 'max'=>150),
			array('description, file, deleted_file, approved', 'length', 'max'=>450),
			array('version', 'length', 'max'=>11),
			array('code_module', 'length', 'max'=>50),
			array('information, date_update, date_approved', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, module_sub_id, title, description, information, file, deleted_file, deleted, files, date_register, date_update, approved, version, date_approved, code_module, status', 'safe', 'on'=>'search'),
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
			'moduleSub' => array(self::BELONGS_TO, 'ModuleSub', 'module_sub_id'),
			'moduleDataFiles' => array(self::HAS_MANY, 'ModuleDataFiles', 'module_data_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'module_sub_id' => 'Module Sub',
			'title' => 'Titulo',
			'description' => 'Descripcion',
			'information' => 'Informacion',
			'file' => 'Archivo',
			'deleted_file' => 'Deleted File',
			'deleted' => 'Deleted',
			'files' => 'Archivos',
			'date_register' => 'Date Register',
			'date_update' => 'Date Update',
			'approved' => 'Aprovado',
			'version' => 'Version',
			'date_approved' => 'Fecha Aprobacion',
			'code_module' => 'Codigo',
			'status' => 'Estado',
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
		$criteria->compare('module_sub_id',$this->module_sub_id);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('information',$this->information,true);
		$criteria->compare('file',$this->file,true);
		$criteria->compare('deleted_file',$this->deleted_file,true);
		$criteria->compare('deleted',$this->deleted);
		$criteria->compare('files',$this->files);
		$criteria->compare('date_register',$this->date_register,true);
		$criteria->compare('date_update',$this->date_update,true);
		$criteria->compare('approved',$this->approved,true);
		$criteria->compare('version',$this->version,true);
		$criteria->compare('date_approved',$this->date_approved,true);
		$criteria->compare('code_module',$this->code_module,true);
		$criteria->compare('status',$this->status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ModuleData the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
