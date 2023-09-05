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
                
                $subscriberId_in = trim($_POST['suscr_id']);
                $subscriberCi_in = trim($_POST['ci_id']);
                $cellPhone_in    = trim($_POST['newval_nro_cel']);
                $email_in        = trim($_POST['newval_email']);

                if($_POST['newval_email'] === "")
                {
                  $email_in = "sin_correo_electronico";
                }

                $username ='jtoro';
                $password ='jt0r0..';

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
                $keyHandleIS=$cadena->{'keyHandle'};


                $url = 'https://becom.comteco.com.bo:8181/xapi/updateDataSubs/'.$subscriberId_in.'?email='.$email_in.'&cellPhone='.$cellPhone_in; 
                $method = 'PUT';
                $conexion = curl_init($url);
                $curlOption = array(
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
                    CURLOPT_CUSTOMREQUEST => $method
                );
                curl_setopt_array($conexion, $curlOption);
                $response = curl_exec($conexion);
                $cadena= json_decode($response);

                $naturalPersonsErrDet =$cadena->{'errorDetail'};

                // +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
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
                      "document": "'.$subscriberCi_in.'",
                      "email": "'.$email_in.'",
                      "movil": "'.$cellPhone_in.'"
                  }',
                  CURLOPT_HTTPHEADER => array(
                    'Content-Type: application/json'
                  ),
                );
                curl_setopt_array($conexionS, $curlOptionS);
                $responseS = curl_exec($conexionS);
                $cadenaS   = json_decode($responseS);

                $updateCoupons =$cadenaS->{'msg_error'};

                if(($updateCoupons == "OK") && ($naturalPersonsErrDet == "OK"))
                {
                  echo '<script>window.location.href="cupon_controller.php?data_ci='.$subscriberCi_in.'";</script>';
                  /*echo '<script>alert("Sus datos han sido validados de forma correcta!!");window.location.href="cupon_controller.php?data_ci='.$subscriberCi_in.'";</script>';*/
                }
              ?>
            </tr>
          </thead>
        </table>
      </div>
    </div>
  </body>
</html>