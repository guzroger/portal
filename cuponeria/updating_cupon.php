<html>
  <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

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
    <div id="wrapper" align="center">
      <div class="card-box">
        <table class="table mb-0" style="width: 100%"> 
          <thead class="thead-dark">
            <tr>
              <?php
                error_reporting(0);
                
                $subscriberId_in = trim($_GET['ci']);

                //Update STATUS Cupones
                $urlS        ='http://becom.comteco.com.bo:8081/api/bss/updateCoupons';
                $methodS     = 'POST';
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
                    "document": "'.$subscriberId_in.'"
                }',
                  CURLOPT_HTTPHEADER => array(
                    'Content-Type: application/json'
                  ),
                );
                curl_setopt_array($conexionS, $curlOptionS);
                $responseS = curl_exec($conexionS);
                $cadenaS   = json_decode($responseS);


                $updateCoupons =$cadenaS->{'msg_error'};
                if($updateCoupons == "OK")
                {
                  echo'<table class="table table-dark table-borderless mb-0" style="width: 40%"> 
                    <thead>
                      <tr>
                        <th align="left" colspan="2" bgcolor="#BB2D3B">
                          <font size="-1" color="#FFFFFF">
                            <i class="fas fa-sync"></i>&nbsp;&nbsp;Habilitacion Satisfactoria!
                          </font>
                        </th>
                      </tr>
                      <tr>
                        <td align="left" colspan="2">
                          <font size="-1">
                              - Se <code class="highlighter-rouge">Habilitaron sus Cupones</code> de forma correcta!
                              <br><br>
                          </font>
                        </td>
                      </tr>

                      <tr>
                        <td align="left" colspan="2">
                          <font size="-1">
                              <a href="prueba_correo.php" target="_self">
                                <button type="submit" class="btn btn-primary" >Continuar&nbsp;&nbsp;<i class="fe-check-circle"></i></button>
                              </a>
                          </font>
                        </td>
                      </tr>
                    </thead>
                  </table>';
                  }
                else
                {
                  echo'<!--table class="table mb-0" style="width: 40%"> 
                    <thead>
                      <tr>
                        <th align="left" colspan="2" bgcolor="#C82333">
                          <font size="-1" color="#FFFFFF">
                            <i class="fas fa-sync"></i>&nbsp;&nbsp;Error!
                          </font>
                        </th>
                      </tr>
                      <tr>
                        <td align="left" colspan="2">
                          <font size="-1">
                              - Al parecer algo salio malSe <code class="highlighter-rouge">No Se Actualizaron sus Datos</code> intentelo nuevamente<br>Gracias
                              <br><br>
                          </font>
                        </td>
                      </tr>

                      <tr>
                        <td align="left" colspan="2">
                          <font size="-1">
                              <a href="index.php" target="_self">
                                <button type="submit" class="btn btn-danger" >Continuar&nbsp;&nbsp;<i class="fe-check-circle"></i></button>
                              </a>
                          </font>
                        </td>
                      </tr>
                    </thead>
                  </table-->';
                }
              ?>
            </tr>
          </thead>
        </table>
      </div>
    </div>
  </body>
</html>