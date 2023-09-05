<?php
class ModulesController extends Controller
{	
    private function _publicActionsList()
    {
        return array(
            'error'
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
	public function actionIndex()
	{
		$usuario = Yii::app()->user->um->loadUserById(Yii::app()->user->id);

        if($usuario != null){

            if($usuario->username == 'invitado'){
                $this->redirect(Yii::app()->createUrl('cruge/ui/login',array()));
            }else{

                $login = $usuario->username;

                $usuariologin = Yii::app()->user->um->loadUser($login);

                $buscarSesion = Yii::app()->user->um->findSession($usuariologin);

                if($buscarSesion != null){ 

                	if(isset($_GET['modC'])){

                		$code = $_GET['modC'];

                		if($code != null){
                			$find = ModuleType::model()->findByAttributes(array('code'=>$code,'status'=>1));

                			if(!empty($find)){

								$this->pageTitle = $find->name;

								$api = new IntraModules;

								$id = $find->id;

								$model = $api->GetModules($id);

								$this->render('index',array('model'=>$model));

                			}else{
                				$this->redirect(Yii::app()->createUrl('site/index',array()));
                			}

                		}else{
                			$this->redirect(Yii::app()->createUrl('site/index',array()));
                		}
                	}else{
                		$this->redirect(Yii::app()->createUrl('site/index',array()));
                	}
                    
                }else{
                    $this->redirect(Yii::app()->createUrl('cruge/ui/login',array()));
                }
            }
        }else{
            $this->redirect(Yii::app()->createUrl('cruge/ui/login',array()));
        }
	}


    public function actionCreate()
    {
        $usuario = Yii::app()->user->um->loadUserById(Yii::app()->user->id);

        if($usuario != null){

            if($usuario->username == 'invitado'){
                $this->redirect(Yii::app()->createUrl('cruge/ui/login',array()));
            }else{

                $login = $usuario->username;

                $usuariologin = Yii::app()->user->um->loadUser($login);

                $buscarSesion = Yii::app()->user->um->findSession($usuariologin);

                if($buscarSesion != null){ 

                    if(isset($_GET['modC'])){

                        $code = $_GET['modC'];

                        if($code != null){
                            $find = ModuleType::model()->findByAttributes(array('code'=>$code,'status'=>1));

                            if(!empty($find)){

                                $this->pageTitle = 'Crear '.$find->name;

                                $id = $find->id;

                                $folder = $find->folder.'/';

                                $nombre = $find->folder;

                                $api = new IntraModules;

                                $model = new ModuleData;

                                $modules = $api->GetModulesForm($id);

                                if(isset($_POST['ModuleData']))
                                {
                                    $model->attributes=$_POST['ModuleData'];                                    

                                    $model->module_sub_id = $_POST['submodel'];                              

                                    $model->approved = $_POST['personal'];                       

                                    $model->version = $_POST['ModuleData']['version'];                    

                                    $model->code_module = $_POST['ModuleData']['code_module'];      

                                    $fechaAprobado = str_replace('/', '-', $_POST['ModuleData']['date_approved']);              

                                    $model->date_approved = date('Y-m-d H:i:s',strtotime($fechaAprobado));

                                    $model->date_register = date('Y-m-d H:i:s');

                                    $model->deleted = 0;

                                    if(!empty($_FILES['onefile']["name"])){
                                        $upfile = $_FILES['onefile']["tmp_name"];
                                        $onefile = 1;
                                    }else{
                                        $upfile = null;
                                        $onefile = 0;
                                    }

                                    if($model->validate()){
                                        
                                        $model->save();                                        

                                        $idModel = $model->id;

                                        $buscar = ModuleData::model()->findByPk($idModel);

                                        $check = $buscar->files;

                                        if($onefile == 1){

                                            $archivoName = $nombre.'_'.$idModel;

                                            $archivoExe = strtolower(pathinfo($_FILES['onefile']["name"], PATHINFO_EXTENSION));

                                            $getArchivoFiles = file_get_contents($upfile);

                                            $archivoFileName = $archivoName.'.'.$archivoExe;

                                            $pathArchivoFile = "./protected/images/modules/".$folder.$archivoFileName;

                                            if(file_put_contents($pathArchivoFile , $getArchivoFiles)){

                                                $buscar->file = $archivoFileName;

                                                $buscar->save();

                                            }   
                                        }

                                        

                                        if(!empty($_FILES['modFiles']["name"][0])){
                                            $verficate = 1;
                                            $files = $_FILES['modFiles']["tmp_name"];
                                        }else{
                                            $verficate = 0;
                                            $files = null;
                                        } 

                                        if($check == 1 && $verficate == 1){
                                            $contadorFile = 0;

                                            foreach($files as $uploadFile){

                                                $fileName = $nombre.'_'.$idModel.'_'.$contadorFile;

                                                $fileExe = strtolower(pathinfo($_FILES['modFiles']["name"][$contadorFile], PATHINFO_EXTENSION));

                                                $nameFile = $fileName.'.'.$fileExe;

                                                $archivos = new ModuleDataFiles;

                                                $archivos->module_data_id = $idModel;

                                                $archivos->date_register = date('Y-m-d H:i:s');

                                                $archivos->name = urlencode($_FILES['modFiles']["name"][$contadorFile]);

                                                $archivos->file = $nameFile;

                                                $archivos->status = 1 ;

                                                $getFileFiles = file_get_contents($uploadFile);

                                                $pathFileFiles = "./protected/images/modules/".$folder.$nameFile;

                                                if(file_put_contents($pathFileFiles , $getFileFiles)){
                                                    $archivos->save();
                                                }

                                                $contadorFile = $contadorFile + 1;
                                            }
                                        }else{
                                            $buscar->files = 0;

                                            $buscar->save();
                                        }

                                        $this->redirect(Yii::app()->createUrl('modules/index',array('modC'=>$code)));
                                    }

                                }

                                $this->render('create',array('model'=>$model,'modules'=>$modules));

                            }else{
                                $this->redirect(Yii::app()->createUrl('site/index',array()));
                            }

                        }else{
                            $this->redirect(Yii::app()->createUrl('site/index',array()));
                        }
                    }else{
                        $this->redirect(Yii::app()->createUrl('site/index',array()));
                    }
                    
                }else{
                    $this->redirect(Yii::app()->createUrl('cruge/ui/login',array()));
                }
            }
        }else{
            $this->redirect(Yii::app()->createUrl('cruge/ui/login',array()));
        }
    }


    public function actionUpdate()
    {
        $usuario = Yii::app()->user->um->loadUserById(Yii::app()->user->id);

        if($usuario != null){

            if($usuario->username == 'invitado'){
                $this->redirect(Yii::app()->createUrl('cruge/ui/login',array()));
            }else{

                $login = $usuario->username;

                $usuariologin = Yii::app()->user->um->loadUser($login);

                $buscarSesion = Yii::app()->user->um->findSession($usuariologin);

                if($buscarSesion != null){ 

                    if(isset($_GET['modC']) && isset($_GET['modI'])){

                        $code = $_GET['modC'];

                        $modId = $_GET['modI'];

                        if($code != null && $modId != null){

                            $find = ModuleType::model()->findByAttributes(array('code'=>$code,'status'=>1));

                            if(!empty($find)){

                                $model = ModuleData::model()->findByPk($modId);

                                if(!empty($model)){

                                    $this->pageTitle = 'Crear '.$find->name;

                                    $id = $find->id;

                                    $folder = $find->folder.'/';

                                    $nombre = $find->folder;

                                    $api = new IntraModules;

                                    $modules = $api->GetModulesForm($id);

                                    if(isset($_POST['ModuleData']))
                                    {
                                        $model->attributes=$_POST['ModuleData'];                                    

                                        $model->module_sub_id = $_POST['submodel'];                       

                                        $model->approved = $_POST['personal'];           

                                        $model->version = $_POST['ModuleData']['version'];                    

                                        $model->code_module = $_POST['ModuleData']['code_module'];      

                                        $fechaAprobado = str_replace('/', '-', $_POST['ModuleData']['date_approved']);              

                                        $model->date_approved = date('Y-m-d H:i:s',strtotime($fechaAprobado));

                                        $model->date_register = date('Y-m-d H:i:s');

                                        $model->date_update = date('Y-m-d H:i:s');

                                        if(!empty($_FILES['onefile']["name"])){
                                            $upfile = $_FILES['onefile']["tmp_name"];
                                            $onefile = 1;
                                        }else{
                                            $upfile = null;
                                            $onefile = 0;
                                        }
                                        if($model->validate()){
                                            
                                            $model->save();                                        

                                            $idModel = $model->id;

                                            $buscar = ModuleData::model()->findByPk($idModel);

                                            $check = $buscar->files;

                                            if($onefile == 1){

                                                $archivoName = $nombre.'_'.$idModel;

                                                $archivoExe = strtolower(pathinfo($_FILES['onefile']["name"], PATHINFO_EXTENSION));

                                                $getArchivoFiles = file_get_contents($upfile);

                                                $archivoFileName = $archivoName.'.'.$archivoExe;

                                                $pathArchivoFile = "./protected/images/modules/".$folder.$archivoFileName;

                                                if(file_put_contents($pathArchivoFile , $getArchivoFiles)){

                                                    $buscar->file = $archivoFileName;

                                                    $buscar->save();

                                                }   
                                            }

                                            if(!empty($_FILES['modFiles']["name"][0])){
                                                $verficate = 1;
                                                $files = $_FILES['modFiles']["tmp_name"];
                                            }else{
                                                $verficate = 0;
                                                $files = null;
                                            } 

                                            if($check == 1 && $verficate == 1){
                                                $contadorFile = 0;

                                                foreach($files as $uploadFile){

                                                    $fileName = $nombre.'_update_'.$idModel.'_'.$contadorFile;

                                                    $fileExe = strtolower(pathinfo($_FILES['modFiles']["name"][$contadorFile], PATHINFO_EXTENSION));

                                                    $nameFile = $fileName.'.'.$fileExe;

                                                    $archivos = new ModuleDataFiles;

                                                    $archivos->module_data_id = $idModel;

                                                    $archivos->date_register = date('Y-m-d H:i:s');

                                                    $archivos->name = urlencode($_FILES['modFiles']["name"][$contadorFile]);

                                                    $archivos->file = $nameFile;

                                                    $archivos->status = 1 ;

                                                    $getFileFiles = file_get_contents($uploadFile);

                                                    $pathFileFiles = "./protected/images/modules/".$folder.$nameFile;

                                                    if(file_put_contents($pathFileFiles , $getFileFiles)){
                                                        $archivos->save();
                                                    }

                                                    $contadorFile = $contadorFile + 1;
                                                }
                                            }else{
                                                $criteria = new CDbCriteria(); 

                                                $criteria->addCondition('module_data_id='.$model->id);

                                                $criteria->addCondition('status != 3');

                                                $veriFiles = ModuleDataFiles::model()->findAll($criteria);

                                                if(empty($veriFiles)){
                                                    $buscar->files = 0;

                                                    $buscar->save();
                                                }else{
                                                    $buscar->files = 1;

                                                    $buscar->save();
                                                }
                                            }

                                            $this->redirect(Yii::app()->createUrl('modules/index',array('modC'=>$code)));
                                        }
                                    }

                                    $this->render('update',array('model'=>$model,'modules'=>$modules));
                                }else{
                                    $this->redirect(Yii::app()->createUrl('site/index',array()));
                                }

                            }else{
                                $this->redirect(Yii::app()->createUrl('site/index',array()));
                            }

                        }else{
                            $this->redirect(Yii::app()->createUrl('site/index',array()));
                        }
                    }else{
                        $this->redirect(Yii::app()->createUrl('site/index',array()));
                    }
                    
                }else{
                    $this->redirect(Yii::app()->createUrl('cruge/ui/login',array()));
                }
            }
        }else{
            $this->redirect(Yii::app()->createUrl('cruge/ui/login',array()));
        }
    }

    public function actionUpdateStatus(){
        if(isset($_POST['codId']) && isset($_POST['codAcc']) && isset($_POST['codGl']) && isset($_POST['codMod'])){
            
            $id = $_POST['codId'];

            $code = $_POST['codAcc'];

            $module = $_POST['codGl'];

            $submodule = $_POST['codMod'];

            $model = ModuleDataFiles::model()->findByPk($id);

            if(!empty($model)){
                //INACTIVAR
                if($code == 'fhcErx'){
                    $model->status = 0;

                    $model->save();

                    $send = array('error'=>1,'token'=>$module,'param'=>$submodule);
                //ACTIVAR
                }elseif($code == 'SyhoKo'){
                    $model->status = 1;
                    
                    $model->save();

                    $send = array('error'=>1,'token'=>$module,'param'=>$submodule);

                }else{
                    $send = array('error'=>0);
                }

            }else{
                $send = array('error'=>0);
            }
        }else{
            $send = array('error'=>0);
        }

        echo json_encode($send);
    }

    public function actionDeleteFiles(){
        if(isset($_POST['codId'])&& isset($_POST['codGl']) && isset($_POST['codMod'])){
            
            $id = $_POST['codId'];

            $module = $_POST['codGl'];

            $submodule = $_POST['codMod'];

            $model = ModuleDataFiles::model()->findByPk($id);

            if(!empty($model)){

                $find = ModuleType::model()->findByAttributes(array('code'=>$module,'status'=>1));

                if(!empty($find)){

                    $folder = $find->folder.'/';

                    $nameFile = $model->file;

                    $path = "./protected/images/modules/".$folder.$nameFile; 
       
                    if (!unlink($path)) {  
                        $deleted = 0; 
                    }  
                    else {  
                        $deleted = 1;
                    }

                    $model->deleted = $deleted;

                    $model->status = 3;

                    $model->save();

                    $send = array('error'=>1,'token'=>$module,'param'=>$submodule);
                }else{
                    $send = array('error'=>0);
                }

            }else{
                $send = array('error'=>0);
            }
        }else{
            $send = array('error'=>0);
        }
        echo json_encode($send);
    }

    public function actionDeleteFileOne(){
        if(isset($_POST['codId'])&& isset($_POST['codGl']) && isset($_POST['codMod'])){
            
            $id = $_POST['codId'];

            $module = $_POST['codGl'];

            $submodule = $_POST['codMod'];

            $model = ModuleData::model()->findByPk($id);

            if(!empty($model)){

                $find = ModuleType::model()->findByAttributes(array('code'=>$module,'status'=>1));

                if(!empty($find)){

                    $folder = $find->folder.'/';

                    $nameFile = $model->file;

                    $path = "./protected/images/modules/".$folder.$nameFile; 
       
                    if (!unlink($path)) {  
                        $deleted = 0; 
                    }  
                    else {  
                        $deleted = 1;
                    }

                    $model->deleted = $deleted;

                    $model->deleted_file = $nameFile;

                    $model->file = null;

                    $model->save();

                    $send = array('error'=>1,'token'=>$module,'param'=>$submodule);
                }else{
                    $send = array('error'=>0);
                }

            }else{
                $send = array('error'=>0);
            }
        }else{
            $send = array('error'=>0);
        }

        echo json_encode($send);
    }
}