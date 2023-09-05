<?php
class ApiEmployee{
	public function Users(){

        try {

            $post = Yii::app()->dbldap->createCommand("SELECT COD_EMPLEADO AS ITEM, USUARIO, STS FROM CUENTAS ORDER BY TO_NUMBER(COD_EMPLEADO) ASC")->queryAll();

            if(!empty($post)){

                $updates = 0;

                $news = 0; 

                $count = 0;           

                foreach($post as $event){

                    $fecha = date('Y-m-d H:i:s');

                    $item = $event['ITEM'];

                    $usuario = strtolower($event['USUARIO']);

                    $sts = $event['STS'];

                    if($sts == 'VIG'){
                        $estado = 1;
                    }else{
                        $estado = 0;
                    }

                    $validate = User::model()->findByAttributes(array('username'=>$usuario));

                    if(empty($validate)){

                        $token = md5($usuario.$item.$estado);

                        $register = new User;

                        $register->username = $usuario;

                        $register->code = $token;

                        $register->item = $item;

                        $register->date_register = $fecha;

                        $register->status = $estado ;

                        $register->user_type_id = 1;

                        $register->save();

                        $news = $news + 1;

                        $id = $register->id;

                    }else{
                        $token = md5($usuario.$item.$estado);

                        $validate->code = $token;
                        
                        $validate->item = $item;

                        $validate->date_update = $fecha;

                        $validate->status = $estado;

                        $validate->user_type_id = 1;

                        $validate->save();

                        $updates = $updates + 1;

                        $id = $validate->id;
                    }

                    $check = GroupUser::model()->findByAttributes(array('user_id'=>$id,'group_id'=>1));

                    if(empty($check)){

                        $group = new GroupUser;

                        $group->user_id = $id;

                        $group->group_id = 1;

                        $group->date_register = $fecha;

                        $group->manager = 0;

                        $group->status = 1;

                        $group->save();

                    }else{
                        $check->status = 1;
                        
                        $check->save();
                    }

                    $count = $count + 1;

                }

                $detalle = array('count'=>$count,'register'=>$news,'updates'=>$updates);

                $send = array('error'=>0,'message'=>'Ok','data'=>$detalle);

            }else{
            	$send = array('error'=>'-4000','message'=>'Consulta Vacia');
            }
        }catch(Exception $ex) {

            $error =  $ex->getMessage();

            $send = array('error'=>'-8000','message'=>$error);

        }
        return $send;
    }

    public function Employees(){

        $starttime = microtime(true);

        $in_userid = Yii::app()->params['rrhhuser'];

        $conn = oci_connect(Yii::app()->params['dbrrhhuser'], Yii::app()->params['dbrrhhpass'], Yii::app()->params['dbrrhhconnect'], 'AL32UTF8') or die;

        $sql = 'BEGIN NAP.CC_KARDEXEMPLEADO.get_all_empleados(:in_userid, :out_Empleados, :out_NuError, :out_DeError); END;';

        $stmt = oci_parse($conn,$sql);   

        //  Bind the input parameter
        oci_bind_by_name($stmt,':in_userid',$p1,500);

        // Bind the output parameter
        oci_bind_by_name($stmt,':out_NuError',$e1,500);

        //Bind the output parameter
        oci_bind_by_name($stmt,':out_DeError', $e2,1000);

        // Assign a value to the input 
        
        $p1 = $in_userid;

        //But BEFORE statement, Create your cursor
        $cursor = oci_new_cursor($conn);

        // On your code add the latest parameter to bind the cursor resource to the Oracle argument
        oci_bind_by_name($stmt,":out_Empleados", $cursor,-1,OCI_B_CURSOR);

        oci_execute($stmt, OCI_NO_AUTO_COMMIT);
        // and now, execute the cursor
        oci_execute($cursor);

        if($e1 == 0){

            $numsuccess = 0;

            $numerror = 0;

            $count = 0;
        
            while ($data = oci_fetch_assoc($cursor)) {

                $url = Yii::app()->params['hostUrl'];

                $item = $data['OUT_ITEM'];
                $name = $data['OUT_NOMBRE'];
                $area = $data['OUT_AREA'];
                $company = $data['OUT_EMPRESA'];

                $photo = $data['OUT_FOTO'];          
                
                if($photo) {

                    $filename = Yii::getPathOfAlias('application.images'). '/employee/'.$item.".jpg";
                    if($photo->export($filename)) {
                        $fotoExport = true;
                    } else {
                        $fotoExport = false;
                    }
                }else{
                    $image = file_get_contents(Yii::getPathOfAlias('application.images'). '/employee/user.png');
                    $filename = Yii::getPathOfAlias('application.images'). '/employee/'.$item.".jpg";
                    $dbResult = file_put_contents($filename,$image);
                    $fotoExport = true;
                }

                $picture = $item.'.jpg';

                $photo = $picture;

                $register = $this->RegisterEmployee($item,$name,$area,$company,$photo);

                if($register['error'] == 0){
                    $numsuccess = $numsuccess + 1;
                }else{
                    $numerror = $numerror + 1;
                }

                $count = $count + 1;

            }

            $endtime = microtime(true);

            $time = $endtime - $starttime;

            $detail = array('count'=>$count,'success'=>$numsuccess,'failed'=>$numerror,'time'=>$time);

            $send = array('error'=>0,'message'=>'Ok','date'=>$detail);

        }else{
            $send = array('error'=>$e1,'message'=>$e2);
        }

        oci_close($conn);

        return $send;
    }

    public function RegisterEmployee($item,$name,$area,$company, $photo){

        $fecha = date('Y-m-d H:i:s');

        $find = Employee::model()->findByAttributes(array('item'=>$item));

        if(empty($find)){
            $employee = new Employee;

            $employee->date_register = $fecha;

            $employee->name = $name;

            $employee->item = $item;

            $employee->company = $company;

            $employee->area = $area;

            $employee->photo = $photo;

            $employee->status = 1;

            if($employee->save()){

                $id = $employee->id;

                $personal = $this->InfoPersonal($id, $item);

                $public = $this->InfoPublic($id, $item);

                $send = array('error'=>0);

            }else{
                $send = array('error'=>1);
            }
        }else{
            
            $find->name = $name;

            $find->date_update = date('Y-m-d H:i:s');

            $find->item = $item;

            $find->company = $company;

            $find->area = $area;

            $find->photo = $photo;

            if($find->save()){

                $id = $find->id;

                $personal = $this->InfoPersonal($id, $item);

                $public = $this->InfoPublic($id, $item);

                $send = array('error'=>0);

            }else{
                $send = array('error'=>1);
            }
        }       

        return $send;

    }

    public function InfoPersonal($id, $in_Item){

        $fecha = date('Y-m-d H:i:s');

        $in_userid = Yii::app()->params['rrhhuser'];
        
        $conn = oci_connect(Yii::app()->params['dbrrhhuser'], Yii::app()->params['dbrrhhpass'], Yii::app()->params['dbrrhhconnect'], 'AL32UTF8') or die;

        $sqlTime = "ALTER SESSION SET NLS_DATE_FORMAT = 'YYYY-MM-DD HH24:MI:SS'";

        $stmtTime = oci_parse($conn,$sqlTime);

        oci_execute($stmtTime);

        $sql = 'BEGIN NAP.CC_KARDEXEMPLEADO.get_inf_personal(:in_userid, :in_Item, :out_Nacionalidad, :out_ECivil, :out_Genero, :out_FNacimiento, :out_TDocumento, :out_NDocumento, :out_EmisionDocumento, :out_FVDocumento, :out_UrlDocumento, :out_NPasaporte, :out_FVPasaporte, :out_UrlPasaporte, :out_NLicencia, :out_FVLicencia, :out_UrlLicencia, :out_Direccion, :out_TFijo, :out_TCelular, :out_EmailPersonal, :out_NuError, :out_DeError); END;';

        $stmt = oci_parse($conn,$sql);   

        //  Bind the input parameter
        oci_bind_by_name($stmt,':in_userid',$p1,500);

        //  Bind the input parameter
        oci_bind_by_name($stmt,':in_Item',$p2,500);

        // Bind the output parameter
        oci_bind_by_name($stmt,':out_Nacionalidad',$o1,500);
        
        // Bind the output parameter
        oci_bind_by_name($stmt,':out_ECivil',$o2,500);
        
        // Bind the output parameter
        oci_bind_by_name($stmt,':out_Genero',$o3,500);
        
        // Bind the output parameter
        oci_bind_by_name($stmt,':out_FNacimiento',$o4,500);
        
        // Bind the output parameter
        oci_bind_by_name($stmt,':out_TDocumento',$o5,500);
        
        // Bind the output parameter
        oci_bind_by_name($stmt,':out_NDocumento',$o6,500);
        
        // Bind the output parameter
        oci_bind_by_name($stmt,':out_EmisionDocumento',$o7,500);
        
        // Bind the output parameter
        oci_bind_by_name($stmt,':out_FVDocumento',$o8,500);
        
        // Bind the output parameter
        oci_bind_by_name($stmt,':out_UrlDocumento',$o9,500);
        
        // Bind the output parameter
        oci_bind_by_name($stmt,':out_NPasaporte',$o10,500);
        
        // Bind the output parameter
        oci_bind_by_name($stmt,':out_FVPasaporte',$o11,500);
        
        // Bind the output parameter
        oci_bind_by_name($stmt,':out_UrlPasaporte',$o12,500);
        
        // Bind the output parameter
        oci_bind_by_name($stmt,':out_NLicencia',$o13,500);
        
        // Bind the output parameter
        oci_bind_by_name($stmt,':out_FVLicencia',$o14,500);
        
        // Bind the output parameter
        oci_bind_by_name($stmt,':out_UrlLicencia',$o15,500);
        
        // Bind the output parameter
        oci_bind_by_name($stmt,':out_Direccion',$o16,500);
        
        // Bind the output parameter
        oci_bind_by_name($stmt,':out_TFijo',$o17,500);
        
        // Bind the output parameter
        oci_bind_by_name($stmt,':out_TCelular',$o18,500);
        
        // Bind the output parameter
        oci_bind_by_name($stmt,':out_EmailPersonal',$o19,500);
            
        // Bind the output parameter
        oci_bind_by_name($stmt,':out_NuError',$e1,500);

        //Bind the output parameter
        oci_bind_by_name($stmt,':out_DeError', $e2,1000);

        // Assign a value to the input 
        
        $p1 = $in_userid;

        $p2 = $in_Item;

        oci_execute($stmt, OCI_NO_AUTO_COMMIT);

        $error = $e1;
        
        if($error == 0){

            $find = EmployeePersonal::model()->findByAttributes(array('employee_id'=>$id));

            if(empty($find)){

                $employee = new EmployeePersonal;

                $employee->employee_id = $id;

                $employee->date_register = $fecha;

                $employee->item = $in_Item;

                $employee->nationality = $o1;

                $employee->civil_status = $o2;

                $employee->gender = $o3;

                $employee->birthdate = $o4;

                $employee->document = $o6;

                $employee->document_type = $o5;

                $employee->document_emi = $o7;

                $employee->document_photo = $o8;

                $employee->document_url = $o9;

                $employee->passport = $o10;

                $employee->passport_photo = $o11;

                $employee->passport_url = $o12;

                $employee->driver_license = $o13;

                $employee->driver_license_photo = $o14;

                $employee->driver_license_url = $o15;

                $employee->address = $o16;

                $employee->phone = $o17;

                $employee->cellphone = $o18;

                $employee->email = $o19;

                $employee->status = 1;

                $employee->save();

            }else{

                $find->nationality = $o1;

                $find->civil_status = $o2;

                $find->gender = $o3;

                $find->birthdate = $o4;

                $find->document = $o6;

                $find->document_type = $o5;

                $find->document_emi = $o7;

                $find->document_photo = $o8;

                $find->document_url = $o9;

                $find->passport = $o10;

                $find->passport_photo = $o11;

                $find->passport_url = $o12;

                $find->driver_license = $o13;

                $find->driver_license_photo = $o14;

                $find->driver_license_url = $o15;

                $find->address = $o16;

                $find->phone = $o17;

                $find->cellphone = $o18;

                $find->email = $o19;

                $find->save();
            }

            $send = array('error'=>0,'errorDetail'=>$e2);

        }else{
            $send = array('error'=>$error,'errorDetail'=>$e2);
            
        } 

        oci_close($conn);
        return $send;
    }


    public function InfoPublic($id, $in_Item){

        $fecha = date('Y-m-d H:i:s');

        $in_userid = Yii::app()->params['rrhhuser'];
        
        $conn = oci_connect(Yii::app()->params['dbrrhhuser'], Yii::app()->params['dbrrhhpass'], Yii::app()->params['dbrrhhconnect'], 'AL32UTF8') or die;

        $sqlTime = "ALTER SESSION SET NLS_DATE_FORMAT = 'YYYY-MM-DD HH24:MI:SS'";

        $stmtTime = oci_parse($conn,$sqlTime);

        oci_execute($stmtTime);

        $sql = 'BEGIN NAP.CC_KARDEXEMPLEADO.get_inf_publica(:in_userid, :in_Item, :out_Email, :out_TDir, :out_TInt, :out_TCorp, :out_edificio, :out_piso, :out_Area, :out_Cargo, :out_NuError, :out_DeError); END;';

        $stmt = oci_parse($conn,$sql);   

        //  Bind the input parameter
        oci_bind_by_name($stmt,':in_userid',$p1,500);

        //  Bind the input parameter
        oci_bind_by_name($stmt,':in_Item',$p2,500);

        // Bind the output parameter
        oci_bind_by_name($stmt,':out_Email',$o1,500);
        
        // Bind the output parameter
        oci_bind_by_name($stmt,':out_TDir',$o2,500);
        
        // Bind the output parameter
        oci_bind_by_name($stmt,':out_TInt',$o3,500);
        
        // Bind the output parameter
        oci_bind_by_name($stmt,':out_TCorp',$o4,500);
        
        // Bind the output parameter
        oci_bind_by_name($stmt,':out_edificio',$m1,500);
        
        // Bind the output parameter
        oci_bind_by_name($stmt,':out_piso',$m2,500);
        
        // Bind the output parameter
        oci_bind_by_name($stmt,':out_Area',$o5,500);
        
        // Bind the output parameter
        oci_bind_by_name($stmt,':out_Cargo',$o6,500);
            
        // Bind the output parameter
        oci_bind_by_name($stmt,':out_NuError',$e1,500);

        //Bind the output parameter
        oci_bind_by_name($stmt,':out_DeError', $e2,1000);
        // Assign a value to the input 
        
        $p1 = $in_userid;

        $p2 = $in_Item;

        oci_execute($stmt, OCI_NO_AUTO_COMMIT);

        $error = $e1;
        
        if($error == 0){

            $find = EmployeePublic::model()->findByAttributes(array('employee_id'=>$id));

            if(empty($find)){

                $employee = new EmployeePublic;

                $employee->employee_id = $id;

                $employee->date_register = $fecha;

                $employee->item = $in_Item;

                $employee->email = $o1;

                $employee->phone_direct = $o2;

                $employee->phone_corp = $o4;

                $employee->phone_int = $o3;

                $employee->charge = $o6;

                $employee->area = $o5;

                $employee->building = $m1;

                $employee->building_flat = $m2;

                $employee->status = 1;

                $employee->save();
            }else{

                $find->item = $in_Item;

                $find->email = $o1;

                $find->phone_direct = $o2;

                $find->phone_corp = $o4;

                $find->phone_int = $o3;

                $find->charge = $o6;

                $find->area = $o5;

                $find->building = $m1;

                $find->building_flat = $m2;

                $find->save();

            }

            $send = array('error'=>0,'errorDetail'=>$e2);

        }else{
            $send = array('error'=>$error,'errorDetail'=>$e2);
            
        } 

        oci_close($conn);

        return $send;
    }


    public function EmployeesSchedule(){


        $employee = Employee::model()->findAll();

        $cantidad = 0;

        foreach ($employee as $value) {

            $in_Item = $value->item;

            $in_userid = Yii::app()->params['rrhhuser']; 
        
            $conn = oci_connect(Yii::app()->params['dbrrhhuser'], Yii::app()->params['dbrrhhpass'], Yii::app()->params['dbrrhhconnect'], 'AL32UTF8') or die;

            $sql = 'BEGIN NAP.CC_UTILITIES_ASISTENCIA.get_horario_vacacion_actual(:in_userid, :in_Item, :out_Horario, :out_Licencia, :out_NuError, :out_DeError); END;';

            $stmt = oci_parse($conn,$sql);   

            //  Bind the input parameter
            oci_bind_by_name($stmt,':in_userid',$p1,500);

            //  Bind the input parameter
            oci_bind_by_name($stmt,':in_Item',$p2,500);
            
            // Bind the output parameter
            oci_bind_by_name($stmt,':out_Horario',$o1,500);
            
            // Bind the output parameter
            oci_bind_by_name($stmt,':out_Licencia',$o2,500);
                
            // Bind the output parameter
            oci_bind_by_name($stmt,':out_NuError',$e1,500);

            //Bind the output parameter
            oci_bind_by_name($stmt,':out_DeError', $e2,1000);

            // Assign a value to the input 
            
            $p1 = $in_userid;

            $p2 = $in_Item;

            oci_execute($stmt, OCI_NO_AUTO_COMMIT);

            if($e1 == 0){

                if($o1 == null){
                    $schedule = 0;
                }else{
                    $schedule = $o1;
                }
                
                $license = $o2;

                if($o2 == 0){
                    $estado = 'SIN PERMISO';
                }else{
                    $estado = 'CON PERMISO';
                }

            }else{

                $schedule = 0;

                $license = 0;

                $estado = 'SIN PERMISO';
            }

            $check = EmployeeSchedule::model()->findByAttributes(array('employee_id'=>$value->id));

            if(empty($check)){

                $register = new EmployeeSchedule;

                $register->employee_id = $value->id;

                $register->schedule = $schedule;

                $register->code_license = $license;

                $register->license = $estado;

                $register->date_register = date('Y-m-d H:i:s');

                $register->error = $e1;

                $register->error_message = $e2;

                $register->status = 1;

                $register->save();

            }else{

                $check->date_register = date('Y-m-d H:i:s');

                $check->schedule = $schedule;

                $check->code_license = $license;

                $check->license = $estado;

                $check->error = $e1;

                $check->error_message = $e2;

                $check->save();
            }

            $cantidad = $cantidad + 1;

            oci_close($conn);
        }                

        $send = array('error'=>0,'message'=>'Ok','count'=>$cantidad);

        return $send;
    }

    public function RegisterSchedule(){

        $inUser = Yii::app()->params['rrhhuser'];

        $cantidad = 0;

        $post = Yii::app()->db->createCommand("SELECT
            `schedule`
        FROM
            employee_schedule
        WHERE
            `status` = 1
        GROUP BY
            `schedule`")->queryAll();

        foreach ($post as $value) {

            $turno = $value['schedule'];
        
            $conn = oci_connect(Yii::app()->params['dbrrhhuser'], Yii::app()->params['dbrrhhpass'], Yii::app()->params['dbrrhhconnect'], 'AL32UTF8') or die;

            $sql = 'BEGIN NAP.CC_KARDEXEMPLEADO.get_horario(:in_userid, :in_cod_turno, :out_horario, :out_NuError, :out_DeError); END;';

            $stmt = oci_parse($conn,$sql);   

            //  Bind the input parameter
            oci_bind_by_name($stmt,':in_userid',$p1,500);

            //  Bind the input parameter
            oci_bind_by_name($stmt,':in_cod_turno',$p2,500);

            // Bind the output parameter
            oci_bind_by_name($stmt,':out_NuError',$e1,500);

            //Bind the output parameter
            oci_bind_by_name($stmt,':out_DeError', $e2,1000);

            // Assign a value to the input 
            
            $p1 = $inUser;

            $p2 = $turno;

            //But BEFORE statement, Create your cursor
            $cursor = oci_new_cursor($conn);

            // On your code add the latest parameter to bind the cursor resource to the Oracle argument
            oci_bind_by_name($stmt,":out_horario", $cursor,-1,OCI_B_CURSOR);

            oci_execute($stmt);
            // and now, execute the cursor
            oci_execute($cursor);

            $detalle = array();

            if($e1 == 0){

                $check = Schedules::model()->findByAttributes(array('schedule'=>$turno));

                if(empty($check)){

                    while ($data = oci_fetch_assoc($cursor)) {

                        $register = new Schedules;

                        $register->schedule = $turno;

                        $register->entry = $data['OUT_ENTRADA'];

                        $register->output = $data['OUT_SALIDA'];

                        $register->date_register = date('Y-m-d H:i:s');

                        $register->status = 1;

                        $register->save();

                    }

                }
            }
            
            $cantidad = $cantidad + 1;

        }

        $send = array('error'=>0,'message'=>'Ok','count'=>$cantidad);

        
        return json_encode($send); 
    }

    public function EmployeesInactive()
    {
        $in_userid = Yii::app()->params['rrhhuser']; 
        
        $conn = oci_connect(Yii::app()->params['dbrrhhuser'], Yii::app()->params['dbrrhhpass'], Yii::app()->params['dbrrhhconnect'], 'AL32UTF8') or die;

        $cursor = oci_new_cursor($conn);

        $sql = "BEGIN NAP.CC_KARDEXEMPLEADO.GET_EMPLEADOS_BAJA(:in_usuario,:empleados,:NuError,:DeError); END;";

        $stmt = oci_parse($conn, $sql);

        oci_bind_by_name($stmt, ":in_usuario", $in_userid, -1, SQLT_CHR);

        oci_bind_by_name($stmt, ":empleados", $cursor, -1, OCI_B_CURSOR);

        oci_bind_by_name($stmt, ":NuError", $result['NuError'], 10000, OCI_B_INT);

        oci_bind_by_name($stmt, ":DeError", $result['DeError'], 10000, SQLT_CHR);

        oci_execute($stmt);

        oci_execute($cursor);

        oci_close($conn);
        
        $detalle = array();


        $cantidad = 0;

        if($result['NuError'] == 0){
            while ($data = oci_fetch_assoc($cursor)) {

                $item['item'] = $data["OUT_ITEM"];

                $nombre['nombre'] = $data["OUT_NOMBRE"];

                //$detalle[] = $item + $nombre;

                $find = Employee::model()->findByAttributes(array('item'=>$item, 'status'=>1));

                if(!empty($find)){
                    $find->status = 0;

                    $find->save();

                    $cantidad = $cantidad + 1;
                }
            }

            $send = array('error'=>0,'message'=>'Ok','count'=>count($detalle),'inactive'=>$cantidad);

        }else{
            $send = array('error'=>1,'message'=>$result['DeError']);
        }

        
        return $send;
    }

    public function EmployeesSupervisor()
    {
        $in_userid = Yii::app()->params['rrhhuser']; 
        
        $conn = oci_connect(Yii::app()->params['dbrrhhuser'], Yii::app()->params['dbrrhhpass'], Yii::app()->params['dbrrhhconnect'], 'AL32UTF8') or die;

        $cursor = oci_new_cursor($conn);

        $sql = 'BEGIN NAP.CC_KARDEXEMPLEADO.GET_FIRMAS(:in_usuario,:cursor,:NuError,:DeError); END;';

        $stmt = oci_parse($conn, $sql);

        oci_bind_by_name($stmt, ":in_usuario", $in_userid, -1, SQLT_CHR);

        oci_bind_by_name($stmt, ":cursor", $cursor, -1, OCI_B_CURSOR);

        oci_bind_by_name($stmt, ":NuError", $result['NuError'], 10000, OCI_B_INT);

        oci_bind_by_name($stmt, ":DeError", $result['DeError'], 10000, SQLT_CHR);

        oci_execute($stmt);

        oci_execute($cursor);

        oci_close($conn);
        
        $detalle = array();

        if($result['NuError'] == 0){
            while ($data = oci_fetch_assoc($cursor)) {


                $detalle[] = $data;

                $nombre = $data["OUT_NOMBRE"];

                $item = $data["OUT_ITEM"];

                $cargo =  $data["OUT_CARGO"];
                
                $find = Supervisor::model()->findByAttributes(array('item'=>$item));

                $area = Employee::model()->findByAttributes(array('item'=>$item));

                if(!empty($area)){
                    $unidad = $area->area;
                }else{
                    $unidad = 'DESCONOCIDO';
                }

                if(!empty($find)){

                    $find->name = $nombre;

                    $find->area = $unidad;

                    $find->charge = $cargo;

                    $find->date_register = date('Y-m-d H:i:s');

                    $find->status = 1;

                    $find->save();
                }else{

                    $new = new Supervisor;

                    $new->name = $nombre;

                    $new->item = $item;

                    $new->area = $unidad;

                    $find->charge = $cargo;

                    $new->date_register = date('Y-m-d H:i:s');

                    $new->status = 1;

                    $new->save();

                }
            }

            $send = array('error'=>0,'message'=>'Ok','count'=>count($detalle));

        }else{
            $send = array('error'=>1,'message'=>$result['DeError']);
        }

        
        return $send;
    }

}
?>