<?php
//////PROCEDIMENTO RECUPERAR CATALOGO DENTRO DE UN PAQUETE CON CURSOR ORACLE //////

$userid=$_POST['user'];
$entidad=$_POST['entidad'];


    $dbphuser = 'qflow';
    $dbphpass = 'c0t3c0';
    $dbphconnect = '(DESCRIPTION = (ADDRESS = (PROTOCOL = TCP)(HOST = 192.9.200.207)(PORT = 1521)) (CONNECT_DATA = (SERVICE_NAME = DB1) (SID = DB1)))';

    $conn = oci_connect($dbphuser, $dbphpass, $dbphconnect, 'AL32UTF8') or die;

    $sql = 'BEGIN NAP.CC_KARDEXEMPLEADO.GET_DATOS_CATALOGO(:IN_USERID, :IN_ENTIDAD, :OUT_CATALOGO, :OUT_NUERROR, :OUT_DEERROR ); END;';

    $stmt = oci_parse($conn,$sql);

    //  Bind the input parameter
    oci_bind_by_name($stmt,':IN_USERID',$p1,500);

    //  Bind the input parameter
    oci_bind_by_name($stmt,':IN_ENTIDAD',$p2,500);

    //Bind the output parameter
    oci_bind_by_name($stmt,':OUT_NUERROR', $o1,500);

    //Bind the output parameter
    oci_bind_by_name($stmt,':OUT_DEERROR', $o2,500);

    // Assign a value to the input
    $p1 = $userid;

    $p2 = $entidad;

    //But BEFORE statement, Create your cursor
    $cursor = oci_new_cursor($conn);

    oci_bind_by_name($stmt,":OUT_CATALOGO", $cursor,-1,OCI_B_CURSOR);

    oci_execute($stmt);

    oci_execute($cursor);

    $detalle = array();

    while ($data = oci_fetch_assoc($cursor)) {
        $detalle[] = $data;
    }

    //$send = array('error'=>$o1,'detalle'=>$o2, 'catalogo'=>$detalle);

    echo json_encode(array('error'=>$o1, 'detalle'=>$o2, 'catalogo'=>$detalle));

    //return $send;

//$equipos=Catalogo($userid,$entidad);

//print_r($equipos);

//////PROCEDIMENTO RECUPERAR CATALOGO DENTRO DE UN PAQUETE CON CURSOR ORACLE //////

?>