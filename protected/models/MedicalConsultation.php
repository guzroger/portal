<?php
class MedicalConsultation{

	public function Calendar($id){
		$data = Yii::app()->dbMedical->createCommand("SELECT
				sch.id,
				sch.title,
				sch.`start`,
				sch.`end`,
				sch.date_consultation,
				sch.color,
				sch.patient_item,
				sch.patient_name,
				sch.patient_relation,
				sch.patient_status,
				sch.patient_type,
				sch.`status`,
				sch_sts.`id` as stsConId,
				sch_sts.`name` as stsCon,
				sch_typ.`name` as typeCon
			FROM
				`schedule` sch,
				schedule_status sch_sts,
				schedule_type sch_typ
			WHERE
				sch.schedule_status_id = sch_sts.id
			AND sch.schedule_type_id = sch_typ.id
			AND sch.`status` = 1
			AND sch.personal_calendar_id = $id
			ORDER BY
				sch.id DESC")->queryAll();

		$schedules = array();

		foreach ($data as $value) {

			$schedules[] = $value;
		}		

		$send = $schedules;

		return $send;
	}

	public function FindPatient($search){
		$data = Yii::app()->dbMedical->createCommand("SELECT
				pat.id,
				pat.`name`,
				pat.item,
				pat.employee,
				pat.patient_type,
				pat_sts.`name` as patient_sts
			FROM
				patient pat,
				patient_status pat_sts
			WHERE
				pat.patient_status_id != 4
			AND pat.patient_status_id = pat_sts.id
			AND pat.`name` LIKE '%$search%'
			ORDER BY
				pat.`name` ASC
			LIMIT
				10")->queryAll();

		$patients = array();

		foreach ($data as $value) {

			$id['value'] = $value['id'];

			$name['label'] = $value['name'];

			$item['item'] = $value['item'];

			$relation['relation'] = $value['patient_type'];

			if($value['employee'] == 1){
				$type['type'] = 'FUNCIONARIO/A';
			}else{
				$type['type'] = 'DEPENDIENTE';
			}

			$sts['sts'] = $value['patient_sts'];

			$patients[] = $id + $name + $item + $type + $relation + $sts;
		}		

		$send = $patients;

		return $send;
	}


}
?>