<?php
date_default_timezone_set('America/La_Paz');
// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'Mi Comteco',
	'theme'=>'classic',
	'defaultController' => 'api/verificate',//por defecto es site/index
	'preload'=>array('log'),
	'language'=>'es',
	// preloading 'log' component
	'preload'=>array('log'),
	//'timeZone' => 'Pacific/Tahiti',
	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
		//CRUGE (ADMINISTRADOR DE USUARIOS) IMPORT
		'application.modules.cruge.components.*',
		'application.modules.cruge.extensions.crugemailer.*',
	),

	'modules'=>array(
		// uncomment the following to enable the Gii tool
		
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'comteco',
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1'),
		),
		//CRUGE (ADMINISTRADOR DE USUARIOS) CONFIG
		'cruge'=>array(
			'tableprefix'=>'cruge_',
			// para que utilice a protected.modules.cruge.models.auth.CrugeAuthDefault.php
			//
			// en vez de 'default' pon 'authdemo' para que utilice el demo de autenticacion alterna
			// para saber mas lee documentacion de la clase modules/cruge/models/auth/AlternateAuthDe
			//
			'availableAuthMethods'=>array('default'),
			'availableAuthModes'=>array('username','email'),
			// url base para los links de activacion de cuenta de usuario
			'baseUrl'=>'http://coco.com/',
			// NO OLVIDES PONER EN FALSE TRAS INSTALAR
			'debug'=>true,
			'rbacSetupEnabled'=>true,
			'allowUserAlways'=>false,
			// MIENTRAS INSTALAS..PONLO EN: false
			// lee mas abajo respecto a 'Encriptando las claves'
			//
			'useEncryptedPassword' => false,
			// Algoritmo de la función hash que deseas usar
			// Los valores admitidos están en: http://www.php.net/manual/en/function.hash-algos.
			//'hash' => 'md5',
			// Estos tres atributos controlan la redirección del usuario. Solo serán son usados // hay un filtro de sesion definido (el componente MiSesionCruge), es mejor usar un // lee en la wiki acerca de:
			// "CONTROL AVANZADO DE SESIONES Y EVENTOS DE AUTENTICACION Y SESION"
			//
			// ejemplo:
			// 'afterLoginUrl'=>array('/site/welcome'), ( !!! no olvidar el slash // 'afterLogoutUrl'=>array('/site/page','view'=>'about'),
			//
			'afterLoginUrl'=>null,
			'afterLogoutUrl'=>null,
			'afterSessionExpiredUrl'=>null,
			// manejo del layout con cruge.
			//
			'loginLayout'=>'//layouts/column2',
			'registrationLayout'=>'//layouts/column2',
			'activateAccountLayout'=>'//layouts/column2',
			'editProfileLayout'=>'//layouts/column2',
			// en la siguiente puedes especificar el valor "ui" o "column2" para que use el layout
			// de fabrica, es basico pero funcional. si pones otro valor considera que cruge
			// requerirá de un portlet para desplegar un menu con las opciones de administrador.
			//
			'generalUserManagementLayout'=>'ui',
			// permite indicar un array con los nombres de campos personalizados,
			// incluyendo username y/o email para personalizar la respuesta de una consulta a:
			// $usuario->getUserDescription();
			'userDescriptionFieldsArray'=>array('email'),
		),
		
	),

	// application components
	'components'=>array(

		// CRUGE (ADMINISTRADOR DE USUARIOS Y ROLES)
		//
		// IMPORTANTE: asegurate de que la entrada 'user' (y format) que por defecto trae Yii
		// sea sustituida por estas a continuación:
		//
		'user'=>array(
			'allowAutoLogin'=>true,
			'class' => 'application.modules.cruge.components.CrugeWebUser',
			'loginUrl' => array('/cruge/ui/login'),
		),
		'authManager' => array(
			'class' => 'application.modules.cruge.components.CrugeAuthManager',
		),
		'crugemailer'=>array(
			'class' => 'application.modules.cruge.components.CrugeMailer',
			'mailfrom' => 'email-desde-donde-quieres-enviar-los-mensajes@xxxx.com',
			'subjectprefix' => 'Tu Encabezado del asunto - ',
			'debug' => true,
		),
		'format' => array(
			'datetimeFormat'=>"d M, Y h:m:s a",
		),
		//EXTENSION MPDF
		'ePdf' => array(
                    'class'         => 'ext.yii-pdf.EYiiPdf',
                    'params'        => array(
                    'mpdf'     => array(
                    'librarySourcePath' => 'application.vendors.mpdf.*',
                    'constants'         => array(
                        '_MPDF_TEMP_PATH' => Yii::getPathOfAlias('application.runtime'),
                    ),
                    'class'=>'mpdf', // the literal class filename to be loaded from the vendors folder
                ),
                'HTML2PDF' => array(
                    'librarySourcePath' => 'application.vendors.html2pdf.*',
                    'classFile'         => 'html2pdf.class.php', // For adding to Yii::$classMap
                    /*'defaultParams'     => array( // More info: http://wiki.spipu.net/doku.php?id=html2pdf:en:v4:accueil
                        'orientation' => 'P', // landscape or portrait orientation
                        'format'      => 'A4', // format A4, A5, ...
                        'language'    => 'en', // language: fr, en, it ...
                        'unicode'     => true, // TRUE means clustering the input text IS unicode (default = true)
                        'encoding'    => 'UTF-8', // charset encoding; Default is UTF-8
                        'marges'      => array(5, 5, 5, 8), // margins by default, in order (left, top, right, bottom)
                    )*/
                        )
                    ),
                ),

		// database settings are configured in database.php
		'db'=>require(dirname(__FILE__).'/database.php'),

		'dbMedical'=>require(dirname(__FILE__).'/databaseConsultorio.php'),

		'dbldap'=>require(dirname(__FILE__).'/databaseLdap.php'),

		'dbqflow'=>require(dirname(__FILE__).'/databaseQflow.php'),

		'dbestadisticas'=>require(dirname(__FILE__).'/databaseEstadisticas.php'),

		'dbpoa'=>require(dirname(__FILE__).'/databasePoa.php'),

		'dbapo'=>require(dirname(__FILE__).'/databaseApo.php'),

		'dbsirhu'=>require(dirname(__FILE__).'/databaseSirhu.php'),

		'errorHandler'=>array(
			// use 'site/error' action to display errors
			'errorAction'=>YII_DEBUG ? null : 'site/error',
		),



		'Smtpmail'=>array(
			'class'=>'application.extensions.smtpmail.PHPMailer',
			'Host'=>"smtp.office365.com",
			'Username'=>'notificaciones@comtecoRL.onmicrosoft.com',
			'Password'=>'Comt3c0.',    		
			//'SMTPDebug'  => 4,
			'Mailer'=>'smtp',
			'Port'=>587,
			'SMTPAuth'=>true,
			'SMTPSecure' => 'tls',
		),

		/*'Smtpmail'=>array(
			'class'=>'application.extensions.smtpmail.PHPMailer',
			'Host'=>"smtp.gmail.com",
    			'Username'=>'portal.comteco@gmail.com',
    			'Password'=>'Comteco2020.',    		
			//'SMTPDebug'  => 4,
			'Mailer'=>'smtp',
    			'Port'=>587,
    			'SMTPAuth'=>true,
			'SMTPSecure' => 'tls',
    		),*/

		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
				// uncomment the following to show log messages on web pages
				/*
				array(
					'class'=>'CWebLogRoute',
				),
				*/
			),
		),

	),

	'params'=>array(
		//RUMANO OFICIAL
		'dbrrhhuser'=>'unap_consulta',
		'dbrrhhpass'=>'nap',
		'dbrrhhconnect'=>'(DESCRIPTION = (ADDRESS = (PROTOCOL = TCP)(HOST = 192.9.200.207)(PORT = 1521)) (CONNECT_DATA = (SERVICE_NAME = DB1) (SID = DB1)))',
		//LLAVE INGRESO CONSULTAS RHUMANO
		'rrhhuser'=>'USUARIO',

		//QFLOW OFICIAL
		'dbqflowuser'=>'qflow',
		'dbqflowpass'=>'c0t3c0',
		'dbqflowconnect'=>'(DESCRIPTION = (ADDRESS = (PROTOCOL = TCP)(HOST = 192.9.200.207)(PORT = 1521)) (CONNECT_DATA = (SERVICE_NAME = DB1) (SID = DB1)))',
/*
		//LICENCIAS PRUEBA
		'phdbrrhhuser'=>'UNAP_WEB',
		'phdbrrhhpass'=>'web2019',
		'phdbrrhhconnect'=>'(DESCRIPTION=(ADDRESS=(PROTOCOL=TCP)(HOST=192.9.200.24)(PORT=1521))(CONNECT_DATA=(DB=DB1)(SID=DB1)))',
		'phrrhhuser'=>'Admin',
*/
		//LICENCIAS OFICIAL
		'phdbrrhhuser'=>'UNAP_WEB',
		'phdbrrhhpass'=>'web2020user',
		'phdbrrhhconnect'=>'(DESCRIPTION = (ADDRESS = (PROTOCOL = TCP)(HOST = 192.9.200.207)(PORT = 1521)) (CONNECT_DATA = (SERVICE_NAME = DB1) (SID = DB1)))',
		'phrrhhuser'=>'PORTAL_WEB',
	),
);
