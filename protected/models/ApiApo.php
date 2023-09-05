<?php
class ApiApo{

	public function TeleTrabajo($item){

		$data = Yii::app()->dbapo->createCommand("SELECT
				te.id AS team_id,
				te.`name` AS team_name,
				te.online_url AS team_url,
				emp.`name` AS employee_name,
				emp.item AS employee_item,
				emp.area AS employee_area
			FROM
				team te,
				team_employee tem,
				employee emp
			WHERE
				te.id = tem.team_id
			AND tem.employee_id = emp.id
			AND emp.item = '$item'
			AND te.`status` = 1
			AND emp.`status` = 1
			AND te.online_url IS NOT NULL
			ORDER BY
				te.`name` ASC")->queryAll();

		return $data;
	}

	public function Team($sala){
		$data = Yii::app()->dbapo->createCommand("SELECT
				*
			FROM
				team te
			WHERE
				id = $sala
			AND `status` = 1")->queryRow();

		return $data;
	}

	public function RegisterWork($team,$user,$userid){

		$reg = new WorkOnline;

		$reg->user_id = $userid;

		$reg->item = $user['item'];

		$reg->name = $user['name'];

		$reg->team_id = $team['id'];

		$reg->team_name = $team['name'];

		$reg->team_url = $team['online_url'];

		$reg->date_register = date('Y-m-d H:i:s');

		$reg->date_online = date('Y-m-d H:i:s');

		$reg->status = 1;

		$reg->save();

		$send = array('status'=>0,'message'=>'Registrado');

		return $send;
	}
}
?>