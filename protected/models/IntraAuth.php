<?php 
class IntraAuth{

	public function AuthorizatedLicense($id, $result){

		$auth_obs = $result['obs'];

		$auth_status = $result['sts'];

        $lic_fch_ini = $result['lic_fch_ini'];

        $lic_fch_fin = $result['lic_fch_fin'];

        $lic_fch_ret = $result['lic_fch_ret'];

        $lic_day = $result['lic_day'];

        $lic_hour = $result['lic_hour'];

        $lic_minutes = $result['lic_minutes'];

		$license = License::model()->findByPk($id);

        if($license->type == 'LIC_PERMISO'){
            $obsreg = $auth_obs.' '.$license->observation_sol;
        }else{
            $obsreg = $auth_obs;
        }

        $license->date_start_auth = $lic_fch_ini;

        $license->date_end_auth = $lic_fch_fin;

        $license->date_return_auth = $lic_fch_ret;

        $license->days_auth = $lic_day;

        $license->hours_auth = $lic_hour;

        $license->minutes_auth = $lic_minutes;

        $license->observation_auth = $obsreg;

        $license->date_auth = date('Y-m-d H:i:s');

        $license->status_auth = $auth_status;

        if($license->save()){

            if($auth_status == 1){

                $update = License::model()->findByPk($id);

                if($update->type == 'PORTAL_TI_PROG'){

                    $estado = 'APROBADO';

                    $model = $this->ProcedureLicenseProg($id, $estado);

                    if($model['error'] == 0){

                        $send = array('error'=>0,'message'=>'OK');

                    }else{
                        $update->observation_auth = null;

                        $update->date_auth = null;

                        $update->status_auth = 0;

                        $update->save();

                        $send = array('error'=>1,'message'=>$model['message']);

                    }
                }else{
                    $model = $this->ProcedureLicense($id);

                    if($model['error'] == 0){

                        $update->code = $model['sol'];

                        $update->save();

                        $send = array('error'=>0,'message'=>'OK');

                    }else{
                        $update->observation_auth = null;

                        $update->date_auth = null;

                        $update->status_auth = 0;

                        $update->save();

                        $send = array('error'=>1,'message'=>$model['message']);

                    }                    
                }
                
            }else{

                $update = License::model()->findByPk($id);

                if($update->type == 'PORTAL_TI_PROG'){

                    $estado = 'RECHAZADO';

                    $model = $this->ProcedureLicenseProg($id, $estado);
                }

                $send = array('error'=>0,'message'=>'OK');
            }        	
        }else{
        	$send = array('error'=>1,'message'=>'PARAMETROS INCORRECTOS');
        }

        return $send;
	}

    public function ProcedureLicense($id){

        $license = License::model()->findByPk($id);

        $supervisor = Supervisor::model()->findByPk($license->supervisor_id); 

        //$in_userid = Yii::app()->params['rrhhuser'];

        //$conn = oci_connect(Yii::app()->params['dbrrhhuser'], Yii::app()->params['dbrrhhpass'], Yii::app()->params['dbrrhhconnect'], 'AL32UTF8') or die;

        $do_commit = 1;

        $do_trans = null;

        $pi_cod_tipo_solicitud = $license->type;

        $pi_cod_empleado = $license->item;

        $pi_nro_dias = $license->days;

        $pi_nro_horas = $license->hours;

        $pi_nro_minutos = $license->minutes;

        $pi_fch_desde = $license->date_start;

        $pi_fch_hasta = $license->date_end;

        $pi_fch_retorno = $license->date_return;

        $pi_obs_solicitud = $license->observation_sol;

        $pi_nro_dias_autoriz = $license->days_auth;

        $pi_nro_hrs_autoriz = $license->hours_auth;

        $pi_nro_minutos_autoriz = $license->minutes_auth;

        $pi_fch_desde_autoriz = $license->date_start_auth;

        $pi_fch_hasta_autoriz = $license->date_end_auth;

        $pi_fch_retorno_autoriz = $license->date_return_auth;

        $pi_jefe_autoriz = $supervisor->item;

        $pi_obs_autoriz = $license->observation_auth;

        $pi_fch_tran = $license->date_auth;

        $in_userid = Yii::app()->params['phrrhhuser'];

        $conn = oci_connect(Yii::app()->params['phdbrrhhuser'], Yii::app()->params['phdbrrhhpass'], Yii::app()->params['phdbrrhhconnect'], 'AL32UTF8') or die;

        $sql2 = "ALTER SESSION SET NLS_DATE_FORMAT = 'YYYY-MM-DD HH24:MI:SS'";

        $stmt1 = oci_parse($conn,$sql2);

        oci_execute($stmt1);

        $sql = "BEGIN NAP.CC_SOLICITUD.CREAR(:pi_usuario, :pi_do_commit, :pi_cod_tipo_solicitud, :pi_cod_empleado, :pi_nro_dias, :pi_nro_horas, :pi_nro_minutos, :pi_fch_desde, :pi_fch_hasta, :pi_fch_retorno, :pi_obs_solicitud, :pi_nro_dias_autoriz, :pi_nro_hrs_autoriz, :pi_nro_minutos_autoriz, :pi_fch_desde_autoriz, :pi_fch_hasta_autoriz, :pi_fch_retorno_autoriz, :pi_jefe_autoriz, :pi_obs_autoriz, :pi_id_tran, :pi_fch_tran,:po_id_solicitud ,:out_NuError,:out_DeError); END;";

        $stmt = oci_parse($conn, $sql);

        oci_bind_by_name($stmt, ":pi_usuario",$in_userid,32767,SQLT_CHR);

        oci_bind_by_name($stmt, ":pi_do_commit",$do_commit,32767,SQLT_CHR);

        oci_bind_by_name($stmt, ":pi_cod_tipo_solicitud",$pi_cod_tipo_solicitud,32767,SQLT_CHR);

        oci_bind_by_name($stmt, ":pi_cod_empleado",$pi_cod_empleado,32767,SQLT_CHR);

        oci_bind_by_name($stmt, ":pi_nro_dias",$pi_nro_dias,32767,SQLT_CHR);

        oci_bind_by_name($stmt, ":pi_nro_horas",$pi_nro_horas,32767,SQLT_CHR);

        oci_bind_by_name($stmt, ":pi_nro_minutos",$pi_nro_minutos,32767,SQLT_CHR);

        oci_bind_by_name($stmt, ":pi_fch_desde",$pi_fch_desde,32767,SQLT_CHR);

        oci_bind_by_name($stmt, ":pi_fch_hasta",$pi_fch_hasta,32767,SQLT_CHR);

        oci_bind_by_name($stmt, ":pi_fch_retorno",$pi_fch_retorno,32767,SQLT_CHR);

        oci_bind_by_name($stmt, ":pi_obs_solicitud",$pi_obs_solicitud,32767,SQLT_CHR);

        oci_bind_by_name($stmt, ":pi_nro_dias_autoriz",$pi_nro_dias_autoriz,32767,SQLT_CHR);

        oci_bind_by_name($stmt, ":pi_nro_hrs_autoriz",$pi_nro_hrs_autoriz,32767,SQLT_CHR);

        oci_bind_by_name($stmt, ":pi_nro_minutos_autoriz",$pi_nro_minutos_autoriz,32767,SQLT_CHR);

        oci_bind_by_name($stmt, ":pi_fch_desde_autoriz",$pi_fch_desde_autoriz,32767,SQLT_CHR);

        oci_bind_by_name($stmt, ":pi_fch_hasta_autoriz",$pi_fch_hasta_autoriz,32767,SQLT_CHR);

        oci_bind_by_name($stmt, ":pi_fch_retorno_autoriz",$pi_fch_retorno_autoriz,32767,SQLT_CHR);

        oci_bind_by_name($stmt, ":pi_jefe_autoriz",$pi_jefe_autoriz,32767,SQLT_CHR);

        oci_bind_by_name($stmt, ":pi_obs_autoriz",$pi_obs_autoriz,32767,SQLT_CHR);

        oci_bind_by_name($stmt, ":pi_id_tran",$do_trans,32767,SQLT_CHR);

        oci_bind_by_name($stmt, ":pi_fch_tran",$pi_fch_tran,32767,SQLT_CHR);

        oci_bind_by_name($stmt, ":po_id_solicitud",$o1,32767,SQLT_CHR);

        oci_bind_by_name($stmt, ":out_NuError",$e1,32767,SQLT_CHR);

        oci_bind_by_name($stmt, ":out_DeError",$e2,32767,SQLT_CHR);

        oci_execute($stmt);

        if($e1 == 0){
            $send = array('error'=>0,'message'=>'OK','sol'=>$o1);
        }else{
            $send = array('error'=>1,'message'=>$e2);
        }

        return $send;
    }


    public function ProcedureLicenseProg($id, $estado){

        $license = License::model()->findByPk($id);

        $supervisor = Supervisor::model()->findByPk($license->supervisor_id); 

        $do_commit = 1;

        $pi_solicitud = $license->code;

        $pi_cod_empleado = $license->item;

        $pi_obs_solicitud = $license->observation_sol;

        $pi_nro_dias_autoriz = $license->days_auth;

        $pi_fch_desde_autoriz = $license->date_start_auth;

        $pi_fch_hasta_autoriz = $license->date_end_auth;

        $pi_fch_retorno_autoriz = $license->date_return_auth;

        $pi_jefe_autoriz = $supervisor->item;

        $pi_obs_autoriz = $license->observation_auth;

        $in_userid = Yii::app()->params['phrrhhuser'];

        $conn = oci_connect(Yii::app()->params['phdbrrhhuser'], Yii::app()->params['phdbrrhhpass'], Yii::app()->params['phdbrrhhconnect'], 'AL32UTF8') or die;

        $sql2 = "ALTER SESSION SET NLS_DATE_FORMAT = 'YYYY-MM-DD HH24:MI:SS'";

        $stmt1 = oci_parse($conn,$sql2);

        oci_execute($stmt1);

        $sql = "BEGIN NAP.CC_SOLICITUD.GESTIONAR_PROG_VACACION(:pi_usuario,:pi_do_commit,:pi_solicitud,:pi_cod_empleado,:pi_nro_dias,:pi_fch_desde,:pi_fch_hasta,:pi_fch_retorno,:pi_estado,:pi_observacion,:pi_jefe_autoriza,:po_cod_err,:po_msj); END;";

        $stmt = oci_parse($conn, $sql);

        oci_bind_by_name($stmt, ":pi_usuario",$in_userid,32767,SQLT_CHR);

        oci_bind_by_name($stmt, ":pi_do_commit",$do_commit,32767,SQLT_CHR);

        oci_bind_by_name($stmt, ":pi_solicitud",$pi_solicitud,32767,SQLT_CHR);

        oci_bind_by_name($stmt, ":pi_cod_empleado",$pi_cod_empleado,32767,SQLT_CHR);

        oci_bind_by_name($stmt, ":pi_nro_dias",$pi_nro_dias_autoriz,32767,SQLT_CHR);

        oci_bind_by_name($stmt, ":pi_fch_desde",$pi_fch_desde_autoriz,32767,SQLT_CHR);

        oci_bind_by_name($stmt, ":pi_fch_hasta",$pi_fch_hasta_autoriz,32767,SQLT_CHR);

        oci_bind_by_name($stmt, ":pi_fch_retorno",$pi_fch_retorno_autoriz,32767,SQLT_CHR);

        oci_bind_by_name($stmt, ":pi_estado",$estado,32767,SQLT_CHR);

        oci_bind_by_name($stmt, ":pi_observacion",$pi_obs_autoriz,32767,SQLT_CHR);

        oci_bind_by_name($stmt, ":pi_jefe_autoriza",$pi_jefe_autoriz,32767,SQLT_CHR);

        oci_bind_by_name($stmt, ":po_cod_err",$e1,32767,SQLT_CHR);

        oci_bind_by_name($stmt, ":po_msj",$e2,32767,SQLT_CHR);

        oci_execute($stmt);

        if($e1 == 0){
            $send = array('error'=>0,'message'=>'OK');
        }else{
            $send = array('error'=>1,'message'=>$e2);
        }

        return $send;
    }

    public function RegisterProgramacion($id){

        $license = License::model()->findByPk($id);

        $supervisor = Supervisor::model()->findByPk($license->supervisor_id); 

        $do_commit = 1;

        $do_trans = null;

        $pi_cod_tipo_solicitud = $license->type;

        $pi_cod_empleado = $license->item;

        $pi_nro_dias = $license->days;

        $pi_fch_desde = $license->date_start;

        $pi_fch_hasta = $license->date_end;

        $pi_fch_retorno = $license->date_return;

        $pi_obs_solicitud = $license->observation_sol;

        $pi_jefe_autoriz = $supervisor->item;

        $in_userid = Yii::app()->params['phrrhhuser'];

        $conn = oci_connect(Yii::app()->params['phdbrrhhuser'], Yii::app()->params['phdbrrhhpass'], Yii::app()->params['phdbrrhhconnect'], 'AL32UTF8') or die;

        $sql2 = "ALTER SESSION SET NLS_DATE_FORMAT = 'YYYY-MM-DD HH24:MI:SS'";

        $stmt1 = oci_parse($conn,$sql2);

        oci_execute($stmt1);

        $sql = "BEGIN NAP.CC_SOLICITUD.REGISTRAR_PROG_VACACION(:pi_usuario, :pi_do_commit, :pi_cod_empleado, :pi_nro_dias, :pi_fch_desde, :pi_fch_hasta, :pi_fch_retorno, :pi_observacion, :pi_jefe_autoriza, :po_id_solicitud, :po_cod_err, :po_msj); END;";

        $stmt = oci_parse($conn, $sql);

        oci_bind_by_name($stmt, ":pi_usuario",$in_userid,32767,SQLT_CHR);

        oci_bind_by_name($stmt, ":pi_do_commit",$do_commit,32767,SQLT_CHR);

        oci_bind_by_name($stmt, ":pi_cod_empleado",$pi_cod_empleado,32767,SQLT_CHR);

        oci_bind_by_name($stmt, ":pi_nro_dias",$pi_nro_dias,32767,SQLT_CHR);

        oci_bind_by_name($stmt, ":pi_fch_desde",$pi_fch_desde,32767,SQLT_CHR);

        oci_bind_by_name($stmt, ":pi_fch_hasta",$pi_fch_hasta,32767,SQLT_CHR);

        oci_bind_by_name($stmt, ":pi_fch_retorno",$pi_fch_retorno,32767,SQLT_CHR);

        oci_bind_by_name($stmt, ":pi_observacion",$pi_obs_solicitud,32767,SQLT_CHR);

        oci_bind_by_name($stmt, ":pi_jefe_autoriza",$pi_jefe_autoriz,32767,SQLT_CHR);

        oci_bind_by_name($stmt, ":po_id_solicitud",$psol,32767,SQLT_CHR);

        oci_bind_by_name($stmt, ":po_cod_err",$e1,32767,SQLT_CHR);

        oci_bind_by_name($stmt, ":po_msj",$e2,32767,SQLT_CHR);

        oci_execute($stmt);

        if($e1 == 0){
            $license->code = $psol;

            $license->save();

            $send = array('error'=>0,'message'=>'OK');
        }else{
            $send = array('error'=>1,'message'=>$e2);
        }

        return $send;

    }

    public function GetVacations($item){

        $post = Yii::app()->dbqflow->createCommand("SELECT
            MIN(V.cod_gestion) AS GI,
            MAX(V.cod_gestion) AS GF,
            ROUND(SUM (V.nro_dias_saldo),2) AS SS
        FROM
            nap.VAC_CTA_CORRIENTE_VACACION V
        WHERE
            V.cod_empleado = $item
        AND V.nro_dias_saldo > 0")->queryAll();

        $send = $post;

        return $send;
    }
}
?>