<?php

class RedirectController extends Controller
{
	public function actionIndex()
	{
		$this->render('index');
	}

	public function actionSend()
	{
		if(isset($_GET['data']))
		{
			//print_r($_GET['data']);
			if(isset($_GET['username']))
			{
				//validar
				$uno = base64_decode($_GET['data']);
				$dos = base64_decode($uno);				
				$pieces = explode("#", $dos);   
				$pieces[0]; // hoy 
				$pieces[1]; // usuario
				$usuario= base64_decode($pieces[1]);

				if($_GET['username'] == $usuario)
				{					
					header("Location: https://pagos.comteco.com.bo/api-php-react-cobro/obtener_ingreso.php/?data=".$_GET['data']."");
					exit();
				}else{
					header("Location: https://portal.comteco.com.bo/index.php?r=cruge/ui/login");
					exit();
				}
			}else{
				header("Location: https://portal.comteco.com.bo/index.php?r=cruge/ui/login");
				exit();					
			}		
		}else{
			header("Location: https://portal.comteco.com.bo/index.php?r=cruge/ui/login");
			exit();	
		}
		//$this->render('index');
	}

	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
}