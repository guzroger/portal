<?php
class IntraMedical{

	public function InfoMedical($item){

		$data = Yii::app()->dbMedical->createCommand("SELECT
				pat.`name`,
				pat.item,
				DATEDIFF(CURRENT_DATE, STR_TO_DATE(his.birthday, '%Y-%m-%d'))/365 as age,
				his.birthday,
				NULL AS phone,
				NULL AS sick
			FROM
				patient pat,
				history his
			WHERE
				pat.id = his.patient_id
			AND pat.patient_status_id = 1
			AND pat.parent_id = 0
			AND pat.`status` = 1
			AND pat.titular = 1
			AND pat.item = $item")->queryRow();

		if($data != null){
			$dependents['dependents'] = $this->InfoMedicalDeps($item);

			$document['document'] = $this->InfoDocument($item);

			$send = $data + $document + $dependents;	
		}else{

			$data = Yii::app()->db->createCommand("SELECT
				emp.`name`,
				emp.item,
				DATEDIFF(CURRENT_DATE, STR_TO_DATE(per.birthdate, '%Y-%m-%d'))/365 as age,
				per.birthdate AS birthday,
				NULL AS phone,
				NULL AS sick
			FROM
				employee emp,
				employee_personal per
			WHERE
				emp.id = per.employee_id
			AND emp.`status` = 1
			AND emp.item = $item")->queryRow();

			$dependents['dependents'] = $this->InfoMedicalDeps($item);

			$document['document'] = $this->InfoDocument($item);

			$send = $data + $document + $dependents;	
		}		
		
		return $send;
	}

	public function InfoMedicalDeps($item){

		$data = Yii::app()->dbMedical->createCommand("SELECT
				pat.`name`,
				pat.id AS patient_id,
				pat.item,
				DATEDIFF(CURRENT_DATE, STR_TO_DATE(his.birthday, '%Y-%m-%d'))/365 as age,
				his.birthday,
				NULL AS phone,
				NULL AS document,
				NULL AS sick,
				0 AS verificate
			FROM
				patient pat,
				history his
			WHERE
				pat.id = his.patient_id
			AND pat.patient_status_id = 1
			AND pat.`status` = 1
			AND pat.titular = 0
			AND pat.item = $item
			ORDER BY 
				`name` ASC")->queryAll();

		$send = $data;

		return $send;
	}

	public function InfoDocument($item){
		$data = Yii::app()->db->createCommand("SELECT
				per.document
			FROM
				employee emp,
				employee_personal per
			WHERE
				emp.id = per.employee_id
			AND emp.`status` = 1
			AND emp.item = $item")->queryRow();

		$send = $data['document'];

		return $send;
	}

	public function InfoMedicalCovid($item){

		$data = Yii::app()->dbMedical->createCommand("SELECT
				`name`,
				item,
				age,
				document,
				birthday,
				phone,
				sick
			FROM
				covid
			WHERE
				`status` = 1
			AND is_titular = 1
			AND item = $item")->queryRow();

		if($data != null){

			$verificate= $this->InfoMedicalDepsCovid($item);

			if(!empty($verificate)){

				$dependents['dependents'] = $this->InfoMedicalDepsCovid($item);
			}else{
				$dependents['dependents'] = $this->InfoMedicalDeps($item);
			}

			$send = $data + $dependents;

		}else{
			$send = array();
		}

		return $send;
	}

	public function InfoMedicalDepsCovid($item){

		$data = Yii::app()->dbMedical->createCommand("(SELECT
					`name`,
					patient_id,
					item,
					age,
					document,
					birthday,
					phone,
					sick,
					1 AS verificate
				FROM
					covid 
				WHERE
					`status` = 1
				AND is_titular = 0
				AND item = $item
				ORDER BY 
					`name` ASC)
				UNION
				(SELECT
					pat.`name`,
					pat.id AS patient_id,
					pat.item,
					DATEDIFF(CURRENT_DATE, STR_TO_DATE(his.birthday, '%Y-%m-%d'))/365 as age,
					NULL AS document,
					his.birthday,
					NULL AS phone,
					NULL AS sick,
					0 AS verificate
				FROM
					patient pat,
					history his
				WHERE
					pat.id = his.patient_id
				AND pat.patient_status_id = 1
				AND pat.`status` = 1
				AND pat.titular = 0
				AND pat.id NOT IN (SELECT patient_id
				FROM
					covid 
				WHERE
					`status` = 1
				AND is_titular = 0
				AND item = $item)
				AND pat.item = $item
				ORDER BY 
					`name` ASC)")->queryAll();

		$send = $data;

		return $send;
	}

	public function SicksCovid(){

		$data = Yii::app()->dbMedical->createCommand("SELECT
				*
			FROM
				covid_status
			WHERE
				`status` = 1
			ORDER BY 
				priority ASC")->queryAll();

		$send = $data;

		return $send;
	}

	public function RegisterCovid($result){

		$name = $result['reg_name'];

		$item = $result['reg_item'];

		$document = $result['reg_doc'];

		$birth = $result['reg_birth'];

		$age = $result['reg_age'];

		$phone = $result['reg_phone'];

		$sick = $result['reg_enf'];

		$check = Covid::model()->findByAttributes(array('status'=>1,'item'=>$item,'is_titular'=>1));

		if(!empty($check)){
			$check->date_update = date('Y-m-d H:i:s');

			$check->item = $item;

			$check->is_titular = 1;

			$check->name = $name;

			$check->document = $document;

			$check->birthday = $birth;

			$check->age = $age;

			$check->phone = $phone;

			$check->sick = $sick;

			$check->status = 1;

			$check->save();

			if(isset($result['dependentsId'])){

				foreach ($result['dependentsId'] as $value) {

					$named = $result['dep_name'.$value];

					$documentd = $result['dep_doc'.$value];

					$birthd = $result['dep_birth'.$value];

					$aged = $result['dep_age'.$value];

					$phoned = $result['dep_phone'.$value];

					$sickd = $result['dep_sick'.$value];

					$check2 = Covid::model()->findByAttributes(array('status'=>1,'patient_id'=>$value,'is_titular'=>0));

					if(!empty($check2)){
						$check2->date_update = date('Y-m-d H:i:s');

						$check2->item = $item;

						$check2->patient_id = $value;

						$check2->is_titular = 0;

						$check2->name = $named;

						$check2->document = $documentd;

						$check2->birthday = $birthd;

						$check2->age = $aged;

						$check2->phone = $phoned;

						$check2->sick = $sickd;

						$check2->status = 1;

						$check2->save();
					}else{
						$register2 = new Covid;

						$register2->date_register = date('Y-m-d H:i:s');

						$register2->item = $item;

						$register2->patient_id = $value;

						$register2->is_titular = 0;

						$register2->name = $named;

						$register2->document = $documentd;

						$register2->birthday = $birthd;

						$register2->age = $aged;

						$register2->phone = $phoned;

						$register2->sick = $sickd;

						$register2->status = 1;

						$register2->save();
					}
				}				
			}

			$send = array('status'=>0,'message'=>'Datos Actualizados Exitosamente');

		}else{

			$register = new Covid;

			$register->date_register = date('Y-m-d H:i:s');

			$register->item = $item;

			$register->is_titular = 1;

			$register->name = $name;

			$register->document = $document;

			$register->birthday = $birth;

			$register->age = $age;

			$register->phone = $phone;

			$register->sick = $sick;

			$register->status = 1;

			$register->save();

			if(isset($result['dependentsId'])){

				foreach ($result['dependentsId'] as $value) {

					$named = $result['dep_name'.$value];

					$documentd = $result['dep_doc'.$value];

					$birthd = $result['dep_birth'.$value];

					$aged = $result['dep_age'.$value];

					$phoned = $result['dep_phone'.$value];

					$sickd = $result['dep_sick'.$value];

					$check2 = Covid::model()->findByAttributes(array('status'=>1,'patient_id'=>$value,'is_titular'=>0));

					if(!empty($check2)){
						$check2->date_update = date('Y-m-d H:i:s');

						$check2->item = $item;

						$check2->patient_id = $value;

						$check2->is_titular = 0;

						$check2->name = $named;

						$check2->document = $documentd;

						$check2->birthday = $birthd;

						$check2->age = $aged;

						$check2->phone = $phoned;

						$check2->sick = $sickd;

						$check2->status = 1;

						$check2->save();
					}else{
						$register2 = new Covid;

						$register2->date_register = date('Y-m-d H:i:s');

						$register2->item = $item;

						$register2->patient_id = $value;

						$register2->is_titular = 0;

						$register2->name = $named;

						$register2->document = $documentd;

						$register2->birthday = $birthd;

						$register2->age = $aged;

						$register2->phone = $phoned;

						$register2->sick = $sickd;

						$register2->status = 1;

						$register2->save();
					}
				}				
			}

			$send = array('status'=>0,'message'=>'Datos Registrado Exitosamente');
		}



		return $send;
	}
}
?>