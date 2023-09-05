<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

$fecha = date('Y-m-d H:i:s');

//$get_ci   =$_GET['ndoc'];
//$get_mail =$_GET['email'];

$get_ci   =$_POST['nit_ci2'];
$get_mail =$_POST['mail2'];

/**

*/
$urlD   ='http://becom.comteco.com.bo:8081/api/bss/getCouponByDocument'; 
        $methodD     = 'GET';
        $ContCupon = 0;
        $conexionD   = curl_init($urlD);
        $curlOptionD =  array(
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => $methodD,
          CURLOPT_POSTFIELDS =>'{
            "document": "'.$get_ci.'"
        }',
          CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json'
          ),
        );

        curl_setopt_array($conexionD, $curlOptionD);
        $responseD   = curl_exec($conexionD);
        $cadenaD     = json_decode($responseD);

        $msgErrorD   = $cadenaD->{'msgError'};
        $cErrorD     = $cadenaD->{'codError'};
        $CouponByPersons = $cadenaD->{'coupons'};
        $RazonSocial     = $cadenaD->{'document'};

        $message = '';

        $message .= '<B>'.$cadenaD->{'name'}.'</B><br>';
        $message .= 'Documento Nro.: <B>'.$cadenaD->{'document'}.'</B>&nbsp;&nbsp;|&nbsp;&nbsp;Celular Nro.: <B>'.$cadenaD->{'movil'}.'</B><br>';
        $message .= 'Correo Electronico: <B>'.$cadenaD->{'email'}.'</B><br><br>';
        $message .= 'Tiene la siguiente lista de Cupones Habilitados: <Br>';
        foreach($CouponByPersons as $CBP)
        {
          //$ContCupon ++;
          //$message .= '<B>Cupon</B> Nro.'.$ContCupon.': <B>'.$CBP->{'numCoupon'}.'</B><br>';
          $message .= '<B>Cupon</B> Nro.: <B>'.$CBP->{'numCoupon'}.'</B><br>';
          $DateC_Fec =substr($CBP->{'date'}, 0, 10).'<br>';
          $DateC_Hr  =substr($CBP->{'date'}, -13, 9).'<br>';
          $message .= 'Habilitado a las '.$DateC_Hr.' en Fecha: '.$DateC_Fec.'<br>';
        }

        //$message .= '<hr style="height:1px;border-width:0;background-color:black"><br><font size="-1">Esta promoci&oacuten esta Autorizada & Fiscalizada por la <b>Autoridad de Juegos AJ</b></font><br>';
        $message .= '<h4 class="header-title">Comteco ... #ConectadosSiempre</h4>
                     <font size="-1">Gracias por tu Puntualidad y Participaci&oacuten!...
                     <br>Esta promoci&oacuten esta Autorizada & Fiscalizada por la <b>Autoridad de Juegos AJ</b></font><br><br>';
        $message .= '<font size="-2">
                      Habilitacion de Cupones, hasta las 23:59 pm del 28 de marzo del 2023
                      <br>Sorteo, 30 de marzo del 2023 en Comteco Av. Ballivian - El Prado a horas 10:00 am
                      &nbsp;&nbsp;|&nbsp;&nbsp;Entrega de premio, 31 de marzo del 2023 en Comteco Av. Ballivian - El Prado a horas 10:00 am</font><br>';
/**

*/
$mail = new PHPMailer();
$mail->IsSMTP();
$mail->Mailer = "smtp";                             // Passing `true` enables exceptions

//Server settings
//$mail->SMTPDebug  = 1;
$mail->SMTPAuth   = TRUE; //solo para servidores externos

$mail->SMTPSecure = "tls";
$mail->Port       = 25; //NUEVO OFICIAL/
$mail->Host       = "outlook.office365.com";        // OFICIAL  IMAP
$mail->Username   = "facturas1@comtecoRL.onmicrosoft.com";    // NUEVO OFICIAL
$mail->Password   = "Comt3c0.";   // OFICIAL

//$mail->IsHTML(true);
//$mail->AddAddress("jtoro@comteco.com.bo", "recipient-name");
$mail->SetFrom("facturas1@comtecoRL.onmicrosoft.com", "Cupones COMTECO");
$mail->Subject = " COMTECO";
$mail->Subject = "Cupones COMTECO";


$subject = 'Cupones Comteco R.L.';

$mail->Sender = 'customercmt@gmail.com';

$mail->Subject = $subject; 

$mail->MsgHTML($message);

$mail->AddAddress($get_mail, "");

$content  = $message;

$mail->MsgHTML($content);

    if(!$mail->Send()) 
    {
       	echo "Error! ...Algo salio mal mientras se enviaba el correo.";
        var_dump($mail);
        $mail->ErrorInfo;

    } 
    else 
    {
        echo "<script>alert('Correo enviado satisfactoriamente !!');window.location.href='index.php';</script>";
        $mail->ErrorInfo;
    }
?>