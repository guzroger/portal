<?php
  error_reporting(0);

  if($_POST['extnc_nit_ci'] === "")
  {
    $ci = $_POST['nit_ci'];
    //echo 'sin extension<br>';
  }
  else
  {
    $ci = $_POST['nit_ci'].strtoupper($_POST['extnc_nit_ci']);
  }

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
  $codError = $cadenaD->{'codError'};


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
  $CouponByPersonsS = $cadenaS->{'coupons'};

  $ContQuantities =0;
  foreach($CouponByPersonsS as $CBP)
  {
    if ($CBP->{'status'} =="noActivo")
      {
        $ContQuantities =$CBP->{'quantity'} + $ContQuantities;
      }
  }

  if (($ContQuantities == 0) && ($codError <> 404))
  {
    echo '
      <!DOCTYPE html>
      <html lang="en">
          <head>
              <meta charset="utf-8" />

              <meta name="viewport" content="width=device-width, initial-scale=1.0">
              <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
              <meta content="Coderthemes" name="author" />
              <meta http-equiv="X-UA-Compatible" content="IE=edge" />
              <!-- App favicon -->
              <link rel="shortcut icon" href="assets/images/favicon.ico">

              <!-- App css -->
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
                                                <tr>
                                                    <td>
                                                        <address>
                                                          <font color="#000" size="-1"><strong>'.$cadenaD->{'name'}.'</strong></font>
                                                          <br>Documento de Identidad <font color="#000" size="-1"><strong>'.$cadenaD->{'document'}.'</strong></font>
                                                        </address>
                                                        <br>
                                                        <address>
                                                          <font color="#000" size="-1">Lamentablemente <strong>No Tiene Cupones NUEVOS</strong>&nbsp;por habilitar para nuestro proximo sorteo
                                                          <br>Recuerde cancelar sus facturas pendientes antes del 28 de Marzo del 2023 para acceder a Nuevos Cupones 
                                                          <br>Gracias .....</font>
                                                        </address>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div class="form-group col-md-12" align="center">
                                                            <a href="index.php" target="_self" class="btn btn-dark" role="button">
                                                              <i class="fe-rotate-ccw"></i>&nbsp;&nbsp;Volver
                                                            </a>
                                                        </div>
                                                    </td>
                                                </tr>
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
                                                        <!--img src="img/card.png" width="535" height="288"-->
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
    if($codError == 404) //404
    {
        echo '
      <!DOCTYPE html>
      <html lang="en">
          <head>
              <meta charset="utf-8" />
              <meta name="viewport" content="width=device-width, initial-scale=1.0">
              <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
              <meta content="Coderthemes" name="author" />
              <meta http-equiv="X-UA-Compatible" content="IE=edge" />
              <!-- App favicon -->
              <link rel="shortcut icon" href="assets/images/favicon.ico">

              <!-- App css -->
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
                                                <tr>
                                                    <td>
                                                        <address>
                                                          <font color="#000"><strong>Informacion No Encontrada</strong></font>
                                                          <br>para el numero de documento <font color="#000"><strong>'.$ci.'</strong></font>
                                                        </address>
                                                        <br>
                                                        <address>
                                                          El Nro. de Documento ingresado no se encuentra en nuestros registros.&nbsp;
                                                          Compruebe que el dato ingresado sea un numero de documento valido!
                                                          <br>Recuerde que, solo debe ingresar el valor numerico sin extension de su C.I.
                                                          &nbsp;.....Gracias
                                                        </address>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div class="form-group col-md-12" align="center">
                                                            <a href="index.php" target="_self" class="btn btn-dark" role="button">
                                                              <i class="fe-rotate-ccw"></i>&nbsp;&nbsp;Volver
                                                            </a>
                                                        </div>
                                                    </td>
                                                </tr>
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
      $username ='jtoro';
      $password ='jt0r0..';

      if($_POST['extnc_nit_ci'] === "")
      {
        $ci = $_POST['nit_ci'];
      }
      else
      {
        $ci = $_POST['nit_ci'].strtoupper($_POST['extnc_nit_ci']);
      }

      $FecNac ="01/01/1900";
      $CtrlFecNac = substr($FecNac, 8, 2).'/'.substr($FecNac, 5, 2).'/'.substr($FecNac, 0, 4);

      if ($ci == " ")
      {   
        ?><!--html>
          <head>
                <meta charset="utf-8" />
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
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
                table, th, td 
                {
                  border: 0px solid black;
                  border-collapse: collapse;
                }
                th, td 
                {
                  padding-top: 10px;
                  padding-bottom: 20px;
                  padding-left: 30px;
                  padding-right: 30px;
                }
                p.ex1 
                {
                  margin-left: 1em;
                  margin-right: 1em;
                }
                table tr, td 
                {
                    color: #fff;
                    background-color: #FFF;
                }
            </style>
          </head>
          <body>
            <div class="card-box">
            <div class="row">
                    <table width="100%">
                        <tbody>
                        <tr>
                            <td>
                                <img src="img/arteCuponeria.png">
                            </td>
                        </tr>
                        </tbody>
                    </table>
            </div>
            <br>
              <table class="table mb-0" style="width: 100%"> 
                <thead class="thead-dark">
                  <tr>
                    <th align="left" colspan="2">
                      <font size="-1">
                        <i class="fas fa-times-circle"></i>&nbsp;&nbsp;Error!
                      </font>
                    </th>
                  </tr>

                  <tr>
                    <td align="left">
                      <font size="-1">
                          <code class="highlighter-rouge">Nro. Documento de Identidad Ingresado:</code>&nbsp;<?php //echo $ci; ?></font>
                    </td>
                    <td align="left">
                      <font size="-1">
                          <code class="highlighter-rouge">Fecha de Nacimiento Ingresada:</code>&nbsp;<?php //echo $FecNac; ?></font>
                    </td>
                  </tr>

                  <tr>
                    <td align="left" colspan="2">
                      <font size="-1">
                        Verifique estos posibles errores en el ingreso de su informaci&oacuten:<br>
                          - Su <code class="highlighter-rouge">Nro. Documento de Identidad</code> ingresado <b>#NoPuedeSer</b> Nulo, Vacio o Cero
                          <br>- Su <code class="highlighter-rouge">Fecha de Nacimiento</code> ingresada <b>#NoPuedeSer</b> Nulo, Vacio o Cero
                          <br><br>
                      </font>
                    </td>
                  </tr>

                  <tr>
                    <td align="left" colspan="2">
                      <font size="-1">
                          <a href="index.php" target="_self">Volver a Verificar Su Informaci&oacuten AQUI&nbsp;&nbsp;<i class="fe-check-circle"></i></a>
                      </font>
                    </td>
                  </tr>
                </thead>
                  <tbody>  

                  </tbody>
              </table>
            </div>
          </body>
        </html-->
      <?php
      }
      else
      {
          
          $url = 'https://becom.comteco.com.bo:8181/xapi/getKeyHandle';     // oficial
          $method = 'POST';
          $conexion = curl_init($url);
          $curlOption = array(
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_TIMEOUT => 30,
              /** Header */
              CURLOPT_HTTPHEADER => array(
                  "user:".$username,
                  "password:".$password,
                  "Content-Type:application/json"
              ),
              /** SSL */
              CURLOPT_SSL_VERIFYPEER => 0,
              CURLOPT_SSL_VERIFYHOST => 0,
              CURLOPT_MAXREDIRS => 0,
              /** Body */
              CURLOPT_CUSTOMREQUEST => $method
          );
          curl_setopt_array($conexion, $curlOption);
          $response = curl_exec($conexion);

          $cadena= json_decode($response);
          $keyHandleIS=$cadena->{'keyHandle'};    //key



          $url2 = 'https://becom.comteco.com.bo:8181/xapi/getSubscriberByDocument?document='.$ci.'&includeProducts=N';
          $method2 = 'POST';
          $conexion2 = curl_init($url2);
          $curlOption2 = array(
                      CURLOPT_RETURNTRANSFER => true,
                      CURLOPT_TIMEOUT => 30,
                      /** Header */
                      CURLOPT_HTTPHEADER => array(
                          "keyHandle:".$keyHandleIS
                      ),
                      /** SSL */
                      CURLOPT_SSL_VERIFYPEER => 0,
                      CURLOPT_SSL_VERIFYHOST => 0,
                      CURLOPT_MAXREDIRS => 0,
                      /** Body */
                      CURLOPT_CUSTOMREQUEST => $method2
                  );
          curl_setopt_array($conexion2, $curlOption2);

          $response2 = curl_exec($conexion2);
          $cadena2= json_decode($response2);

          $naturalPersonscod =$cadena2->{'errorDetail'};
          $naturalPersons=$cadena2->{'naturalPersons'};
        
          /*echo'<html>
            <head>
                  <meta charset="utf-8" />
                  <meta name="viewport" content="width=device-width, initial-scale=1.0">
                  <meta content="Admin Theme" name="description" />
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
                table, th, td 
                {
                  border: 0px solid black;
                  border-collapse: collapse;
                }
                th, td 
                {
                  padding-top: 10px;
                  padding-bottom: 20px;
                  padding-left: 30px;
                  padding-right: 30px;
                }
                p.ex1 
                {
                  margin-left: 1em;
                  margin-right: 1em;
                }
                table tr, td 
                {
                    color: #fff;
                    background-color: #FFF;
                }
            </style>

            </head>
            <body>
              <div class="card-box">
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
                <table class="table mb-0" style="width: 100%"> 
                  <thead class="thead-dark">
                    <tr>';*/
                      
                      if($naturalPersonscod <> "OK")
                      { 
                        /*echo'<table class="table mb-0" style="width: 70%"> 
                          <thead class="thead-dark">
                            <tr>
                              <th align="left" colspan="2">
                                <font size="-1">
                                  <i class="fas fa-times-circle"></i>&nbsp;&nbsp;Error!
                                </font>
                              </th>
                            </tr>
                            <tr>
                              <td align="left" colspan="2">
                                <font size="-1">
                                  Verifique estos posibles errores en el ingreso de su informaci&oacuten:<br>
                                    - Su <code class="highlighter-rouge">Nro. Documento de Identidad</code> ingresado <b>#NoPuedeSer</b> Nulo, Vacio o Cero
                                    <br>- El <code class="highlighter-rouge">Lugar de Extensi&oacuten de su Documento de Identidad</code> ingresado <b>#NoEsCorrecto</b>
                                    <br>- Su <code class="highlighter-rouge">Fecha de Nacimiento</code> ingresada <b>#NoEsCorrecta</b>
                                    <br><br>
                                </font>
                              </td>
                            </tr>

                            <tr>
                              <td align="left" colspan="2">
                                <font size="-1">
                                    <a href="index.php" target="_self">Volver a Verificar Su Informaci&oacuten AQUI&nbsp;&nbsp;<i class="fe-check-circle"></i></a>
                                </font>
                              </td>
                            </tr>
                          </thead>
                        </table>';*/
                      }
                      else
                      {
                        foreach($naturalPersons as $naturalP)
                        {

                          if ($naturalP->{'birthDate'} <> $CtrlFecNac)
                          {
                        ?>  
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
                                                        <div class="col-lg-12">
                                                            <div class="card-box">
                                                                <h4 class="header-title"><?php echo $IMP=ucwords(strtolower($naturalP->{'fullName'})); ?></h4>
                                                                <p class="sub-header">
                                                                    Verifica que tu numero de celular y correo electrónico sean los correctos, en caso de no ser asi, por favor  
                                                                    <kbd>actual&iacutezalos!</kbd>
                                                                    <br>
                                                                    Ambos campos, <kbd>Teléfono Celular & Correo Electrónico</kbd>, son obligatorios
                                                                </p>

                                                                <div class="table-responsive">
                                                                    <FORM action="updating_data.php" method="POST">
                                                                        <table class="table table-borderless mb-0">
                                                                            <tbody>
                                                                            <tr>
                                                                                <td>
                                                                                    <div class="form-group col-md-9">
                                                                                        <label for="example-number"><font size="-1" color="#000">Nro. Documento Ingresado</font></label>
                                                                                        <br>
                                                                                        <input id="nro_documentIS" name="nro_documentIS" type="text" readonly="YES" class="form-control" value="<?php echo $IMP=$naturalP->{'document'}; ?>">
                                                                                        <!--p class="form-control-static">email@example.com</p-->
                                                                                    </div>
                                                                                </td>
                                                                                <td>
                                                                                    <div class="form-group col-md-9">
                                                                                        <label for="example-number"><font size="-1" color="#000">Nro. de Tel&eacutefono Celular[*]</font></label>
                                                                                        <input id="newval_nro_cel" name="newval_nro_cel" type="text" class="form-control" required value=" <?php echo $IMP=$naturalP->{'cellPhone'}; ?> ">
                                                                                    </div>
                                                                                </td>
                                                                                <td>
                                                                                    <div class="form-group col-md-12">
                                                                                        <label for="example-number"><font size="-1" color="#000">Correo<br>Electr&oacutenico [*]</font></label>
                                                                                        <input id="newval_email" name="newval_email" type="email" class="form-control" required value=" <?php echo $IMP=$naturalP->{'email'}; ?> ">
                                                                                    </div>
                                                                                </td>
                                                                                <input type="hidden" name="suscr_id" id="suscr_id" value=" <?php echo $IMP=$naturalP->{'subscriberId'}; ?> ">
                                                                                <input type="hidden" name="ci_id" id="ci_id" value=" <?php echo $ci; ?> ">
                                                                            </tr>
                                                                            <tr>
                                                                                <td>
                                                                                    <div class="form-group col-md-12" align="left">
                                                                                        <button type="submit" class="btn btn-dark">Continuar&nbsp;&nbsp;<i class="fe-upload"></i></button>
                                                                                    </div>
                                                                                </td>
                                                                                <td>
                                                                                    <div class="form-group col-md-12">
                                                                                        &nbsp;
                                                                                    </div>
                                                                                </td>
                                                                                <td>
                                                                                    <div class="form-group col-md-12" align="right">
                                                                                        <a href="index.php" target="_self" class="btn btn-primary btn-sm" role="button">
                                                                                          <i class="fe-rotate-ccw"></i>&nbsp;&nbsp;Cancelar
                                                                                        </a>
                                                                                    </div>
                                                                                </td>
                                                                            </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </FORM>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="rightbar-overlay"></div>
                                    <script src="assets/js/vendor.min.js"></script>
                                    <script src="assets/js/app.min.js"></script>
                                    
                                </body>
                            </html>                            
                        <?php
                          } //if ($naturalP->{'fullName'} === $CtrlFecNac)
                          else
                          {
                            /*echo'<table class="table mb-0" style="width: 100%"> 
                                  <thead class="thead-dark">
                                    <tr>
                                      <th align="left" colspan="2">
                                        <font size="-1">
                                          <i class="fas fa-times-circle"></i>&nbsp;&nbsp;Error!
                                        </font>
                                      </th>
                                    </tr>
                                    <tr>
                                      <td align="left" colspan="2">
                                        <font size="-1">
                                            - Su <code class="highlighter-rouge">Fecha de Nacimiento</code> ingresada <b>#NoCorresponde</b> al Documento de Identidad Ingresado!
                                            <br><br>
                                        </font>
                                      </td>
                                    </tr>

                                    <tr>
                                      <td align="left" colspan="2">
                                        <font size="-1">
                                            <a href="index.php" target="_self">Volver a Verificar Su Informaci&oacuten AQUI&nbsp;&nbsp;<i class="fe-check-circle"></i></a>
                                        </font>
                                      </td>
                                    </tr>
                                  </thead>
                                </table>';*/
                          }
                        } //foreach
                      } //if_else
      }
                  echo'</tbody>
                </table>
              </div>
            </body>
            </html>';
    }
  }
?>