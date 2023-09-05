<?php
class ApiLog{
	public function LogRegister($data){

		$url = Yii::app()->request->hostInfo.Yii::app()->request->url;

		$userid = 1;

		$username = 'ecuevas';

		$date_log = date('Y-m-d');

		$date_register = date('Y-m-d H:i:s');

		$param_in = $data['param_in'];

		$param_out = $data['param_out'];

		$time = $data['timediff'];

		if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
		    $ip = $_SERVER['HTTP_CLIENT_IP'];
		} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
		    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
		} else {
		    $ip = $_SERVER['REMOTE_ADDR'];
		}

		$model = new LogRegister;

		$model->user_id = $userid;

		$model->username = $username;

		$model->date_log = $date_log;

		$model->date_register = $date_register;

		$model->url = $url;

		$model->param_in = json_encode($param_in);

		$model->param_out = json_encode($param_out);

		$model->time_execute = $time;

		$model->ip_address = $ip;

		$model->save();

	}
}
?>