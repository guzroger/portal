<?php
class ApiController extends Controller
{
    private function _publicActionsList()
    {
        return array(
            'error',
            'verificate',
            'sendLicReg',
            'sendLicConfirm',
            'execute'

        );
    }

    public function filters()
    {
        return array_merge(
            array(
                'accessControl',
                array('CrugeUiAccessControlFilter', 'publicActions' => self::_publicActionsList()),
            )
        );
    }

    public function accessRules()
    {
        return array(
            array(
                'allow',
                'actions' => self::_publicActionsList(),
                'users' => array('@'),
            ),
            array(
                'allow',
                'users' => array('@'),
            ),
            array(
                'deny', // deny all users
                'users' => array('@'),
            ),
        );
    }
    public function actionVerificate(){

        $usuario = Yii::app()->user->um->loadUserById(Yii::app()->user->id);

        if($usuario != null){

            if($usuario->username == 'invitado'){
                $this->redirect(Yii::app()->createUrl('cruge/ui/login',array()));
            }else{

                $login = $usuario->username;

                $usuariologin = Yii::app()->user->um->loadUser($login);

                $buscarSesion = Yii::app()->user->um->findSession($usuariologin);

                if($buscarSesion == null){ 
                    $this->redirect(Yii::app()->createUrl('cruge/ui/login',array()));
                }else{
                    $this->redirect(Yii::app()->createUrl('site/index',array()));
                }
            }
        }else{
            $this->redirect(Yii::app()->createUrl('cruge/ui/login',array()));
        }

        //print_r($usuario);
    }


    
    public function actionExecute(){

        // Ignorar los abortos hechos por el usuario y permitir que el script
        // se ejecute siempre
        ignore_user_abort(true);
        set_time_limit(0);

        $api = new ApiEmployee;

        $usuario = $api->Users();

        $empleados = $api->Employees();

        $empleadoHorario = $api->EmployeesSchedule();

        $horarios = $api->RegisterSchedule();

        $inactivos = $api->EmployeesInactive();

        $supervisores = $api->EmployeesSupervisor();

        $send = array('usuario'=>$usuario,'empleados'=>$empleados,'empleadoHorario'=>$empleadoHorario,'horarios'=>$horarios,'inactivos'=>$inactivos,'supervisores'=>$supervisores);

        print_r($send);
    }

	public function actionUsers(){

		$api = new ApiEmployee;

		$model = $api->Users();

		print_r($model);
	}
	
	public function actionEmployees(){

		$api = new ApiEmployee;

		$model = $api->Employees();

		print_r($model);
	}
    
    public function actionEmployeesSchedule(){

        $api = new ApiEmployee;

        $model = $api->EmployeesSchedule();

        print_r($model);
    }
    
    public function actionRegisterSchedule(){

        $api = new ApiEmployee;

        $model = $api->RegisterSchedule();

        print_r($model);
    }
    
    public function actionEmployeesInactive(){

        $api = new ApiEmployee;

        $model = $api->EmployeesInactive();

        print_r($model);
    }
    
    public function actionEmployeesSupervisor(){

        $api = new ApiEmployee;

        $model = $api->EmployeesSupervisor();

        print_r($model);
    }


    public function actionSendLicReg(){
        $id = $_GET['id'];

        $api = new ApiSend;

        $model = $api->SendLicense($id);

        echo json_encode($model);
    }


    public function actionSendLicConfirm(){
        $id = $_GET['id'];

        $api = new ApiSend;

        $model = $api->SendLicenseConfirm($id);

        echo json_encode($model);
    }

    public function actionShowPersonal($filename = false)
    {
        
        if ($filename)
        {
            $path =  Yii::getPathOfAlias('application.images'). '/employee/';
            if (file_exists($path. $filename))
            {
                /*Yii::app()->request->sendFile(
                    $filename,
                    file_get_contents($path. $filename)
                );*/

				$file = $path. $filename;
                header('Content-type: image/jpeg');
                header('Content-Disposition: inline; filename="' . $filename . '"');
                header('Content-Transfer-Encoding: binary');
                header('Accept-Ranges: bytes');
                @readfile($file); 

            } else {
                $file = $path. 'user.png';
                header('Content-type: image/jpeg');
                header('Content-Disposition: inline; filename="' . $filename . '"');
                header('Content-Transfer-Encoding: binary');
                header('Accept-Ranges: bytes');
                @readfile($file); 
            }
        }
    }

    public function actionShowGallery($filename = false)
    {
        
        if ($filename)
        {
            $path =  Yii::getPathOfAlias('application.images'). '/gallery/';
            if (file_exists($path. $filename))
            {
                /*Yii::app()->request->sendFile(
                    $filename,
                    file_get_contents($path. $filename)
                );*/

                $file = $path. $filename;
                header('Content-type: image/jpeg');
                header('Content-Disposition: inline; filename="' . $filename . '"');
                header('Content-Transfer-Encoding: binary');
                header('Accept-Ranges: bytes');
                @readfile($file); 

            } else {
                echo "File not found!";
            }
        }
    }

    public function actionShowCompany($filename = false)
    {
        
        if ($filename)
        {
            $path =  Yii::getPathOfAlias('application.images'). '/company/';
            if (file_exists($path. $filename))
            {
                /*Yii::app()->request->sendFile(
                    $filename,
                    file_get_contents($path. $filename)
                );*/

                $file = $path. $filename;
                header('Content-type: image/jpeg');
                header('Content-Disposition: inline; filename="' . $filename . '"');
                header('Content-Transfer-Encoding: binary');
                header('Accept-Ranges: bytes');
                @readfile($file); 

            } else {
                echo "File not found!";
            }
        }
    }

    public function actionShowGroups($filename = false)
    {
        
        if ($filename)
        {
            $path =  Yii::getPathOfAlias('application.images'). '/groups/';
            if (file_exists($path. $filename))
            {
                /*Yii::app()->request->sendFile(
                    $filename,
                    file_get_contents($path. $filename)
                );*/

                $file = $path. $filename;
                header('Content-type: image/jpeg');
                header('Content-Disposition: inline; filename="' . $filename . '"');
                header('Content-Transfer-Encoding: binary');
                header('Accept-Ranges: bytes');
                @readfile($file); 

            } else {
                echo "File not found!";
            }
        }
    }

    public function actionShowPublicationImages($filename = false)
    {
        
        if ($filename)
        {
            $path =  Yii::getPathOfAlias('application.images'). '/publications/images/';
            if (file_exists($path. $filename))
            {
                /*Yii::app()->request->sendFile(
                    $filename,
                    file_get_contents($path. $filename)
                );*/

                $file = $path. $filename;
                header('Content-type: image/jpeg');
                header('Content-Disposition: inline; filename="' . $filename . '"');
                header('Content-Transfer-Encoding: binary');
                header('Accept-Ranges: bytes');
                @readfile($file); 

            } else {
                echo "File not found!";
            }
        }
    }

    public function actionShowPublicationVideo($filename = false)
    {
        
        if ($filename)
        {
            $path =  Yii::getPathOfAlias('application.images'). '/publications/videos/';
            if (file_exists($path. $filename))
            {
                /*Yii::app()->request->sendFile(
                    $filename,
                    file_get_contents($path. $filename)
                );*/

                $file = $path. $filename;
                header('Content-type: video/mp4');
                header('Content-Disposition: inline; filename="' . $filename . '"');
                header('Content-Transfer-Encoding: binary');
                header('Accept-Ranges: bytes');
                @readfile($file); 

            } else {
                echo "File not found!";
            }
        }
    }

    public function actionShowPublicationFiles($filename = false)
    {
        
        if ($filename)
        {
            $path =  Yii::getPathOfAlias('application.images'). '/publications/files/';
            if (file_exists($path. $filename))
            {
                Yii::app()->request->sendFile(
                    $filename,
                    file_get_contents($path. $filename)
                );

            } else {
                echo "File not found!";
            }
        }
    }

    public function actionShowModulesFiles($filename = false, $code)
    {
        
        if ($filename)
        {
            $find = ModuleType::model()->findByAttributes(array('code'=>$code,'status'=>1));

            if(!empty($find)){

                $folder = $find->folder.'/';

                $path =  Yii::getPathOfAlias('application.images'). "/modules/".$folder;
                if (file_exists($path. $filename))
                {
                    Yii::app()->request->sendFile(
                        $filename,
                        file_get_contents($path. $filename)
                    );

                } else {
                    echo "File not found!".$path;
                }

            }else{
                echo "Error Modulo no reconocido";
            }
        }
    }
}
?>