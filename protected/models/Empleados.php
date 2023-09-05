<?php
class Empleados {

	public function DonwloadPhotos($in_userid){
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

        oci_execute($stmt);
        // and now, execute the cursor
        oci_execute($cursor);

        $detalle = array();        

        $error = $e1;
        
        if($error == 0){

        	$success = 0;

			$failed = 0;

			$noimage = 0;

        	while ($data = oci_fetch_assoc($cursor)) {
    			
    			$photo = $data['OUT_FOTO'];    			
	        
	        	if($photo) {
					$filename = "./images/empleados/".$data['OUT_ITEM'].".jpg";
					if($photo->export($filename)) {
				        $success = $success + 1;
				    } else {
				        $failed = $failed + 1;
				    }
				}else{
					$image = file_get_contents("./images/empleados/user.png");
					$filename = "./images/empleados/".$data['OUT_ITEM'].".jpg";
					$dbResult = file_put_contents($filename,$image);
					$noimage = $noimage + 1;
				}
			}
            $send = array('error' => 200 , 'errorDetail'=>'Ok', 'info'=>'Fotografias Descargadas', 'Descargadas' => $success, 'NoDescargadas' => $failed,'SinFoto'=>$noimage);
            return $send;
        }else{
            $send = array('error'=>$error,'errorDetail'=>$e2);
            return $send;
        }
	}

	public function GetAllEmpleados($in_userid){
        
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

        oci_execute($stmt);
        // and now, execute the cursor
        oci_execute($cursor);

        $detalle = array();
        
        while ($data = oci_fetch_assoc($cursor)) {

        	$url = Yii::app()->params['hostUrl'];

            //$url = 'http://intranetws/images/empleados/192.168.203.40'

        	$item['item'] = $data['OUT_ITEM'];
        	$name['name'] = $data['OUT_NOMBRE'];
        	$area['area'] = $data['OUT_AREA'];
        	$empresa['company'] = $data['OUT_EMPRESA'];
        	$photo['photo'] = $url.$data['OUT_ITEM'].'.jpg' ;
            $detalle[] = $item + $name + $area + $empresa + $photo;
        }

        $error = $e1;
        
        if($error == 0){
            $send = array('error' => 200 , 'errorDetail'=>'Ok', 'empleados'=>$detalle);
            return $send;
        }else{
            $send = array('error'=>$error,'errorDetail'=>$e2);
            return $send;
        } 
    }

    public function GetEmpleado($in_userid, $in_Item){
        
        $conn = oci_connect(Yii::app()->params['dbrrhhuser'], Yii::app()->params['dbrrhhpass'], Yii::app()->params['dbrrhhconnect'], 'AL32UTF8') or die;

        $sql = 'BEGIN NAP.CC_KARDEXEMPLEADO.get_empleado(:in_userid, :in_Item, :out_Foto, :out_Estado, :out_ApPaterno, :out_ApMaterno, :out_ApAux, :out_ApNombres, :out_NuError, :out_DeError ); END;';

        $stmt = oci_parse($conn,$sql);   

        $o1 = oci_new_descriptor($conn, OCI_D_LOB);

        //  Bind the input parameter
        oci_bind_by_name($stmt,':in_userid',$p1,500);

        //  Bind the input parameter
        oci_bind_by_name($stmt,':in_Item',$p2,500);
        
        // Bind the output parameter
        oci_bind_by_name($stmt,':out_Foto', $o1, -1, OCI_B_BLOB);
        
        // Bind the output parameter
        oci_bind_by_name($stmt,':out_Estado',$o2,500);
        
        // Bind the output parameter
        oci_bind_by_name($stmt,':out_ApPaterno',$o3,500);
        
        // Bind the output parameter
        oci_bind_by_name($stmt,':out_ApMaterno',$o4,500);
        
        // Bind the output parameter
        oci_bind_by_name($stmt,':out_ApAux',$o5,500);
        
        // Bind the output parameter
        oci_bind_by_name($stmt,':out_ApNombres',$o6,500);
            
        // Bind the output parameter
        oci_bind_by_name($stmt,':out_NuError',$e1,500);

        //Bind the output parameter
        oci_bind_by_name($stmt,':out_DeError', $e2,1000);

        // Assign a value to the input 
        
        $p1 = $in_userid;

        $p2 = $in_Item;

        oci_execute($stmt);

        $error = $e1;
        
        if($error == 0){

        	$url = Yii::app()->params['hostUrl'];

        	$photo = $photo['photo'] = $url.$p2.'.jpg' ;

            $send = array('error' => 200 , 'errorDetail'=>'Ok', 'photo' => $photo, 'status' => $o2, 'fatherLastName' => $o3, 'motherLastName' => $o4, 'auxLAstName' => $o5, 'name' => $o6);
            
            return $send;
        }else{
            $send = array('error'=>$error,'errorDetail'=>$e2);
            return $send;
        } 
    }
/*
    public function GetEmpleadoInfoPub($in_userid, $in_Item){
        
        $conn = oci_connect(Yii::app()->params['dbrrhhuser'], Yii::app()->params['dbrrhhpass'], Yii::app()->params['dbrrhhconnect'], 'AL32UTF8') or die;

        $sql = 'BEGIN NAP.CC_KARDEXEMPLEADO.get_inf_publica(:in_userid, :in_Item, :out_Email, :out_TDir, :out_TInt, :out_TCorp, :out_Area, :out_Cargo, :out_NuError, :out_DeError); END;';

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

        oci_execute($stmt);

        $error = $e1;
        
        if($error == 0){
            $send = array('error' => 200 , 'errorDetail'=>'Ok', 'email' => $o1, 'address' => $o2, 'phoneInt' => $o3, 'phoneCorp' => $o4, 'area' => $o5, 'charge' => $o6);
            return $send;
        }else{
            $send = array('error'=>$error,'errorDetail'=>$e2);
            return $send;
        } 
    }
*/
    public function GetEmpleadoInfoPer($in_userid, $in_Item){
        
        $conn = oci_connect(Yii::app()->params['dbrrhhuser'], Yii::app()->params['dbrrhhpass'], Yii::app()->params['dbrrhhconnect'], 'AL32UTF8') or die;

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

        oci_execute($stmt);

        $error = $e1;
        
        if($error == 0){
            $send = array('error' => 200 , 'errorDetail'=>'Ok', 'nationality'  => $o1,'civilStatus'  => $o2,'gender'  => $o3,'birthdate'  => $o4,'documentType'  => $o5,'documentNumber'  => $o6,'documentEmi'  => $o7,'documentFv'  => $o8,'documentUrl'  => $o9,'passport'  => $o10,'passportFv'  => $o11,'passportUrl'  => $o12,'licenseNumber'  => $o13,'licenseFv'  => $o14,'licenseUrl'  => $o15,'address'  => $o16,'phonePersonal'  => $o17,'cellphonePersonal'  => $o18,'emailPersonal'  => $o19);
            return $send;
        }else{
            $send = array('error'=>$error,'errorDetail'=>$e2);
            return $send;
        } 
    }


    public function EmpleadoInfoPub($in_userid, $in_Item){
        
        $conn = oci_connect(Yii::app()->params['dbrrhhuser'], Yii::app()->params['dbrrhhpass'], Yii::app()->params['dbrrhhconnect'], 'AL32UTF8') or die;

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

        oci_execute($stmt);

        $error = $e1;
        
        if($error == 0){
            $send = array('email' => $o1, 'address' => $o2, 'phoneInt' => $o3, 'phoneCorp' => $o4, 'edificio'=>$m1, 'piso'=>$m2, 'area' => $o5, 'charge' => $o6);
            return $send;
        }else{
            $send = array();
            return $send;
        } 
    }

    public function EmpleadoInfoPer($in_userid, $in_Item){
        
        $conn = oci_connect(Yii::app()->params['dbrrhhuser'], Yii::app()->params['dbrrhhpass'], Yii::app()->params['dbrrhhconnect'], 'AL32UTF8') or die;

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

        oci_execute($stmt);

        $error = $e1;
        
        if($error == 0){
            $send = array('nationality'  => $o1,'civilStatus'  => $o2,'gender'  => $o3,'birthdate'  => $o4,'documentType'  => $o5,'documentNumber'  => $o6,'documentEmi'  => $o7,'documentFv'  => $o8,'documentUrl'  => $o9,'passport'  => $o10,'passportFv'  => $o11,'passportUrl'  => $o12,'licenseNumber'  => $o13,'licenseFv'  => $o14,'licenseUrl'  => $o15,'address'  => $o16,'phonePersonal'  => $o17,'cellphonePersonal'  => $o18,'emailPersonal'  => $o19);
            return $send;
        }else{
            $send = array();
            return $send;
        } 
    }

    public function GetEmpleados($in_userid){
        
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

        oci_execute($stmt);
        // and now, execute the cursor
        oci_execute($cursor);

        $detalle = array();
        
        while ($data = oci_fetch_assoc($cursor)) {

            $url = Yii::app()->params['hostUrl'];

            //$url = 'http://intranetws/images/empleados/192.168.203.40'

            $item['item'] = $data['OUT_ITEM'];
            $name['name'] = $data['OUT_NOMBRE'];
            $photo['photo'] = $url.$data['OUT_ITEM'].'.jpg' ;
            $detalle[] = $item + $name + $photo;
        }

        $error = $e1;
        
        if($error == 0){
            $count = count($detalle);
            $send = array('count'=>$count,'empleados'=>$detalle);
            return $send;
        }else{
            $send = array('error'=>$error,'errorDetail'=>$e2);
            return $send;
        } 
    }


    public function GetDataEmpleado($username){

        $usuario = strtoupper($username);

        $post = Yii::app()->dbldap->createCommand("SELECT COD_EMPLEADO as item FROM CUENTAS WHERE USUARIO = '$usuario'")->queryRow();

        return $post;
    }


    public function GetMarcaEmpleado($item, $fchini, $fchfin){

        $inUser = Yii::app()->params['inUser'];
        
        $conn = oci_connect(Yii::app()->params['dbrrhhuser'], Yii::app()->params['dbrrhhpass'], Yii::app()->params['dbrrhhconnect'], 'AL32UTF8') or die;

        $sql2 = "ALTER SESSION SET NLS_DATE_FORMAT = 'YYYY-MM-DD HH24:MI:SS'";

        $stmt1 = oci_parse($conn,$sql2);

        oci_execute($stmt1);

       // Yii::app()->dbrrhh->createCommand("ALTER SESSION SET NLS_DATE_FORMAT = 'DD-MM-YYYY HH24:MI:SS';")->queryRow();

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

        $detalle = array();
        
        $checkfch = '';

        while ($data = oci_fetch_assoc($cursor)) {
            //$hora['hora_marca'] = date('Y-m-d H:i:s',strtotime($data['OUT_FECHA_HORA']));
            //$hora['hora_marca'] = "TO_CHAR(".$data['OUT_FECHA_HORA'].",'YYYY-MM-DD HH:II:SS')";

            //$datedata = date_create($data['OUT_FECHA_HORA']);
                
           /* $fechaReg['fecha_reg'] = date('Y-m-d',strtotime($data['OUT_FECHA_HORA']));

            $hora['hora_marca'] = $data['OUT_FECHA_HORA'];

            $turno['turno'] = $data['OUT_TURNO'];

            $detalle[] = $fechaReg + $turno + $hora;*/


            $fechaReg['fecha_reg'] = date('Y-m-d',strtotime($data['OUT_FECHA_HORA']));

            $hora['hora_marca'] = $data['OUT_FECHA_HORA'];

            $turno = $data['OUT_TURNO'];

            $turnoCd['turno'] = $data['OUT_TURNO'];

            $sqlturno = 'BEGIN NAP.CC_KARDEXEMPLEADO.get_horario(:in_userid, :in_cod_turno, :out_horario, :out_NuError, :out_DeError); END;';

            $stmtturno = oci_parse($conn,$sqlturno);   

            //  Bind the input parameter
            oci_bind_by_name($stmtturno,':in_userid',$pt1,500);

            //  Bind the input parameter
            oci_bind_by_name($stmtturno,':in_cod_turno',$pt2,500);

            // Bind the output parameter
            oci_bind_by_name($stmtturno,':out_NuError',$et1,500);

            //Bind the output parameter
            oci_bind_by_name($stmtturno,':out_DeError', $et2,1000);

            // Assign a value to the input 
            
            $pt1 = $inUser;

            $pt2 = $turno;

            //But BEFORE statement, Create your cursor
            $cursort = oci_new_cursor($conn);

            // On your code add the latest parameter to bind the cursor resource to the Oracle argument
            oci_bind_by_name($stmtturno,":out_horario", $cursort,-1,OCI_B_CURSOR);

            oci_execute($stmtturno);
            // and now, execute the cursor
            oci_execute($cursort);

            $detalleturno = array();
            
            while ($dataturno = oci_fetch_assoc($cursort)) {

                //$detalletu['turno'] = $dataturno;
                $detalleturno[] = $dataturno + $fechaReg ;
            }
            $turnos = array('turnos'=>$detalleturno);

            $detalle[] = $fechaReg + $hora + $turnoCd + $turnos;
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


        $error = $e1;
        
        if($error == 0){
            $send = array('error'=>200,'errorDetail'=>'OK','item'=>$item,'marca'=>$result);
            return $send;
        }else{
            $send = array('error'=>$error,'errorDetail'=>$e2);
            return $send;
        } 
    }

    public function GetHorarios($turno){

        $inUser = Yii::app()->params['inUser'];
        
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
        
        while ($data = oci_fetch_assoc($cursor)) {
            $detalle[] = $data;
        }

        $error = $e1;
        
        if($error == 0){
            $count = count($detalle);
            $send = array('error'=>200,'errorDetail'=>'OK','count'=>$count,'horarios'=>$detalle);
            return $send;
        }else{
            $send = array('error'=>$error,'errorDetail'=>$e2);
            return $send;
        } 
    }

    public function GetSolicitudesEmpleado($item, $fchini, $fchfin){

        $inUser = Yii::app()->params['inUser'];
        
        $conn = oci_connect(Yii::app()->params['dbrrhhuser'], Yii::app()->params['dbrrhhpass'], Yii::app()->params['dbrrhhconnect'], 'AL32UTF8') or die;

        $sql2 = "ALTER SESSION SET NLS_DATE_FORMAT = 'YYYY-MM-DD HH24:MI:SS'";

        $stmt1 = oci_parse($conn,$sql2);

        oci_execute($stmt1);

       // Yii::app()->dbrrhh->createCommand("ALTER SESSION SET NLS_DATE_FORMAT = 'DD-MM-YYYY HH24:MI:SS';")->queryRow();

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

        $detalle = array();
        
        while ($data = oci_fetch_assoc($cursor)) {
            
            $detalle[] = $data;
        }

        $error = $e1;
        
        if($error == 0){
            $send = array('error'=>200,'errorDetail'=>'OK','item'=>$item,'vacaciones'=>$detalle);
            return $send;
        }else{
            $send = array('error'=>$error,'errorDetail'=>$e2);
            return $send;
        } 
    }

    public function GetSolicitudesPen($userid){

        $puser = User::model()->findByPk($userid);

        $username = $puser->username;

        $usuario = strtolower($username);

        $conn = oci_connect(Yii::app()->params['dbqflowuser'], Yii::app()->params['dbqflowpass'], Yii::app()->params['dbqflowconnect'], 'AL32UTF8') or die;

        $sql = "SELECT SM2.LOGINNAME,
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
            ORDER BY F.FLOWCORRELATIVEID DESC";

        $stid = oci_parse($conn, $sql);
        oci_execute($stid);
        $detalle = array();
        while ($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)) {
            $detalle[] = $row;
        }
           
        $send = array('error'=>200,'errorDetail'=>'OK','requestPen'=>$detalle);

        return $send;
    }

    public function GetVacaciones($userid){

        $puser = UserData::model()->findByAttributes(array('user_id'=>$userid));

        $item = $puser->item;

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

        $send = array('error'=>200,'errorDetail'=>'OK','vacaciones'=>$post);

        return $send;
    }

    public function GetPlanilla($item, $periodo){

        $pcia = '01';

        $conn = oci_connect(Yii::app()->params['dbnafuser'], Yii::app()->params['dbnafpass'], Yii::app()->params['dbnafconnect'], 'AL32UTF8') or die;

        $sql = 'BEGIN Plplani.planilla(:pcia , :pemple , :pperiodo , :pcursor); END;';

        $stmt = oci_parse($conn,$sql);   

        //  Bind the input parameter
        oci_bind_by_name($stmt,':pcia',$p1,500);

        //  Bind the input parameter
        oci_bind_by_name($stmt,':pemple',$p2,500);

        //  Bind the input parameter
        oci_bind_by_name($stmt,':pperiodo',$p3,500);

        // Assign a value to the input 
        
        $p1 = $pcia;

        $p2 = $item;

        $p3 = $periodo;

        //But BEFORE statement, Create your cursor
        $cursor = oci_new_cursor($conn);

        // On your code add the latest parameter to bind the cursor resource to the Oracle argument
        oci_bind_by_name($stmt,":pcursor", $cursor,-1,OCI_B_CURSOR);

        oci_execute($stmt);
        // and now, execute the cursor
        oci_execute($cursor);

        $detalle = array();     

        while ($data = oci_fetch_assoc($cursor)) {
            $detalle[] = $data;                
        }

        $ingresos = $this->GetIngresosPlanilla($item, $periodo);

        $descuentos = $this->GetDescuentosPlanilla($item, $periodo);

        $send = array('error' => 200 , 'errorDetail'=>'Ok','periodo'=>$periodo, 'planilla' => $detalle, 'ingresosVarios'=>$ingresos,'descuentosVarios'=>$descuentos);

        return $send;        
    }

    public function GetIngresosPlanilla($item, $periodo){

        $pcia = '01';

        $conn = oci_connect(Yii::app()->params['dbnafuser'], Yii::app()->params['dbnafpass'], Yii::app()->params['dbnafconnect'], 'AL32UTF8') or die;

        $sql = 'BEGIN Plplani.ingresos_varios(:pcia , :pemple , :pperiodo , :pcursor); END;';

        $stmt = oci_parse($conn,$sql);   

        //  Bind the input parameter
        oci_bind_by_name($stmt,':pcia',$p1,500);

        //  Bind the input parameter
        oci_bind_by_name($stmt,':pemple',$p2,500);

        //  Bind the input parameter
        oci_bind_by_name($stmt,':pperiodo',$p3,500);

        // Assign a value to the input 
        
        $p1 = $pcia;

        $p2 = $item;

        $p3 = $periodo;

        //But BEFORE statement, Create your cursor
        $cursor = oci_new_cursor($conn);

        // On your code add the latest parameter to bind the cursor resource to the Oracle argument
        oci_bind_by_name($stmt,":pcursor", $cursor,-1,OCI_B_CURSOR);

        oci_execute($stmt);
        // and now, execute the cursor
        oci_execute($cursor);

        $detalle = array();     

        while ($data = oci_fetch_assoc($cursor)) {
            $detalle[] = $data;                
        }

        $send = $detalle;

        return $send;        
    }

    public function GetDescuentosPlanilla($item, $periodo){

        $pcia = '01';

        $conn = oci_connect(Yii::app()->params['dbnafuser'], Yii::app()->params['dbnafpass'], Yii::app()->params['dbnafconnect'], 'AL32UTF8') or die;

        $sql = 'BEGIN Plplani.descuentos_varios(:pcia , :pemple , :pperiodo , :pcursor); END;';

        $stmt = oci_parse($conn,$sql);   

        //  Bind the input parameter
        oci_bind_by_name($stmt,':pcia',$p1,500);

        //  Bind the input parameter
        oci_bind_by_name($stmt,':pemple',$p2,500);

        //  Bind the input parameter
        oci_bind_by_name($stmt,':pperiodo',$p3,500);

        // Assign a value to the input 
        
        $p1 = $pcia;

        $p2 = $item;

        $p3 = $periodo;

        //But BEFORE statement, Create your cursor
        $cursor = oci_new_cursor($conn);

        // On your code add the latest parameter to bind the cursor resource to the Oracle argument
        oci_bind_by_name($stmt,":pcursor", $cursor,-1,OCI_B_CURSOR);

        oci_execute($stmt);
        // and now, execute the cursor
        oci_execute($cursor);

        $detalle = array();     

        while ($data = oci_fetch_assoc($cursor)) {
            $detalle[] = $data;                
        }

        $send = $detalle;

        return $send;        
    }

    public function GetCumpleanios(){

        $post = Yii::app()->dbldap->createCommand("SELECT
            TO_CHAR(FCH_NACIMIENTO, 'YYYY-MM-DD') AS NACIMIENTO,
            COD_EMPLEADO
        FROM
            EMPLEADOS

            WHERE
        TO_CHAR( SYSDATE, 'DD-MM') = TO_CHAR( FCH_NACIMIENTO, 'DD-MM')
        ORDER BY
            NOMBRES ASC")->queryAll();

        $detalle = array();

        foreach ($post as $value) {

            $empleado = $this->DatosEmpleado($value['COD_EMPLEADO']);

            $nacimiento['nacimiento'] = $value['NACIMIENTO'];

            $item['item'] = $value['COD_EMPLEADO'];

            $nombre['nombre'] = $empleado['name'].' '.$empleado['fatherLastName'].' '.$empleado['motherLastName'].' '.$empleado['auxLAstName'];

            $foto['foto'] = $empleado['photo'];

            $detalle[] = $item + $nacimiento + $nombre + $foto;
        }

        return $detalle;
    }

    public function DatosEmpleado($in_Item){

        $in_userid = Yii::app()->params['inUser'];
        
        $conn = oci_connect(Yii::app()->params['dbrrhhuser'], Yii::app()->params['dbrrhhpass'], Yii::app()->params['dbrrhhconnect'], 'AL32UTF8') or die;

        $sql = 'BEGIN NAP.CC_KARDEXEMPLEADO.get_empleado(:in_userid, :in_Item, :out_Foto, :out_Estado, :out_ApPaterno, :out_ApMaterno, :out_ApAux, :out_ApNombres, :out_NuError, :out_DeError ); END;';

        $stmt = oci_parse($conn,$sql);   

        $o1 = oci_new_descriptor($conn, OCI_D_LOB);

        //  Bind the input parameter
        oci_bind_by_name($stmt,':in_userid',$p1,500);

        //  Bind the input parameter
        oci_bind_by_name($stmt,':in_Item',$p2,500);
        
        // Bind the output parameter
        oci_bind_by_name($stmt,':out_Foto', $o1, -1, OCI_B_BLOB);
        
        // Bind the output parameter
        oci_bind_by_name($stmt,':out_Estado',$o2,500);
        
        // Bind the output parameter
        oci_bind_by_name($stmt,':out_ApPaterno',$o3,500);
        
        // Bind the output parameter
        oci_bind_by_name($stmt,':out_ApMaterno',$o4,500);
        
        // Bind the output parameter
        oci_bind_by_name($stmt,':out_ApAux',$o5,500);
        
        // Bind the output parameter
        oci_bind_by_name($stmt,':out_ApNombres',$o6,500);
            
        // Bind the output parameter
        oci_bind_by_name($stmt,':out_NuError',$e1,500);

        //Bind the output parameter
        oci_bind_by_name($stmt,':out_DeError', $e2,1000);

        // Assign a value to the input 
        
        $p1 = $in_userid;

        $p2 = $in_Item;

        oci_execute($stmt);

        $error = $e1;
        
        if($error == 0){

            $url = Yii::app()->params['hostUrl'];

            $photo = $photo['photo'] = $url.$p2.'.jpg' ;

            $send = array('error' => 200 , 'errorDetail'=>'Ok', 'photo' => $photo, 'status' => $o2, 'fatherLastName' => $o3, 'motherLastName' => $o4, 'auxLAstName' => $o5, 'name' => $o6);
            
            return $send;
        }else{
            $send = array('error'=>$error,'errorDetail'=>$e2);
            return $send;
        } 
    }


    public function GetEmpleadoInfoPub($in_Item){

        $in_userid = Yii::app()->params['inUser']; 
        
        $conn = oci_connect(Yii::app()->params['dbrrhhptuser'], Yii::app()->params['dbrrhhptpass'], Yii::app()->params['dbrrhhptconnect'], 'AL32UTF8') or die;

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

        oci_execute($stmt);

        $error = $e1;
        
        if($error == 0){
            $send = array('error' => 200 , 'errorDetail'=>'Ok', 'email' => $o1, 'address' => $o2, 'phoneInt' => $o3, 'phoneCorp' => $o4, 'edificio'=>$m1, 'piso'=>$m2, 'area' => $o5, 'charge' => $o6);
            return $send;
        }else{
            $send = array('error'=>$error,'errorDetail'=>$e2);
            return $send;
        } 
    }


    public function GetEmpleadosInfo($in_userid){
        
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

        oci_execute($stmt);
        // and now, execute the cursor
        oci_execute($cursor);

        $detalle = array();
        
        while ($data = oci_fetch_assoc($cursor)) {

            $url = Yii::app()->params['hostUrl'];

            //$url = 'http://intranetws/images/empleados/192.168.203.40'

            $item['item'] = $data['OUT_ITEM'];
            $name['name'] = $data['OUT_NOMBRE'];
            $photo['photo'] = $url.$data['OUT_ITEM'].'.jpg' ;

            $in_Item = $data['OUT_ITEM'];

            $info = $this->EmpleadosInfoPub($in_Item);

            $cumple = $this->CumpleaniosEmp($in_Item);

            $more = $this->EmpleadosMoreInfo($in_Item);

            $detalle[] = $item + $name + $photo + $info + $cumple + $more;
        }

        $error = $e1;
        
        if($error == 0){
            $count = count($detalle);
            
            $send = array('count'=>$count,'empleados'=>$detalle);

            $jsonData = json_encode($send);

            $fecha = date('Y-m-d');
                    
            if(file_put_contents('./protected/data/directorio/directorio.json', $jsonData)){
                return $send;
            }else{
                $sende = array('error'=>1,'errorDetail'=>'No exported');

                return $sende;
            }

            
        }else{
            $send = array('error'=>$error,'errorDetail'=>$e2);
            return $send;
        } 
    }


    public function EmpleadosInfoPub($in_Item){

        $in_userid = Yii::app()->params['inUser']; 
        
        $conn = oci_connect(Yii::app()->params['dbrrhhuser'], Yii::app()->params['dbrrhhpass'], Yii::app()->params['dbrrhhconnect'], 'AL32UTF8') or die;

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

        oci_execute($stmt);

        $send = array('email' => $o1, 'address' => $o2, 'phoneInt' => $o3, 'phoneCorp' => $o4, 'edificio'=>$m1, 'piso'=>$m2, 'area' => $o5, 'charge' => $o6);
        return $send;
    }

    public function CumpleaniosEmp($item){

        $post = Yii::app()->dbldap->createCommand("SELECT
            TO_CHAR(FCH_NACIMIENTO, 'DD / MONTH', 'NLS_DATE_LANGUAGE = spanish') AS NACIMIENTO,
            COD_EMPLEADO
            FROM
            EMPLEADOS

            WHERE
            COD_EMPLEADO = $item")->queryRow();

        $detalle = array();

        $nacimiento['nacimiento'] = $post['NACIMIENTO'];

            $itemnum['item'] = $post['COD_EMPLEADO'];

            $detalle = $itemnum + $nacimiento;

        return $detalle;
    }


    public function EmpleadosMoreInfo($in_Item){

        $in_userid = Yii::app()->params['inUser']; 
        
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

        oci_execute($stmt);

        $horario = $this->HorarioEmpleado($o1);

        if($o2 == 0){
            $estado = 'ACTIVO';
        }else{
            $estado = 'EN VACACION';
        }

        $send = array('horario' => $horario, 'licencia' => $estado );
        return $send;
    }

    public function HorarioEmpleado($turno){

        $inUser = Yii::app()->params['inUser'];
        
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
        
        while ($data = oci_fetch_assoc($cursor)) {
            $detalle[] = $data;
        }
        
        $send = $detalle;
        return $send; 
    }
}
?>