<?php
class IntraGroup{
	public function GetPersonal(){

		$data = Yii::app()->db->createCommand("SELECT
			emp.id,
			emp.name,
			emp.item,
			emp.area,
			emp.photo,
			emp_pu.email,
			emp_pu.phone_direct,
			emp_pu.phone_corp,
			emp_pu.phone_int,
			emp_pu.charge,
			emp_pu.building,
			emp_pu.building_flat
		FROM
			employee emp,
			employee_public emp_pu
		WHERE
		emp.id = emp_pu.employee_id
		AND emp.status = 1
		ORDER BY
			emp.name ASC")->queryAll();

		$personal = array();

		foreach ($data as $value) {

			$item = $value['item'];

			$id = $value['id'];

			$photoUp['photoUp'] = $this->UserPhoto($item);

			$status['status'] = $this->UserStatus($item);

			$statusNum['statusNum'] = $this->UserStatusNum($item);

			$licenses = $this->EmployeeLicense($id);

			$license['license'] = $licenses['license'];

			$licenseCode['licenseCode'] = $licenses['code'];

			$schedules['schedules'] = $this->EmployeeSchedules($id);

			$personal[] = $value + $photoUp + $status + $statusNum + $license + $licenseCode + $schedules;
		}		

		$send = array('personal'=>$personal);

		return $send;
	}

	public function UserPhoto($item){

		$model = User::model()->findByAttributes(array('item'=>$item,'status'=>1));

		if(!empty($model)){
			$photo = $model->photo;
		}else{
			$photo = null;
		}

		return $photo;

	}

	public function UserStatus($item){

		$model = User::model()->findByAttributes(array('item'=>$item,'status'=>1));

		if(!empty($model)){
			
			$login = $model->username;

			$buscarUsuario = Yii::app()->user->um->loadUserByUsername($login);

            if($buscarUsuario != null){

	            $usuario = Yii::app()->user->um->loadUser($login);

	            $sesion = Yii::app()->user->um->findSession($usuario);

	            if($sesion != null){
	            	$status = 'Conectado';
	            }else{
	            	$status = 'Desconectado';
	            }	
	        }else{
	        	$status = 'No Disponible';
	        }

		}else{
			$status = 'Inactivo';
		}

		return $status;

	}

	public function UserStatusNum($item){

		$model = User::model()->findByAttributes(array('item'=>$item,'status'=>1));

		if(!empty($model)){
			
			$login = $model->username;

			$buscarUsuario = Yii::app()->user->um->loadUserByUsername($login);

            if($buscarUsuario != null){

	            $usuario = Yii::app()->user->um->loadUser($login);

	            $sesion = Yii::app()->user->um->findSession($usuario);

	            if($sesion != null){
	            	$status = 1;
	            }else{
	            	$status = 2;
	            }	
	        }else{
	        	$status = 3;
	        }

		}else{
			$status = 0;
		}

		return $status;

	}

	public function GetMembers($groupId){

		$data = Yii::app()->db->createCommand("SELECT
			emp.id,
			emp.name,
			emp.item,
			emp.area,
			emp.photo,
			us.photo as photoUp,
			emp_pu.email,
			emp_pu.phone_direct,
			emp_pu.phone_corp,
			emp_pu.phone_int,
			emp_pu.charge,
			emp_pu.building,
			emp_pu.building_flat
		FROM
			employee emp,
			employee_public emp_pu,
			`user` us,
			group_user gr
		WHERE
			us.item = emp.item
		AND gr.user_id = us.id
		AND emp.id = emp_pu.employee_id
		AND gr.group_id = $groupId
		AND us.status = 1
		AND gr.status = 1
		AND emp.status = 1
		ORDER BY
			emp.name ASC")->queryAll();

		$members = array();

		foreach ($data as $value) {

			$id = $value['id'];

			$item = $value['item'];

			$licenses = $this->EmployeeLicense($id);

			$license['license'] = $licenses['license'];

			$licenseCode['licenseCode'] = $licenses['code'];

			$schedules['schedules'] = $this->EmployeeSchedules($id);

			$members[] = $value + $license + $licenseCode + $schedules;
		}		

		$send = array('members'=>$members);

		return $send;
	}

	public function EmployeeLicense($id){
		$model = EmployeeSchedule::model()->findByAttributes(array('employee_id'=>$id));

		if(!empty($model)){
			$code['code'] = $model->code_license;
			$license['license'] = $model->license;
		}else{
			$code['code'] = '-1';
			$license['license'] = 'NO DISPONIBLE';
		}
		$send = $code + $license;

		return $send;
	}

	public function EmployeeSchedules($id){
		$model = EmployeeSchedule::model()->findByAttributes(array('employee_id'=>$id));

		if(!empty($model)){
			$code = $model->schedule;

			$data = Yii::app()->db->createCommand("SELECT
					`schedule`,
					turn,
					entry,
					output
				FROM
					schedules
				WHERE
					`schedule` = '$code'
				ORDER BY
					`order` ASC")->queryAll();

				$detail = array();

				foreach ($data as $value) {
					$detail[] = $value;
				}

				$send = $detail;
		}else{
			$send = array();
		}

		return $send;
	}

	public function GetPublications($usuario, $groupId){

		$user_id = Yii::app()->user->um->getFieldValue($usuario,'identificator');

		$data = Yii::app()->db->createCommand("SELECT
				pub.*,
				emp.name as postby,
				gr.name as groupName
			FROM
				publication pub,
				publication_group pub_gr,
				`group` gr,
				`user` usr,
				employee emp
			WHERE
				pub.id = pub_gr.publication_id
			AND pub_gr.group_id = $groupId
			AND gr.id = pub_gr.group_id
			AND pub.status = 1
			AND pub.user_id = usr.id
			AND usr.item = emp.item
			ORDER BY
				pub.priority DESC, pub.date_register DESC
			LIMIT
				10")->queryAll();

		$publications = array();

		foreach ($data as $value) {

			$id = $value['id'];

			$checkSave = PublicationSave::model()->findByAttributes(array('publication_id'=>$id,'user_id'=>$user_id,'status'=>1));

			if(empty($checkSave)){
				$save['saved'] = 0;
			}else{
				$save['saved'] = 1;
			}

			$images['images'] = $this->PublicationImages($id);

			$files['folder'] = $this->PublicationFiles($id);

			$publications[] = $value + $save + $images + $files;
		}

		

		$send = array('publications'=>$publications);

		return $send;
	}

	public function PublicationImages($id){
		$data = Yii::app()->db->createCommand("SELECT
				*
			FROM
				publication_image
			WHERE
				publication_id = $id
			AND status = 1
			ORDER BY
				id ASC")->queryAll();

		if(!empty($data)){
			$send = $data;
		}else{
			$send = array();
		}

		return $send;
	}

	public function PublicationFiles($id){
		$data = Yii::app()->db->createCommand("SELECT
				*
			FROM
				publication_file
			WHERE
				publication_id = $id
			AND status = 1
			ORDER BY
				id ASC")->queryAll();

		if(!empty($data)){
			$send = $data;
		}else{
			$send = array();
		}

		return $send;
		
	}

	
}
?>