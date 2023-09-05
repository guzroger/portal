<?php
//////PROCEDIMENTO REGISTRO DE SALIDA Y RETORNO DENTRO DE UN PAQUETE ORACLE //////

$item=$_POST['item'];
if(isset($_POST['fecha_salida']))
{
    $fecha_salida=$_POST['fecha_salida'];
}else{
    $fecha_salida=date('Y-m-d H:i:s');
}
$motivo=$_POST['motivo'];
if(isset($_POST['fecha_retorno']))
{
    $fecha_retorno=$_POST['fecha_retorno'];
}else{
    $fecha_retorno=date('Y-m-d H:i:s');
}
$id_solicitud=$_POST['id_solicitud'];


    $dbphuser = 'qflow';
    $dbphpass = 'c0t3c0';
    $dbphconnect = '(DESCRIPTION = (ADDRESS = (PROTOCOL = TCP)(HOST = 192.9.200.207)(PORT = 1521)) (CONNECT_DATA = (SERVICE_NAME = DB1) (SID = DB1)))';

    $conn = oci_connect($dbphuser, $dbphpass, $dbphconnect, 'AL32UTF8') or die;

    $sql2 = "ALTER SESSION SET NLS_DATE_FORMAT = 'YYYY-MM-DD HH24:MI:SS'";

    $stmt1 = oci_parse($conn,$sql2);

    oci_execute($stmt1);

    $sql = 'BEGIN NAP.CC_CONTROL_ASIS.REGISTRA_SALIDA(:IN_ITEM, :IN_FECHA_SALIDA, :IN_MOTIVO, :IN_FECHA_RETORNO, :IN_ID_SOLICITUD, :OUT_NUERROR, :OUT_DEERROR ); END;';

    $stmt = oci_parse($conn,$sql);

    //  Bind the input parameter
    oci_bind_by_name($stmt,':IN_ITEM',$p1,500);

    //  Bind the input parameter
    oci_bind_by_name($stmt,':IN_FECHA_SALIDA',$p2,500);

    //  Bind the input parameter
    oci_bind_by_name($stmt,':IN_MOTIVO',$p3,500);

    //  Bind the input parameter
    oci_bind_by_name($stmt,':IN_FECHA_RETORNO',$p4,500);

    //  Bind the input parameter
    oci_bind_by_name($stmt,':IN_ID_SOLICITUD',$p5,500);

    //Bind the output parameter
    oci_bind_by_name($stmt,':OUT_NUERROR', $o1,500);

    //Bind the output parameter
    oci_bind_by_name($stmt,':OUT_DEERROR', $o2,500);

    // Assign a value to the input
    $p1 = $item;

    $p2 = $fecha_salida;

    $p3 = $motivo;

    $p4 = $fecha_retorno;

    $p5 = $id_solicitud;

    oci_execute($stmt);

    //$send = array('error'=>$o1,'detalle'=>$o2, 'fecha'=>$detalle);

    echo json_encode(array('error'=>$o1, 'detalle'=>$o2));

    //return $send;

//$equipos=Veregistro($item,$fecha);

//print_r($equipos);

//////PROCEDIMENTO REGISTRO DE SALIDA Y RETORNO DENTRO DE UN PAQUETE ORACLE //////

?>