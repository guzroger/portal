<?php
  error_reporting(0);

  //$ci = $_POST['nit_ci'];
  $ci = $_GET['data_ci'];

                

/*echo '
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="COMTECO R.L." name="description" />
    <meta content="Coderthemes" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.ico">

    <!-- App css -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/app.min.css" rel="stylesheet" type="text/css" />

    <style>
      a:link {
        color: Red;
        background-color: transparent;
        text-decoration: none;
      }
      a:visited {
        color: Red;
        background-color: transparent;
        text-decoration: none;
      }
      a:hover {
        color: Red;
        background-color: transparent;
        text-decoration: none;
      }
      a:active {
        color: Red;
        background-color: transparent;
        text-decoration: none;
      }

   </style>

</head>
<body>
  <!-- BEGIN wrapper -->
  <div id="wrapper">

      <div class="row">
                      <div class="col-lg-12">
                          <div class="card-box">
  ';*/

  //DETALLE Cupones
  $urlD        ='http://becom.comteco.com.bo:8081/api/bss/getCouponByDocument';
  $methodD     = 'GET';
  $conexionD   = curl_init($urlD);
  $curlOptionD = array(
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => $methodD,
    CURLOPT_POSTFIELDS =>'{
      "document": "'.$ci.'"
  }',
    CURLOPT_HTTPHEADER => array(
      'Content-Type: application/json'
    ),
  );
  curl_setopt_array($conexionD, $curlOptionD);
  $responseD = curl_exec($conexionD);
  $cadenaD   = json_decode($responseD);


  //STATUS Cupones
  $urlS        ='http://becom.comteco.com.bo:8081/api/bss/getCuponsWithStatus';
  $methodS     = 'GET';
  $conexionS   = curl_init($urlS);
  $curlOptionS = array(
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => $methodS,
    CURLOPT_POSTFIELDS =>'{
      "document": "'.$ci.'"
  }',
    CURLOPT_HTTPHEADER => array(
      'Content-Type: application/json'
    ),
  );
  curl_setopt_array($conexionS, $curlOptionS);
  $responseS = curl_exec($conexionS);
  $cadenaS   = json_decode($responseS);

$codErrorD = $cadenaD->{'codError'};
if($codErrorD == 404) //404
{
    /*echo '
          <!-- BEGIN wrapper -->
              <div id="wrapper">
                <div class="row">
                    <table width="100%">
                        <tbody>
                        <tr>
                            <td>
                                <!--p class="ex1" align="justify"-->
                                    <img src="img/arteCuponeria.png">
                                <!--/p-->
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <br>
                <div class="row">      
                    <div class="col-lg-12">
                        <div class="card-box">
                            <h4 class="header-title">Informacion No Encontrada</h4>
                            <p class="sub-header">
                                <div align="justify"><font color="#000">El Nro. de Documento ingresado <code>'.$ci.'</code> no se encuentra en nuestros registros
                                <br>Compruebe que su dato ingresado sea un numero de Carnet de Identidad o Nit valido!
                                <br>Recuerde que, para el Carnet de Identidad, solo debe ingresar el valor numerico sin extension<br>
                                </font></font>
                            </p>

                            <div class="table-responsive">
                                <table>
                                    <tbody>
                                      <tr>
                                        <td align="left">
                                              <div class="form-group col-md-5" align="right">
                                                  <font size="-1">
                                                      <a href="index.php" target="_self">
                                                        <button type="submit" class="btn btn-secondary" >Volver&nbsp;&nbsp;<i class="fe-check-circle"></i></button>
                                                      </a>
                                                  </font>
                                              </div>
                                        </td>
                                      </tr>    
                                    </tbody>
                                </table>
                            </div>
                        </div> <!-- end card-box -->
                    </div> <!-- end col -->
                </div>
              </div>
          <!-- END wrapper -->
    ';*/
}
else //404
{
  //IMPRESION DETALLEs Cupones
  $NamePersons = $cadenaD->{'name'};
  $MailPersons = $cadenaD->{'email'}; 

  //IMPRESION Status
  $CouponByPersonsS = $cadenaS->{'coupons'};
  foreach($CouponByPersonsS as $CBPs)
  {
    $NroDocu = $CBPs->{'document'};

    /*echo '<!--p class="sub-header">
              Con el Documento de Identidad Nro.: '.$NroDocu.'<br>
              y Correo Electronico: '.$MailPersons.'<br>
          </p-->
          
          <div class="row">
              <table bgcolor="#FFF" width="100%">
                  <tbody>
                  <tr>
                      <td>
                          <!--p class="ex1" align="justify"-->
                              &nbsp;&nbsp;<img src="img/arteCuponeria.png">
                          <!--/p-->
                      </td>
                  </tr>
                  </tbody>
              </table>
          </div>
          <br>
          
          <div class="col-lg-9">
            <div class="card-box">
              <div class="table-responsive">
              <table >
                  <tbody>
                  <tr><td>'; 
                    echo 'Sr./Sra./Srta.: <h4 class="header-title">'.ucwords(strtolower($NamePersons)).'</h4>'; 
                    echo '<p class="sub-header">
                            Con el Documento de Identidad Nro.: '.$NroDocu.'<br>
                            y Correo Electronico: '.$MailPersons.'<br>
                        </p>';
                  echo'</td></tr>
                  <tr>
                    <td>';*/
  }

  //IMPRESION Detalles
  if ($CBPs->{'status'} === "activo")
  {
    echo '
    <!DOCTYPE html>
    <html lang="en">
        <head>
            <meta charset="utf-8" />
            <meta name="viewport" content="width=device-width, initial-scale=1.0">

            <meta content="Coderthemes" name="author" />
            <meta http-equiv="X-UA-Compatible" content="IE=edge" />

            <link rel="shortcut icon" href="assets/images/favicon.ico">


            <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
            <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
            <link href="assets/css/app.min.css" rel="stylesheet" type="text/css" />

            <style>
                body 
                {
                  background-color: #ffffff;
                }
            </style>
        </head>
        <body>
            <div id="wrapper">
                <div class="content-page">
                    <div class="content">
                        <div class="container-fluid">       
                            <div class="row">       
                                <div class="col-lg-6">
                                    <div class="card-box">
                                        <div class="table-responsive">
                                            <table class="table mb-0">                                          
                                                
                                                <FORM action="mail2.php" method="POST" id="CuponUpdateForm">
                                                <div class="form-row">
                                                    <div class="form-group align="left">
                                                        <input id="nit_ci2" name="nit_ci2" type="hidden" class="form-control" required value="'.$ci.'"/>
                                                    </div>
                                                    <div class="form-group align="left">
                                                        <input id="mail2" name="mail2" type="hidden" class="form-control" required value="'.$MailPersons.'"/>
                                                    </div>
                                                </div>
                                                <tr>
                                                    <td>
                                                    <!--td colspan="2"-->
                                                        <address>
                                                          <font color="#000"><strong>'.ucwords(strtolower($NamePersons)).'</strong></font>
                                                          <br>Documento de Identidad <font color="#000"><strong>'.$NroDocu.'</strong></font>
                                                          <br>Correo Electronico <font color="#000"><strong>'.$MailPersons.'</strong></font>
                                                        </address>
                                                        <br>
                                                        <address>
                                                          Tiene <font size="+1"><kbd>'.$CBPs->{'quantity'}.'</kbd></font> 
                                                          <font color="#000"><strong>Cupones NUEVOS</strong></font>&nbsp;para nuestro
                                                          <br>proximo sorteo. 
                                                          <br>Para recibir sus cupones <strong>HABILITADOS</strong> 
                                                          <br>presione en el boton inferior de 
                                                          <br><font color="#000"><strong>Enviar Cupones</strong></font> ...Gracias
                                                        </address>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div class="form-group col-md-9" align="left">
                                                            <button type="submit" class="btn btn-dark">Enviar Cupones&nbsp;&nbsp;<i class="fe-upload"></i></button>
                                                        </div>
                                                    </td>
                                                    <!--td>
                                                        <br><div class="form-group col-md-3" align="right">
                                                            <a href="index.php" target="_self" class="btn btn-primary btn-sm" role="button">
                                                              <i class="fe-rotate-ccw"></i>&nbsp;&nbsp;Cancelar
                                                            </a>
                                                        </div>
                                                    </td-->
                                                </tr>
                                                </FORM>

                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="card-box">
                                        <div class="table-responsive">
                                            <table class="table mb-0">                                          
                                                <tr>
                                                    <td>
                                                        <img src="img/card3.png" width="325" height="290">
                                                    </td>
                                                </tr>
                                                </FORM>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <!-- END wrapper -->



            <!-- Right bar overlay-->
            <div class="rightbar-overlay"></div>
            <!-- Vendor js -->
            <script src="assets/js/vendor.min.js"></script>
            <!-- App js -->
            <script src="assets/js/app.min.js"></script>
            
        </body>
    </html>
    ';
  }
  else
  {
    echo 'Tiene <B>'.$CBPs->{'quantity'}.'</B> cupones <b>Nuevos</b> ...para nuestro proximo sorteo<br><br>';
    echo '
    <!-- BEGIN wrapper -->
        <div id="wrapper">
          <div class="row">      
              <div class="col-lg-9">
                  <div class="card-box">
                      <!--h4 class="header-title">¿Desea Activar sus Cupones Ahora?</h4-->
                      <p class="sub-header">
                          Para recibir un detalle de sus cupones en el correo <b>'.$MailPersons.'</b> registrado, 
                                               <br>presione en el boton inferior <b>Enviar mis Cupones</b> ...Gracias
                                               <hr style="width:100%;height:1px;border-width:0;color:black;background-color:black">
                      </p>

                      <div class="table-responsive">
                          <table>
                              <tbody>
                                <tr>
                                  <td>
                                      <FORM action="mail2.php" method="POST" id="CuponUpdateForm">
                                          <div class="form-row">
                                              <div class="form-group col-md-9" align="left">
                                                  <!--label for="example-number">N&uacutemero Documento de Identidad<code class="highlighter-rouge"> [*]</code></label-->
                                                  <input id="nit_ci" name="nit_ci" type="hidden" class="form-control" required value="'.$ci.'"/>
                                              </div>
                                              <div class="form-group col-md-6" align="left">
                                                  <!--label for="example-number">N&uacutemero Documento de Identidad<code class="highlighter-rouge"> [*]</code></label-->
                                                  <input id="mail2" name="mail2" type="hidden" class="form-control" required value="'.$MailPersons.'"/>
                                              </div>
                                          </div>

                                          <div class="form-row">
                                              <div class="form-group col-md-12" align="left">
                                                  <button type="submit" class="btn btn-primary" >Enviar Mis Cupones&nbsp;&nbsp;<i class="fe-upload"></i></button>
                                              </div>
                                          </div>
                                      </FORM>
                                  </td>
                                  <!--td align="right">
                                        <div class="form-group col-md-6">
                                            <font size="-1">
                                                <a href="index.php" target="_self">
                                                  <br><button type="submit" class="btn btn-secondary" >No&nbsp;&nbsp;<i class="fe-check-circle"></i></button>
                                                </a>
                                            </font>
                                        </div>
                                  </td-->
                                </tr>    
                              </tbody>
                          </table>
                      </div>
                  </div> <!-- end card-box -->
              </div> <!-- end col -->
          </div>
        </div>
    <!-- END wrapper -->
    ';
  }

} //404
?>
