<?php
class ApiSend{

	public function SendLicense($id){

		$license = License::model()->findByPk($id);

		$supervisor = Supervisor::model()->findByPk($license->supervisor_id);

		$employeeSol = Employee::model()->findByPk($license->employee_id);

		$employeeSolInfo = EmployeePublic::model()->findByAttributes(array('employee_id'=>$employeeSol->id));

		$employeeAuth = Employee::model()->findByAttributes(array('item'=>$supervisor->item));

		$employeeAuthInfo = EmployeePublic::model()->findByAttributes(array('employee_id'=>$employeeAuth->id));		

		if($employeeSolInfo->email != null){

			$emailsol = $employeeSolInfo->email;

		}else{	

			$employeeSolInfoPer = EmployeePersonal::model()->findByAttributes(array('employee_id'=>$employeeSol->id));

			if($employeeSolInfoPer->email != null){

				$emailsol = $employeeSolInfoPer->email;

			}else{
				$emailsol = 0;
			}
		}



		if($employeeAuthInfo->email != null){

			$emailAuth = $employeeAuthInfo->email;

		}else{

			$employeeAuthInfoPer = EmployeePersonal::model()->findByAttributes(array('employee_id'=>$employeeAuth->id));

			if($employeeAuthInfoPer->email != null){

				$emailAuth = $employeeAuthInfoPer->email;

			}else{
				$emailAuth = 0;	
			}

		}

		$respuestaAuth = '';

		$respuestaSol = '';

		if($emailsol != '0'){

			$messageSol = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional //EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

				<html xmlns="http://www.w3.org/1999/xhtml" xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:v="urn:schemas-microsoft-com:vml">
				<head>
				<!--[if gte mso 9]><xml><o:OfficeDocumentSettings><o:AllowPNG/><o:PixelsPerInch>96</o:PixelsPerInch></o:OfficeDocumentSettings></xml><![endif]-->
				<meta content="text/html; charset=utf-8" http-equiv="Content-Type"/>
				<meta content="width=device-width" name="viewport"/>
				<!--[if !mso]><!-->
				<meta content="IE=edge" http-equiv="X-UA-Compatible"/>
				<!--<![endif]-->
				<title></title>
				<!--[if !mso]><!-->
				<!--<![endif]-->
				<style type="text/css">
						body {
							margin: 0;
							padding: 0;
						}

						table,
						td,
						tr {
							vertical-align: top;
							border-collapse: collapse;
						}

						* {
							line-height: inherit;
						}

						a[x-apple-data-detectors=true] {
							color: inherit !important;
							text-decoration: none !important;
						}
					</style>
				<style id="media-query" type="text/css">
						@media (max-width: 720px) {

							.block-grid,
							.col {
								min-width: 320px !important;
								max-width: 100% !important;
								display: block !important;
							}

							.block-grid {
								width: 100% !important;
							}

							.col {
								width: 100% !important;
							}

							.col_cont {
								margin: 0 auto;
							}

							img.fullwidth,
							img.fullwidthOnMobile {
								max-width: 100% !important;
							}

							.no-stack .col {
								min-width: 0 !important;
								display: table-cell !important;
							}

							.no-stack.two-up .col {
								width: 50% !important;
							}

							.no-stack .col.num2 {
								width: 16.6% !important;
							}

							.no-stack .col.num3 {
								width: 25% !important;
							}

							.no-stack .col.num4 {
								width: 33% !important;
							}

							.no-stack .col.num5 {
								width: 41.6% !important;
							}

							.no-stack .col.num6 {
								width: 50% !important;
							}

							.no-stack .col.num7 {
								width: 58.3% !important;
							}

							.no-stack .col.num8 {
								width: 66.6% !important;
							}

							.no-stack .col.num9 {
								width: 75% !important;
							}

							.no-stack .col.num10 {
								width: 83.3% !important;
							}

							.video-block {
								max-width: none !important;
							}

							.mobile_hide {
								min-height: 0px;
								max-height: 0px;
								max-width: 0px;
								display: none;
								overflow: hidden;
								font-size: 0px;
							}

							.desktop_hide {
								display: block !important;
								max-height: none !important;
							}
						}
					</style>
				</head>
				<body class="clean-body" style="margin: 0; padding: 0; -webkit-text-size-adjust: 100%; background-color: #f9f9f9;">
				<!--[if IE]><div class="ie-browser"><![endif]-->
				<table bgcolor="#f9f9f9" cellpadding="0" cellspacing="0" class="nl-container" role="presentation" style="table-layout: fixed; vertical-align: top; min-width: 320px; border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #f9f9f9; width: 100%;" valign="top" width="100%">
				<tbody>
				<tr style="vertical-align: top;" valign="top">
				<td style="word-break: break-word; vertical-align: top;" valign="top">
				<!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td align="center" style="background-color:#f9f9f9"><![endif]-->
				<div style="background-color:transparent;">
				<div class="block-grid two-up no-stack" style="min-width: 320px; max-width: 700px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; Margin: 0 auto; background-color: transparent;">
				<div style="border-collapse: collapse;display: table;width: 100%;background-color:transparent;">
				<!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color:transparent;"><tr><td align="center"><table cellpadding="0" cellspacing="0" border="0" style="width:700px"><tr class="layout-full-width" style="background-color:transparent"><![endif]-->
				<!--[if (mso)|(IE)]><td align="center" width="350" style="background-color:transparent;width:350px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;" valign="top"><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 0px; padding-left: 0px; padding-top:5px; padding-bottom:5px;"><![endif]-->
				<div class="col num6" style="display: table-cell; vertical-align: top; max-width: 320px; min-width: 348px; width: 350px;">
				<div class="col_cont" style="width:100% !important;">
				<!--[if (!mso)&(!IE)]><!-->
				<div style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:5px; padding-bottom:5px; padding-right: 0px; padding-left: 0px;">
				<!--<![endif]-->
				<div align="left" class="img-container left fixedwidth" style="padding-right: 0px;padding-left: 25px;">
				<!--[if mso]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr style="line-height:0px"><td style="padding-right: 0px;padding-left: 25px;" align="left"><![endif]--><img alt="Alternate text" border="0" class="left fixedwidth" src="https://portal.comteco.com.bo/images/0650149b-5589-4827-88da-4a4c98cbea2d.png" style="text-decoration: none; -ms-interpolation-mode: bicubic; height: auto; border: 0; width: 100%; max-width: 245px; display: block;" title="Alternate text" width="245"/>
				<!--[if mso]></td></tr></table><![endif]-->
				</div>
				<!--[if (!mso)&(!IE)]><!-->
				</div>
				<!--<![endif]-->
				</div>
				</div>
				<!--[if (mso)|(IE)]></td></tr></table><![endif]-->
				<!--[if (mso)|(IE)]></td><td align="center" width="350" style="background-color:transparent;width:350px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;" valign="top"><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 0px; padding-left: 0px; padding-top:5px; padding-bottom:5px;"><![endif]-->
				<div class="col num6" style="display: table-cell; vertical-align: top; max-width: 320px; min-width: 348px; width: 350px;">
				<div class="col_cont" style="width:100% !important;">
				<!--[if (!mso)&(!IE)]><!-->
				<div style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:5px; padding-bottom:5px; padding-right: 0px; padding-left: 0px;">
				<!--<![endif]-->
				<!--[if mso]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 10px; padding-left: 10px; padding-top: 10px; padding-bottom: 10px; font-family: Tahoma, sans-serif"><![endif]-->
				<div style="color:#555555;font-family:Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif;line-height:1.2;padding-top:10px;padding-right:10px;padding-bottom:10px;padding-left:10px;">
				<div style="line-height: 1.2; font-size: 12px; color: #555555; font-family: Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif; mso-line-height-alt: 14px;">
				<p style="text-align: right; line-height: 1.2; word-break: break-word; mso-line-height-alt: 14px; margin: 0;">Portal COMTECO R.L.</p>
				<p style="text-align: right; line-height: 1.2; word-break: break-word; mso-line-height-alt: 14px; margin: 0;">Contacto: Int. 270</p>
				<p style="text-align: right; line-height: 1.2; word-break: break-word; mso-line-height-alt: 14px; margin: 0;">Divisi&oacute;n de Tecnolog&iacute;as de Informaci&oacute;n</p>
				</div>
				</div>
				<!--[if mso]></td></tr></table><![endif]-->
				<!--[if (!mso)&(!IE)]><!-->
				</div>
				<!--<![endif]-->
				</div>
				</div>
				<!--[if (mso)|(IE)]></td></tr></table><![endif]-->
				<!--[if (mso)|(IE)]></td></tr></table></td></tr></table><![endif]-->
				</div>
				</div>
				</div>
				<div style="background-color:transparent;">
				<div class="block-grid" style="min-width: 320px; max-width: 700px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; Margin: 0 auto; background-color: #ffffff;">
				<div style="border-collapse: collapse;display: table;width: 100%;background-color:#ffffff;">
				<!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color:transparent;"><tr><td align="center"><table cellpadding="0" cellspacing="0" border="0" style="width:700px"><tr class="layout-full-width" style="background-color:#ffffff"><![endif]-->
				<!--[if (mso)|(IE)]><td align="center" width="700" style="background-color:#ffffff;width:700px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;" valign="top"><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 0px; padding-left: 0px; padding-top:0px; padding-bottom:0px;"><![endif]-->
				<div class="col num12" style="min-width: 320px; max-width: 700px; display: table-cell; vertical-align: top; width: 700px;">
				<div class="col_cont" style="width:100% !important;">
				<!--[if (!mso)&(!IE)]><!-->
				<div style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:0px; padding-bottom:0px; padding-right: 0px; padding-left: 0px;">
				<!--<![endif]-->
				<div align="center" class="img-container center autowidth" style="padding-right: 0px;padding-left: 0px;">
				
				</div>
				<!--[if (!mso)&(!IE)]><!-->
				</div>
				<!--<![endif]-->
				</div>
				</div>
				<!--[if (mso)|(IE)]></td></tr></table><![endif]-->
				<!--[if (mso)|(IE)]></td></tr></table></td></tr></table><![endif]-->
				</div>
				</div>
				</div>
				<div style="background-color:transparent;">
				<div class="block-grid" style="min-width: 320px; max-width: 700px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; Margin: 0 auto; background-color: #ffffff;">
				<div style="border-collapse: collapse;display: table;width: 100%;background-color:#ffffff;">
				<!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color:transparent;"><tr><td align="center"><table cellpadding="0" cellspacing="0" border="0" style="width:700px"><tr class="layout-full-width" style="background-color:#ffffff"><![endif]-->
				<!--[if (mso)|(IE)]><td align="center" width="700" style="background-color:#ffffff;width:700px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;" valign="top"><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 0px; padding-left: 0px; padding-top:5px; padding-bottom:5px;"><![endif]-->
				<div class="col num12" style="min-width: 320px; max-width: 700px; display: table-cell; vertical-align: top; width: 700px;">
				<div class="col_cont" style="width:100% !important;">
				<!--[if (!mso)&(!IE)]><!-->
				<div style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:5px; padding-bottom:5px; padding-right: 0px; padding-left: 0px;">
				<!--<![endif]-->
				<!--[if mso]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 10px; padding-left: 10px; padding-top: 25px; padding-bottom: 20px; font-family: Tahoma, sans-serif"><![endif]-->
				<div style="color:#0b1560;font-family:Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif;line-height:1.2;padding-top:25px;padding-right:10px;padding-bottom:20px;padding-left:10px;">
				<div style="line-height: 1.2; font-size: 12px; font-family: Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif; color: #0b1560; mso-line-height-alt: 14px;">
				<p style="font-size: 18px; line-height: 1.2; text-align: center; word-break: break-word; font-family: Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif; mso-line-height-alt: 22px; margin: 0;"><span style="font-size: 18px;"><strong>Solicitud de Permiso</strong></span></p>
				</div>
				</div>
				<!--[if mso]></td></tr></table><![endif]-->
				<!--[if mso]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 30px; padding-left: 30px; padding-top: 10px; padding-bottom: 25px; font-family: Tahoma, sans-serif"><![endif]-->
				<div style="color:#555555;font-family:Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif;line-height:1.5;padding-top:10px;padding-right:30px;padding-bottom:25px;padding-left:30px;">
				<div style="line-height: 1.5; font-size: 12px; font-family: Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif; color: #555555; mso-line-height-alt: 18px;">
				<p style="font-size: 15px; line-height: 1.5; text-align: center; word-break: break-word; font-family: Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif; mso-line-height-alt: 23px; margin: 0;"><span style="font-size: 15px;">Estimado/a '.$employeeSol->name.' usted realizo una solicitud de permiso, a continuaci&oacute;n se detalla la solicitud de permiso:</span></p>
				<p style="font-size: 15px; line-height: 1.5; text-align: center; word-break: break-word; font-family: Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif; mso-line-height-alt: 23px; margin: 0;"><span style="font-size: 15px;">Solicitante: '.$employeeSol->name.'<br/>Fecha Inicio: '.date('d/m/Y H:i',strtotime($license->date_start)).'<br/>Fecha Fin: '.date('d/m/Y H:i',strtotime($license->date_end)).'<br/>Fecha Retorno: '.date('d/m/Y H:i',strtotime($license->date_return)).'<br/>D&iacute;as: '.$license->days.' - Horas: '.$license->hours.' - Minutos: '.$license->minutes.'<br/>Observaci&oacute;n: '.$license->observation_sol.'<br/><br/>Jefe Inmediato: '.$employeeAuth->name.'<br/>Estado: Pendiente</span></p>
				<p style="font-size: 15px; line-height: 1.5; text-align: center; word-break: break-word; font-family: Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif; mso-line-height-alt: 23px; margin: 0;"><span style="font-size: 15px;">Una vez aprobada o rechazada su solicitud recibira una confirmaci&oacute;n por correo electronico.</span></p>
				</div>
				</div>
				<!--[if mso]></td></tr></table><![endif]-->
				<!--[if (!mso)&(!IE)]><!-->
				</div>
				<!--<![endif]-->
				</div>
				</div>
				<!--[if (mso)|(IE)]></td></tr></table><![endif]-->
				<!--[if (mso)|(IE)]></td></tr></table></td></tr></table><![endif]-->
				</div>
				</div>
				</div>
				<div style="background-color:transparent;">
				<div class="block-grid" style="min-width: 320px; max-width: 700px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; Margin: 0 auto; background-color: #ffffff;">
				<div style="border-collapse: collapse;display: table;width: 100%;background-color:#ffffff;">
				<!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color:transparent;"><tr><td align="center"><table cellpadding="0" cellspacing="0" border="0" style="width:700px"><tr class="layout-full-width" style="background-color:#ffffff"><![endif]-->
				<!--[if (mso)|(IE)]><td align="center" width="700" style="background-color:#ffffff;width:700px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;" valign="top"><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 0px; padding-left: 0px; padding-top:5px; padding-bottom:5px;"><![endif]-->
				<div class="col num12" style="min-width: 320px; max-width: 700px; display: table-cell; vertical-align: top; width: 700px;">
				<div class="col_cont" style="width:100% !important;">
				<!--[if (!mso)&(!IE)]><!-->
				<div style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:5px; padding-bottom:5px; padding-right: 0px; padding-left: 0px;">
				<!--<![endif]-->
				<table border="0" cellpadding="0" cellspacing="0" class="divider" role="presentation" style="table-layout: fixed; vertical-align: top; border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; min-width: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;" valign="top" width="100%">
				<tbody>
				<tr style="vertical-align: top;" valign="top">
				<td class="divider_inner" style="word-break: break-word; vertical-align: top; min-width: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; padding-top: 10px; padding-right: 10px; padding-bottom: 10px; padding-left: 10px;" valign="top">
				<table align="center" border="0" cellpadding="0" cellspacing="0" class="divider_content" height="1" role="presentation" style="table-layout: fixed; vertical-align: top; border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-top: 1px solid #DDE3E8; height: 1px; width: 95%;" valign="top" width="95%">
				<tbody>
				<tr style="vertical-align: top;" valign="top">
				<td height="1" style="word-break: break-word; vertical-align: top; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;" valign="top"><span></span></td>
				</tr>
				</tbody>
				</table>
				</td>
				</tr>
				</tbody>
				</table>
				<!--[if (!mso)&(!IE)]><!-->
				</div>
				<!--<![endif]-->
				</div>
				</div>
				<!--[if (mso)|(IE)]></td></tr></table><![endif]-->
				<!--[if (mso)|(IE)]></td></tr></table></td></tr></table><![endif]-->
				</div>
				</div>
				</div>
				<div style="background-color:transparent;">
				<div class="block-grid" style="min-width: 320px; max-width: 700px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; Margin: 0 auto; background-color: #ffffff;">
				<div style="border-collapse: collapse;display: table;width: 100%;background-color:#ffffff;">
				<!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color:transparent;"><tr><td align="center"><table cellpadding="0" cellspacing="0" border="0" style="width:700px"><tr class="layout-full-width" style="background-color:#ffffff"><![endif]-->
				<!--[if (mso)|(IE)]><td align="center" width="700" style="background-color:#ffffff;width:700px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;" valign="top"><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 0px; padding-left: 0px; padding-top:5px; padding-bottom:5px;"><![endif]-->
				<div class="col num12" style="min-width: 320px; max-width: 700px; display: table-cell; vertical-align: top; width: 700px;">
				<div class="col_cont" style="width:100% !important;">
				<!--[if (!mso)&(!IE)]><!-->
				<div style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:5px; padding-bottom:5px; padding-right: 0px; padding-left: 0px;">
				<!--<![endif]-->
				<!--[if mso]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 10px; padding-left: 10px; padding-top: 10px; padding-bottom: 10px; font-family: Tahoma, sans-serif"><![endif]-->
				<div style="color:#555555;font-family:Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif;line-height:1.2;padding-top:10px;padding-right:10px;padding-bottom:10px;padding-left:10px;">
				<div style="line-height: 1.2; font-size: 12px; color: #555555; font-family: Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif; mso-line-height-alt: 14px;">
				<p style="font-size: 14px; line-height: 1.2; word-break: break-word; text-align: center; mso-line-height-alt: 17px; margin: 0;">NOTA: En caso de haber registrado mal la solicitud, registre nuevamente e indique a su jefe inmediato que anule esta solicitud.</p>
				</div>
				</div>
				<!--[if mso]></td></tr></table><![endif]-->
				<!--[if (!mso)&(!IE)]><!-->
				</div>
				<!--<![endif]-->
				</div>
				</div>
				<!--[if (mso)|(IE)]></td></tr></table><![endif]-->
				<!--[if (mso)|(IE)]></td></tr></table></td></tr></table><![endif]-->
				</div>
				</div>
				</div>
				<div style="background-color:transparent;">
				<div class="block-grid" style="min-width: 320px; max-width: 700px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; Margin: 0 auto; background-color: #bd0000;">
				<div style="border-collapse: collapse;display: table;width: 100%;background-color:#bd0000;">
				<!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color:transparent;"><tr><td align="center"><table cellpadding="0" cellspacing="0" border="0" style="width:700px"><tr class="layout-full-width" style="background-color:#bd0000"><![endif]-->
				<!--[if (mso)|(IE)]><td align="center" width="700" style="background-color:#bd0000;width:700px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;" valign="top"><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 0px; padding-left: 0px; padding-top:5px; padding-bottom:5px;"><![endif]-->
				<div class="col num12" style="min-width: 320px; max-width: 700px; display: table-cell; vertical-align: top; width: 700px;">
				<div class="col_cont" style="width:100% !important;">
				<!--[if (!mso)&(!IE)]><!-->
				<div style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:5px; padding-bottom:5px; padding-right: 0px; padding-left: 0px;">
				<!--<![endif]-->
				<!--[if mso]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 10px; padding-left: 10px; padding-top: 10px; padding-bottom: 10px; font-family: Tahoma, sans-serif"><![endif]-->
				<div style="color:#555555;font-family:Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif;line-height:1.2;padding-top:10px;padding-right:10px;padding-bottom:10px;padding-left:10px;">
				<div style="line-height: 1.2; font-size: 12px; color: #555555; font-family: Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif; mso-line-height-alt: 14px;">
				<p style="font-size: 14px; line-height: 1.2; word-break: break-word; text-align: center; mso-line-height-alt: 17px; margin: 0;"><strong><span style="color: #ffffff; font-size: 16px;"><a href="https://portal.comteco.com.bo" rel="noopener" style="text-decoration: underline; color: #ffffff;" target="_blank" title="Portal COMTECO R.L.">Portal COMTECO R.L.</a></span></strong></p>
				</div>
				</div>
				<!--[if mso]></td></tr></table><![endif]-->
				<!--[if (!mso)&(!IE)]><!-->
				</div>
				<!--<![endif]-->
				</div>
				</div>
				<!--[if (mso)|(IE)]></td></tr></table><![endif]-->
				<!--[if (mso)|(IE)]></td></tr></table></td></tr></table><![endif]-->
				</div>
				</div>
				</div>
				<!--[if (mso)|(IE)]></td></tr></table><![endif]-->
				</td>
				</tr>
				</tbody>
				</table>
				<!--[if (IE)]></div><![endif]-->
				</body>
				</html>';


			$mailSol = Yii::app()->Smtpmail;

	        $mailSol->addReplyTo('no-reply@comteco.com.bo', 'COMTECO R.L.');

	        

	        //$mailSol->SetFrom('no-reply@comteco.com.bo', 'COMTECO R.L.');
	    
	        //$mailSol->Sender = 'no-reply@comteco.com.bo';

       		$mailSol->SetFrom('notificaciones@comtecoRL.onmicrosoft.com', 'COMTECO R.L.');
    
        	$mailSol->Sender = 'notificaciones@comtecoRL.onmicrosoft.com';

            $mailSol->AddBCC('portal.comteco@gmail.com');

	        $mailSol->Subject = "Solicitud de Permiso COMTECO R.L.";

	        $mailSol->MsgHTML($messageSol);

	        $mailSol->AddAddress($emailsol, "");

	        if(!$mailSol->Send()) {
	            $mailSol->ClearAllRecipients();
	            $mailSol->SmtpClose();
	            $respuestaSol = $mailSol->ErrorInfo;
	        }else {
				$mailSol->ClearAttachments();		            
	            $mailSol->ClearAllRecipients();
	            $mailSol->SmtpClose();
	            $respuestaSol = 'ok';
	        }
		}

		if($emailAuth != '0'){

			$messageAuth = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional //EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

				<html xmlns="http://www.w3.org/1999/xhtml" xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:v="urn:schemas-microsoft-com:vml">
				<head>
				<!--[if gte mso 9]><xml><o:OfficeDocumentSettings><o:AllowPNG/><o:PixelsPerInch>96</o:PixelsPerInch></o:OfficeDocumentSettings></xml><![endif]-->
				<meta content="text/html; charset=utf-8" http-equiv="Content-Type"/>
				<meta content="width=device-width" name="viewport"/>
				<!--[if !mso]><!-->
				<meta content="IE=edge" http-equiv="X-UA-Compatible"/>
				<!--<![endif]-->
				<title></title>
				<!--[if !mso]><!-->
				<!--<![endif]-->
				<style type="text/css">
						body {
							margin: 0;
							padding: 0;
						}

						table,
						td,
						tr {
							vertical-align: top;
							border-collapse: collapse;
						}

						* {
							line-height: inherit;
						}

						a[x-apple-data-detectors=true] {
							color: inherit !important;
							text-decoration: none !important;
						}
					</style>
				<style id="media-query" type="text/css">
						@media (max-width: 720px) {

							.block-grid,
							.col {
								min-width: 320px !important;
								max-width: 100% !important;
								display: block !important;
							}

							.block-grid {
								width: 100% !important;
							}

							.col {
								width: 100% !important;
							}

							.col_cont {
								margin: 0 auto;
							}

							img.fullwidth,
							img.fullwidthOnMobile {
								max-width: 100% !important;
							}

							.no-stack .col {
								min-width: 0 !important;
								display: table-cell !important;
							}

							.no-stack.two-up .col {
								width: 50% !important;
							}

							.no-stack .col.num2 {
								width: 16.6% !important;
							}

							.no-stack .col.num3 {
								width: 25% !important;
							}

							.no-stack .col.num4 {
								width: 33% !important;
							}

							.no-stack .col.num5 {
								width: 41.6% !important;
							}

							.no-stack .col.num6 {
								width: 50% !important;
							}

							.no-stack .col.num7 {
								width: 58.3% !important;
							}

							.no-stack .col.num8 {
								width: 66.6% !important;
							}

							.no-stack .col.num9 {
								width: 75% !important;
							}

							.no-stack .col.num10 {
								width: 83.3% !important;
							}

							.video-block {
								max-width: none !important;
							}

							.mobile_hide {
								min-height: 0px;
								max-height: 0px;
								max-width: 0px;
								display: none;
								overflow: hidden;
								font-size: 0px;
							}

							.desktop_hide {
								display: block !important;
								max-height: none !important;
							}
						}
					</style>
				</head>
				<body class="clean-body" style="margin: 0; padding: 0; -webkit-text-size-adjust: 100%; background-color: #f9f9f9;">
				<!--[if IE]><div class="ie-browser"><![endif]-->
				<table bgcolor="#f9f9f9" cellpadding="0" cellspacing="0" class="nl-container" role="presentation" style="table-layout: fixed; vertical-align: top; min-width: 320px; border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #f9f9f9; width: 100%;" valign="top" width="100%">
				<tbody>
				<tr style="vertical-align: top;" valign="top">
				<td style="word-break: break-word; vertical-align: top;" valign="top">
				<!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td align="center" style="background-color:#f9f9f9"><![endif]-->
				<div style="background-color:transparent;">
				<div class="block-grid two-up no-stack" style="min-width: 320px; max-width: 700px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; Margin: 0 auto; background-color: transparent;">
				<div style="border-collapse: collapse;display: table;width: 100%;background-color:transparent;">
				<!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color:transparent;"><tr><td align="center"><table cellpadding="0" cellspacing="0" border="0" style="width:700px"><tr class="layout-full-width" style="background-color:transparent"><![endif]-->
				<!--[if (mso)|(IE)]><td align="center" width="350" style="background-color:transparent;width:350px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;" valign="top"><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 0px; padding-left: 0px; padding-top:5px; padding-bottom:5px;"><![endif]-->
				<div class="col num6" style="display: table-cell; vertical-align: top; max-width: 320px; min-width: 348px; width: 350px;">
				<div class="col_cont" style="width:100% !important;">
				<!--[if (!mso)&(!IE)]><!-->
				<div style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:5px; padding-bottom:5px; padding-right: 0px; padding-left: 0px;">
				<!--<![endif]-->
				<div align="left" class="img-container left fixedwidth" style="padding-right: 0px;padding-left: 25px;">
				<!--[if mso]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr style="line-height:0px"><td style="padding-right: 0px;padding-left: 25px;" align="left"><![endif]--><img alt="Alternate text" border="0" class="left fixedwidth" src="https://portal.comteco.com.bo/images/0650149b-5589-4827-88da-4a4c98cbea2d.png" style="text-decoration: none; -ms-interpolation-mode: bicubic; height: auto; border: 0; width: 100%; max-width: 245px; display: block;" title="Alternate text" width="245"/>
				<!--[if mso]></td></tr></table><![endif]-->
				</div>
				<!--[if (!mso)&(!IE)]><!-->
				</div>
				<!--<![endif]-->
				</div>
				</div>
				<!--[if (mso)|(IE)]></td></tr></table><![endif]-->
				<!--[if (mso)|(IE)]></td><td align="center" width="350" style="background-color:transparent;width:350px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;" valign="top"><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 0px; padding-left: 0px; padding-top:5px; padding-bottom:5px;"><![endif]-->
				<div class="col num6" style="display: table-cell; vertical-align: top; max-width: 320px; min-width: 348px; width: 350px;">
				<div class="col_cont" style="width:100% !important;">
				<!--[if (!mso)&(!IE)]><!-->
				<div style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:5px; padding-bottom:5px; padding-right: 0px; padding-left: 0px;">
				<!--<![endif]-->
				<!--[if mso]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 10px; padding-left: 10px; padding-top: 10px; padding-bottom: 10px; font-family: Tahoma, sans-serif"><![endif]-->
				<div style="color:#555555;font-family:Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif;line-height:1.2;padding-top:10px;padding-right:10px;padding-bottom:10px;padding-left:10px;">
				<div style="line-height: 1.2; font-size: 12px; color: #555555; font-family: Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif; mso-line-height-alt: 14px;">
				<p style="text-align: right; line-height: 1.2; word-break: break-word; mso-line-height-alt: 14px; margin: 0;">Portal COMTECO R.L.</p>
				<p style="text-align: right; line-height: 1.2; word-break: break-word; mso-line-height-alt: 14px; margin: 0;">Contacto: Int. 270</p>
				<p style="text-align: right; line-height: 1.2; word-break: break-word; mso-line-height-alt: 14px; margin: 0;">Divisi&oacute;n de Tecnolog&iacute;as de Informaci&oacute;n</p>
				</div>
				</div>
				<!--[if mso]></td></tr></table><![endif]-->
				<!--[if (!mso)&(!IE)]><!-->
				</div>
				<!--<![endif]-->
				</div>
				</div>
				<!--[if (mso)|(IE)]></td></tr></table><![endif]-->
				<!--[if (mso)|(IE)]></td></tr></table></td></tr></table><![endif]-->
				</div>
				</div>
				</div>
				<div style="background-color:transparent;">
				<div class="block-grid" style="min-width: 320px; max-width: 700px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; Margin: 0 auto; background-color: #ffffff;">
				<div style="border-collapse: collapse;display: table;width: 100%;background-color:#ffffff;">
				<!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color:transparent;"><tr><td align="center"><table cellpadding="0" cellspacing="0" border="0" style="width:700px"><tr class="layout-full-width" style="background-color:#ffffff"><![endif]-->
				<!--[if (mso)|(IE)]><td align="center" width="700" style="background-color:#ffffff;width:700px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;" valign="top"><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 0px; padding-left: 0px; padding-top:0px; padding-bottom:0px;"><![endif]-->
				<div class="col num12" style="min-width: 320px; max-width: 700px; display: table-cell; vertical-align: top; width: 700px;">
				<div class="col_cont" style="width:100% !important;">
				<!--[if (!mso)&(!IE)]><!-->
				<div style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:0px; padding-bottom:0px; padding-right: 0px; padding-left: 0px;">
				<!--<![endif]-->
				<div align="center" class="img-container center autowidth" style="padding-right: 0px;padding-left: 0px;">
				
				</div>
				<!--[if (!mso)&(!IE)]><!-->
				</div>
				<!--<![endif]-->
				</div>
				</div>
				<!--[if (mso)|(IE)]></td></tr></table><![endif]-->
				<!--[if (mso)|(IE)]></td></tr></table></td></tr></table><![endif]-->
				</div>
				</div>
				</div>
				<div style="background-color:transparent;">
				<div class="block-grid" style="min-width: 320px; max-width: 700px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; Margin: 0 auto; background-color: #ffffff;">
				<div style="border-collapse: collapse;display: table;width: 100%;background-color:#ffffff;">
				<!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color:transparent;"><tr><td align="center"><table cellpadding="0" cellspacing="0" border="0" style="width:700px"><tr class="layout-full-width" style="background-color:#ffffff"><![endif]-->
				<!--[if (mso)|(IE)]><td align="center" width="700" style="background-color:#ffffff;width:700px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;" valign="top"><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 0px; padding-left: 0px; padding-top:5px; padding-bottom:5px;"><![endif]-->
				<div class="col num12" style="min-width: 320px; max-width: 700px; display: table-cell; vertical-align: top; width: 700px;">
				<div class="col_cont" style="width:100% !important;">
				<!--[if (!mso)&(!IE)]><!-->
				<div style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:5px; padding-bottom:5px; padding-right: 0px; padding-left: 0px;">
				<!--<![endif]-->
				<!--[if mso]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 10px; padding-left: 10px; padding-top: 25px; padding-bottom: 20px; font-family: Tahoma, sans-serif"><![endif]-->
				<div style="color:#0b1560;font-family:Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif;line-height:1.2;padding-top:25px;padding-right:10px;padding-bottom:20px;padding-left:10px;">
				<div style="line-height: 1.2; font-size: 12px; font-family: Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif; color: #0b1560; mso-line-height-alt: 14px;">
				<p style="font-size: 18px; line-height: 1.2; text-align: center; word-break: break-word; font-family: Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif; mso-line-height-alt: 22px; margin: 0;"><span style="font-size: 18px;"><strong>Solicitud de Permiso</strong></span></p>
				</div>
				</div>
				<!--[if mso]></td></tr></table><![endif]-->
				<!--[if mso]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 30px; padding-left: 30px; padding-top: 10px; padding-bottom: 25px; font-family: Tahoma, sans-serif"><![endif]-->
				<div style="color:#555555;font-family:Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif;line-height:1.5;padding-top:10px;padding-right:30px;padding-bottom:25px;padding-left:30px;">
				<div style="line-height: 1.5; font-size: 12px; font-family: Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif; color: #555555; mso-line-height-alt: 18px;">
				<p style="font-size: 15px; line-height: 1.5; text-align: center; word-break: break-word; font-family: Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif; mso-line-height-alt: 23px; margin: 0;"><span style="font-size: 15px;">Estimado/a '.$employeeAuth->name.' el funcionario/a '.$employeeSol->name.' realizo una solicitud de permiso, a continuaci&oacute;n se detalla la solicitud de permiso:</span></p>
				<p style="font-size: 15px; line-height: 1.5; text-align: center; word-break: break-word; font-family: Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif; mso-line-height-alt: 23px; margin: 0;"><span style="font-size: 15px;">Solicitante: '.$employeeSol->name.'<br/>Fecha Inicio: '.date('d/m/Y H:i',strtotime($license->date_start)).'<br/>Fecha Fin: '.date('d/m/Y H:i',strtotime($license->date_end)).'<br/>Fecha Retorno: '.date('d/m/Y H:i',strtotime($license->date_return)).'<br/>D&iacute;as: '.$license->days.' - Horas: '.$license->hours.' - Minutos: '.$license->minutes.'<br/>Observaci&oacute;n: '.$license->observation_sol.'<br/><br/>Jefe Inmediato: '.$employeeAuth->name.'<br/>Estado: Pendiente</span></p>
				<p style="font-size: 14px; line-height: 1.5; text-align: center; word-break: break-word; font-family: Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif; mso-line-height-alt: 21px; margin: 0;"><span style=""><span style="font-size: 15px;">Para aprobar o rechazar el permiso, por favor </span></span><span style="font-size: 15px;">aqu&iacute;</span><span style=""><span style="font-size: 15px;"> click en el bot&oacute;n que tiene en la parte inferior, en caso de no funcionar el bot&oacute;n por favor hacer click en el enlace:</span></span></p>
				<p style="font-size: 14px; line-height: 1.5; text-align: center; word-break: break-word; font-family: Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif; mso-line-height-alt: 21px; margin: 0;"><br></p>
				<p style="font-size: 14px; line-height: 1.5; text-align: center; word-break: break-word; font-family: Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif; mso-line-height-alt: 21px; margin: 0;"><span style=""><span style="font-size: 15px;"><a href="'.Yii::app()->createAbsoluteUrl("profile/authorization").'" rel="noopener" style="text-decoration: underline;" target="_blank" title="Portal COMTECO">'.Yii::app()->createAbsoluteUrl("profile/authorization").'</a></span></span></p>
				</div>
				</div>
				<!--[if mso]></td></tr></table><![endif]-->
				<div align="center" class="button-container" style="padding-top:10px;padding-right:10px;padding-bottom:10px;padding-left:10px;">
				<!--[if mso]><table width="100%" cellpadding="0" cellspacing="0" border="0" style="border-spacing: 0; border-collapse: collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;"><tr><td style="padding-top: 10px; padding-right: 10px; padding-bottom: 10px; padding-left: 10px" align="center"><v:roundrect xmlns:v="urn:schemas-microsoft-com:vml" xmlns:w="urn:schemas-microsoft-com:office:word" href="'.Yii::app()->createAbsoluteUrl("profile/authorization").'" style="height:39pt; width:276.75pt; v-text-anchor:middle;" arcsize="8%" stroke="false" fillcolor="#d80000"><w:anchorlock/><v:textbox inset="0,0,0,0"><center style="color:#ffffff; font-family:Tahoma, sans-serif; font-size:16px"><![endif]--><a href="'.Yii::app()->createAbsoluteUrl("profile/authorization").'" style="-webkit-text-size-adjust: none; text-decoration: none; display: inline-block; color: #ffffff; background-color: #d80000; border-radius: 4px; -webkit-border-radius: 4px; -moz-border-radius: 4px; width: auto; width: auto; border-top: 1px solid #d80000; border-right: 1px solid #d80000; border-bottom: 1px solid #d80000; border-left: 1px solid #d80000; padding-top: 10px; padding-bottom: 10px; font-family: Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif; text-align: center; mso-border-alt: none; word-break: keep-all;" target="_blank"><span style="padding-left:60px;padding-right:55px;font-size:16px;display:inline-block;"><span style="font-size: 16px; margin: 0; line-height: 2; word-break: break-word; mso-line-height-alt: 32px;">Aprobar / Rechazar</span></span></a>
				<!--[if mso]></center></v:textbox></v:roundrect></td></tr></table><![endif]-->
				</div>
				<!--[if (!mso)&(!IE)]><!-->
				</div>
				<!--<![endif]-->
				</div>
				</div>
				<!--[if (mso)|(IE)]></td></tr></table><![endif]-->
				<!--[if (mso)|(IE)]></td></tr></table></td></tr></table><![endif]-->
				</div>
				</div>
				</div>
				<div style="background-color:transparent;">
				<div class="block-grid" style="min-width: 320px; max-width: 700px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; Margin: 0 auto; background-color: #ffffff;">
				<div style="border-collapse: collapse;display: table;width: 100%;background-color:#ffffff;">
				<!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color:transparent;"><tr><td align="center"><table cellpadding="0" cellspacing="0" border="0" style="width:700px"><tr class="layout-full-width" style="background-color:#ffffff"><![endif]-->
				<!--[if (mso)|(IE)]><td align="center" width="700" style="background-color:#ffffff;width:700px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;" valign="top"><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 0px; padding-left: 0px; padding-top:5px; padding-bottom:5px;"><![endif]-->
				<div class="col num12" style="min-width: 320px; max-width: 700px; display: table-cell; vertical-align: top; width: 700px;">
				<div class="col_cont" style="width:100% !important;">
				<!--[if (!mso)&(!IE)]><!-->
				<div style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:5px; padding-bottom:5px; padding-right: 0px; padding-left: 0px;">
				<!--<![endif]-->
				<table border="0" cellpadding="0" cellspacing="0" class="divider" role="presentation" style="table-layout: fixed; vertical-align: top; border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; min-width: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;" valign="top" width="100%">
				<tbody>
				<tr style="vertical-align: top;" valign="top">
				<td class="divider_inner" style="word-break: break-word; vertical-align: top; min-width: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; padding-top: 10px; padding-right: 10px; padding-bottom: 10px; padding-left: 10px;" valign="top">
				<table align="center" border="0" cellpadding="0" cellspacing="0" class="divider_content" height="1" role="presentation" style="table-layout: fixed; vertical-align: top; border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-top: 1px solid #DDE3E8; height: 1px; width: 95%;" valign="top" width="95%">
				<tbody>
				<tr style="vertical-align: top;" valign="top">
				<td height="1" style="word-break: break-word; vertical-align: top; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;" valign="top"><span></span></td>
				</tr>
				</tbody>
				</table>
				</td>
				</tr>
				</tbody>
				</table>
				<!--[if (!mso)&(!IE)]><!-->
				</div>
				<!--<![endif]-->
				</div>
				</div>
				<!--[if (mso)|(IE)]></td></tr></table><![endif]-->
				<!--[if (mso)|(IE)]></td></tr></table></td></tr></table><![endif]-->
				</div>
				</div>
				</div>
				<div style="background-color:transparent;">
				<div class="block-grid" style="min-width: 320px; max-width: 700px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; Margin: 0 auto; background-color: #ffffff;">
				<div style="border-collapse: collapse;display: table;width: 100%;background-color:#ffffff;">
				<!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color:transparent;"><tr><td align="center"><table cellpadding="0" cellspacing="0" border="0" style="width:700px"><tr class="layout-full-width" style="background-color:#ffffff"><![endif]-->
				<!--[if (mso)|(IE)]><td align="center" width="700" style="background-color:#ffffff;width:700px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;" valign="top"><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 0px; padding-left: 0px; padding-top:5px; padding-bottom:5px;"><![endif]-->
				<div class="col num12" style="min-width: 320px; max-width: 700px; display: table-cell; vertical-align: top; width: 700px;">
				<div class="col_cont" style="width:100% !important;">
				<!--[if (!mso)&(!IE)]><!-->
				<div style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:5px; padding-bottom:5px; padding-right: 0px; padding-left: 0px;">
				<!--<![endif]-->
				<!--[if mso]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 10px; padding-left: 10px; padding-top: 10px; padding-bottom: 10px; font-family: Tahoma, sans-serif"><![endif]-->
				<div style="color:#555555;font-family:Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif;line-height:1.2;padding-top:10px;padding-right:10px;padding-bottom:10px;padding-left:10px;">
				<div style="line-height: 1.2; font-size: 12px; color: #555555; font-family: Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif; mso-line-height-alt: 14px;">
				<p style="font-size: 14px; line-height: 1.2; word-break: break-word; text-align: center; mso-line-height-alt: 17px; margin: 0;">NOTA: En caso de que el que funcionario no pertenezca a su unidad, por favor rechazar la solicitud de licencia.</p>
				</div>
				</div>
				<!--[if mso]></td></tr></table><![endif]-->
				<!--[if (!mso)&(!IE)]><!-->
				</div>
				<!--<![endif]-->
				</div>
				</div>
				<!--[if (mso)|(IE)]></td></tr></table><![endif]-->
				<!--[if (mso)|(IE)]></td></tr></table></td></tr></table><![endif]-->
				</div>
				</div>
				</div>
				<div style="background-color:transparent;">
				<div class="block-grid" style="min-width: 320px; max-width: 700px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; Margin: 0 auto; background-color: #bd0000;">
				<div style="border-collapse: collapse;display: table;width: 100%;background-color:#bd0000;">
				<!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color:transparent;"><tr><td align="center"><table cellpadding="0" cellspacing="0" border="0" style="width:700px"><tr class="layout-full-width" style="background-color:#bd0000"><![endif]-->
				<!--[if (mso)|(IE)]><td align="center" width="700" style="background-color:#bd0000;width:700px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;" valign="top"><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 0px; padding-left: 0px; padding-top:5px; padding-bottom:5px;"><![endif]-->
				<div class="col num12" style="min-width: 320px; max-width: 700px; display: table-cell; vertical-align: top; width: 700px;">
				<div class="col_cont" style="width:100% !important;">
				<!--[if (!mso)&(!IE)]><!-->
				<div style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:5px; padding-bottom:5px; padding-right: 0px; padding-left: 0px;">
				<!--<![endif]-->
				<!--[if mso]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 10px; padding-left: 10px; padding-top: 10px; padding-bottom: 10px; font-family: Tahoma, sans-serif"><![endif]-->
				<div style="color:#555555;font-family:Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif;line-height:1.2;padding-top:10px;padding-right:10px;padding-bottom:10px;padding-left:10px;">
				<div style="line-height: 1.2; font-size: 12px; color: #555555; font-family: Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif; mso-line-height-alt: 14px;">
				<p style="font-size: 14px; line-height: 1.2; word-break: break-word; text-align: center; mso-line-height-alt: 17px; margin: 0;"><strong><span style="color: #ffffff; font-size: 16px;"><a href="https://portal.comteco.com.bo" rel="noopener" style="text-decoration: underline; color: #ffffff;" target="_blank" title="Portal COMTECO R.L.">Portal COMTECO R.L.</a></span></strong></p>
				</div>
				</div>
				<!--[if mso]></td></tr></table><![endif]-->
				<!--[if (!mso)&(!IE)]><!-->
				</div>
				<!--<![endif]-->
				</div>
				</div>
				<!--[if (mso)|(IE)]></td></tr></table><![endif]-->
				<!--[if (mso)|(IE)]></td></tr></table></td></tr></table><![endif]-->
				</div>
				</div>
				</div>
				<!--[if (mso)|(IE)]></td></tr></table><![endif]-->
				</td>
				</tr>
				</tbody>
				</table>
				<!--[if (IE)]></div><![endif]-->
				</body>
				</html>';
			

			$mailAuth = Yii::app()->Smtpmail;

	        $mailAuth->addReplyTo('no-reply@comteco.com.bo', 'COMTECO R.L.');

	       // $mailAuth->SetFrom('no-reply@comteco.com.bo', 'COMTECO R.L.');
	    
	       // $mailAuth->Sender = 'no-reply@comteco.com.bo';

       		$mailAuth->SetFrom('notificaciones@comtecoRL.onmicrosoft.com', 'COMTECO R.L.');
    
        	$mailAuth->Sender = 'notificaciones@comtecoRL.onmicrosoft.com';

	        $mailAuth->AddBCC('portal.comteco@gmail.com');

	        $mailAuth->Subject = "Solicitud de Permiso COMTECO R.L.";

	        $mailAuth->MsgHTML($messageAuth);

	        $mailAuth->AddAddress($emailAuth, "");

	        if(!$mailAuth->Send()) {
	            $mailAuth->ClearAllRecipients();
	            $mailAuth->SmtpClose();
	            $respuestaAuth = $mailAuth->ErrorInfo;
	        }else {
				$mailAuth->ClearAttachments();		            
	            $mailAuth->ClearAllRecipients();
	            $mailAuth->SmtpClose();
	            $respuestaAuth = 'ok';
	        }
		}

		$send = array('mailSolicitante'=>$respuestaSol,'mailAutoriza'=>$respuestaAuth);

		return $send;
	}

	public function SendLicenseConfirm($id){

		$license = License::model()->findByPk($id);

		$supervisor = Supervisor::model()->findByPk($license->supervisor_id);

		$employeeSol = Employee::model()->findByPk($license->employee_id);

		$employeeSolInfo = EmployeePublic::model()->findByAttributes(array('employee_id'=>$employeeSol->id));

		$employeeAuth = Employee::model()->findByAttributes(array('item'=>$supervisor->item));

		$employeeAuthInfo = EmployeePublic::model()->findByAttributes(array('employee_id'=>$employeeAuth->id));		

		if($employeeSolInfo->email != null){

			$emailsol = $employeeSolInfo->email;

		}else{	

			$employeeSolInfoPer = EmployeePersonal::model()->findByAttributes(array('employee_id'=>$employeeSol->id));

			if($employeeSolInfoPer->email != null){

				$emailsol = $employeeSolInfoPer->email;

			}else{
				$emailsol = 0;
			}
		}



		if($employeeAuthInfo->email != null){

			$emailAuth = $employeeAuthInfo->email;

		}else{

			$employeeAuthInfoPer = EmployeePersonal::model()->findByAttributes(array('employee_id'=>$employeeAuth->id));

			if($employeeAuthInfoPer->email != null){

				$emailAuth = $employeeAuthInfoPer->email;

			}else{
				$emailAuth = 0;	
			}

		}

		if($license->status_auth == 0){
			$estado = 'PENDIENTE';
		}elseif($license->status_auth == 1){
			$estado = 'APROBADO';
		}elseif($license->status_auth == 2){
			$estado = 'RECHAZADO';
		}else{
			$estado = 'PENDIENTE';
		}

		$respuestaAuth = '';

		$respuestaSol = '';

		if($emailsol != '0'){

			$messageSol = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional //EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

				<html xmlns="http://www.w3.org/1999/xhtml" xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:v="urn:schemas-microsoft-com:vml">
				<head>
				<!--[if gte mso 9]><xml><o:OfficeDocumentSettings><o:AllowPNG/><o:PixelsPerInch>96</o:PixelsPerInch></o:OfficeDocumentSettings></xml><![endif]-->
				<meta content="text/html; charset=utf-8" http-equiv="Content-Type"/>
				<meta content="width=device-width" name="viewport"/>
				<!--[if !mso]><!-->
				<meta content="IE=edge" http-equiv="X-UA-Compatible"/>
				<!--<![endif]-->
				<title></title>
				<!--[if !mso]><!-->
				<!--<![endif]-->
				<style type="text/css">
						body {
							margin: 0;
							padding: 0;
						}

						table,
						td,
						tr {
							vertical-align: top;
							border-collapse: collapse;
						}

						* {
							line-height: inherit;
						}

						a[x-apple-data-detectors=true] {
							color: inherit !important;
							text-decoration: none !important;
						}
					</style>
				<style id="media-query" type="text/css">
						@media (max-width: 720px) {

							.block-grid,
							.col {
								min-width: 320px !important;
								max-width: 100% !important;
								display: block !important;
							}

							.block-grid {
								width: 100% !important;
							}

							.col {
								width: 100% !important;
							}

							.col_cont {
								margin: 0 auto;
							}

							img.fullwidth,
							img.fullwidthOnMobile {
								max-width: 100% !important;
							}

							.no-stack .col {
								min-width: 0 !important;
								display: table-cell !important;
							}

							.no-stack.two-up .col {
								width: 50% !important;
							}

							.no-stack .col.num2 {
								width: 16.6% !important;
							}

							.no-stack .col.num3 {
								width: 25% !important;
							}

							.no-stack .col.num4 {
								width: 33% !important;
							}

							.no-stack .col.num5 {
								width: 41.6% !important;
							}

							.no-stack .col.num6 {
								width: 50% !important;
							}

							.no-stack .col.num7 {
								width: 58.3% !important;
							}

							.no-stack .col.num8 {
								width: 66.6% !important;
							}

							.no-stack .col.num9 {
								width: 75% !important;
							}

							.no-stack .col.num10 {
								width: 83.3% !important;
							}

							.video-block {
								max-width: none !important;
							}

							.mobile_hide {
								min-height: 0px;
								max-height: 0px;
								max-width: 0px;
								display: none;
								overflow: hidden;
								font-size: 0px;
							}

							.desktop_hide {
								display: block !important;
								max-height: none !important;
							}
						}
					</style>
				</head>
				<body class="clean-body" style="margin: 0; padding: 0; -webkit-text-size-adjust: 100%; background-color: #f9f9f9;">
				<!--[if IE]><div class="ie-browser"><![endif]-->
				<table bgcolor="#f9f9f9" cellpadding="0" cellspacing="0" class="nl-container" role="presentation" style="table-layout: fixed; vertical-align: top; min-width: 320px; border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #f9f9f9; width: 100%;" valign="top" width="100%">
				<tbody>
				<tr style="vertical-align: top;" valign="top">
				<td style="word-break: break-word; vertical-align: top;" valign="top">
				<!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td align="center" style="background-color:#f9f9f9"><![endif]-->
				<div style="background-color:transparent;">
				<div class="block-grid two-up no-stack" style="min-width: 320px; max-width: 700px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; Margin: 0 auto; background-color: transparent;">
				<div style="border-collapse: collapse;display: table;width: 100%;background-color:transparent;">
				<!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color:transparent;"><tr><td align="center"><table cellpadding="0" cellspacing="0" border="0" style="width:700px"><tr class="layout-full-width" style="background-color:transparent"><![endif]-->
				<!--[if (mso)|(IE)]><td align="center" width="350" style="background-color:transparent;width:350px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;" valign="top"><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 0px; padding-left: 0px; padding-top:5px; padding-bottom:5px;"><![endif]-->
				<div class="col num6" style="display: table-cell; vertical-align: top; max-width: 320px; min-width: 348px; width: 350px;">
				<div class="col_cont" style="width:100% !important;">
				<!--[if (!mso)&(!IE)]><!-->
				<div style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:5px; padding-bottom:5px; padding-right: 0px; padding-left: 0px;">
				<!--<![endif]-->
				<div align="left" class="img-container left fixedwidth" style="padding-right: 0px;padding-left: 25px;">
				<!--[if mso]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr style="line-height:0px"><td style="padding-right: 0px;padding-left: 25px;" align="left"><![endif]--><img alt="Alternate text" border="0" class="left fixedwidth" src="https://portal.comteco.com.bo/images/0650149b-5589-4827-88da-4a4c98cbea2d.png" style="text-decoration: none; -ms-interpolation-mode: bicubic; height: auto; border: 0; width: 100%; max-width: 245px; display: block;" title="Alternate text" width="245"/>
				<!--[if mso]></td></tr></table><![endif]-->
				</div>
				<!--[if (!mso)&(!IE)]><!-->
				</div>
				<!--<![endif]-->
				</div>
				</div>
				<!--[if (mso)|(IE)]></td></tr></table><![endif]-->
				<!--[if (mso)|(IE)]></td><td align="center" width="350" style="background-color:transparent;width:350px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;" valign="top"><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 0px; padding-left: 0px; padding-top:5px; padding-bottom:5px;"><![endif]-->
				<div class="col num6" style="display: table-cell; vertical-align: top; max-width: 320px; min-width: 348px; width: 350px;">
				<div class="col_cont" style="width:100% !important;">
				<!--[if (!mso)&(!IE)]><!-->
				<div style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:5px; padding-bottom:5px; padding-right: 0px; padding-left: 0px;">
				<!--<![endif]-->
				<!--[if mso]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 10px; padding-left: 10px; padding-top: 10px; padding-bottom: 10px; font-family: Tahoma, sans-serif"><![endif]-->
				<div style="color:#555555;font-family:Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif;line-height:1.2;padding-top:10px;padding-right:10px;padding-bottom:10px;padding-left:10px;">
				<div style="line-height: 1.2; font-size: 12px; color: #555555; font-family: Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif; mso-line-height-alt: 14px;">
				<p style="text-align: right; line-height: 1.2; word-break: break-word; mso-line-height-alt: 14px; margin: 0;">Portal COMTECO R.L.</p>
				<p style="text-align: right; line-height: 1.2; word-break: break-word; mso-line-height-alt: 14px; margin: 0;">Contacto: Int. 270</p>
				<p style="text-align: right; line-height: 1.2; word-break: break-word; mso-line-height-alt: 14px; margin: 0;">Divisi&oacute;n de Tecnolog&iacute;as de Informaci&oacute;n</p>
				</div>
				</div>
				<!--[if mso]></td></tr></table><![endif]-->
				<!--[if (!mso)&(!IE)]><!-->
				</div>
				<!--<![endif]-->
				</div>
				</div>
				<!--[if (mso)|(IE)]></td></tr></table><![endif]-->
				<!--[if (mso)|(IE)]></td></tr></table></td></tr></table><![endif]-->
				</div>
				</div>
				</div>
				<div style="background-color:transparent;">
				<div class="block-grid" style="min-width: 320px; max-width: 700px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; Margin: 0 auto; background-color: #ffffff;">
				<div style="border-collapse: collapse;display: table;width: 100%;background-color:#ffffff;">
				<!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color:transparent;"><tr><td align="center"><table cellpadding="0" cellspacing="0" border="0" style="width:700px"><tr class="layout-full-width" style="background-color:#ffffff"><![endif]-->
				<!--[if (mso)|(IE)]><td align="center" width="700" style="background-color:#ffffff;width:700px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;" valign="top"><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 0px; padding-left: 0px; padding-top:0px; padding-bottom:0px;"><![endif]-->
				<div class="col num12" style="min-width: 320px; max-width: 700px; display: table-cell; vertical-align: top; width: 700px;">
				<div class="col_cont" style="width:100% !important;">
				<!--[if (!mso)&(!IE)]><!-->
				<div style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:0px; padding-bottom:0px; padding-right: 0px; padding-left: 0px;">
				<!--<![endif]-->
				<div align="center" class="img-container center autowidth" style="padding-right: 0px;padding-left: 0px;">
				
				</div>
				<!--[if (!mso)&(!IE)]><!-->
				</div>
				<!--<![endif]-->
				</div>
				</div>
				<!--[if (mso)|(IE)]></td></tr></table><![endif]-->
				<!--[if (mso)|(IE)]></td></tr></table></td></tr></table><![endif]-->
				</div>
				</div>
				</div>
				<div style="background-color:transparent;">
				<div class="block-grid" style="min-width: 320px; max-width: 700px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; Margin: 0 auto; background-color: #ffffff;">
				<div style="border-collapse: collapse;display: table;width: 100%;background-color:#ffffff;">
				<!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color:transparent;"><tr><td align="center"><table cellpadding="0" cellspacing="0" border="0" style="width:700px"><tr class="layout-full-width" style="background-color:#ffffff"><![endif]-->
				<!--[if (mso)|(IE)]><td align="center" width="700" style="background-color:#ffffff;width:700px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;" valign="top"><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 0px; padding-left: 0px; padding-top:5px; padding-bottom:5px;"><![endif]-->
				<div class="col num12" style="min-width: 320px; max-width: 700px; display: table-cell; vertical-align: top; width: 700px;">
				<div class="col_cont" style="width:100% !important;">
				<!--[if (!mso)&(!IE)]><!-->
				<div style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:5px; padding-bottom:5px; padding-right: 0px; padding-left: 0px;">
				<!--<![endif]-->
				<!--[if mso]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 10px; padding-left: 10px; padding-top: 25px; padding-bottom: 20px; font-family: Tahoma, sans-serif"><![endif]-->
				<div style="color:#0b1560;font-family:Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif;line-height:1.2;padding-top:25px;padding-right:10px;padding-bottom:20px;padding-left:10px;">
				<div style="line-height: 1.2; font-size: 12px; font-family: Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif; color: #0b1560; mso-line-height-alt: 14px;">
				<p style="font-size: 18px; line-height: 1.2; text-align: center; word-break: break-word; font-family: Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif; mso-line-height-alt: 22px; margin: 0;"><span style="font-size: 18px;"><strong>Solicitud '.$estado.'</strong></span></p>
				</div>
				</div>
				<!--[if mso]></td></tr></table><![endif]-->
				<!--[if mso]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 30px; padding-left: 30px; padding-top: 10px; padding-bottom: 25px; font-family: Tahoma, sans-serif"><![endif]-->
				<div style="color:#555555;font-family:Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif;line-height:1.5;padding-top:10px;padding-right:30px;padding-bottom:25px;padding-left:30px;">
				<div style="line-height: 1.5; font-size: 12px; font-family: Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif; color: #555555; mso-line-height-alt: 18px;">
				<p style="font-size: 15px; line-height: 1.5; text-align: center; word-break: break-word; font-family: Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif; mso-line-height-alt: 23px; margin: 0;"><span style="font-size: 15px;">Estimado/a '.$employeeSol->name.' usted realizo una solicitud de permiso la cual fue "'.$estado.'", a continuaci&oacute;n se detalla la solicitud de permiso:</span></p>
				<p style="font-size: 15px; line-height: 1.5; text-align: center; word-break: break-word; font-family: Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif; mso-line-height-alt: 23px; margin: 0;"><span style="font-size: 15px;">Solicitante: '.$employeeSol->name.'<br/>Fecha Inicio Autorizado: '.date('d/m/Y H:i',strtotime($license->date_start_auth)).'<br/>Fecha Fin Autorizado: '.date('d/m/Y H:i',strtotime($license->date_end_auth)).'<br/>Fecha Retorno Autorizado: '.date('d/m/Y H:i',strtotime($license->date_return_auth)).'<br/>D&iacute;as: '.$license->days_auth.' - Horas: '.$license->hours_auth.' - Minutos: '.$license->minutes_auth.'<br/>Observaci&oacute;n Autorizaci&oacuten: '.$license->observation_auth.'<br/><br/>Jefe Inmediato: '.$employeeAuth->name.'<br/>Estado: '.$estado.'</span></p>
				</div>
				</div>
				<!--[if mso]></td></tr></table><![endif]-->
				<!--[if (!mso)&(!IE)]><!-->
				</div>
				<!--<![endif]-->
				</div>
				</div>
				<!--[if (mso)|(IE)]></td></tr></table><![endif]-->
				<!--[if (mso)|(IE)]></td></tr></table></td></tr></table><![endif]-->
				</div>
				</div>
				</div>
				<div style="background-color:transparent;">
				<div class="block-grid" style="min-width: 320px; max-width: 700px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; Margin: 0 auto; background-color: #ffffff;">
				<div style="border-collapse: collapse;display: table;width: 100%;background-color:#ffffff;">
				<!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color:transparent;"><tr><td align="center"><table cellpadding="0" cellspacing="0" border="0" style="width:700px"><tr class="layout-full-width" style="background-color:#ffffff"><![endif]-->
				<!--[if (mso)|(IE)]><td align="center" width="700" style="background-color:#ffffff;width:700px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;" valign="top"><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 0px; padding-left: 0px; padding-top:5px; padding-bottom:5px;"><![endif]-->
				<div class="col num12" style="min-width: 320px; max-width: 700px; display: table-cell; vertical-align: top; width: 700px;">
				<div class="col_cont" style="width:100% !important;">
				<!--[if (!mso)&(!IE)]><!-->
				<div style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:5px; padding-bottom:5px; padding-right: 0px; padding-left: 0px;">
				<!--<![endif]-->
				<table border="0" cellpadding="0" cellspacing="0" class="divider" role="presentation" style="table-layout: fixed; vertical-align: top; border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; min-width: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;" valign="top" width="100%">
				<tbody>
				<tr style="vertical-align: top;" valign="top">
				<td class="divider_inner" style="word-break: break-word; vertical-align: top; min-width: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; padding-top: 10px; padding-right: 10px; padding-bottom: 10px; padding-left: 10px;" valign="top">
				<table align="center" border="0" cellpadding="0" cellspacing="0" class="divider_content" height="1" role="presentation" style="table-layout: fixed; vertical-align: top; border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-top: 1px solid #DDE3E8; height: 1px; width: 95%;" valign="top" width="95%">
				<tbody>
				<tr style="vertical-align: top;" valign="top">
				<td height="1" style="word-break: break-word; vertical-align: top; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;" valign="top"><span></span></td>
				</tr>
				</tbody>
				</table>
				</td>
				</tr>
				</tbody>
				</table>
				<!--[if (!mso)&(!IE)]><!-->
				</div>
				<!--<![endif]-->
				</div>
				</div>
				<!--[if (mso)|(IE)]></td></tr></table><![endif]-->
				<!--[if (mso)|(IE)]></td></tr></table></td></tr></table><![endif]-->
				</div>
				</div>
				</div>
				<div style="background-color:transparent;">
				<div class="block-grid" style="min-width: 320px; max-width: 700px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; Margin: 0 auto; background-color: #ffffff;">
				<div style="border-collapse: collapse;display: table;width: 100%;background-color:#ffffff;">
				<!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color:transparent;"><tr><td align="center"><table cellpadding="0" cellspacing="0" border="0" style="width:700px"><tr class="layout-full-width" style="background-color:#ffffff"><![endif]-->
				<!--[if (mso)|(IE)]><td align="center" width="700" style="background-color:#ffffff;width:700px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;" valign="top"><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 0px; padding-left: 0px; padding-top:5px; padding-bottom:5px;"><![endif]-->
				<div class="col num12" style="min-width: 320px; max-width: 700px; display: table-cell; vertical-align: top; width: 700px;">
				<div class="col_cont" style="width:100% !important;">
				<!--[if (!mso)&(!IE)]><!-->
				<div style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:5px; padding-bottom:5px; padding-right: 0px; padding-left: 0px;">
				<!--<![endif]-->
				<!--[if mso]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 10px; padding-left: 10px; padding-top: 10px; padding-bottom: 10px; font-family: Tahoma, sans-serif"><![endif]-->
				<div style="color:#555555;font-family:Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif;line-height:1.2;padding-top:10px;padding-right:10px;padding-bottom:10px;padding-left:10px;">
				<div style="line-height: 1.2; font-size: 12px; color: #555555; font-family: Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif; mso-line-height-alt: 14px;">
				<p style="font-size: 14px; line-height: 1.2; word-break: break-word; text-align: center; mso-line-height-alt: 17px; margin: 0;">NOTA: En caso de haber registrado mal la solicitud, registre nuevamente e indique a su jefe inmediato que anule esta solicitud.</p>
				</div>
				</div>
				<!--[if mso]></td></tr></table><![endif]-->
				<!--[if (!mso)&(!IE)]><!-->
				</div>
				<!--<![endif]-->
				</div>
				</div>
				<!--[if (mso)|(IE)]></td></tr></table><![endif]-->
				<!--[if (mso)|(IE)]></td></tr></table></td></tr></table><![endif]-->
				</div>
				</div>
				</div>
				<div style="background-color:transparent;">
				<div class="block-grid" style="min-width: 320px; max-width: 700px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; Margin: 0 auto; background-color: #bd0000;">
				<div style="border-collapse: collapse;display: table;width: 100%;background-color:#bd0000;">
				<!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color:transparent;"><tr><td align="center"><table cellpadding="0" cellspacing="0" border="0" style="width:700px"><tr class="layout-full-width" style="background-color:#bd0000"><![endif]-->
				<!--[if (mso)|(IE)]><td align="center" width="700" style="background-color:#bd0000;width:700px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;" valign="top"><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 0px; padding-left: 0px; padding-top:5px; padding-bottom:5px;"><![endif]-->
				<div class="col num12" style="min-width: 320px; max-width: 700px; display: table-cell; vertical-align: top; width: 700px;">
				<div class="col_cont" style="width:100% !important;">
				<!--[if (!mso)&(!IE)]><!-->
				<div style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:5px; padding-bottom:5px; padding-right: 0px; padding-left: 0px;">
				<!--<![endif]-->
				<!--[if mso]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 10px; padding-left: 10px; padding-top: 10px; padding-bottom: 10px; font-family: Tahoma, sans-serif"><![endif]-->
				<div style="color:#555555;font-family:Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif;line-height:1.2;padding-top:10px;padding-right:10px;padding-bottom:10px;padding-left:10px;">
				<div style="line-height: 1.2; font-size: 12px; color: #555555; font-family: Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif; mso-line-height-alt: 14px;">
				<p style="font-size: 14px; line-height: 1.2; word-break: break-word; text-align: center; mso-line-height-alt: 17px; margin: 0;"><strong><span style="color: #ffffff; font-size: 16px;"><a href="https://portal.comteco.com.bo" rel="noopener" style="text-decoration: underline; color: #ffffff;" target="_blank" title="Portal COMTECO R.L.">Portal COMTECO R.L.</a></span></strong></p>
				</div>
				</div>
				<!--[if mso]></td></tr></table><![endif]-->
				<!--[if (!mso)&(!IE)]><!-->
				</div>
				<!--<![endif]-->
				</div>
				</div>
				<!--[if (mso)|(IE)]></td></tr></table><![endif]-->
				<!--[if (mso)|(IE)]></td></tr></table></td></tr></table><![endif]-->
				</div>
				</div>
				</div>
				<!--[if (mso)|(IE)]></td></tr></table><![endif]-->
				</td>
				</tr>
				</tbody>
				</table>
				<!--[if (IE)]></div><![endif]-->
				</body>
				</html>';


			$mailSol = Yii::app()->Smtpmail;

	        $mailSol->addReplyTo('no-reply@comteco.com.bo', 'COMTECO R.L.');

	        //$mailSol->SetFrom('no-reply@comteco.com.bo', 'COMTECO R.L.');
	    
	        //$mailSol->Sender = 'no-reply@comteco.com.bo';

       		$mailSol->SetFrom('notificaciones@comtecoRL.onmicrosoft.com', 'COMTECO R.L.');
    
        	$mailSol->Sender = 'notificaciones@comtecoRL.onmicrosoft.com';

            $mailSol->AddBCC('portal.comteco@gmail.com');

	        $mailSol->Subject = "Solicitud de Permiso $estado";

	        $mailSol->MsgHTML($messageSol);

	        $mailSol->AddAddress($emailsol, "");

	        if(!$mailSol->Send()) {
	            $mailSol->ClearAllRecipients();
	            $mailSol->SmtpClose();
	            $respuestaSol = $mailSol->ErrorInfo;
	        }else {
				$mailSol->ClearAttachments();		            
	            $mailSol->ClearAllRecipients();
	            $mailSol->SmtpClose();
	            $respuestaSol = 'ok';
	        }
		}

		if($emailAuth != '0'){

			$messageAuth = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional //EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

				<html xmlns="http://www.w3.org/1999/xhtml" xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:v="urn:schemas-microsoft-com:vml">
				<head>
				<!--[if gte mso 9]><xml><o:OfficeDocumentSettings><o:AllowPNG/><o:PixelsPerInch>96</o:PixelsPerInch></o:OfficeDocumentSettings></xml><![endif]-->
				<meta content="text/html; charset=utf-8" http-equiv="Content-Type"/>
				<meta content="width=device-width" name="viewport"/>
				<!--[if !mso]><!-->
				<meta content="IE=edge" http-equiv="X-UA-Compatible"/>
				<!--<![endif]-->
				<title></title>
				<!--[if !mso]><!-->
				<!--<![endif]-->
				<style type="text/css">
						body {
							margin: 0;
							padding: 0;
						}

						table,
						td,
						tr {
							vertical-align: top;
							border-collapse: collapse;
						}

						* {
							line-height: inherit;
						}

						a[x-apple-data-detectors=true] {
							color: inherit !important;
							text-decoration: none !important;
						}
					</style>
				<style id="media-query" type="text/css">
						@media (max-width: 720px) {

							.block-grid,
							.col {
								min-width: 320px !important;
								max-width: 100% !important;
								display: block !important;
							}

							.block-grid {
								width: 100% !important;
							}

							.col {
								width: 100% !important;
							}

							.col_cont {
								margin: 0 auto;
							}

							img.fullwidth,
							img.fullwidthOnMobile {
								max-width: 100% !important;
							}

							.no-stack .col {
								min-width: 0 !important;
								display: table-cell !important;
							}

							.no-stack.two-up .col {
								width: 50% !important;
							}

							.no-stack .col.num2 {
								width: 16.6% !important;
							}

							.no-stack .col.num3 {
								width: 25% !important;
							}

							.no-stack .col.num4 {
								width: 33% !important;
							}

							.no-stack .col.num5 {
								width: 41.6% !important;
							}

							.no-stack .col.num6 {
								width: 50% !important;
							}

							.no-stack .col.num7 {
								width: 58.3% !important;
							}

							.no-stack .col.num8 {
								width: 66.6% !important;
							}

							.no-stack .col.num9 {
								width: 75% !important;
							}

							.no-stack .col.num10 {
								width: 83.3% !important;
							}

							.video-block {
								max-width: none !important;
							}

							.mobile_hide {
								min-height: 0px;
								max-height: 0px;
								max-width: 0px;
								display: none;
								overflow: hidden;
								font-size: 0px;
							}

							.desktop_hide {
								display: block !important;
								max-height: none !important;
							}
						}
					</style>
				</head>
				<body class="clean-body" style="margin: 0; padding: 0; -webkit-text-size-adjust: 100%; background-color: #f9f9f9;">
				<!--[if IE]><div class="ie-browser"><![endif]-->
				<table bgcolor="#f9f9f9" cellpadding="0" cellspacing="0" class="nl-container" role="presentation" style="table-layout: fixed; vertical-align: top; min-width: 320px; border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #f9f9f9; width: 100%;" valign="top" width="100%">
				<tbody>
				<tr style="vertical-align: top;" valign="top">
				<td style="word-break: break-word; vertical-align: top;" valign="top">
				<!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td align="center" style="background-color:#f9f9f9"><![endif]-->
				<div style="background-color:transparent;">
				<div class="block-grid two-up no-stack" style="min-width: 320px; max-width: 700px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; Margin: 0 auto; background-color: transparent;">
				<div style="border-collapse: collapse;display: table;width: 100%;background-color:transparent;">
				<!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color:transparent;"><tr><td align="center"><table cellpadding="0" cellspacing="0" border="0" style="width:700px"><tr class="layout-full-width" style="background-color:transparent"><![endif]-->
				<!--[if (mso)|(IE)]><td align="center" width="350" style="background-color:transparent;width:350px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;" valign="top"><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 0px; padding-left: 0px; padding-top:5px; padding-bottom:5px;"><![endif]-->
				<div class="col num6" style="display: table-cell; vertical-align: top; max-width: 320px; min-width: 348px; width: 350px;">
				<div class="col_cont" style="width:100% !important;">
				<!--[if (!mso)&(!IE)]><!-->
				<div style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:5px; padding-bottom:5px; padding-right: 0px; padding-left: 0px;">
				<!--<![endif]-->
				<div align="left" class="img-container left fixedwidth" style="padding-right: 0px;padding-left: 25px;">
				<!--[if mso]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr style="line-height:0px"><td style="padding-right: 0px;padding-left: 25px;" align="left"><![endif]--><img alt="Alternate text" border="0" class="left fixedwidth" src="https://portal.comteco.com.bo/images/0650149b-5589-4827-88da-4a4c98cbea2d.png" style="text-decoration: none; -ms-interpolation-mode: bicubic; height: auto; border: 0; width: 100%; max-width: 245px; display: block;" title="Alternate text" width="245"/>
				<!--[if mso]></td></tr></table><![endif]-->
				</div>
				<!--[if (!mso)&(!IE)]><!-->
				</div>
				<!--<![endif]-->
				</div>
				</div>
				<!--[if (mso)|(IE)]></td></tr></table><![endif]-->
				<!--[if (mso)|(IE)]></td><td align="center" width="350" style="background-color:transparent;width:350px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;" valign="top"><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 0px; padding-left: 0px; padding-top:5px; padding-bottom:5px;"><![endif]-->
				<div class="col num6" style="display: table-cell; vertical-align: top; max-width: 320px; min-width: 348px; width: 350px;">
				<div class="col_cont" style="width:100% !important;">
				<!--[if (!mso)&(!IE)]><!-->
				<div style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:5px; padding-bottom:5px; padding-right: 0px; padding-left: 0px;">
				<!--<![endif]-->
				<!--[if mso]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 10px; padding-left: 10px; padding-top: 10px; padding-bottom: 10px; font-family: Tahoma, sans-serif"><![endif]-->
				<div style="color:#555555;font-family:Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif;line-height:1.2;padding-top:10px;padding-right:10px;padding-bottom:10px;padding-left:10px;">
				<div style="line-height: 1.2; font-size: 12px; color: #555555; font-family: Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif; mso-line-height-alt: 14px;">
				<p style="text-align: right; line-height: 1.2; word-break: break-word; mso-line-height-alt: 14px; margin: 0;">Portal COMTECO R.L.</p>
				<p style="text-align: right; line-height: 1.2; word-break: break-word; mso-line-height-alt: 14px; margin: 0;">Contacto: Int. 270</p>
				<p style="text-align: right; line-height: 1.2; word-break: break-word; mso-line-height-alt: 14px; margin: 0;">Divisi&oacute;n de Tecnolog&iacute;as de Informaci&oacute;n</p>
				</div>
				</div>
				<!--[if mso]></td></tr></table><![endif]-->
				<!--[if (!mso)&(!IE)]><!-->
				</div>
				<!--<![endif]-->
				</div>
				</div>
				<!--[if (mso)|(IE)]></td></tr></table><![endif]-->
				<!--[if (mso)|(IE)]></td></tr></table></td></tr></table><![endif]-->
				</div>
				</div>
				</div>
				<div style="background-color:transparent;">
				<div class="block-grid" style="min-width: 320px; max-width: 700px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; Margin: 0 auto; background-color: #ffffff;">
				<div style="border-collapse: collapse;display: table;width: 100%;background-color:#ffffff;">
				<!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color:transparent;"><tr><td align="center"><table cellpadding="0" cellspacing="0" border="0" style="width:700px"><tr class="layout-full-width" style="background-color:#ffffff"><![endif]-->
				<!--[if (mso)|(IE)]><td align="center" width="700" style="background-color:#ffffff;width:700px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;" valign="top"><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 0px; padding-left: 0px; padding-top:0px; padding-bottom:0px;"><![endif]-->
				<div class="col num12" style="min-width: 320px; max-width: 700px; display: table-cell; vertical-align: top; width: 700px;">
				<div class="col_cont" style="width:100% !important;">
				<!--[if (!mso)&(!IE)]><!-->
				<div style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:0px; padding-bottom:0px; padding-right: 0px; padding-left: 0px;">
				<!--<![endif]-->
				<div align="center" class="img-container center autowidth" style="padding-right: 0px;padding-left: 0px;">
				
				</div>
				<!--[if (!mso)&(!IE)]><!-->
				</div>
				<!--<![endif]-->
				</div>
				</div>
				<!--[if (mso)|(IE)]></td></tr></table><![endif]-->
				<!--[if (mso)|(IE)]></td></tr></table></td></tr></table><![endif]-->
				</div>
				</div>
				</div>
				<div style="background-color:transparent;">
				<div class="block-grid" style="min-width: 320px; max-width: 700px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; Margin: 0 auto; background-color: #ffffff;">
				<div style="border-collapse: collapse;display: table;width: 100%;background-color:#ffffff;">
				<!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color:transparent;"><tr><td align="center"><table cellpadding="0" cellspacing="0" border="0" style="width:700px"><tr class="layout-full-width" style="background-color:#ffffff"><![endif]-->
				<!--[if (mso)|(IE)]><td align="center" width="700" style="background-color:#ffffff;width:700px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;" valign="top"><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 0px; padding-left: 0px; padding-top:5px; padding-bottom:5px;"><![endif]-->
				<div class="col num12" style="min-width: 320px; max-width: 700px; display: table-cell; vertical-align: top; width: 700px;">
				<div class="col_cont" style="width:100% !important;">
				<!--[if (!mso)&(!IE)]><!-->
				<div style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:5px; padding-bottom:5px; padding-right: 0px; padding-left: 0px;">
				<!--<![endif]-->
				<!--[if mso]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 10px; padding-left: 10px; padding-top: 25px; padding-bottom: 20px; font-family: Tahoma, sans-serif"><![endif]-->
				<div style="color:#0b1560;font-family:Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif;line-height:1.2;padding-top:25px;padding-right:10px;padding-bottom:20px;padding-left:10px;">
				<div style="line-height: 1.2; font-size: 12px; font-family: Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif; color: #0b1560; mso-line-height-alt: 14px;">
				<p style="font-size: 18px; line-height: 1.2; text-align: center; word-break: break-word; font-family: Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif; mso-line-height-alt: 22px; margin: 0;"><span style="font-size: 18px;"><strong>Solicitud '.$estado.'</strong></span></p>
				</div>
				</div>
				<!--[if mso]></td></tr></table><![endif]-->
				<!--[if mso]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 30px; padding-left: 30px; padding-top: 10px; padding-bottom: 25px; font-family: Tahoma, sans-serif"><![endif]-->
				<div style="color:#555555;font-family:Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif;line-height:1.5;padding-top:10px;padding-right:30px;padding-bottom:25px;padding-left:30px;">
				<div style="line-height: 1.5; font-size: 12px; font-family: Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif; color: #555555; mso-line-height-alt: 18px;">
				<p style="font-size: 15px; line-height: 1.5; text-align: center; word-break: break-word; font-family: Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif; mso-line-height-alt: 23px; margin: 0;"><span style="font-size: 15px;">Estimado/a '.$employeeAuth->name.' la solicitud del funcionario/a '.$employeeSol->name.' fue "'.$estado.'", a continuaci&oacute;n se detalla la solicitud de permiso:</span></p>
				<p style="font-size: 15px; line-height: 1.5; text-align: center; word-break: break-word; font-family: Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif; mso-line-height-alt: 23px; margin: 0;"><span style="font-size: 15px;">Solicitante: '.$employeeSol->name.'<br/>Fecha Inicio Autorizado: '.date('d/m/Y H:i',strtotime($license->date_start_auth)).'<br/>Fecha Fin Autorizado: '.date('d/m/Y H:i',strtotime($license->date_end_auth)).'<br/>Fecha Retorno Autorizado: '.date('d/m/Y H:i',strtotime($license->date_return_auth)).'<br/>D&iacute;as: '.$license->days_auth.' - Horas: '.$license->hours_auth.' - Minutos: '.$license->minutes_auth.'<br/>Observaci&oacute;n Autorizaci&oacuten: '.$license->observation_auth.'<br/><br/>Jefe Inmediato: '.$employeeAuth->name.'<br/>Estado: '.$estado.'</span></p>
				</div>
				</div>
				<!--[if mso]></td></tr></table><![endif]-->
				<!--[if (!mso)&(!IE)]><!-->
				</div>
				<!--<![endif]-->
				</div>
				</div>
				<!--[if (mso)|(IE)]></td></tr></table><![endif]-->
				<!--[if (mso)|(IE)]></td></tr></table></td></tr></table><![endif]-->
				</div>
				</div>
				</div>
				<div style="background-color:transparent;">
				<div class="block-grid" style="min-width: 320px; max-width: 700px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; Margin: 0 auto; background-color: #ffffff;">
				<div style="border-collapse: collapse;display: table;width: 100%;background-color:#ffffff;">
				<!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color:transparent;"><tr><td align="center"><table cellpadding="0" cellspacing="0" border="0" style="width:700px"><tr class="layout-full-width" style="background-color:#ffffff"><![endif]-->
				<!--[if (mso)|(IE)]><td align="center" width="700" style="background-color:#ffffff;width:700px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;" valign="top"><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 0px; padding-left: 0px; padding-top:5px; padding-bottom:5px;"><![endif]-->
				<div class="col num12" style="min-width: 320px; max-width: 700px; display: table-cell; vertical-align: top; width: 700px;">
				<div class="col_cont" style="width:100% !important;">
				<!--[if (!mso)&(!IE)]><!-->
				<div style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:5px; padding-bottom:5px; padding-right: 0px; padding-left: 0px;">
				<!--<![endif]-->
				<table border="0" cellpadding="0" cellspacing="0" class="divider" role="presentation" style="table-layout: fixed; vertical-align: top; border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; min-width: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;" valign="top" width="100%">
				<tbody>
				<tr style="vertical-align: top;" valign="top">
				<td class="divider_inner" style="word-break: break-word; vertical-align: top; min-width: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; padding-top: 10px; padding-right: 10px; padding-bottom: 10px; padding-left: 10px;" valign="top">
				<table align="center" border="0" cellpadding="0" cellspacing="0" class="divider_content" height="1" role="presentation" style="table-layout: fixed; vertical-align: top; border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-top: 1px solid #DDE3E8; height: 1px; width: 95%;" valign="top" width="95%">
				<tbody>
				<tr style="vertical-align: top;" valign="top">
				<td height="1" style="word-break: break-word; vertical-align: top; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;" valign="top"><span></span></td>
				</tr>
				</tbody>
				</table>
				</td>
				</tr>
				</tbody>
				</table>
				<!--[if (!mso)&(!IE)]><!-->
				</div>
				<!--<![endif]-->
				</div>
				</div>
				<!--[if (mso)|(IE)]></td></tr></table><![endif]-->
				<!--[if (mso)|(IE)]></td></tr></table></td></tr></table><![endif]-->
				</div>
				</div>
				</div>
				<div style="background-color:transparent;">
				<div class="block-grid" style="min-width: 320px; max-width: 700px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; Margin: 0 auto; background-color: #ffffff;">
				<div style="border-collapse: collapse;display: table;width: 100%;background-color:#ffffff;">
				<!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color:transparent;"><tr><td align="center"><table cellpadding="0" cellspacing="0" border="0" style="width:700px"><tr class="layout-full-width" style="background-color:#ffffff"><![endif]-->
				<!--[if (mso)|(IE)]><td align="center" width="700" style="background-color:#ffffff;width:700px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;" valign="top"><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 0px; padding-left: 0px; padding-top:5px; padding-bottom:5px;"><![endif]-->
				<div class="col num12" style="min-width: 320px; max-width: 700px; display: table-cell; vertical-align: top; width: 700px;">
				<div class="col_cont" style="width:100% !important;">
				<!--[if (!mso)&(!IE)]><!-->
				<div style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:5px; padding-bottom:5px; padding-right: 0px; padding-left: 0px;">
				<!--<![endif]-->
				<!--[if mso]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 10px; padding-left: 10px; padding-top: 10px; padding-bottom: 10px; font-family: Tahoma, sans-serif"><![endif]-->
				<div style="color:#555555;font-family:Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif;line-height:1.2;padding-top:10px;padding-right:10px;padding-bottom:10px;padding-left:10px;">
				<div style="line-height: 1.2; font-size: 12px; color: #555555; font-family: Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif; mso-line-height-alt: 14px;">
				<p style="font-size: 14px; line-height: 1.2; word-break: break-word; text-align: center; mso-line-height-alt: 17px; margin: 0;">NOTA: En caso de haber registrado mal la solicitud, registre nuevamente e indique a su jefe inmediato que anule esta solicitud.</p>
				</div>
				</div>
				<!--[if mso]></td></tr></table><![endif]-->
				<!--[if (!mso)&(!IE)]><!-->
				</div>
				<!--<![endif]-->
				</div>
				</div>
				<!--[if (mso)|(IE)]></td></tr></table><![endif]-->
				<!--[if (mso)|(IE)]></td></tr></table></td></tr></table><![endif]-->
				</div>
				</div>
				</div>
				<div style="background-color:transparent;">
				<div class="block-grid" style="min-width: 320px; max-width: 700px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; Margin: 0 auto; background-color: #bd0000;">
				<div style="border-collapse: collapse;display: table;width: 100%;background-color:#bd0000;">
				<!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color:transparent;"><tr><td align="center"><table cellpadding="0" cellspacing="0" border="0" style="width:700px"><tr class="layout-full-width" style="background-color:#bd0000"><![endif]-->
				<!--[if (mso)|(IE)]><td align="center" width="700" style="background-color:#bd0000;width:700px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;" valign="top"><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 0px; padding-left: 0px; padding-top:5px; padding-bottom:5px;"><![endif]-->
				<div class="col num12" style="min-width: 320px; max-width: 700px; display: table-cell; vertical-align: top; width: 700px;">
				<div class="col_cont" style="width:100% !important;">
				<!--[if (!mso)&(!IE)]><!-->
				<div style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:5px; padding-bottom:5px; padding-right: 0px; padding-left: 0px;">
				<!--<![endif]-->
				<!--[if mso]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 10px; padding-left: 10px; padding-top: 10px; padding-bottom: 10px; font-family: Tahoma, sans-serif"><![endif]-->
				<div style="color:#555555;font-family:Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif;line-height:1.2;padding-top:10px;padding-right:10px;padding-bottom:10px;padding-left:10px;">
				<div style="line-height: 1.2; font-size: 12px; color: #555555; font-family: Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif; mso-line-height-alt: 14px;">
				<p style="font-size: 14px; line-height: 1.2; word-break: break-word; text-align: center; mso-line-height-alt: 17px; margin: 0;"><strong><span style="color: #ffffff; font-size: 16px;"><a href="https://portal.comteco.com.bo" rel="noopener" style="text-decoration: underline; color: #ffffff;" target="_blank" title="Portal COMTECO R.L.">Portal COMTECO R.L.</a></span></strong></p>
				</div>
				</div>
				<!--[if mso]></td></tr></table><![endif]-->
				<!--[if (!mso)&(!IE)]><!-->
				</div>
				<!--<![endif]-->
				</div>
				</div>
				<!--[if (mso)|(IE)]></td></tr></table><![endif]-->
				<!--[if (mso)|(IE)]></td></tr></table></td></tr></table><![endif]-->
				</div>
				</div>
				</div>
				<!--[if (mso)|(IE)]></td></tr></table><![endif]-->
				</td>
				</tr>
				</tbody>
				</table>
				<!--[if (IE)]></div><![endif]-->
				</body>
				</html>';

			$mailAuth = Yii::app()->Smtpmail;

	        $mailAuth->addReplyTo('no-reply@comteco.com.bo', 'COMTECO R.L.');

	        //$mailAuth->SetFrom('no-reply@comteco.com.bo', 'COMTECO R.L.');
	    
	        //$mailAuth->Sender = 'no-reply@comteco.com.bo';

       		$mailAuth->SetFrom('notificaciones@comtecoRL.onmicrosoft.com', 'COMTECO R.L.');
    
        	$mailAuth->Sender = 'notificaciones@comtecoRL.onmicrosoft.com';

	        $mailAuth->AddBCC('portal.comteco@gmail.com');

	        $mailAuth->Subject = "Solicitud de Permiso $estado";

	        $mailAuth->MsgHTML($messageAuth);

	        $mailAuth->AddAddress($emailAuth, "");

	        if(!$mailAuth->Send()) {
	            $mailAuth->ClearAllRecipients();
	            $mailAuth->SmtpClose();
	            $respuestaAuth = $mailAuth->ErrorInfo;
	        }else {
				$mailAuth->ClearAttachments();		            
	            $mailAuth->ClearAllRecipients();
	            $mailAuth->SmtpClose();
	            $respuestaAuth = 'ok';
	        }
		}

		$send = array('mailSolicitante'=>$respuestaSol,'mailAutoriza'=>$respuestaAuth);

		return $send;
	}

	public function SendLicenseProg($id){

		$license = License::model()->findByPk($id);

		$supervisor = Supervisor::model()->findByPk($license->supervisor_id);

		$employeeSol = Employee::model()->findByPk($license->employee_id);

		$employeeSolInfo = EmployeePublic::model()->findByAttributes(array('employee_id'=>$employeeSol->id));

		$employeeAuth = Employee::model()->findByAttributes(array('item'=>$supervisor->item));

		$employeeAuthInfo = EmployeePublic::model()->findByAttributes(array('employee_id'=>$employeeAuth->id));		

		if($employeeSolInfo->email != null){

			$emailsol = $employeeSolInfo->email;

		}else{	

			$employeeSolInfoPer = EmployeePersonal::model()->findByAttributes(array('employee_id'=>$employeeSol->id));

			if($employeeSolInfoPer->email != null){

				$emailsol = $employeeSolInfoPer->email;

			}else{
				$emailsol = 0;
			}
		}



		if($employeeAuthInfo->email != null){

			$emailAuth = $employeeAuthInfo->email;

		}else{

			$employeeAuthInfoPer = EmployeePersonal::model()->findByAttributes(array('employee_id'=>$employeeAuth->id));

			if($employeeAuthInfoPer->email != null){

				$emailAuth = $employeeAuthInfoPer->email;

			}else{
				$emailAuth = 0;	
			}

		}

		$respuestaAuth = '';

		$respuestaSol = '';

		if($emailsol != '0'){

			$messageSol = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional //EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

				<html xmlns="http://www.w3.org/1999/xhtml" xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:v="urn:schemas-microsoft-com:vml">
				<head>
				<!--[if gte mso 9]><xml><o:OfficeDocumentSettings><o:AllowPNG/><o:PixelsPerInch>96</o:PixelsPerInch></o:OfficeDocumentSettings></xml><![endif]-->
				<meta content="text/html; charset=utf-8" http-equiv="Content-Type"/>
				<meta content="width=device-width" name="viewport"/>
				<!--[if !mso]><!-->
				<meta content="IE=edge" http-equiv="X-UA-Compatible"/>
				<!--<![endif]-->
				<title></title>
				<!--[if !mso]><!-->
				<!--<![endif]-->
				<style type="text/css">
						body {
							margin: 0;
							padding: 0;
						}

						table,
						td,
						tr {
							vertical-align: top;
							border-collapse: collapse;
						}

						* {
							line-height: inherit;
						}

						a[x-apple-data-detectors=true] {
							color: inherit !important;
							text-decoration: none !important;
						}
					</style>
				<style id="media-query" type="text/css">
						@media (max-width: 720px) {

							.block-grid,
							.col {
								min-width: 320px !important;
								max-width: 100% !important;
								display: block !important;
							}

							.block-grid {
								width: 100% !important;
							}

							.col {
								width: 100% !important;
							}

							.col_cont {
								margin: 0 auto;
							}

							img.fullwidth,
							img.fullwidthOnMobile {
								max-width: 100% !important;
							}

							.no-stack .col {
								min-width: 0 !important;
								display: table-cell !important;
							}

							.no-stack.two-up .col {
								width: 50% !important;
							}

							.no-stack .col.num2 {
								width: 16.6% !important;
							}

							.no-stack .col.num3 {
								width: 25% !important;
							}

							.no-stack .col.num4 {
								width: 33% !important;
							}

							.no-stack .col.num5 {
								width: 41.6% !important;
							}

							.no-stack .col.num6 {
								width: 50% !important;
							}

							.no-stack .col.num7 {
								width: 58.3% !important;
							}

							.no-stack .col.num8 {
								width: 66.6% !important;
							}

							.no-stack .col.num9 {
								width: 75% !important;
							}

							.no-stack .col.num10 {
								width: 83.3% !important;
							}

							.video-block {
								max-width: none !important;
							}

							.mobile_hide {
								min-height: 0px;
								max-height: 0px;
								max-width: 0px;
								display: none;
								overflow: hidden;
								font-size: 0px;
							}

							.desktop_hide {
								display: block !important;
								max-height: none !important;
							}
						}
					</style>
				</head>
				<body class="clean-body" style="margin: 0; padding: 0; -webkit-text-size-adjust: 100%; background-color: #f9f9f9;">
				<!--[if IE]><div class="ie-browser"><![endif]-->
				<table bgcolor="#f9f9f9" cellpadding="0" cellspacing="0" class="nl-container" role="presentation" style="table-layout: fixed; vertical-align: top; min-width: 320px; border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #f9f9f9; width: 100%;" valign="top" width="100%">
				<tbody>
				<tr style="vertical-align: top;" valign="top">
				<td style="word-break: break-word; vertical-align: top;" valign="top">
				<!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td align="center" style="background-color:#f9f9f9"><![endif]-->
				<div style="background-color:transparent;">
				<div class="block-grid two-up no-stack" style="min-width: 320px; max-width: 700px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; Margin: 0 auto; background-color: transparent;">
				<div style="border-collapse: collapse;display: table;width: 100%;background-color:transparent;">
				<!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color:transparent;"><tr><td align="center"><table cellpadding="0" cellspacing="0" border="0" style="width:700px"><tr class="layout-full-width" style="background-color:transparent"><![endif]-->
				<!--[if (mso)|(IE)]><td align="center" width="350" style="background-color:transparent;width:350px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;" valign="top"><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 0px; padding-left: 0px; padding-top:5px; padding-bottom:5px;"><![endif]-->
				<div class="col num6" style="display: table-cell; vertical-align: top; max-width: 320px; min-width: 348px; width: 350px;">
				<div class="col_cont" style="width:100% !important;">
				<!--[if (!mso)&(!IE)]><!-->
				<div style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:5px; padding-bottom:5px; padding-right: 0px; padding-left: 0px;">
				<!--<![endif]-->
				<div align="left" class="img-container left fixedwidth" style="padding-right: 0px;padding-left: 25px;">
				<!--[if mso]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr style="line-height:0px"><td style="padding-right: 0px;padding-left: 25px;" align="left"><![endif]--><img alt="Alternate text" border="0" class="left fixedwidth" src="https://portal.comteco.com.bo/images/0650149b-5589-4827-88da-4a4c98cbea2d.png" style="text-decoration: none; -ms-interpolation-mode: bicubic; height: auto; border: 0; width: 100%; max-width: 245px; display: block;" title="Alternate text" width="245"/>
				<!--[if mso]></td></tr></table><![endif]-->
				</div>
				<!--[if (!mso)&(!IE)]><!-->
				</div>
				<!--<![endif]-->
				</div>
				</div>
				<!--[if (mso)|(IE)]></td></tr></table><![endif]-->
				<!--[if (mso)|(IE)]></td><td align="center" width="350" style="background-color:transparent;width:350px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;" valign="top"><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 0px; padding-left: 0px; padding-top:5px; padding-bottom:5px;"><![endif]-->
				<div class="col num6" style="display: table-cell; vertical-align: top; max-width: 320px; min-width: 348px; width: 350px;">
				<div class="col_cont" style="width:100% !important;">
				<!--[if (!mso)&(!IE)]><!-->
				<div style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:5px; padding-bottom:5px; padding-right: 0px; padding-left: 0px;">
				<!--<![endif]-->
				<!--[if mso]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 10px; padding-left: 10px; padding-top: 10px; padding-bottom: 10px; font-family: Tahoma, sans-serif"><![endif]-->
				<div style="color:#555555;font-family:Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif;line-height:1.2;padding-top:10px;padding-right:10px;padding-bottom:10px;padding-left:10px;">
				<div style="line-height: 1.2; font-size: 12px; color: #555555; font-family: Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif; mso-line-height-alt: 14px;">
				<p style="text-align: right; line-height: 1.2; word-break: break-word; mso-line-height-alt: 14px; margin: 0;">Portal COMTECO R.L.</p>
				<p style="text-align: right; line-height: 1.2; word-break: break-word; mso-line-height-alt: 14px; margin: 0;">Contacto: Int. 270</p>
				<p style="text-align: right; line-height: 1.2; word-break: break-word; mso-line-height-alt: 14px; margin: 0;">Divisi&oacute;n de Tecnolog&iacute;as de Informaci&oacute;n</p>
				</div>
				</div>
				<!--[if mso]></td></tr></table><![endif]-->
				<!--[if (!mso)&(!IE)]><!-->
				</div>
				<!--<![endif]-->
				</div>
				</div>
				<!--[if (mso)|(IE)]></td></tr></table><![endif]-->
				<!--[if (mso)|(IE)]></td></tr></table></td></tr></table><![endif]-->
				</div>
				</div>
				</div>
				<div style="background-color:transparent;">
				<div class="block-grid" style="min-width: 320px; max-width: 700px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; Margin: 0 auto; background-color: #ffffff;">
				<div style="border-collapse: collapse;display: table;width: 100%;background-color:#ffffff;">
				<!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color:transparent;"><tr><td align="center"><table cellpadding="0" cellspacing="0" border="0" style="width:700px"><tr class="layout-full-width" style="background-color:#ffffff"><![endif]-->
				<!--[if (mso)|(IE)]><td align="center" width="700" style="background-color:#ffffff;width:700px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;" valign="top"><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 0px; padding-left: 0px; padding-top:0px; padding-bottom:0px;"><![endif]-->
				<div class="col num12" style="min-width: 320px; max-width: 700px; display: table-cell; vertical-align: top; width: 700px;">
				<div class="col_cont" style="width:100% !important;">
				<!--[if (!mso)&(!IE)]><!-->
				<div style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:0px; padding-bottom:0px; padding-right: 0px; padding-left: 0px;">
				<!--<![endif]-->
				<div align="center" class="img-container center autowidth" style="padding-right: 0px;padding-left: 0px;">
				
				</div>
				<!--[if (!mso)&(!IE)]><!-->
				</div>
				<!--<![endif]-->
				</div>
				</div>
				<!--[if (mso)|(IE)]></td></tr></table><![endif]-->
				<!--[if (mso)|(IE)]></td></tr></table></td></tr></table><![endif]-->
				</div>
				</div>
				</div>
				<div style="background-color:transparent;">
				<div class="block-grid" style="min-width: 320px; max-width: 700px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; Margin: 0 auto; background-color: #ffffff;">
				<div style="border-collapse: collapse;display: table;width: 100%;background-color:#ffffff;">
				<!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color:transparent;"><tr><td align="center"><table cellpadding="0" cellspacing="0" border="0" style="width:700px"><tr class="layout-full-width" style="background-color:#ffffff"><![endif]-->
				<!--[if (mso)|(IE)]><td align="center" width="700" style="background-color:#ffffff;width:700px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;" valign="top"><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 0px; padding-left: 0px; padding-top:5px; padding-bottom:5px;"><![endif]-->
				<div class="col num12" style="min-width: 320px; max-width: 700px; display: table-cell; vertical-align: top; width: 700px;">
				<div class="col_cont" style="width:100% !important;">
				<!--[if (!mso)&(!IE)]><!-->
				<div style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:5px; padding-bottom:5px; padding-right: 0px; padding-left: 0px;">
				<!--<![endif]-->
				<!--[if mso]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 10px; padding-left: 10px; padding-top: 25px; padding-bottom: 20px; font-family: Tahoma, sans-serif"><![endif]-->
				<div style="color:#0b1560;font-family:Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif;line-height:1.2;padding-top:25px;padding-right:10px;padding-bottom:20px;padding-left:10px;">
				<div style="line-height: 1.2; font-size: 12px; font-family: Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif; color: #0b1560; mso-line-height-alt: 14px;">
				<p style="font-size: 18px; line-height: 1.2; text-align: center; word-break: break-word; font-family: Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif; mso-line-height-alt: 22px; margin: 0;"><span style="font-size: 18px;"><strong>Solicitud de Programaci&oacute;n de Vacaci&oacute;n</strong></span></p>
				</div>
				</div>
				<!--[if mso]></td></tr></table><![endif]-->
				<!--[if mso]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 30px; padding-left: 30px; padding-top: 10px; padding-bottom: 25px; font-family: Tahoma, sans-serif"><![endif]-->
				<div style="color:#555555;font-family:Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif;line-height:1.5;padding-top:10px;padding-right:30px;padding-bottom:25px;padding-left:30px;">
				<div style="line-height: 1.5; font-size: 12px; font-family: Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif; color: #555555; mso-line-height-alt: 18px;">
				<p style="font-size: 15px; line-height: 1.5; text-align: center; word-break: break-word; font-family: Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif; mso-line-height-alt: 23px; margin: 0;"><span style="font-size: 15px;">Estimado/a '.$employeeSol->name.' usted realizo una programaci&oacute;n de Vacaci&oacute;n, a continuaci&oacute;n se detalla la solicitud:</span></p>
				<p style="font-size: 15px; line-height: 1.5; text-align: center; word-break: break-word; font-family: Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif; mso-line-height-alt: 23px; margin: 0;"><span style="font-size: 15px;">Solicitante: '.$employeeSol->name.'<br/>Fecha Inicio: '.date('d/m/Y H:i',strtotime($license->date_start)).'<br/>Fecha Fin: '.date('d/m/Y H:i',strtotime($license->date_end)).'<br/>Fecha Retorno: '.date('d/m/Y H:i',strtotime($license->date_return)).'<br/>D&iacute;as: '.$license->days.' - Horas: '.$license->hours.' - Minutos: '.$license->minutes.'<br/>Observaci&oacute;n: '.$license->observation_sol.'<br/><br/>Jefe Inmediato: '.$employeeAuth->name.'<br/>Estado: Pendiente</span></p>
				<p style="font-size: 15px; line-height: 1.5; text-align: center; word-break: break-word; font-family: Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif; mso-line-height-alt: 23px; margin: 0;"><span style="font-size: 15px;">Una vez aprobada o rechazada su solicitud recibira una confirmaci&oacute;n por correo electronico.</span></p>
				</div>
				</div>
				<!--[if mso]></td></tr></table><![endif]-->
				<!--[if (!mso)&(!IE)]><!-->
				</div>
				<!--<![endif]-->
				</div>
				</div>
				<!--[if (mso)|(IE)]></td></tr></table><![endif]-->
				<!--[if (mso)|(IE)]></td></tr></table></td></tr></table><![endif]-->
				</div>
				</div>
				</div>
				<div style="background-color:transparent;">
				<div class="block-grid" style="min-width: 320px; max-width: 700px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; Margin: 0 auto; background-color: #ffffff;">
				<div style="border-collapse: collapse;display: table;width: 100%;background-color:#ffffff;">
				<!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color:transparent;"><tr><td align="center"><table cellpadding="0" cellspacing="0" border="0" style="width:700px"><tr class="layout-full-width" style="background-color:#ffffff"><![endif]-->
				<!--[if (mso)|(IE)]><td align="center" width="700" style="background-color:#ffffff;width:700px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;" valign="top"><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 0px; padding-left: 0px; padding-top:5px; padding-bottom:5px;"><![endif]-->
				<div class="col num12" style="min-width: 320px; max-width: 700px; display: table-cell; vertical-align: top; width: 700px;">
				<div class="col_cont" style="width:100% !important;">
				<!--[if (!mso)&(!IE)]><!-->
				<div style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:5px; padding-bottom:5px; padding-right: 0px; padding-left: 0px;">
				<!--<![endif]-->
				<table border="0" cellpadding="0" cellspacing="0" class="divider" role="presentation" style="table-layout: fixed; vertical-align: top; border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; min-width: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;" valign="top" width="100%">
				<tbody>
				<tr style="vertical-align: top;" valign="top">
				<td class="divider_inner" style="word-break: break-word; vertical-align: top; min-width: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; padding-top: 10px; padding-right: 10px; padding-bottom: 10px; padding-left: 10px;" valign="top">
				<table align="center" border="0" cellpadding="0" cellspacing="0" class="divider_content" height="1" role="presentation" style="table-layout: fixed; vertical-align: top; border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-top: 1px solid #DDE3E8; height: 1px; width: 95%;" valign="top" width="95%">
				<tbody>
				<tr style="vertical-align: top;" valign="top">
				<td height="1" style="word-break: break-word; vertical-align: top; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;" valign="top"><span></span></td>
				</tr>
				</tbody>
				</table>
				</td>
				</tr>
				</tbody>
				</table>
				<!--[if (!mso)&(!IE)]><!-->
				</div>
				<!--<![endif]-->
				</div>
				</div>
				<!--[if (mso)|(IE)]></td></tr></table><![endif]-->
				<!--[if (mso)|(IE)]></td></tr></table></td></tr></table><![endif]-->
				</div>
				</div>
				</div>
				<div style="background-color:transparent;">
				<div class="block-grid" style="min-width: 320px; max-width: 700px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; Margin: 0 auto; background-color: #ffffff;">
				<div style="border-collapse: collapse;display: table;width: 100%;background-color:#ffffff;">
				<!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color:transparent;"><tr><td align="center"><table cellpadding="0" cellspacing="0" border="0" style="width:700px"><tr class="layout-full-width" style="background-color:#ffffff"><![endif]-->
				<!--[if (mso)|(IE)]><td align="center" width="700" style="background-color:#ffffff;width:700px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;" valign="top"><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 0px; padding-left: 0px; padding-top:5px; padding-bottom:5px;"><![endif]-->
				<div class="col num12" style="min-width: 320px; max-width: 700px; display: table-cell; vertical-align: top; width: 700px;">
				<div class="col_cont" style="width:100% !important;">
				<!--[if (!mso)&(!IE)]><!-->
				<div style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:5px; padding-bottom:5px; padding-right: 0px; padding-left: 0px;">
				<!--<![endif]-->
				<!--[if mso]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 10px; padding-left: 10px; padding-top: 10px; padding-bottom: 10px; font-family: Tahoma, sans-serif"><![endif]-->
				<div style="color:#555555;font-family:Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif;line-height:1.2;padding-top:10px;padding-right:10px;padding-bottom:10px;padding-left:10px;">
				<div style="line-height: 1.2; font-size: 12px; color: #555555; font-family: Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif; mso-line-height-alt: 14px;">
				<p style="font-size: 14px; line-height: 1.2; word-break: break-word; text-align: center; mso-line-height-alt: 17px; margin: 0;">NOTA: En caso de haber registrado mal la solicitud, registre nuevamente e indique a su jefe inmediato que anule esta solicitud.</p>
				</div>
				</div>
				<!--[if mso]></td></tr></table><![endif]-->
				<!--[if (!mso)&(!IE)]><!-->
				</div>
				<!--<![endif]-->
				</div>
				</div>
				<!--[if (mso)|(IE)]></td></tr></table><![endif]-->
				<!--[if (mso)|(IE)]></td></tr></table></td></tr></table><![endif]-->
				</div>
				</div>
				</div>
				<div style="background-color:transparent;">
				<div class="block-grid" style="min-width: 320px; max-width: 700px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; Margin: 0 auto; background-color: #bd0000;">
				<div style="border-collapse: collapse;display: table;width: 100%;background-color:#bd0000;">
				<!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color:transparent;"><tr><td align="center"><table cellpadding="0" cellspacing="0" border="0" style="width:700px"><tr class="layout-full-width" style="background-color:#bd0000"><![endif]-->
				<!--[if (mso)|(IE)]><td align="center" width="700" style="background-color:#bd0000;width:700px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;" valign="top"><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 0px; padding-left: 0px; padding-top:5px; padding-bottom:5px;"><![endif]-->
				<div class="col num12" style="min-width: 320px; max-width: 700px; display: table-cell; vertical-align: top; width: 700px;">
				<div class="col_cont" style="width:100% !important;">
				<!--[if (!mso)&(!IE)]><!-->
				<div style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:5px; padding-bottom:5px; padding-right: 0px; padding-left: 0px;">
				<!--<![endif]-->
				<!--[if mso]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 10px; padding-left: 10px; padding-top: 10px; padding-bottom: 10px; font-family: Tahoma, sans-serif"><![endif]-->
				<div style="color:#555555;font-family:Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif;line-height:1.2;padding-top:10px;padding-right:10px;padding-bottom:10px;padding-left:10px;">
				<div style="line-height: 1.2; font-size: 12px; color: #555555; font-family: Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif; mso-line-height-alt: 14px;">
				<p style="font-size: 14px; line-height: 1.2; word-break: break-word; text-align: center; mso-line-height-alt: 17px; margin: 0;"><strong><span style="color: #ffffff; font-size: 16px;"><a href="https://portal.comteco.com.bo" rel="noopener" style="text-decoration: underline; color: #ffffff;" target="_blank" title="Portal COMTECO R.L.">Portal COMTECO R.L.</a></span></strong></p>
				</div>
				</div>
				<!--[if mso]></td></tr></table><![endif]-->
				<!--[if (!mso)&(!IE)]><!-->
				</div>
				<!--<![endif]-->
				</div>
				</div>
				<!--[if (mso)|(IE)]></td></tr></table><![endif]-->
				<!--[if (mso)|(IE)]></td></tr></table></td></tr></table><![endif]-->
				</div>
				</div>
				</div>
				<!--[if (mso)|(IE)]></td></tr></table><![endif]-->
				</td>
				</tr>
				</tbody>
				</table>
				<!--[if (IE)]></div><![endif]-->
				</body>
				</html>';


			$mailSol = Yii::app()->Smtpmail;

	        $mailSol->addReplyTo('no-reply@comteco.com.bo', 'COMTECO R.L.');

	        

	        //$mailSol->SetFrom('no-reply@comteco.com.bo', 'COMTECO R.L.');
	    
	        //$mailSol->Sender = 'no-reply@comteco.com.bo';

       		$mailSol->SetFrom('notificaciones@comtecoRL.onmicrosoft.com', 'COMTECO R.L.');
    
        	$mailSol->Sender = 'notificaciones@comtecoRL.onmicrosoft.com';

            $mailSol->AddBCC('portal.comteco@gmail.com');

	        $mailSol->Subject = "Solicitud de Programacion de Vacacion COMTECO R.L.";

	        $mailSol->MsgHTML($messageSol);

	        $mailSol->AddAddress($emailsol, "");

	        if(!$mailSol->Send()) {
	            $mailSol->ClearAllRecipients();
	            $mailSol->SmtpClose();
	            $respuestaSol = $mailSol->ErrorInfo;
	        }else {
				$mailSol->ClearAttachments();		            
	            $mailSol->ClearAllRecipients();
	            $mailSol->SmtpClose();
	            $respuestaSol = 'ok';
	        }
		}

		if($emailAuth != '0'){

			$messageAuth = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional //EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

				<html xmlns="http://www.w3.org/1999/xhtml" xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:v="urn:schemas-microsoft-com:vml">
				<head>
				<!--[if gte mso 9]><xml><o:OfficeDocumentSettings><o:AllowPNG/><o:PixelsPerInch>96</o:PixelsPerInch></o:OfficeDocumentSettings></xml><![endif]-->
				<meta content="text/html; charset=utf-8" http-equiv="Content-Type"/>
				<meta content="width=device-width" name="viewport"/>
				<!--[if !mso]><!-->
				<meta content="IE=edge" http-equiv="X-UA-Compatible"/>
				<!--<![endif]-->
				<title></title>
				<!--[if !mso]><!-->
				<!--<![endif]-->
				<style type="text/css">
						body {
							margin: 0;
							padding: 0;
						}

						table,
						td,
						tr {
							vertical-align: top;
							border-collapse: collapse;
						}

						* {
							line-height: inherit;
						}

						a[x-apple-data-detectors=true] {
							color: inherit !important;
							text-decoration: none !important;
						}
					</style>
				<style id="media-query" type="text/css">
						@media (max-width: 720px) {

							.block-grid,
							.col {
								min-width: 320px !important;
								max-width: 100% !important;
								display: block !important;
							}

							.block-grid {
								width: 100% !important;
							}

							.col {
								width: 100% !important;
							}

							.col_cont {
								margin: 0 auto;
							}

							img.fullwidth,
							img.fullwidthOnMobile {
								max-width: 100% !important;
							}

							.no-stack .col {
								min-width: 0 !important;
								display: table-cell !important;
							}

							.no-stack.two-up .col {
								width: 50% !important;
							}

							.no-stack .col.num2 {
								width: 16.6% !important;
							}

							.no-stack .col.num3 {
								width: 25% !important;
							}

							.no-stack .col.num4 {
								width: 33% !important;
							}

							.no-stack .col.num5 {
								width: 41.6% !important;
							}

							.no-stack .col.num6 {
								width: 50% !important;
							}

							.no-stack .col.num7 {
								width: 58.3% !important;
							}

							.no-stack .col.num8 {
								width: 66.6% !important;
							}

							.no-stack .col.num9 {
								width: 75% !important;
							}

							.no-stack .col.num10 {
								width: 83.3% !important;
							}

							.video-block {
								max-width: none !important;
							}

							.mobile_hide {
								min-height: 0px;
								max-height: 0px;
								max-width: 0px;
								display: none;
								overflow: hidden;
								font-size: 0px;
							}

							.desktop_hide {
								display: block !important;
								max-height: none !important;
							}
						}
					</style>
				</head>
				<body class="clean-body" style="margin: 0; padding: 0; -webkit-text-size-adjust: 100%; background-color: #f9f9f9;">
				<!--[if IE]><div class="ie-browser"><![endif]-->
				<table bgcolor="#f9f9f9" cellpadding="0" cellspacing="0" class="nl-container" role="presentation" style="table-layout: fixed; vertical-align: top; min-width: 320px; border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #f9f9f9; width: 100%;" valign="top" width="100%">
				<tbody>
				<tr style="vertical-align: top;" valign="top">
				<td style="word-break: break-word; vertical-align: top;" valign="top">
				<!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td align="center" style="background-color:#f9f9f9"><![endif]-->
				<div style="background-color:transparent;">
				<div class="block-grid two-up no-stack" style="min-width: 320px; max-width: 700px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; Margin: 0 auto; background-color: transparent;">
				<div style="border-collapse: collapse;display: table;width: 100%;background-color:transparent;">
				<!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color:transparent;"><tr><td align="center"><table cellpadding="0" cellspacing="0" border="0" style="width:700px"><tr class="layout-full-width" style="background-color:transparent"><![endif]-->
				<!--[if (mso)|(IE)]><td align="center" width="350" style="background-color:transparent;width:350px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;" valign="top"><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 0px; padding-left: 0px; padding-top:5px; padding-bottom:5px;"><![endif]-->
				<div class="col num6" style="display: table-cell; vertical-align: top; max-width: 320px; min-width: 348px; width: 350px;">
				<div class="col_cont" style="width:100% !important;">
				<!--[if (!mso)&(!IE)]><!-->
				<div style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:5px; padding-bottom:5px; padding-right: 0px; padding-left: 0px;">
				<!--<![endif]-->
				<div align="left" class="img-container left fixedwidth" style="padding-right: 0px;padding-left: 25px;">
				<!--[if mso]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr style="line-height:0px"><td style="padding-right: 0px;padding-left: 25px;" align="left"><![endif]--><img alt="Alternate text" border="0" class="left fixedwidth" src="https://portal.comteco.com.bo/images/0650149b-5589-4827-88da-4a4c98cbea2d.png" style="text-decoration: none; -ms-interpolation-mode: bicubic; height: auto; border: 0; width: 100%; max-width: 245px; display: block;" title="Alternate text" width="245"/>
				<!--[if mso]></td></tr></table><![endif]-->
				</div>
				<!--[if (!mso)&(!IE)]><!-->
				</div>
				<!--<![endif]-->
				</div>
				</div>
				<!--[if (mso)|(IE)]></td></tr></table><![endif]-->
				<!--[if (mso)|(IE)]></td><td align="center" width="350" style="background-color:transparent;width:350px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;" valign="top"><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 0px; padding-left: 0px; padding-top:5px; padding-bottom:5px;"><![endif]-->
				<div class="col num6" style="display: table-cell; vertical-align: top; max-width: 320px; min-width: 348px; width: 350px;">
				<div class="col_cont" style="width:100% !important;">
				<!--[if (!mso)&(!IE)]><!-->
				<div style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:5px; padding-bottom:5px; padding-right: 0px; padding-left: 0px;">
				<!--<![endif]-->
				<!--[if mso]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 10px; padding-left: 10px; padding-top: 10px; padding-bottom: 10px; font-family: Tahoma, sans-serif"><![endif]-->
				<div style="color:#555555;font-family:Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif;line-height:1.2;padding-top:10px;padding-right:10px;padding-bottom:10px;padding-left:10px;">
				<div style="line-height: 1.2; font-size: 12px; color: #555555; font-family: Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif; mso-line-height-alt: 14px;">
				<p style="text-align: right; line-height: 1.2; word-break: break-word; mso-line-height-alt: 14px; margin: 0;">Portal COMTECO R.L.</p>
				<p style="text-align: right; line-height: 1.2; word-break: break-word; mso-line-height-alt: 14px; margin: 0;">Contacto: Int. 270</p>
				<p style="text-align: right; line-height: 1.2; word-break: break-word; mso-line-height-alt: 14px; margin: 0;">Divisi&oacute;n de Tecnolog&iacute;as de Informaci&oacute;n</p>
				</div>
				</div>
				<!--[if mso]></td></tr></table><![endif]-->
				<!--[if (!mso)&(!IE)]><!-->
				</div>
				<!--<![endif]-->
				</div>
				</div>
				<!--[if (mso)|(IE)]></td></tr></table><![endif]-->
				<!--[if (mso)|(IE)]></td></tr></table></td></tr></table><![endif]-->
				</div>
				</div>
				</div>
				<div style="background-color:transparent;">
				<div class="block-grid" style="min-width: 320px; max-width: 700px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; Margin: 0 auto; background-color: #ffffff;">
				<div style="border-collapse: collapse;display: table;width: 100%;background-color:#ffffff;">
				<!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color:transparent;"><tr><td align="center"><table cellpadding="0" cellspacing="0" border="0" style="width:700px"><tr class="layout-full-width" style="background-color:#ffffff"><![endif]-->
				<!--[if (mso)|(IE)]><td align="center" width="700" style="background-color:#ffffff;width:700px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;" valign="top"><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 0px; padding-left: 0px; padding-top:0px; padding-bottom:0px;"><![endif]-->
				<div class="col num12" style="min-width: 320px; max-width: 700px; display: table-cell; vertical-align: top; width: 700px;">
				<div class="col_cont" style="width:100% !important;">
				<!--[if (!mso)&(!IE)]><!-->
				<div style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:0px; padding-bottom:0px; padding-right: 0px; padding-left: 0px;">
				<!--<![endif]-->
				<div align="center" class="img-container center autowidth" style="padding-right: 0px;padding-left: 0px;">
				
				</div>
				<!--[if (!mso)&(!IE)]><!-->
				</div>
				<!--<![endif]-->
				</div>
				</div>
				<!--[if (mso)|(IE)]></td></tr></table><![endif]-->
				<!--[if (mso)|(IE)]></td></tr></table></td></tr></table><![endif]-->
				</div>
				</div>
				</div>
				<div style="background-color:transparent;">
				<div class="block-grid" style="min-width: 320px; max-width: 700px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; Margin: 0 auto; background-color: #ffffff;">
				<div style="border-collapse: collapse;display: table;width: 100%;background-color:#ffffff;">
				<!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color:transparent;"><tr><td align="center"><table cellpadding="0" cellspacing="0" border="0" style="width:700px"><tr class="layout-full-width" style="background-color:#ffffff"><![endif]-->
				<!--[if (mso)|(IE)]><td align="center" width="700" style="background-color:#ffffff;width:700px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;" valign="top"><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 0px; padding-left: 0px; padding-top:5px; padding-bottom:5px;"><![endif]-->
				<div class="col num12" style="min-width: 320px; max-width: 700px; display: table-cell; vertical-align: top; width: 700px;">
				<div class="col_cont" style="width:100% !important;">
				<!--[if (!mso)&(!IE)]><!-->
				<div style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:5px; padding-bottom:5px; padding-right: 0px; padding-left: 0px;">
				<!--<![endif]-->
				<!--[if mso]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 10px; padding-left: 10px; padding-top: 25px; padding-bottom: 20px; font-family: Tahoma, sans-serif"><![endif]-->
				<div style="color:#0b1560;font-family:Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif;line-height:1.2;padding-top:25px;padding-right:10px;padding-bottom:20px;padding-left:10px;">
				<div style="line-height: 1.2; font-size: 12px; font-family: Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif; color: #0b1560; mso-line-height-alt: 14px;">
				<p style="font-size: 18px; line-height: 1.2; text-align: center; word-break: break-word; font-family: Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif; mso-line-height-alt: 22px; margin: 0;"><span style="font-size: 18px;"><strong>Solicitud de Programaci&oacute;n de de Vacaci&oacute;n</strong></span></p>
				</div>
				</div>
				<!--[if mso]></td></tr></table><![endif]-->
				<!--[if mso]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 30px; padding-left: 30px; padding-top: 10px; padding-bottom: 25px; font-family: Tahoma, sans-serif"><![endif]-->
				<div style="color:#555555;font-family:Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif;line-height:1.5;padding-top:10px;padding-right:30px;padding-bottom:25px;padding-left:30px;">
				<div style="line-height: 1.5; font-size: 12px; font-family: Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif; color: #555555; mso-line-height-alt: 18px;">
				<p style="font-size: 15px; line-height: 1.5; text-align: center; word-break: break-word; font-family: Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif; mso-line-height-alt: 23px; margin: 0;"><span style="font-size: 15px;">Estimado/a '.$employeeAuth->name.' el funcionario/a '.$employeeSol->name.' realizo una solicitud de Programaci&oacute;n de Vacaci&oacute;n, a continuaci&oacute;n se detalla la solicitud:</span></p>
				<p style="font-size: 15px; line-height: 1.5; text-align: center; word-break: break-word; font-family: Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif; mso-line-height-alt: 23px; margin: 0;"><span style="font-size: 15px;">Solicitante: '.$employeeSol->name.'<br/>Fecha Inicio: '.date('d/m/Y H:i',strtotime($license->date_start)).'<br/>Fecha Fin: '.date('d/m/Y H:i',strtotime($license->date_end)).'<br/>Fecha Retorno: '.date('d/m/Y H:i',strtotime($license->date_return)).'<br/>D&iacute;as: '.$license->days.' - Horas: '.$license->hours.' - Minutos: '.$license->minutes.'<br/>Observaci&oacute;n: '.$license->observation_sol.'<br/><br/>Jefe Inmediato: '.$employeeAuth->name.'<br/>Estado: Pendiente</span></p>
				<p style="font-size: 14px; line-height: 1.5; text-align: center; word-break: break-word; font-family: Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif; mso-line-height-alt: 21px; margin: 0;"><span style=""><span style="font-size: 15px;">Para aprobar o rechazar la programaci&oacute;n, por favor </span></span><span style="font-size: 15px;">aqu&iacute;</span><span style=""><span style="font-size: 15px;"> click en el bot&oacute;n que tiene en la parte inferior, en caso de no funcionar el bot&oacute;n por favor hacer click en el enlace:</span></span></p>
				<p style="font-size: 14px; line-height: 1.5; text-align: center; word-break: break-word; font-family: Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif; mso-line-height-alt: 21px; margin: 0;"><br></p>
				<p style="font-size: 14px; line-height: 1.5; text-align: center; word-break: break-word; font-family: Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif; mso-line-height-alt: 21px; margin: 0;"><span style=""><span style="font-size: 15px;"><a href="'.Yii::app()->createAbsoluteUrl("profile/authorization").'" rel="noopener" style="text-decoration: underline;" target="_blank" title="Portal COMTECO">'.Yii::app()->createAbsoluteUrl("profile/authorization").'</a></span></span></p>
				</div>
				</div>
				<!--[if mso]></td></tr></table><![endif]-->
				<div align="center" class="button-container" style="padding-top:10px;padding-right:10px;padding-bottom:10px;padding-left:10px;">
				<!--[if mso]><table width="100%" cellpadding="0" cellspacing="0" border="0" style="border-spacing: 0; border-collapse: collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;"><tr><td style="padding-top: 10px; padding-right: 10px; padding-bottom: 10px; padding-left: 10px" align="center"><v:roundrect xmlns:v="urn:schemas-microsoft-com:vml" xmlns:w="urn:schemas-microsoft-com:office:word" href="'.Yii::app()->createAbsoluteUrl("profile/authorization").'" style="height:39pt; width:276.75pt; v-text-anchor:middle;" arcsize="8%" stroke="false" fillcolor="#d80000"><w:anchorlock/><v:textbox inset="0,0,0,0"><center style="color:#ffffff; font-family:Tahoma, sans-serif; font-size:16px"><![endif]--><a href="'.Yii::app()->createAbsoluteUrl("profile/authorization").'" style="-webkit-text-size-adjust: none; text-decoration: none; display: inline-block; color: #ffffff; background-color: #d80000; border-radius: 4px; -webkit-border-radius: 4px; -moz-border-radius: 4px; width: auto; width: auto; border-top: 1px solid #d80000; border-right: 1px solid #d80000; border-bottom: 1px solid #d80000; border-left: 1px solid #d80000; padding-top: 10px; padding-bottom: 10px; font-family: Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif; text-align: center; mso-border-alt: none; word-break: keep-all;" target="_blank"><span style="padding-left:60px;padding-right:55px;font-size:16px;display:inline-block;"><span style="font-size: 16px; margin: 0; line-height: 2; word-break: break-word; mso-line-height-alt: 32px;">Aprobar / Rechazar</span></span></a>
				<!--[if mso]></center></v:textbox></v:roundrect></td></tr></table><![endif]-->
				</div>
				<!--[if (!mso)&(!IE)]><!-->
				</div>
				<!--<![endif]-->
				</div>
				</div>
				<!--[if (mso)|(IE)]></td></tr></table><![endif]-->
				<!--[if (mso)|(IE)]></td></tr></table></td></tr></table><![endif]-->
				</div>
				</div>
				</div>
				<div style="background-color:transparent;">
				<div class="block-grid" style="min-width: 320px; max-width: 700px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; Margin: 0 auto; background-color: #ffffff;">
				<div style="border-collapse: collapse;display: table;width: 100%;background-color:#ffffff;">
				<!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color:transparent;"><tr><td align="center"><table cellpadding="0" cellspacing="0" border="0" style="width:700px"><tr class="layout-full-width" style="background-color:#ffffff"><![endif]-->
				<!--[if (mso)|(IE)]><td align="center" width="700" style="background-color:#ffffff;width:700px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;" valign="top"><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 0px; padding-left: 0px; padding-top:5px; padding-bottom:5px;"><![endif]-->
				<div class="col num12" style="min-width: 320px; max-width: 700px; display: table-cell; vertical-align: top; width: 700px;">
				<div class="col_cont" style="width:100% !important;">
				<!--[if (!mso)&(!IE)]><!-->
				<div style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:5px; padding-bottom:5px; padding-right: 0px; padding-left: 0px;">
				<!--<![endif]-->
				<table border="0" cellpadding="0" cellspacing="0" class="divider" role="presentation" style="table-layout: fixed; vertical-align: top; border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; min-width: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;" valign="top" width="100%">
				<tbody>
				<tr style="vertical-align: top;" valign="top">
				<td class="divider_inner" style="word-break: break-word; vertical-align: top; min-width: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; padding-top: 10px; padding-right: 10px; padding-bottom: 10px; padding-left: 10px;" valign="top">
				<table align="center" border="0" cellpadding="0" cellspacing="0" class="divider_content" height="1" role="presentation" style="table-layout: fixed; vertical-align: top; border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-top: 1px solid #DDE3E8; height: 1px; width: 95%;" valign="top" width="95%">
				<tbody>
				<tr style="vertical-align: top;" valign="top">
				<td height="1" style="word-break: break-word; vertical-align: top; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;" valign="top"><span></span></td>
				</tr>
				</tbody>
				</table>
				</td>
				</tr>
				</tbody>
				</table>
				<!--[if (!mso)&(!IE)]><!-->
				</div>
				<!--<![endif]-->
				</div>
				</div>
				<!--[if (mso)|(IE)]></td></tr></table><![endif]-->
				<!--[if (mso)|(IE)]></td></tr></table></td></tr></table><![endif]-->
				</div>
				</div>
				</div>
				<div style="background-color:transparent;">
				<div class="block-grid" style="min-width: 320px; max-width: 700px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; Margin: 0 auto; background-color: #ffffff;">
				<div style="border-collapse: collapse;display: table;width: 100%;background-color:#ffffff;">
				<!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color:transparent;"><tr><td align="center"><table cellpadding="0" cellspacing="0" border="0" style="width:700px"><tr class="layout-full-width" style="background-color:#ffffff"><![endif]-->
				<!--[if (mso)|(IE)]><td align="center" width="700" style="background-color:#ffffff;width:700px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;" valign="top"><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 0px; padding-left: 0px; padding-top:5px; padding-bottom:5px;"><![endif]-->
				<div class="col num12" style="min-width: 320px; max-width: 700px; display: table-cell; vertical-align: top; width: 700px;">
				<div class="col_cont" style="width:100% !important;">
				<!--[if (!mso)&(!IE)]><!-->
				<div style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:5px; padding-bottom:5px; padding-right: 0px; padding-left: 0px;">
				<!--<![endif]-->
				<!--[if mso]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 10px; padding-left: 10px; padding-top: 10px; padding-bottom: 10px; font-family: Tahoma, sans-serif"><![endif]-->
				<div style="color:#555555;font-family:Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif;line-height:1.2;padding-top:10px;padding-right:10px;padding-bottom:10px;padding-left:10px;">
				<div style="line-height: 1.2; font-size: 12px; color: #555555; font-family: Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif; mso-line-height-alt: 14px;">
				<p style="font-size: 14px; line-height: 1.2; word-break: break-word; text-align: center; mso-line-height-alt: 17px; margin: 0;">NOTA: En caso de que el que funcionario no pertenezca a su unidad, por favor rechazar la solicitud de licencia.</p>
				</div>
				</div>
				<!--[if mso]></td></tr></table><![endif]-->
				<!--[if (!mso)&(!IE)]><!-->
				</div>
				<!--<![endif]-->
				</div>
				</div>
				<!--[if (mso)|(IE)]></td></tr></table><![endif]-->
				<!--[if (mso)|(IE)]></td></tr></table></td></tr></table><![endif]-->
				</div>
				</div>
				</div>
				<div style="background-color:transparent;">
				<div class="block-grid" style="min-width: 320px; max-width: 700px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; Margin: 0 auto; background-color: #bd0000;">
				<div style="border-collapse: collapse;display: table;width: 100%;background-color:#bd0000;">
				<!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color:transparent;"><tr><td align="center"><table cellpadding="0" cellspacing="0" border="0" style="width:700px"><tr class="layout-full-width" style="background-color:#bd0000"><![endif]-->
				<!--[if (mso)|(IE)]><td align="center" width="700" style="background-color:#bd0000;width:700px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;" valign="top"><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 0px; padding-left: 0px; padding-top:5px; padding-bottom:5px;"><![endif]-->
				<div class="col num12" style="min-width: 320px; max-width: 700px; display: table-cell; vertical-align: top; width: 700px;">
				<div class="col_cont" style="width:100% !important;">
				<!--[if (!mso)&(!IE)]><!-->
				<div style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:5px; padding-bottom:5px; padding-right: 0px; padding-left: 0px;">
				<!--<![endif]-->
				<!--[if mso]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 10px; padding-left: 10px; padding-top: 10px; padding-bottom: 10px; font-family: Tahoma, sans-serif"><![endif]-->
				<div style="color:#555555;font-family:Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif;line-height:1.2;padding-top:10px;padding-right:10px;padding-bottom:10px;padding-left:10px;">
				<div style="line-height: 1.2; font-size: 12px; color: #555555; font-family: Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif; mso-line-height-alt: 14px;">
				<p style="font-size: 14px; line-height: 1.2; word-break: break-word; text-align: center; mso-line-height-alt: 17px; margin: 0;"><strong><span style="color: #ffffff; font-size: 16px;"><a href="https://portal.comteco.com.bo" rel="noopener" style="text-decoration: underline; color: #ffffff;" target="_blank" title="Portal COMTECO R.L.">Portal COMTECO R.L.</a></span></strong></p>
				</div>
				</div>
				<!--[if mso]></td></tr></table><![endif]-->
				<!--[if (!mso)&(!IE)]><!-->
				</div>
				<!--<![endif]-->
				</div>
				</div>
				<!--[if (mso)|(IE)]></td></tr></table><![endif]-->
				<!--[if (mso)|(IE)]></td></tr></table></td></tr></table><![endif]-->
				</div>
				</div>
				</div>
				<!--[if (mso)|(IE)]></td></tr></table><![endif]-->
				</td>
				</tr>
				</tbody>
				</table>
				<!--[if (IE)]></div><![endif]-->
				</body>
				</html>';
			

			$mailAuth = Yii::app()->Smtpmail;

	        $mailAuth->addReplyTo('no-reply@comteco.com.bo', 'COMTECO R.L.');


	        //$mailAuth->SetFrom('no-reply@comteco.com.bo', 'COMTECO R.L.');
	    
	        //$mailAuth->Sender = 'no-reply@comteco.com.bo';

       		$mailAuth->SetFrom('notificaciones@comtecoRL.onmicrosoft.com', 'COMTECO R.L.');
    
        	$mailAuth->Sender = 'notificaciones@comtecoRL.onmicrosoft.com';
        	
	        $mailAuth->AddBCC('portal.comteco@gmail.com');

	        $mailAuth->Subject = "Solicitud de Programacion de Vacacion COMTECO R.L.";

	        $mailAuth->MsgHTML($messageAuth);

	        $mailAuth->AddAddress($emailAuth, "");

	        if(!$mailAuth->Send()) {
	            $mailAuth->ClearAllRecipients();
	            $mailAuth->SmtpClose();
	            $respuestaAuth = $mailAuth->ErrorInfo;
	        }else {
				$mailAuth->ClearAttachments();		            
	            $mailAuth->ClearAllRecipients();
	            $mailAuth->SmtpClose();
	            $respuestaAuth = 'ok';
	        }
		}

		$send = array('mailSolicitante'=>$respuestaSol,'mailAutoriza'=>$respuestaAuth);

		return $send;
	}

	public function SendLicenseConfirmProg($id){

		$license = License::model()->findByPk($id);

		$supervisor = Supervisor::model()->findByPk($license->supervisor_id);

		$employeeSol = Employee::model()->findByPk($license->employee_id);

		$employeeSolInfo = EmployeePublic::model()->findByAttributes(array('employee_id'=>$employeeSol->id));

		$employeeAuth = Employee::model()->findByAttributes(array('item'=>$supervisor->item));

		$employeeAuthInfo = EmployeePublic::model()->findByAttributes(array('employee_id'=>$employeeAuth->id));		

		if($employeeSolInfo->email != null){

			$emailsol = $employeeSolInfo->email;

		}else{	

			$employeeSolInfoPer = EmployeePersonal::model()->findByAttributes(array('employee_id'=>$employeeSol->id));

			if($employeeSolInfoPer->email != null){

				$emailsol = $employeeSolInfoPer->email;

			}else{
				$emailsol = 0;
			}
		}



		if($employeeAuthInfo->email != null){

			$emailAuth = $employeeAuthInfo->email;

		}else{

			$employeeAuthInfoPer = EmployeePersonal::model()->findByAttributes(array('employee_id'=>$employeeAuth->id));

			if($employeeAuthInfoPer->email != null){

				$emailAuth = $employeeAuthInfoPer->email;

			}else{
				$emailAuth = 0;	
			}

		}

		if($license->status_auth == 0){
			$estado = 'PENDIENTE';
		}elseif($license->status_auth == 1){
			$estado = 'APROBADO';
		}elseif($license->status_auth == 2){
			$estado = 'RECHAZADO';
		}else{
			$estado = 'PENDIENTE';
		}

		$respuestaAuth = '';

		$respuestaSol = '';

		if($emailsol != '0'){

			$messageSol = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional //EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

				<html xmlns="http://www.w3.org/1999/xhtml" xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:v="urn:schemas-microsoft-com:vml">
				<head>
				<!--[if gte mso 9]><xml><o:OfficeDocumentSettings><o:AllowPNG/><o:PixelsPerInch>96</o:PixelsPerInch></o:OfficeDocumentSettings></xml><![endif]-->
				<meta content="text/html; charset=utf-8" http-equiv="Content-Type"/>
				<meta content="width=device-width" name="viewport"/>
				<!--[if !mso]><!-->
				<meta content="IE=edge" http-equiv="X-UA-Compatible"/>
				<!--<![endif]-->
				<title></title>
				<!--[if !mso]><!-->
				<!--<![endif]-->
				<style type="text/css">
						body {
							margin: 0;
							padding: 0;
						}

						table,
						td,
						tr {
							vertical-align: top;
							border-collapse: collapse;
						}

						* {
							line-height: inherit;
						}

						a[x-apple-data-detectors=true] {
							color: inherit !important;
							text-decoration: none !important;
						}
					</style>
				<style id="media-query" type="text/css">
						@media (max-width: 720px) {

							.block-grid,
							.col {
								min-width: 320px !important;
								max-width: 100% !important;
								display: block !important;
							}

							.block-grid {
								width: 100% !important;
							}

							.col {
								width: 100% !important;
							}

							.col_cont {
								margin: 0 auto;
							}

							img.fullwidth,
							img.fullwidthOnMobile {
								max-width: 100% !important;
							}

							.no-stack .col {
								min-width: 0 !important;
								display: table-cell !important;
							}

							.no-stack.two-up .col {
								width: 50% !important;
							}

							.no-stack .col.num2 {
								width: 16.6% !important;
							}

							.no-stack .col.num3 {
								width: 25% !important;
							}

							.no-stack .col.num4 {
								width: 33% !important;
							}

							.no-stack .col.num5 {
								width: 41.6% !important;
							}

							.no-stack .col.num6 {
								width: 50% !important;
							}

							.no-stack .col.num7 {
								width: 58.3% !important;
							}

							.no-stack .col.num8 {
								width: 66.6% !important;
							}

							.no-stack .col.num9 {
								width: 75% !important;
							}

							.no-stack .col.num10 {
								width: 83.3% !important;
							}

							.video-block {
								max-width: none !important;
							}

							.mobile_hide {
								min-height: 0px;
								max-height: 0px;
								max-width: 0px;
								display: none;
								overflow: hidden;
								font-size: 0px;
							}

							.desktop_hide {
								display: block !important;
								max-height: none !important;
							}
						}
					</style>
				</head>
				<body class="clean-body" style="margin: 0; padding: 0; -webkit-text-size-adjust: 100%; background-color: #f9f9f9;">
				<!--[if IE]><div class="ie-browser"><![endif]-->
				<table bgcolor="#f9f9f9" cellpadding="0" cellspacing="0" class="nl-container" role="presentation" style="table-layout: fixed; vertical-align: top; min-width: 320px; border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #f9f9f9; width: 100%;" valign="top" width="100%">
				<tbody>
				<tr style="vertical-align: top;" valign="top">
				<td style="word-break: break-word; vertical-align: top;" valign="top">
				<!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td align="center" style="background-color:#f9f9f9"><![endif]-->
				<div style="background-color:transparent;">
				<div class="block-grid two-up no-stack" style="min-width: 320px; max-width: 700px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; Margin: 0 auto; background-color: transparent;">
				<div style="border-collapse: collapse;display: table;width: 100%;background-color:transparent;">
				<!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color:transparent;"><tr><td align="center"><table cellpadding="0" cellspacing="0" border="0" style="width:700px"><tr class="layout-full-width" style="background-color:transparent"><![endif]-->
				<!--[if (mso)|(IE)]><td align="center" width="350" style="background-color:transparent;width:350px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;" valign="top"><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 0px; padding-left: 0px; padding-top:5px; padding-bottom:5px;"><![endif]-->
				<div class="col num6" style="display: table-cell; vertical-align: top; max-width: 320px; min-width: 348px; width: 350px;">
				<div class="col_cont" style="width:100% !important;">
				<!--[if (!mso)&(!IE)]><!-->
				<div style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:5px; padding-bottom:5px; padding-right: 0px; padding-left: 0px;">
				<!--<![endif]-->
				<div align="left" class="img-container left fixedwidth" style="padding-right: 0px;padding-left: 25px;">
				<!--[if mso]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr style="line-height:0px"><td style="padding-right: 0px;padding-left: 25px;" align="left"><![endif]--><img alt="Alternate text" border="0" class="left fixedwidth" src="https://portal.comteco.com.bo/images/0650149b-5589-4827-88da-4a4c98cbea2d.png" style="text-decoration: none; -ms-interpolation-mode: bicubic; height: auto; border: 0; width: 100%; max-width: 245px; display: block;" title="Alternate text" width="245"/>
				<!--[if mso]></td></tr></table><![endif]-->
				</div>
				<!--[if (!mso)&(!IE)]><!-->
				</div>
				<!--<![endif]-->
				</div>
				</div>
				<!--[if (mso)|(IE)]></td></tr></table><![endif]-->
				<!--[if (mso)|(IE)]></td><td align="center" width="350" style="background-color:transparent;width:350px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;" valign="top"><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 0px; padding-left: 0px; padding-top:5px; padding-bottom:5px;"><![endif]-->
				<div class="col num6" style="display: table-cell; vertical-align: top; max-width: 320px; min-width: 348px; width: 350px;">
				<div class="col_cont" style="width:100% !important;">
				<!--[if (!mso)&(!IE)]><!-->
				<div style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:5px; padding-bottom:5px; padding-right: 0px; padding-left: 0px;">
				<!--<![endif]-->
				<!--[if mso]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 10px; padding-left: 10px; padding-top: 10px; padding-bottom: 10px; font-family: Tahoma, sans-serif"><![endif]-->
				<div style="color:#555555;font-family:Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif;line-height:1.2;padding-top:10px;padding-right:10px;padding-bottom:10px;padding-left:10px;">
				<div style="line-height: 1.2; font-size: 12px; color: #555555; font-family: Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif; mso-line-height-alt: 14px;">
				<p style="text-align: right; line-height: 1.2; word-break: break-word; mso-line-height-alt: 14px; margin: 0;">Portal COMTECO R.L.</p>
				<p style="text-align: right; line-height: 1.2; word-break: break-word; mso-line-height-alt: 14px; margin: 0;">Contacto: Int. 270</p>
				<p style="text-align: right; line-height: 1.2; word-break: break-word; mso-line-height-alt: 14px; margin: 0;">Divisi&oacute;n de Tecnolog&iacute;as de Informaci&oacute;n</p>
				</div>
				</div>
				<!--[if mso]></td></tr></table><![endif]-->
				<!--[if (!mso)&(!IE)]><!-->
				</div>
				<!--<![endif]-->
				</div>
				</div>
				<!--[if (mso)|(IE)]></td></tr></table><![endif]-->
				<!--[if (mso)|(IE)]></td></tr></table></td></tr></table><![endif]-->
				</div>
				</div>
				</div>
				<div style="background-color:transparent;">
				<div class="block-grid" style="min-width: 320px; max-width: 700px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; Margin: 0 auto; background-color: #ffffff;">
				<div style="border-collapse: collapse;display: table;width: 100%;background-color:#ffffff;">
				<!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color:transparent;"><tr><td align="center"><table cellpadding="0" cellspacing="0" border="0" style="width:700px"><tr class="layout-full-width" style="background-color:#ffffff"><![endif]-->
				<!--[if (mso)|(IE)]><td align="center" width="700" style="background-color:#ffffff;width:700px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;" valign="top"><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 0px; padding-left: 0px; padding-top:0px; padding-bottom:0px;"><![endif]-->
				<div class="col num12" style="min-width: 320px; max-width: 700px; display: table-cell; vertical-align: top; width: 700px;">
				<div class="col_cont" style="width:100% !important;">
				<!--[if (!mso)&(!IE)]><!-->
				<div style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:0px; padding-bottom:0px; padding-right: 0px; padding-left: 0px;">
				<!--<![endif]-->
				<div align="center" class="img-container center autowidth" style="padding-right: 0px;padding-left: 0px;">
				
				</div>
				<!--[if (!mso)&(!IE)]><!-->
				</div>
				<!--<![endif]-->
				</div>
				</div>
				<!--[if (mso)|(IE)]></td></tr></table><![endif]-->
				<!--[if (mso)|(IE)]></td></tr></table></td></tr></table><![endif]-->
				</div>
				</div>
				</div>
				<div style="background-color:transparent;">
				<div class="block-grid" style="min-width: 320px; max-width: 700px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; Margin: 0 auto; background-color: #ffffff;">
				<div style="border-collapse: collapse;display: table;width: 100%;background-color:#ffffff;">
				<!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color:transparent;"><tr><td align="center"><table cellpadding="0" cellspacing="0" border="0" style="width:700px"><tr class="layout-full-width" style="background-color:#ffffff"><![endif]-->
				<!--[if (mso)|(IE)]><td align="center" width="700" style="background-color:#ffffff;width:700px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;" valign="top"><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 0px; padding-left: 0px; padding-top:5px; padding-bottom:5px;"><![endif]-->
				<div class="col num12" style="min-width: 320px; max-width: 700px; display: table-cell; vertical-align: top; width: 700px;">
				<div class="col_cont" style="width:100% !important;">
				<!--[if (!mso)&(!IE)]><!-->
				<div style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:5px; padding-bottom:5px; padding-right: 0px; padding-left: 0px;">
				<!--<![endif]-->
				<!--[if mso]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 10px; padding-left: 10px; padding-top: 25px; padding-bottom: 20px; font-family: Tahoma, sans-serif"><![endif]-->
				<div style="color:#0b1560;font-family:Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif;line-height:1.2;padding-top:25px;padding-right:10px;padding-bottom:20px;padding-left:10px;">
				<div style="line-height: 1.2; font-size: 12px; font-family: Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif; color: #0b1560; mso-line-height-alt: 14px;">
				<p style="font-size: 18px; line-height: 1.2; text-align: center; word-break: break-word; font-family: Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif; mso-line-height-alt: 22px; margin: 0;"><span style="font-size: 18px;"><strong>Solicitud Programaci&oacute;n de Vacaci&oacute;n  <br>Estado: '.$estado.'</strong></span></p>
				</div>
				</div>
				<!--[if mso]></td></tr></table><![endif]-->
				<!--[if mso]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 30px; padding-left: 30px; padding-top: 10px; padding-bottom: 25px; font-family: Tahoma, sans-serif"><![endif]-->
				<div style="color:#555555;font-family:Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif;line-height:1.5;padding-top:10px;padding-right:30px;padding-bottom:25px;padding-left:30px;">
				<div style="line-height: 1.5; font-size: 12px; font-family: Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif; color: #555555; mso-line-height-alt: 18px;">
				<p style="font-size: 15px; line-height: 1.5; text-align: center; word-break: break-word; font-family: Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif; mso-line-height-alt: 23px; margin: 0;"><span style="font-size: 15px;">Estimado/a '.$employeeSol->name.' usted realizo una solicitud de programaci&oacute;n de vacaci&oacute;n la cual fue "'.$estado.'", a continuaci&oacute;n se detalla la solicitud:</span></p>
				<p style="font-size: 15px; line-height: 1.5; text-align: center; word-break: break-word; font-family: Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif; mso-line-height-alt: 23px; margin: 0;"><span style="font-size: 15px;">Solicitante: '.$employeeSol->name.'<br/>Fecha Inicio Autorizado: '.date('d/m/Y H:i',strtotime($license->date_start_auth)).'<br/>Fecha Fin Autorizado: '.date('d/m/Y H:i',strtotime($license->date_end_auth)).'<br/>Fecha Retorno Autorizado: '.date('d/m/Y H:i',strtotime($license->date_return_auth)).'<br/>D&iacute;as: '.$license->days_auth.' - Horas: '.$license->hours_auth.' - Minutos: '.$license->minutes_auth.'<br/>Observaci&oacute;n Autorizaci&oacuten: '.$license->observation_auth.'<br/><br/>Jefe Inmediato: '.$employeeAuth->name.'<br/>Estado: '.$estado.'</span></p>
				</div>
				</div>
				<!--[if mso]></td></tr></table><![endif]-->
				<!--[if (!mso)&(!IE)]><!-->
				</div>
				<!--<![endif]-->
				</div>
				</div>
				<!--[if (mso)|(IE)]></td></tr></table><![endif]-->
				<!--[if (mso)|(IE)]></td></tr></table></td></tr></table><![endif]-->
				</div>
				</div>
				</div>
				<div style="background-color:transparent;">
				<div class="block-grid" style="min-width: 320px; max-width: 700px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; Margin: 0 auto; background-color: #ffffff;">
				<div style="border-collapse: collapse;display: table;width: 100%;background-color:#ffffff;">
				<!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color:transparent;"><tr><td align="center"><table cellpadding="0" cellspacing="0" border="0" style="width:700px"><tr class="layout-full-width" style="background-color:#ffffff"><![endif]-->
				<!--[if (mso)|(IE)]><td align="center" width="700" style="background-color:#ffffff;width:700px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;" valign="top"><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 0px; padding-left: 0px; padding-top:5px; padding-bottom:5px;"><![endif]-->
				<div class="col num12" style="min-width: 320px; max-width: 700px; display: table-cell; vertical-align: top; width: 700px;">
				<div class="col_cont" style="width:100% !important;">
				<!--[if (!mso)&(!IE)]><!-->
				<div style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:5px; padding-bottom:5px; padding-right: 0px; padding-left: 0px;">
				<!--<![endif]-->
				<table border="0" cellpadding="0" cellspacing="0" class="divider" role="presentation" style="table-layout: fixed; vertical-align: top; border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; min-width: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;" valign="top" width="100%">
				<tbody>
				<tr style="vertical-align: top;" valign="top">
				<td class="divider_inner" style="word-break: break-word; vertical-align: top; min-width: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; padding-top: 10px; padding-right: 10px; padding-bottom: 10px; padding-left: 10px;" valign="top">
				<table align="center" border="0" cellpadding="0" cellspacing="0" class="divider_content" height="1" role="presentation" style="table-layout: fixed; vertical-align: top; border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-top: 1px solid #DDE3E8; height: 1px; width: 95%;" valign="top" width="95%">
				<tbody>
				<tr style="vertical-align: top;" valign="top">
				<td height="1" style="word-break: break-word; vertical-align: top; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;" valign="top"><span></span></td>
				</tr>
				</tbody>
				</table>
				</td>
				</tr>
				</tbody>
				</table>
				<!--[if (!mso)&(!IE)]><!-->
				</div>
				<!--<![endif]-->
				</div>
				</div>
				<!--[if (mso)|(IE)]></td></tr></table><![endif]-->
				<!--[if (mso)|(IE)]></td></tr></table></td></tr></table><![endif]-->
				</div>
				</div>
				</div>
				<div style="background-color:transparent;">
				<div class="block-grid" style="min-width: 320px; max-width: 700px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; Margin: 0 auto; background-color: #ffffff;">
				<div style="border-collapse: collapse;display: table;width: 100%;background-color:#ffffff;">
				<!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color:transparent;"><tr><td align="center"><table cellpadding="0" cellspacing="0" border="0" style="width:700px"><tr class="layout-full-width" style="background-color:#ffffff"><![endif]-->
				<!--[if (mso)|(IE)]><td align="center" width="700" style="background-color:#ffffff;width:700px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;" valign="top"><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 0px; padding-left: 0px; padding-top:5px; padding-bottom:5px;"><![endif]-->
				<div class="col num12" style="min-width: 320px; max-width: 700px; display: table-cell; vertical-align: top; width: 700px;">
				<div class="col_cont" style="width:100% !important;">
				<!--[if (!mso)&(!IE)]><!-->
				<div style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:5px; padding-bottom:5px; padding-right: 0px; padding-left: 0px;">
				<!--<![endif]-->
				<!--[if mso]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 10px; padding-left: 10px; padding-top: 10px; padding-bottom: 10px; font-family: Tahoma, sans-serif"><![endif]-->
				<div style="color:#555555;font-family:Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif;line-height:1.2;padding-top:10px;padding-right:10px;padding-bottom:10px;padding-left:10px;">
				<div style="line-height: 1.2; font-size: 12px; color: #555555; font-family: Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif; mso-line-height-alt: 14px;">
				<p style="font-size: 14px; line-height: 1.2; word-break: break-word; text-align: center; mso-line-height-alt: 17px; margin: 0;">NOTA: En caso de haber registrado mal la solicitud, registre nuevamente e indique a su jefe inmediato que anule esta solicitud.</p>
				</div>
				</div>
				<!--[if mso]></td></tr></table><![endif]-->
				<!--[if (!mso)&(!IE)]><!-->
				</div>
				<!--<![endif]-->
				</div>
				</div>
				<!--[if (mso)|(IE)]></td></tr></table><![endif]-->
				<!--[if (mso)|(IE)]></td></tr></table></td></tr></table><![endif]-->
				</div>
				</div>
				</div>
				<div style="background-color:transparent;">
				<div class="block-grid" style="min-width: 320px; max-width: 700px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; Margin: 0 auto; background-color: #bd0000;">
				<div style="border-collapse: collapse;display: table;width: 100%;background-color:#bd0000;">
				<!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color:transparent;"><tr><td align="center"><table cellpadding="0" cellspacing="0" border="0" style="width:700px"><tr class="layout-full-width" style="background-color:#bd0000"><![endif]-->
				<!--[if (mso)|(IE)]><td align="center" width="700" style="background-color:#bd0000;width:700px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;" valign="top"><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 0px; padding-left: 0px; padding-top:5px; padding-bottom:5px;"><![endif]-->
				<div class="col num12" style="min-width: 320px; max-width: 700px; display: table-cell; vertical-align: top; width: 700px;">
				<div class="col_cont" style="width:100% !important;">
				<!--[if (!mso)&(!IE)]><!-->
				<div style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:5px; padding-bottom:5px; padding-right: 0px; padding-left: 0px;">
				<!--<![endif]-->
				<!--[if mso]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 10px; padding-left: 10px; padding-top: 10px; padding-bottom: 10px; font-family: Tahoma, sans-serif"><![endif]-->
				<div style="color:#555555;font-family:Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif;line-height:1.2;padding-top:10px;padding-right:10px;padding-bottom:10px;padding-left:10px;">
				<div style="line-height: 1.2; font-size: 12px; color: #555555; font-family: Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif; mso-line-height-alt: 14px;">
				<p style="font-size: 14px; line-height: 1.2; word-break: break-word; text-align: center; mso-line-height-alt: 17px; margin: 0;"><strong><span style="color: #ffffff; font-size: 16px;"><a href="https://portal.comteco.com.bo" rel="noopener" style="text-decoration: underline; color: #ffffff;" target="_blank" title="Portal COMTECO R.L.">Portal COMTECO R.L.</a></span></strong></p>
				</div>
				</div>
				<!--[if mso]></td></tr></table><![endif]-->
				<!--[if (!mso)&(!IE)]><!-->
				</div>
				<!--<![endif]-->
				</div>
				</div>
				<!--[if (mso)|(IE)]></td></tr></table><![endif]-->
				<!--[if (mso)|(IE)]></td></tr></table></td></tr></table><![endif]-->
				</div>
				</div>
				</div>
				<!--[if (mso)|(IE)]></td></tr></table><![endif]-->
				</td>
				</tr>
				</tbody>
				</table>
				<!--[if (IE)]></div><![endif]-->
				</body>
				</html>';


			$mailSol = Yii::app()->Smtpmail;

	        $mailSol->addReplyTo('no-reply@comteco.com.bo', 'COMTECO R.L.');

	        

	        //$mailSol->SetFrom('no-reply@comteco.com.bo', 'COMTECO R.L.');
	    
	        //$mailSol->Sender = 'no-reply@comteco.com.bo';

       		$mailSol->SetFrom('notificaciones@comtecoRL.onmicrosoft.com', 'COMTECO R.L.');
    
        	$mailSol->Sender = 'notificaciones@comtecoRL.onmicrosoft.com';

            $mailSol->AddBCC('portal.comteco@gmail.com');

	        $mailSol->Subject = "Solicitud de Programacion de Vacacion $estado";

	        $mailSol->MsgHTML($messageSol);

	        $mailSol->AddAddress($emailsol, "");

	        if(!$mailSol->Send()) {
	            $mailSol->ClearAllRecipients();
	            $mailSol->SmtpClose();
	            $respuestaSol = $mailSol->ErrorInfo;
	        }else {
				$mailSol->ClearAttachments();		            
	            $mailSol->ClearAllRecipients();
	            $mailSol->SmtpClose();
	            $respuestaSol = 'ok';
	        }
		}

		if($emailAuth != '0'){

			$messageAuth = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional //EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

				<html xmlns="http://www.w3.org/1999/xhtml" xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:v="urn:schemas-microsoft-com:vml">
				<head>
				<!--[if gte mso 9]><xml><o:OfficeDocumentSettings><o:AllowPNG/><o:PixelsPerInch>96</o:PixelsPerInch></o:OfficeDocumentSettings></xml><![endif]-->
				<meta content="text/html; charset=utf-8" http-equiv="Content-Type"/>
				<meta content="width=device-width" name="viewport"/>
				<!--[if !mso]><!-->
				<meta content="IE=edge" http-equiv="X-UA-Compatible"/>
				<!--<![endif]-->
				<title></title>
				<!--[if !mso]><!-->
				<!--<![endif]-->
				<style type="text/css">
						body {
							margin: 0;
							padding: 0;
						}

						table,
						td,
						tr {
							vertical-align: top;
							border-collapse: collapse;
						}

						* {
							line-height: inherit;
						}

						a[x-apple-data-detectors=true] {
							color: inherit !important;
							text-decoration: none !important;
						}
					</style>
				<style id="media-query" type="text/css">
						@media (max-width: 720px) {

							.block-grid,
							.col {
								min-width: 320px !important;
								max-width: 100% !important;
								display: block !important;
							}

							.block-grid {
								width: 100% !important;
							}

							.col {
								width: 100% !important;
							}

							.col_cont {
								margin: 0 auto;
							}

							img.fullwidth,
							img.fullwidthOnMobile {
								max-width: 100% !important;
							}

							.no-stack .col {
								min-width: 0 !important;
								display: table-cell !important;
							}

							.no-stack.two-up .col {
								width: 50% !important;
							}

							.no-stack .col.num2 {
								width: 16.6% !important;
							}

							.no-stack .col.num3 {
								width: 25% !important;
							}

							.no-stack .col.num4 {
								width: 33% !important;
							}

							.no-stack .col.num5 {
								width: 41.6% !important;
							}

							.no-stack .col.num6 {
								width: 50% !important;
							}

							.no-stack .col.num7 {
								width: 58.3% !important;
							}

							.no-stack .col.num8 {
								width: 66.6% !important;
							}

							.no-stack .col.num9 {
								width: 75% !important;
							}

							.no-stack .col.num10 {
								width: 83.3% !important;
							}

							.video-block {
								max-width: none !important;
							}

							.mobile_hide {
								min-height: 0px;
								max-height: 0px;
								max-width: 0px;
								display: none;
								overflow: hidden;
								font-size: 0px;
							}

							.desktop_hide {
								display: block !important;
								max-height: none !important;
							}
						}
					</style>
				</head>
				<body class="clean-body" style="margin: 0; padding: 0; -webkit-text-size-adjust: 100%; background-color: #f9f9f9;">
				<!--[if IE]><div class="ie-browser"><![endif]-->
				<table bgcolor="#f9f9f9" cellpadding="0" cellspacing="0" class="nl-container" role="presentation" style="table-layout: fixed; vertical-align: top; min-width: 320px; border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #f9f9f9; width: 100%;" valign="top" width="100%">
				<tbody>
				<tr style="vertical-align: top;" valign="top">
				<td style="word-break: break-word; vertical-align: top;" valign="top">
				<!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td align="center" style="background-color:#f9f9f9"><![endif]-->
				<div style="background-color:transparent;">
				<div class="block-grid two-up no-stack" style="min-width: 320px; max-width: 700px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; Margin: 0 auto; background-color: transparent;">
				<div style="border-collapse: collapse;display: table;width: 100%;background-color:transparent;">
				<!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color:transparent;"><tr><td align="center"><table cellpadding="0" cellspacing="0" border="0" style="width:700px"><tr class="layout-full-width" style="background-color:transparent"><![endif]-->
				<!--[if (mso)|(IE)]><td align="center" width="350" style="background-color:transparent;width:350px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;" valign="top"><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 0px; padding-left: 0px; padding-top:5px; padding-bottom:5px;"><![endif]-->
				<div class="col num6" style="display: table-cell; vertical-align: top; max-width: 320px; min-width: 348px; width: 350px;">
				<div class="col_cont" style="width:100% !important;">
				<!--[if (!mso)&(!IE)]><!-->
				<div style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:5px; padding-bottom:5px; padding-right: 0px; padding-left: 0px;">
				<!--<![endif]-->
				<div align="left" class="img-container left fixedwidth" style="padding-right: 0px;padding-left: 25px;">
				<!--[if mso]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr style="line-height:0px"><td style="padding-right: 0px;padding-left: 25px;" align="left"><![endif]--><img alt="Alternate text" border="0" class="left fixedwidth" src="https://portal.comteco.com.bo/images/0650149b-5589-4827-88da-4a4c98cbea2d.png" style="text-decoration: none; -ms-interpolation-mode: bicubic; height: auto; border: 0; width: 100%; max-width: 245px; display: block;" title="Alternate text" width="245"/>
				<!--[if mso]></td></tr></table><![endif]-->
				</div>
				<!--[if (!mso)&(!IE)]><!-->
				</div>
				<!--<![endif]-->
				</div>
				</div>
				<!--[if (mso)|(IE)]></td></tr></table><![endif]-->
				<!--[if (mso)|(IE)]></td><td align="center" width="350" style="background-color:transparent;width:350px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;" valign="top"><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 0px; padding-left: 0px; padding-top:5px; padding-bottom:5px;"><![endif]-->
				<div class="col num6" style="display: table-cell; vertical-align: top; max-width: 320px; min-width: 348px; width: 350px;">
				<div class="col_cont" style="width:100% !important;">
				<!--[if (!mso)&(!IE)]><!-->
				<div style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:5px; padding-bottom:5px; padding-right: 0px; padding-left: 0px;">
				<!--<![endif]-->
				<!--[if mso]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 10px; padding-left: 10px; padding-top: 10px; padding-bottom: 10px; font-family: Tahoma, sans-serif"><![endif]-->
				<div style="color:#555555;font-family:Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif;line-height:1.2;padding-top:10px;padding-right:10px;padding-bottom:10px;padding-left:10px;">
				<div style="line-height: 1.2; font-size: 12px; color: #555555; font-family: Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif; mso-line-height-alt: 14px;">
				<p style="text-align: right; line-height: 1.2; word-break: break-word; mso-line-height-alt: 14px; margin: 0;">Portal COMTECO R.L.</p>
				<p style="text-align: right; line-height: 1.2; word-break: break-word; mso-line-height-alt: 14px; margin: 0;">Contacto: Int. 270</p>
				<p style="text-align: right; line-height: 1.2; word-break: break-word; mso-line-height-alt: 14px; margin: 0;">Divisi&oacute;n de Tecnolog&iacute;as de Informaci&oacute;n</p>
				</div>
				</div>
				<!--[if mso]></td></tr></table><![endif]-->
				<!--[if (!mso)&(!IE)]><!-->
				</div>
				<!--<![endif]-->
				</div>
				</div>
				<!--[if (mso)|(IE)]></td></tr></table><![endif]-->
				<!--[if (mso)|(IE)]></td></tr></table></td></tr></table><![endif]-->
				</div>
				</div>
				</div>
				<div style="background-color:transparent;">
				<div class="block-grid" style="min-width: 320px; max-width: 700px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; Margin: 0 auto; background-color: #ffffff;">
				<div style="border-collapse: collapse;display: table;width: 100%;background-color:#ffffff;">
				<!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color:transparent;"><tr><td align="center"><table cellpadding="0" cellspacing="0" border="0" style="width:700px"><tr class="layout-full-width" style="background-color:#ffffff"><![endif]-->
				<!--[if (mso)|(IE)]><td align="center" width="700" style="background-color:#ffffff;width:700px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;" valign="top"><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 0px; padding-left: 0px; padding-top:0px; padding-bottom:0px;"><![endif]-->
				<div class="col num12" style="min-width: 320px; max-width: 700px; display: table-cell; vertical-align: top; width: 700px;">
				<div class="col_cont" style="width:100% !important;">
				<!--[if (!mso)&(!IE)]><!-->
				<div style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:0px; padding-bottom:0px; padding-right: 0px; padding-left: 0px;">
				<!--<![endif]-->
				<div align="center" class="img-container center autowidth" style="padding-right: 0px;padding-left: 0px;">
				
				</div>
				<!--[if (!mso)&(!IE)]><!-->
				</div>
				<!--<![endif]-->
				</div>
				</div>
				<!--[if (mso)|(IE)]></td></tr></table><![endif]-->
				<!--[if (mso)|(IE)]></td></tr></table></td></tr></table><![endif]-->
				</div>
				</div>
				</div>
				<div style="background-color:transparent;">
				<div class="block-grid" style="min-width: 320px; max-width: 700px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; Margin: 0 auto; background-color: #ffffff;">
				<div style="border-collapse: collapse;display: table;width: 100%;background-color:#ffffff;">
				<!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color:transparent;"><tr><td align="center"><table cellpadding="0" cellspacing="0" border="0" style="width:700px"><tr class="layout-full-width" style="background-color:#ffffff"><![endif]-->
				<!--[if (mso)|(IE)]><td align="center" width="700" style="background-color:#ffffff;width:700px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;" valign="top"><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 0px; padding-left: 0px; padding-top:5px; padding-bottom:5px;"><![endif]-->
				<div class="col num12" style="min-width: 320px; max-width: 700px; display: table-cell; vertical-align: top; width: 700px;">
				<div class="col_cont" style="width:100% !important;">
				<!--[if (!mso)&(!IE)]><!-->
				<div style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:5px; padding-bottom:5px; padding-right: 0px; padding-left: 0px;">
				<!--<![endif]-->
				<!--[if mso]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 10px; padding-left: 10px; padding-top: 25px; padding-bottom: 20px; font-family: Tahoma, sans-serif"><![endif]-->
				<div style="color:#0b1560;font-family:Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif;line-height:1.2;padding-top:25px;padding-right:10px;padding-bottom:20px;padding-left:10px;">
				<div style="line-height: 1.2; font-size: 12px; font-family: Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif; color: #0b1560; mso-line-height-alt: 14px;">
				<p style="font-size: 18px; line-height: 1.2; text-align: center; word-break: break-word; font-family: Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif; mso-line-height-alt: 22px; margin: 0;"><span style="font-size: 18px;"><strong>Solicitud Programaci&oacute;n de Vacaci&oacute;n <br>Estado: '.$estado.'</strong></span></p>
				</div>
				</div>
				<!--[if mso]></td></tr></table><![endif]-->
				<!--[if mso]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 30px; padding-left: 30px; padding-top: 10px; padding-bottom: 25px; font-family: Tahoma, sans-serif"><![endif]-->
				<div style="color:#555555;font-family:Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif;line-height:1.5;padding-top:10px;padding-right:30px;padding-bottom:25px;padding-left:30px;">
				<div style="line-height: 1.5; font-size: 12px; font-family: Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif; color: #555555; mso-line-height-alt: 18px;">
				<p style="font-size: 15px; line-height: 1.5; text-align: center; word-break: break-word; font-family: Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif; mso-line-height-alt: 23px; margin: 0;"><span style="font-size: 15px;">Estimado/a '.$employeeAuth->name.' la solicitud del funcionario/a '.$employeeSol->name.' fue "'.$estado.'", a continuaci&oacute;n se detalla la solicitud de programaci&oacute;n de vacaci&oacute;n:</span></p>
				<p style="font-size: 15px; line-height: 1.5; text-align: center; word-break: break-word; font-family: Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif; mso-line-height-alt: 23px; margin: 0;"><span style="font-size: 15px;">Solicitante: '.$employeeSol->name.'<br/>Fecha Inicio Autorizado: '.date('d/m/Y H:i',strtotime($license->date_start_auth)).'<br/>Fecha Fin Autorizado: '.date('d/m/Y H:i',strtotime($license->date_end_auth)).'<br/>Fecha Retorno Autorizado: '.date('d/m/Y H:i',strtotime($license->date_return_auth)).'<br/>D&iacute;as: '.$license->days_auth.' - Horas: '.$license->hours_auth.' - Minutos: '.$license->minutes_auth.'<br/>Observaci&oacute;n Autorizaci&oacuten: '.$license->observation_auth.'<br/><br/>Jefe Inmediato: '.$employeeAuth->name.'<br/>Estado: '.$estado.'</span></p>
				</div>
				</div>
				<!--[if mso]></td></tr></table><![endif]-->
				<!--[if (!mso)&(!IE)]><!-->
				</div>
				<!--<![endif]-->
				</div>
				</div>
				<!--[if (mso)|(IE)]></td></tr></table><![endif]-->
				<!--[if (mso)|(IE)]></td></tr></table></td></tr></table><![endif]-->
				</div>
				</div>
				</div>
				<div style="background-color:transparent;">
				<div class="block-grid" style="min-width: 320px; max-width: 700px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; Margin: 0 auto; background-color: #ffffff;">
				<div style="border-collapse: collapse;display: table;width: 100%;background-color:#ffffff;">
				<!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color:transparent;"><tr><td align="center"><table cellpadding="0" cellspacing="0" border="0" style="width:700px"><tr class="layout-full-width" style="background-color:#ffffff"><![endif]-->
				<!--[if (mso)|(IE)]><td align="center" width="700" style="background-color:#ffffff;width:700px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;" valign="top"><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 0px; padding-left: 0px; padding-top:5px; padding-bottom:5px;"><![endif]-->
				<div class="col num12" style="min-width: 320px; max-width: 700px; display: table-cell; vertical-align: top; width: 700px;">
				<div class="col_cont" style="width:100% !important;">
				<!--[if (!mso)&(!IE)]><!-->
				<div style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:5px; padding-bottom:5px; padding-right: 0px; padding-left: 0px;">
				<!--<![endif]-->
				<table border="0" cellpadding="0" cellspacing="0" class="divider" role="presentation" style="table-layout: fixed; vertical-align: top; border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; min-width: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;" valign="top" width="100%">
				<tbody>
				<tr style="vertical-align: top;" valign="top">
				<td class="divider_inner" style="word-break: break-word; vertical-align: top; min-width: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; padding-top: 10px; padding-right: 10px; padding-bottom: 10px; padding-left: 10px;" valign="top">
				<table align="center" border="0" cellpadding="0" cellspacing="0" class="divider_content" height="1" role="presentation" style="table-layout: fixed; vertical-align: top; border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-top: 1px solid #DDE3E8; height: 1px; width: 95%;" valign="top" width="95%">
				<tbody>
				<tr style="vertical-align: top;" valign="top">
				<td height="1" style="word-break: break-word; vertical-align: top; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;" valign="top"><span></span></td>
				</tr>
				</tbody>
				</table>
				</td>
				</tr>
				</tbody>
				</table>
				<!--[if (!mso)&(!IE)]><!-->
				</div>
				<!--<![endif]-->
				</div>
				</div>
				<!--[if (mso)|(IE)]></td></tr></table><![endif]-->
				<!--[if (mso)|(IE)]></td></tr></table></td></tr></table><![endif]-->
				</div>
				</div>
				</div>
				<div style="background-color:transparent;">
				<div class="block-grid" style="min-width: 320px; max-width: 700px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; Margin: 0 auto; background-color: #ffffff;">
				<div style="border-collapse: collapse;display: table;width: 100%;background-color:#ffffff;">
				<!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color:transparent;"><tr><td align="center"><table cellpadding="0" cellspacing="0" border="0" style="width:700px"><tr class="layout-full-width" style="background-color:#ffffff"><![endif]-->
				<!--[if (mso)|(IE)]><td align="center" width="700" style="background-color:#ffffff;width:700px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;" valign="top"><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 0px; padding-left: 0px; padding-top:5px; padding-bottom:5px;"><![endif]-->
				<div class="col num12" style="min-width: 320px; max-width: 700px; display: table-cell; vertical-align: top; width: 700px;">
				<div class="col_cont" style="width:100% !important;">
				<!--[if (!mso)&(!IE)]><!-->
				<div style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:5px; padding-bottom:5px; padding-right: 0px; padding-left: 0px;">
				<!--<![endif]-->
				<!--[if mso]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 10px; padding-left: 10px; padding-top: 10px; padding-bottom: 10px; font-family: Tahoma, sans-serif"><![endif]-->
				<div style="color:#555555;font-family:Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif;line-height:1.2;padding-top:10px;padding-right:10px;padding-bottom:10px;padding-left:10px;">
				<div style="line-height: 1.2; font-size: 12px; color: #555555; font-family: Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif; mso-line-height-alt: 14px;">
				<p style="font-size: 14px; line-height: 1.2; word-break: break-word; text-align: center; mso-line-height-alt: 17px; margin: 0;">NOTA: En caso de haber registrado mal la solicitud, registre nuevamente e indique a su jefe inmediato que anule esta solicitud.</p>
				</div>
				</div>
				<!--[if mso]></td></tr></table><![endif]-->
				<!--[if (!mso)&(!IE)]><!-->
				</div>
				<!--<![endif]-->
				</div>
				</div>
				<!--[if (mso)|(IE)]></td></tr></table><![endif]-->
				<!--[if (mso)|(IE)]></td></tr></table></td></tr></table><![endif]-->
				</div>
				</div>
				</div>
				<div style="background-color:transparent;">
				<div class="block-grid" style="min-width: 320px; max-width: 700px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; Margin: 0 auto; background-color: #bd0000;">
				<div style="border-collapse: collapse;display: table;width: 100%;background-color:#bd0000;">
				<!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color:transparent;"><tr><td align="center"><table cellpadding="0" cellspacing="0" border="0" style="width:700px"><tr class="layout-full-width" style="background-color:#bd0000"><![endif]-->
				<!--[if (mso)|(IE)]><td align="center" width="700" style="background-color:#bd0000;width:700px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;" valign="top"><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 0px; padding-left: 0px; padding-top:5px; padding-bottom:5px;"><![endif]-->
				<div class="col num12" style="min-width: 320px; max-width: 700px; display: table-cell; vertical-align: top; width: 700px;">
				<div class="col_cont" style="width:100% !important;">
				<!--[if (!mso)&(!IE)]><!-->
				<div style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:5px; padding-bottom:5px; padding-right: 0px; padding-left: 0px;">
				<!--<![endif]-->
				<!--[if mso]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 10px; padding-left: 10px; padding-top: 10px; padding-bottom: 10px; font-family: Tahoma, sans-serif"><![endif]-->
				<div style="color:#555555;font-family:Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif;line-height:1.2;padding-top:10px;padding-right:10px;padding-bottom:10px;padding-left:10px;">
				<div style="line-height: 1.2; font-size: 12px; color: #555555; font-family: Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif; mso-line-height-alt: 14px;">
				<p style="font-size: 14px; line-height: 1.2; word-break: break-word; text-align: center; mso-line-height-alt: 17px; margin: 0;"><strong><span style="color: #ffffff; font-size: 16px;"><a href="https://portal.comteco.com.bo" rel="noopener" style="text-decoration: underline; color: #ffffff;" target="_blank" title="Portal COMTECO R.L.">Portal COMTECO R.L.</a></span></strong></p>
				</div>
				</div>
				<!--[if mso]></td></tr></table><![endif]-->
				<!--[if (!mso)&(!IE)]><!-->
				</div>
				<!--<![endif]-->
				</div>
				</div>
				<!--[if (mso)|(IE)]></td></tr></table><![endif]-->
				<!--[if (mso)|(IE)]></td></tr></table></td></tr></table><![endif]-->
				</div>
				</div>
				</div>
				<!--[if (mso)|(IE)]></td></tr></table><![endif]-->
				</td>
				</tr>
				</tbody>
				</table>
				<!--[if (IE)]></div><![endif]-->
				</body>
				</html>';

			$mailAuth = Yii::app()->Smtpmail;

	        //$mailAuth->addReplyTo('no-reply@comteco.com.bo', 'COMTECO R.L.');

	        //$mailAuth->SetFrom('no-reply@comteco.com.bo', 'COMTECO R.L.');

       		$mailAuth->SetFrom('notificaciones@comtecoRL.onmicrosoft.com', 'COMTECO R.L.');
    
        	$mailAuth->Sender = 'notificaciones@comtecoRL.onmicrosoft.com';
	    
	        $mailAuth->Sender = 'no-reply@comteco.com.bo';

	        $mailAuth->AddBCC('portal.comteco@gmail.com');

	        $mailAuth->Subject = "Solicitud de Programacion de Vacacion $estado";

	        $mailAuth->MsgHTML($messageAuth);

	        $mailAuth->AddAddress($emailAuth, "");

	        if(!$mailAuth->Send()) {
	            $mailAuth->ClearAllRecipients();
	            $mailAuth->SmtpClose();
	            $respuestaAuth = $mailAuth->ErrorInfo;
	        }else {
				$mailAuth->ClearAttachments();		            
	            $mailAuth->ClearAllRecipients();
	            $mailAuth->SmtpClose();
	            $respuestaAuth = 'ok';
	        }
		}

		$send = array('mailSolicitante'=>$respuestaSol,'mailAutoriza'=>$respuestaAuth);

		return $send;
	}
}