<?php
//////PROCEDIMENTO VALIDACION DENTRO DE UN PAQUETE ORACLE //////

$item=$_POST['item'];
$ci=$_POST['ci'];


    $dbphuser = 'qflow';
    $dbphpass = 'c0t3c0';
    $dbphconnect = '(DESCRIPTION = (ADDRESS = (PROTOCOL = TCP)(HOST = 192.9.200.207)(PORT = 1521)) (CONNECT_DATA = (SERVICE_NAME = DB1) (SID = DB1)))';

    $conn = oci_connect($dbphuser, $dbphpass, $dbphconnect, 'AL32UTF8') or die;

    $sql = 'BEGIN NAP.CC_CONTROL_ASIS.GET_VALIDAID(:IN_ITEM, :IN_DOCUMENTO, :OUT_NOMBRE,:OUT_NUERROR, :OUT_DEERROR ); END;';

    $stmt = oci_parse($conn,$sql);

    //  Bind the input parameter
    oci_bind_by_name($stmt,':IN_ITEM',$p1,500);

    //  Bind the input parameter
    oci_bind_by_name($stmt,':IN_DOCUMENTO',$p2,500);

    //Bind the output parameter
    oci_bind_by_name($stmt,':OUT_NOMBRE', $o1,500);

    //Bind the output parameter
    oci_bind_by_name($stmt,':OUT_NUERROR', $o2,500);

    //Bind the output parameter
    oci_bind_by_name($stmt,':OUT_DEERROR', $o3,500);

    // Assign a value to the input
    $p1 = $item;

    $p2 = $ci;

    oci_execute($stmt);

    //$send = array('error'=>$o1,'detalle'=>$o2);

    echo json_encode(array('error'=>$o2,'detalle'=>$o3, 'nombre'=>$o1));

    //return $send;


//$equipos=Validacion($item,$ci);

//print_r($equipos);

//////PROCEDIMENTO VALIDACION DENTRO DE UN PAQUETE ORACLE //////

?>