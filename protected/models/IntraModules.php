<?php
class IntraModules{

	public function GetModules($type){

		$data = Yii::app()->db->createCommand("SELECT
				*
			FROM
				module
			WHERE
				module_type_id = $type
			AND `status` = 1
			ORDER BY
				id")->queryAll();

		$modules = array();

		foreach ($data as $value) {

			$id = $value['id'];

			$submodules['submodules'] = $this->GetSubmodules($id);

			$modules[] = $value + $submodules;
		}		

		$send = array('modules'=>$modules);

		return $send;
	}

	public function GetSubmodules($id){

		$data = Yii::app()->db->createCommand("SELECT
				*
			FROM
				module_sub
			WHERE
				module_id = $id
			ORDER BY
				`name` ASC")->queryAll();

		$submodules = array();

		foreach ($data as $value) {

			$idSub = $value['id'];

			$info['data'] = $this->GetData($idSub);

			$submodules[] = $value + $info;
		}		

		$send = $submodules;

		return $send;
	}

	public function GetData($id){

		$data = Yii::app()->db->createCommand("SELECT
				*
			FROM
				module_data
			WHERE
				module_sub_id = $id
			AND `status` = 1
			ORDER BY
				date_update DESC,
				date_register DESC")->queryAll();

		$info = array();

		foreach ($data as $value) {

			$idInfo = $value['id'];

			$file['uploads'] = $this->GetDataFiles($idInfo);

			$info[] = $value + $file;
		}		

		$send = $info;

		return $send;
	}

	public function GetDataFiles($id){

		$data = Yii::app()->db->createCommand("SELECT
				*
			FROM
				module_data_files
			WHERE
				module_data_id = $id
			AND `status` = 1
			ORDER BY
				date_register DESC")->queryAll();

		$files = array();

		foreach ($data as $value) {

			$files[] = $value;
		}		

		$send = $files;

		return $send;
	}

	public function GetModulesForm($type){

		$data = Yii::app()->db->createCommand("SELECT
				*
			FROM
				module
			WHERE
				module_type_id = $type
			ORDER BY
				id")->queryAll();

		$modules = array();

		foreach ($data as $value) {

			$id = $value['id'];

			$submodules['submodules'] = $this->GetSubmodulesForm($id);

			$modules[] = $value + $submodules;
		}	

		$data2 = Yii::app()->db->createCommand("SELECT
				area
			FROM
				employee
			GROUP BY
				area
			ORDER BY
				area ASC")->queryAll();

		$personals = array();

		foreach ($data2 as $value2) {

			$area = $value2['area'];

			$employee['employees'] = $this->GetEmployeeForm($area);

			$personals[] = $value2 + $employee;
		}	




		$send = array('modules'=>$modules, 'personals'=>$personals );

		return $send;
	}

	public function GetSubmodulesForm($id){

		$data = Yii::app()->db->createCommand("SELECT
				*
			FROM
				module_sub
			WHERE
				module_id = $id
			AND status = 1
			ORDER BY
				id")->queryAll();

		$submodules = array();

		foreach ($data as $value) {

			$idSub = $value['id'];

			$info['data'] = $this->GetDataForm($idSub);

			$submodules[] = $value + $info;
		}		

		$send = $submodules;

		return $send;
	}

	public function GetDataForm($id){

		$data = Yii::app()->db->createCommand("SELECT
				*
			FROM
				module_data
			WHERE
				module_sub_id = $id
			AND `status` = 1
			ORDER BY
				date_update DESC,
				date_register DESC")->queryAll();

		$info = array();

		foreach ($data as $value) {

			$info[] = $value;
		}		

		$send = $info;

		return $send;
	}

	public function GetEmployeeForm($area){

		$data = Yii::app()->db->createCommand("SELECT
				*
			FROM
				employee
			WHERE 
				area = '$area'
			ORDER BY
				`name` ASC")->queryAll();

		$info = array();

		foreach ($data as $value) {

			$info[] = $value;
		}		

		$send = $info;

		return $send;
	}
}
?>