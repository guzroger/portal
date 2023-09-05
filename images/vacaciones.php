<?php
//////PROCEDIMENTO VACACIONES DEVOLUCION DE FECHAS //////


    $dbphuser = 'qflow';
    $dbphpass = 'c0t3c0';
    $dbphconnect = '(DESCRIPTION = (ADDRESS = (PROTOCOL = TCP)(HOST = 192.9.200.207)(PORT = 1521)) (CONNECT_DATA = (SERVICE_NAME = DB1) (SID = DB1)))';

    $conn = oci_connect($dbphuser, $dbphpass, $dbphconnect, 'AL32UTF8') or die;

    $sql2 = "ALTER SESSION SET NLS_DATE_FORMAT = 'YYYY-MM-DD HH24:MI:SS'";

    $stmt1 = oci_parse($conn,$sql2);

    oci_execute($stmt1);

    $sql = 'BEGIN NAP.GET_VAC_DATES(:PI_COD_EMPLEADO, :PI_FECHA_INICIO, :PI_DIAS, :PO_FECHA_FIN, :PO_FECHA_RET ); END;';

    $stmt = oci_parse($conn,$sql);

    //  Bind the input parameter
    oci_bind_by_name($stmt,':PI_COD_EMPLEADO',$p1,500);

    //  Bind the input parameter
    oci_bind_by_name($stmt,':PI_FECHA_INICIO',$p2,500);

    //  Bind the input parameter
    oci_bind_by_name($stmt,':PI_DIAS',$p3,500);

    //Bind the output parameter
    oci_bind_by_name($stmt,':PO_FECHA_FIN', $o1,500);

    //Bind the output parameter
    oci_bind_by_name($stmt,':PO_FECHA_RET', $o2,500);

    // Assign a value to the input
    $p1 = $_POST['item'];

    $p2 = $_POST['fechainicio'];

    $p3 = $_POST['dias'];

    oci_execute($stmt);

        $send = array('fecha_fin'=>$o1,'fecha_ret'=>$o2);

    echo json_encode($send);  


//////PROCEDIMENTO VACACIONES DEVOLUCION DE FECHAS //////

?>