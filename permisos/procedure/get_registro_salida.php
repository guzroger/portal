<?php
//////PROCEDIMENTO VERIFICACION DE REGISTRO DENTRO DE UN PAQUETE CON CURSOR ORACLE //////

$item=$_POST['item'];
$fecha=date('Y-m-d H:m:i');

    $dbphuser = 'qflow';
    $dbphpass = 'c0t3c0';
    $dbphconnect = '(DESCRIPTION = (ADDRESS = (PROTOCOL = TCP)(HOST = 192.9.200.207)(PORT = 1521)) (CONNECT_DATA = (SERVICE_NAME = DB1) (SID = DB1)))';

    $conn = oci_connect($dbphuser, $dbphpass, $dbphconnect, 'AL32UTF8') or die;

    $sql2 = "ALTER SESSION SET NLS_DATE_FORMAT = 'YYYY-MM-DD HH24:MI:SS'";

    $stmt1 = oci_parse($conn,$sql2);

    oci_execute($stmt1);

    $sql = 'BEGIN NAP.CC_CONTROL_ASIS.GET_REGISTRO_SALIDA(:IN_ITEM, :IN_FECHA, :OUT_REG_SALIDA, :OUT_NUERROR, :OUT_DEERROR ); END;';

    $stmt = oci_parse($conn,$sql);

    //  Bind the input parameter
    oci_bind_by_name($stmt,':IN_ITEM',$p1,500);

    //  Bind the input parameter
    oci_bind_by_name($stmt,':IN_FECHA',$p2,500);

    //Bind the output parameter
    oci_bind_by_name($stmt,':OUT_NUERROR', $o1,500);

    //Bind the output parameter
    oci_bind_by_name($stmt,':OUT_DEERROR', $o2,500);

    // Assign a value to the input
    $p1 = $item;

    $p2 = $fecha;

    //But BEFORE statement, Create your cursor
    $cursor = oci_new_cursor($conn);

    oci_bind_by_name($stmt,":OUT_REG_SALIDA", $cursor,-1,OCI_B_CURSOR);

    oci_execute($stmt);

    oci_execute($cursor);

    $detalle = array();

    while ($data = oci_fetch_assoc($cursor)) {
        $detalle[] = $data;
    }

    //$send = array('error'=>$o1,'detalle'=>$o2, 'datos'=>$detalle);

    echo json_encode(array('error'=>$o1, 'detalle'=>$o2, 'datos'=>$detalle));

    //return $send;

//$equipos=Veregistro($item,$fecha);

//print_r($equipos);

//////PROCEDIMENTO VERIFICACION DE REGISTRO DENTRO DE UN PAQUETE CON CURSOR ORACLE //////

?>