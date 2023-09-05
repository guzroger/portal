<?php
class IntraProfile{
	public function GetInfo($usuario){

		$user_id = Yii::app()->user->um->getFieldValue($usuario,'identificator');	

		$data = Yii::app()->db->createCommand("SELECT
				emp.id,
				emp.`name`,
				emp.item,
				emp.area,
				emp.photo,
				us.photo AS photoUp,
				emp_pu.email,
				emp_pu.phone_direct,
				emp_pu.phone_corp,
				emp_pu.phone_int,
				emp_pu.charge,
				emp_pu.building,
				emp_pu.building_flat
			FROM
				`user` us,
				employee emp,
				employee_public emp_pu
			WHERE
				us.item = emp.item
			AND emp.id = emp_pu.employee_id
			AND us.id = $user_id")->queryRow();

		$groups['groups'] = $this->UserGroups($user_id);

		$send = $data + $groups;
		
		return $send;
	}


    public function GetTributario($usuario){

        $user_id = Yii::app()->user->um->getFieldValue($usuario,'identificator');   

        $item = Yii::app()->user->um->getFieldValue($usuario,'item');   

        $data = Yii::app()->dbsirhu->createCommand("SELECT
                *
            FROM
                ERPCTCO.SALDO_RCIVA
            WHERE
                ITEM = '$item'
            ORDER BY PERIODO DESC")->queryRow();

        if($data != null){
            $send = $data;
        }else{
            $send = array();
        }
        
        return $send;
    }

	public function UserGroups($userId){
		$groups = Yii::app()->db->createCommand("SELECT
				gr.*,
				gr_us.manager as manager,
				 (
					SELECT
						COUNT(grcon.group_id)
					FROM
						group_user grcon
					WHERE
						grcon.group_id = gr.id
					GROUP BY
						grcon.group_id
				) AS quantity	
			FROM
				`group` gr,
				group_user gr_us
			WHERE
				gr.id = gr_us.group_id
			AND gr_us.user_id = $userId
			AND gr_us.status = 1
			ORDER BY
				gr.id ASC")->queryAll();

		$send = $groups;
		
		return $send;
	}
	public function GetInfoPersonal($usuario, $fchini, $fchfin){

		$user_id = Yii::app()->user->um->getFieldValue($usuario,'identificator');	

		$item = Yii::app()->user->um->getFieldValue($usuario,'item');	

		$data = Yii::app()->db->createCommand("SELECT
				emp_per.*
			FROM
				`user` us,
				employee emp,
				employee_personal emp_per
			WHERE
				us.item = emp.item
			AND emp.id = emp_per.employee_id
			AND us.id = $user_id")->queryRow();

		$groups['groups'] = $this->UserGroups($user_id);

		$marks['marks'] = $this->GetMarkEmployee($item, $fchini, $fchfin);

		$send = $data + $groups + $marks;
		
		return $send;
	}


    public function GetMarkEmployee($item, $fchini, $fchfin){

        $inUser = Yii::app()->params['rrhhuser'];
        
        $conn = oci_connect(Yii::app()->params['dbrrhhuser'], Yii::app()->params['dbrrhhpass'], Yii::app()->params['dbrrhhconnect'], 'AL32UTF8') or die;

        $sql2 = "ALTER SESSION SET NLS_DATE_FORMAT = 'YYYY-MM-DD HH24:MI:SS'";

        $stmt1 = oci_parse($conn,$sql2);

        oci_execute($stmt1);

        $sql = "BEGIN NAP.CC_KARDEXEMPLEADO.get_marcas_reloj(:in_userid, :in_item, :in_fecha_ini, :in_fecha_fin, :out_marcas_reloj, :out_NuError, :out_DeError); END;";

        $stmt = oci_parse($conn,$sql);   

        //  Bind the input parameter
        oci_bind_by_name($stmt,':in_userid',$p1,500);

        //  Bind the input parameter
        oci_bind_by_name($stmt,':in_item',$p2,500);

        //  Bind the input parameter
        oci_bind_by_name($stmt,':in_fecha_ini',$p3,500);

        //  Bind the input parameter
        oci_bind_by_name($stmt,':in_fecha_fin',$p4,500);

        // Bind the output parameter
        oci_bind_by_name($stmt,':out_NuError',$e1,500);

        //Bind the output parameter
        oci_bind_by_name($stmt,':out_DeError', $e2,1000);

        // Assign a value to the input 
        
        $p1 = $inUser;

        $p2 = $item;

        $p3 = $fchini;

        $p4 = $fchfin;

        //But BEFORE statement, Create your cursor
        $cursor = oci_new_cursor($conn);

        // On your code add the latest parameter to bind the cursor resource to the Oracle argument
        oci_bind_by_name($stmt,":out_marcas_reloj", $cursor,-1,OCI_B_CURSOR);

        oci_execute($stmt);
        // and now, execute the cursor
        oci_execute($cursor);

        $error = $e1;
        
        if($error == 0){

	        $detalle = array();

	        while ($data = oci_fetch_assoc($cursor)) {

	        	$fechaReg['fecha_reg'] = date('Y-m-d',strtotime($data['OUT_FECHA_HORA']));

            	$hora['hora_marca'] = $data['OUT_FECHA_HORA'];

            	$turno['turn'] = $data['OUT_TURNO'];

	            $detalle[] = $fechaReg + $hora + $turno;
	        }

	        $result = array();

	        foreach($detalle as $val) {
            
	            $key = 'fecha_reg';

	            if(array_key_exists($key, $val)){
	                $result[$val[$key]][] = $val;
	                //$fechareg['fchreg'] = $val[$key];
	                //$result['registro'][] = $fechareg + $val;
	            }else{
	                $result[""][] = $val;
	            }
	        }

            $send = $result;
        }else{
            $send = array();
        } 

        return $send;
    }
    /**
	MODULO LICENSES
    */
	public function GetVacations($usuario){

		$user_id = Yii::app()->user->um->getFieldValue($usuario,'identificator');	

		$item = Yii::app()->user->um->getFieldValue($usuario,'item');

        $post = Yii::app()->dbqflow->createCommand("SELECT
            VC.cod_gestion Gestion,
            VC.nro_dias_ley DiasVacacion,
            (
                VC.nro_dias_ley - VC.nro_dias_saldo
            ) DiasCuenta,
            VC.nro_dias_saldo SaldoDias,
            (
                SELECT
                    SUM (V.nro_dias_saldo)
                FROM
                    nap.VAC_CTA_CORRIENTE_VACACION V
                WHERE
                    V.cod_empleado = $item
                AND V.nro_dias_saldo > 0
                AND VC.cod_gestion >= V.cod_gestion
            ) SaldoTotal
        FROM
            nap.VAC_CTA_CORRIENTE_VACACION VC
        WHERE
            VC.cod_empleado = $item
        AND VC.nro_dias_saldo > 0
        ORDER BY
            VC.cod_gestion")->queryAll();

        $send = array('vacations'=>$post);

        return $send;
    }
    public function GetLicenseEmployee($usuario, $fchini, $fchfin){

		$item = Yii::app()->user->um->getFieldValue($usuario,'item');

        $inUser = Yii::app()->params['rrhhuser'];
        
        $conn = oci_connect(Yii::app()->params['dbrrhhuser'], Yii::app()->params['dbrrhhpass'], Yii::app()->params['dbrrhhconnect'], 'AL32UTF8') or die;

        $sql2 = "ALTER SESSION SET NLS_DATE_FORMAT = 'YYYY-MM-DD HH24:MI:SS'";

        $stmt1 = oci_parse($conn,$sql2);

        oci_execute($stmt1);

        $sql = "BEGIN NAP.CC_KARDEXEMPLEADO.get_solicitudes(:in_userid, :in_item, :in_fecha_ini, :in_fecha_fin, :out_solicitudes, :out_NuError, :out_DeError); END;";

        $stmt = oci_parse($conn,$sql);   

        //  Bind the input parameter
        oci_bind_by_name($stmt,':in_userid',$p1,500);

        //  Bind the input parameter
        oci_bind_by_name($stmt,':in_item',$p2,500);

        //  Bind the input parameter
        oci_bind_by_name($stmt,':in_fecha_ini',$p3,500);

        //  Bind the input parameter
        oci_bind_by_name($stmt,':in_fecha_fin',$p4,500);

        // Bind the output parameter
        oci_bind_by_name($stmt,':out_NuError',$e1,500);

        //Bind the output parameter
        oci_bind_by_name($stmt,':out_DeError', $e2,1000);

        // Assign a value to the input z
        
        $p1 = $inUser;

        $p2 = $item;

        $p3 = $fchini;

        $p4 = $fchfin;

        //But BEFORE statement, Create your cursor
        $cursor = oci_new_cursor($conn);

        // On your code add the latest parameter to bind the cursor resource to the Oracle argument
        oci_bind_by_name($stmt,":out_solicitudes", $cursor,-1,OCI_B_CURSOR);

        oci_execute($stmt);
        // and now, execute the cursor
        oci_execute($cursor);

        

        $error = $e1;
        
        if($error == 0){
            $detalle = array();
        
	        while ($data = oci_fetch_assoc($cursor)) {
	            
	            $detalle[] = $data;
	        }

            $send = array('licenses'=>$detalle);
        }else{
            $send = array('licenses'=>array());
        } 

        return $send;
    }

    public function GetLicensesPending($usuario){

        $user_id = Yii::app()->user->um->getFieldValue($usuario,'identificator');   

        $find = User::model()->findByPk($user_id);

        $username = strtolower($find->username);

        $conn = oci_connect(Yii::app()->params['dbqflowuser'], Yii::app()->params['dbqflowpass'], Yii::app()->params['dbqflowconnect'], 'AL32UTF8') or die;

        /*$sql = "SELECT SM2.LOGINNAME,
            F.FLOWCORRELATIVEID NFLOW, F.NAME SOLICITUD, SM2.NAME INICIADO_POR, F.STARTDATE FCH_INICIO_REGSOL, F.FLAG TRAMITE_CON,
            SM.NAME REPONSABLE_TAREA, 
            FS.TIMESTARTED FCH_ASIGN_TAREA,
            SUBSTR(TRAM.VALUE.EXTRACT('/Vs/V/text()').getStringVal(),10,8) TRAMITE,
            SUBSTR(TDIAS.VALUE.EXTRACT('/Vs/V/text()').getStringVal(),10,INSTR(TDIAS.VALUE.EXTRACT('/Vs/V/text()').getStringVal(),']]>')-10) DIAS,
            SUBSTR(THRS.VALUE.EXTRACT('/Vs/V/text()').getStringVal(),10,INSTR(THRS.VALUE.EXTRACT('/Vs/V/text()').getStringVal(),']]>')-10) HORAS,
            SUBSTR(TMINS.VALUE.EXTRACT('/Vs/V/text()').getStringVal(),10,INSTR(TMINS.VALUE.EXTRACT('/Vs/V/text()').getStringVal(),']]>')-10) MINUTOS,
            TO_CHAR(TO_DATE(SUBSTR(TFCHINI.VALUE.EXTRACT('/Vs/V/text()').getStringVal(),10,INSTR(TFCHINI.VALUE.EXTRACT('/Vs/V/text()').getStringVal(),'Z]]>')-10), 'YYYY-MM-DD'), 'DD/MM/YYYY') FECHA_INI,
            SUBSTR(THRSINI.VALUE.EXTRACT('/Vs/V/text()').getStringVal(),10,INSTR(THRSINI.VALUE.EXTRACT('/Vs/V/text()').getStringVal(),'Z]]>')-13) HORAS_INI,
            TO_CHAR(TO_DATE(SUBSTR(TFCHFIN.VALUE.EXTRACT('/Vs/V/text()').getStringVal(),10,INSTR(TFCHFIN.VALUE.EXTRACT('/Vs/V/text()').getStringVal(),'Z]]>')-10), 'YYYY-MM-DD'), 'DD/MM/YYYY') FECHA_FIN,
            SUBSTR(THRSFIN.VALUE.EXTRACT('/Vs/V/text()').getStringVal(),10,INSTR(THRSFIN.VALUE.EXTRACT('/Vs/V/text()').getStringVal(),'Z]]>')-13) HORAS_FIN,
            TO_CHAR(TO_DATE(SUBSTR(TFCHRET.VALUE.EXTRACT('/Vs/V/text()').getStringVal(),10,INSTR(TFCHRET.VALUE.EXTRACT('/Vs/V/text()').getStringVal(),'Z]]>')-10), 'YYYY-MM-DD'), 'DD/MM/YYYY') FECHA_RET,
            SUBSTR(THRSRET.VALUE.EXTRACT('/Vs/V/text()').getStringVal(),10,INSTR(THRSRET.VALUE.EXTRACT('/Vs/V/text()').getStringVal(),'Z]]>')-13) HORAS_RET,
            SUBSTR(TOBS.VALUE.EXTRACT('/Vs/V/text()').getStringVal(),10,INSTR(TOBS.VALUE.EXTRACT('/Vs/V/text()').getStringVal(),']]>')-10) OBSERVACIONES
            FROM FLOW F, FLOWSTEP FS, FLOWSTEPTO FST, SECURITYMEMBER SM, SECURITYMEMBER SM2, 
            (SELECT FLOWDATA.FLOWID, FLOWDATA.TEMPLATEDATAID, FLOWDATA.VALUE 
            FROM FLOWDATA WHERE FLOWDATA.TEMPLATEDATAID = '1e41aa43-3cb8-4ee1-a695-b0e3b9155061') TRAM,
            (SELECT FLOWDATA.FLOWID, FLOWDATA.TEMPLATEDATAID, FLOWDATA.VALUE 
            FROM FLOWDATA WHERE FLOWDATA.TEMPLATEDATAID = 'e8ecf70a-b567-4560-b2f6-0abc2385a0d9') TDIAS,
            (SELECT FLOWDATA.FLOWID, FLOWDATA.TEMPLATEDATAID, FLOWDATA.VALUE 
            FROM FLOWDATA WHERE FLOWDATA.TEMPLATEDATAID = '9dc39e92-1a45-4122-aa59-d2eafa422c1e') THRS,
            (SELECT FLOWDATA.FLOWID, FLOWDATA.TEMPLATEDATAID, FLOWDATA.VALUE 
            FROM FLOWDATA WHERE FLOWDATA.TEMPLATEDATAID = '79f075ba-80b3-49dc-adc3-810f5699d225') TMINS,
            (SELECT FLOWDATA.FLOWID, FLOWDATA.TEMPLATEDATAID, FLOWDATA.VALUE 
            FROM FLOWDATA WHERE FLOWDATA.TEMPLATEDATAID = '3e864ab9-378d-42f3-ae25-f1a40d6e0688') TFCHINI,
            (SELECT FLOWDATA.FLOWID, FLOWDATA.TEMPLATEDATAID, FLOWDATA.VALUE 
            FROM FLOWDATA WHERE FLOWDATA.TEMPLATEDATAID = '227b8632-d189-41e9-8277-0ef43c79d361') THRSINI,
            (SELECT FLOWDATA.FLOWID, FLOWDATA.TEMPLATEDATAID, FLOWDATA.VALUE 
            FROM FLOWDATA WHERE FLOWDATA.TEMPLATEDATAID = 'f2aaec4f-e6dc-4746-839a-a9d141e23ca0') TFCHFIN,
            (SELECT FLOWDATA.FLOWID, FLOWDATA.TEMPLATEDATAID, FLOWDATA.VALUE 
            FROM FLOWDATA WHERE FLOWDATA.TEMPLATEDATAID = '9190f54a-d5f7-459d-b59e-8ab84a47e552') THRSFIN,
            (SELECT FLOWDATA.FLOWID, FLOWDATA.TEMPLATEDATAID, FLOWDATA.VALUE 
            FROM FLOWDATA WHERE FLOWDATA.TEMPLATEDATAID = '85ef70b4-7aa4-4a6e-99ef-b4011949f28a') TFCHRET,
            (SELECT FLOWDATA.FLOWID, FLOWDATA.TEMPLATEDATAID, FLOWDATA.VALUE 
            FROM FLOWDATA WHERE FLOWDATA.TEMPLATEDATAID = 'e72d28c9-93b5-442d-b1f3-44677697e2ae') THRSRET,
            (SELECT FLOWDATA.FLOWID, FLOWDATA.TEMPLATEDATAID, FLOWDATA.VALUE 
            FROM FLOWDATA WHERE FLOWDATA.TEMPLATEDATAID = '368c81a2-4f60-4076-9b6b-c02372ba7b2e') TOBS 
            WHERE F.FLOWID = FS.FLOWID
            AND FS.FLOWID = FST.FLOWID 
            AND FST.MEMBERID = SM.MEMBERID
            AND FS.FLOWSTEPID = FST.FLOWSTEPID
            AND F.STARTERUSER = SM2.MEMBERID
            AND F.FLOWID = TRAM.FLOWID
            AND TRAM.FLOWID = TDIAS.FLOWID
            AND TDIAS.FLOWID = THRS.FLOWID
            AND THRS.FLOWID = TMINS.FLOWID
            AND TMINS.FLOWID = TFCHINI.FLOWID
            AND TFCHINI.FLOWID = THRSINI.FLOWID
            AND THRSINI.FLOWID = TFCHFIN.FLOWID
            AND TFCHFIN.FLOWID = THRSFIN.FLOWID
            AND THRSFIN.FLOWID = TFCHRET.FLOWID
            AND TFCHRET.FLOWID = THRSRET.FLOWID
            AND THRSRET.FLOWID = TOBS.FLOWID
            AND F.TEMPLATEID = '9ffc3041-22f8-4e64-bff8-3c4941afba2a' 
            AND F.VERSIONID = 'da1f97f8-d358-4d4d-83e3-2489949da703'
            AND F.FLOWSTATUS = 0
            AND FS.STEPSTATUS <> 9
            AND SM2.LOGINNAME = '$username'
            ORDER BY F.FLOWCORRELATIVEID DESC";*/

        $sql = "SELECT SM2.LOGINNAME,
            F.FLOWCORRELATIVEID NFLOW, F.NAME SOLICITUD, SM2.NAME INICIADO_POR, F.STARTDATE FCH_INICIO_REGSOL, F.FLAG TRAMITE_CON,
            (CASE WHEN SM.NAME = 'qflow' THEN 'RR.HH.' WHEN SM.NAME = 'Eduarda Elizabeth Lora Alejo' THEN 'RR.HH.' ELSE SM.NAME END) REPONSABLE_TAREA,
            FS.TIMESTARTED FCH_ASIGN_TAREA,
            SUBSTR(TRAM.VALUE.EXTRACT('/Vs/V/text()').getStringVal(),10,8) TRAMITE,
            SUBSTR(TDIAS.VALUE.EXTRACT('/Vs/V/text()').getStringVal(),10,INSTR(TDIAS.VALUE.EXTRACT('/Vs/V/text()').getStringVal(),']]>')-10) DIAS,
            SUBSTR(THRS.VALUE.EXTRACT('/Vs/V/text()').getStringVal(),10,INSTR(THRS.VALUE.EXTRACT('/Vs/V/text()').getStringVal(),']]>')-10) HORAS,
            SUBSTR(TMINS.VALUE.EXTRACT('/Vs/V/text()').getStringVal(),10,INSTR(TMINS.VALUE.EXTRACT('/Vs/V/text()').getStringVal(),']]>')-10) MINUTOS,
            TO_CHAR(TO_DATE(SUBSTR(TFCHINI.VALUE.EXTRACT('/Vs/V/text()').getStringVal(),10,INSTR(TFCHINI.VALUE.EXTRACT('/Vs/V/text()').getStringVal(),'Z]]>')-10), 'YYYY-MM-DD'), 'DD/MM/YYYY') FECHA_INI,
            SUBSTR(THRSINI.VALUE.EXTRACT('/Vs/V/text()').getStringVal(),10,INSTR(THRSINI.VALUE.EXTRACT('/Vs/V/text()').getStringVal(),'Z]]>')-13) HORAS_INI,
            TO_CHAR(TO_DATE(SUBSTR(TFCHFIN.VALUE.EXTRACT('/Vs/V/text()').getStringVal(),10,INSTR(TFCHFIN.VALUE.EXTRACT('/Vs/V/text()').getStringVal(),'Z]]>')-10), 'YYYY-MM-DD'), 'DD/MM/YYYY') FECHA_FIN,
            SUBSTR(THRSFIN.VALUE.EXTRACT('/Vs/V/text()').getStringVal(),10,INSTR(THRSFIN.VALUE.EXTRACT('/Vs/V/text()').getStringVal(),'Z]]>')-13) HORAS_FIN,
            TO_CHAR(TO_DATE(SUBSTR(TFCHRET.VALUE.EXTRACT('/Vs/V/text()').getStringVal(),10,INSTR(TFCHRET.VALUE.EXTRACT('/Vs/V/text()').getStringVal(),'Z]]>')-10), 'YYYY-MM-DD'), 'DD/MM/YYYY') FECHA_RET,
            SUBSTR(THRSRET.VALUE.EXTRACT('/Vs/V/text()').getStringVal(),10,INSTR(THRSRET.VALUE.EXTRACT('/Vs/V/text()').getStringVal(),'Z]]>')-13) HORAS_RET,
            SUBSTR(TOBS.VALUE.EXTRACT('/Vs/V/text()').getStringVal(),10,INSTR(TOBS.VALUE.EXTRACT('/Vs/V/text()').getStringVal(),']]>')-10) OBSERVACIONES
            FROM FLOW F, FLOWSTEP FS, FLOWSTEPTO FST, SECURITYMEMBER SM, SECURITYMEMBER SM2,
            (SELECT FLOWDATA.FLOWID, FLOWDATA.TEMPLATEDATAID, FLOWDATA.VALUE FROM FLOWDATA WHERE FLOWDATA.TEMPLATEDATAID = '1e41aa43-3cb8-4ee1-a695-b0e3b9155061') TRAM,
            (SELECT FLOWDATA.FLOWID, FLOWDATA.TEMPLATEDATAID, FLOWDATA.VALUE FROM FLOWDATA WHERE FLOWDATA.TEMPLATEDATAID = 'e8ecf70a-b567-4560-b2f6-0abc2385a0d9') TDIAS,
            (SELECT FLOWDATA.FLOWID, FLOWDATA.TEMPLATEDATAID, FLOWDATA.VALUE FROM FLOWDATA WHERE FLOWDATA.TEMPLATEDATAID = '9dc39e92-1a45-4122-aa59-d2eafa422c1e') THRS,
            (SELECT FLOWDATA.FLOWID, FLOWDATA.TEMPLATEDATAID, FLOWDATA.VALUE FROM FLOWDATA WHERE FLOWDATA.TEMPLATEDATAID = '79f075ba-80b3-49dc-adc3-810f5699d225') TMINS,
            (SELECT FLOWDATA.FLOWID, FLOWDATA.TEMPLATEDATAID, FLOWDATA.VALUE FROM FLOWDATA WHERE FLOWDATA.TEMPLATEDATAID = '3e864ab9-378d-42f3-ae25-f1a40d6e0688') TFCHINI,
            (SELECT FLOWDATA.FLOWID, FLOWDATA.TEMPLATEDATAID, FLOWDATA.VALUE FROM FLOWDATA WHERE FLOWDATA.TEMPLATEDATAID = '227b8632-d189-41e9-8277-0ef43c79d361') THRSINI,
            (SELECT FLOWDATA.FLOWID, FLOWDATA.TEMPLATEDATAID, FLOWDATA.VALUE FROM FLOWDATA WHERE FLOWDATA.TEMPLATEDATAID = 'f2aaec4f-e6dc-4746-839a-a9d141e23ca0') TFCHFIN,
            (SELECT FLOWDATA.FLOWID, FLOWDATA.TEMPLATEDATAID, FLOWDATA.VALUE FROM FLOWDATA WHERE FLOWDATA.TEMPLATEDATAID = '9190f54a-d5f7-459d-b59e-8ab84a47e552') THRSFIN,
            (SELECT FLOWDATA.FLOWID, FLOWDATA.TEMPLATEDATAID, FLOWDATA.VALUE FROM FLOWDATA WHERE FLOWDATA.TEMPLATEDATAID = '85ef70b4-7aa4-4a6e-99ef-b4011949f28a') TFCHRET,
            (SELECT FLOWDATA.FLOWID, FLOWDATA.TEMPLATEDATAID, FLOWDATA.VALUE FROM FLOWDATA WHERE FLOWDATA.TEMPLATEDATAID = 'e72d28c9-93b5-442d-b1f3-44677697e2ae') THRSRET,
            (SELECT FLOWDATA.FLOWID, FLOWDATA.TEMPLATEDATAID, FLOWDATA.VALUE FROM FLOWDATA WHERE FLOWDATA.TEMPLATEDATAID = '368c81a2-4f60-4076-9b6b-c02372ba7b2e') TOBS
            WHERE F.FLOWID = FS.FLOWID
            AND FS.FLOWID = FST.FLOWID
            AND FST.MEMBERID = SM.MEMBERID
            AND FS.FLOWSTEPID = FST.FLOWSTEPID
            AND F.STARTERUSER = SM2.MEMBERID
            AND F.FLOWID = TRAM.FLOWID
            AND TRAM.FLOWID = TDIAS.FLOWID
            AND TDIAS.FLOWID = THRS.FLOWID
            AND THRS.FLOWID = TMINS.FLOWID
            AND TMINS.FLOWID = TFCHINI.FLOWID
            AND TFCHINI.FLOWID = THRSINI.FLOWID
            AND THRSINI.FLOWID = TFCHFIN.FLOWID
            AND TFCHFIN.FLOWID = THRSFIN.FLOWID
            AND THRSFIN.FLOWID = TFCHRET.FLOWID
            AND TFCHRET.FLOWID = THRSRET.FLOWID
            AND THRSRET.FLOWID = TOBS.FLOWID
            AND F.TEMPLATEID = '9ffc3041-22f8-4e64-bff8-3c4941afba2a'
            AND F.VERSIONID = 'da1f97f8-d358-4d4d-83e3-2489949da703'
            AND F.FLOWSTATUS = 0
            AND FS.STEPSTATUS <> 9
            -- AND FST.MEMBERID not in ('7071f96d-2d82-4457-9ca1-fab1d88a0efe ','258ab965-7bbc-4722-9c9d-00b3363a9715 ')
            AND FST.MEMBERID not in ('4ac2293c-2464-4b4a-b531-743454357070  ','258ab965-7bbc-4722-9c9d-00b3363a9715  ')
            AND SM2.LOGINNAME = '$username'
            ORDER BY F.FLOWCORRELATIVEID DESC";
                
        $stid = oci_parse($conn, $sql);

        oci_execute($stid);
        
        $detalle = array();

        while ($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)) {
            $detalle[] = $row;
        }
           
        $send = array('pending'=>$detalle);

        return $send;
    }
    /**
    PUBLICACIONES GUARDADAS
    */

    public function GetPublicationsSaves($usuario){

        $user_id = Yii::app()->user->um->getFieldValue($usuario,'identificator');
        
        $data = Yii::app()->db->createCommand("SELECT
            pub.*, 
            emp.`name` AS postby,
            gr.`name` AS groupName
        FROM
            publication_save pub_sav,
            publication pub,
            publication_group pub_gr,
            `group` gr,
            `user` usr,
            employee emp
        WHERE
            pub_sav.publication_id = pub.id
        AND gr.id = pub_gr.group_id
        AND pub.id = pub_gr.publication_id
        AND pub.user_id = usr.id
        AND usr.item = emp.item
        AND pub_sav.user_id = $user_id
        AND pub.`status` = 1
        AND pub_sav.`status` = 1
        ORDER BY
            pub.date_register DESC")->queryAll();

        $send = array('publications'=>$data);

        return $send;
    }

    public function PublicationUnSave($usuario, $id){

        $user_id = Yii::app()->user->um->getFieldValue($usuario,'identificator');
        
        $save = PublicationSave::model()->findByAttributes(array('publication_id'=>$id,'user_id'=>$user_id));

        if(!empty($save)){

            $save->status = 0;

            $save->save();

            $send = array('error'=>0);

        }else{
            $send = array('error'=>1);
        }

        return $send;
    }

}
?>