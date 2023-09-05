<?php

class ProfileController extends Controller
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
	public function actionProfile()
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

                	$api = new IntraProfile;

                	$model = $api->GetInfo($usuario);

                    $tributa = $api->GetTributario($usuario);

                    if(isset($_POST['fchini']) && isset($_POST['fchfin'])){

                        $getIni = str_replace('/', '-', $_POST['fchini']);

                        $getFin = str_replace('/', '-', $_POST['fchfin']);

                        $fchini = date("Y-m-d", strtotime($getIni));

                        $fchfin = date("Y-m-d", strtotime($getFin));
                    }else{

                        $fchfin = date('Y-m-d');

                        $fchini = date('Y-m-d', strtotime("$fchfin -7 day"));                                                               
                    }  

                    $this->pageTitle = 'Mi Perfil';

                	$personal = $api->GetInfoPersonal($usuario, $fchini, $fchfin);                	

                	$this->render('profile',array('model'=>$model,'personal'=>$personal, 'fchini' => $fchini, 'fchfin' => $fchfin,'tributa'=>$tributa));

            	}else{
                    $this->redirect(Yii::app()->createUrl('cruge/ui/login',array()));
                }
            }
        }else{
            $this->redirect(Yii::app()->createUrl('cruge/ui/login',array()));
        }
	}

    public function actionMemos()
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

                    $api = new IntraProfile;

                    $model = $api->GetInfo($usuario);         

                    $this->pageTitle = 'Mis Memorandums';       

                    $this->render('memos',array('model'=>$model));

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

                    $api = new IntraProfile;

                    $model = $api->GetInfo($usuario);         

                    $this->pageTitle = 'Cambiar Contraseña';  

                    if(isset($_POST['register'])){

                        $validar = ApiData::BasicInfo();

                        $changeUser = User::model()->findByPk($validar['idInt']);

                        $newPass = $_POST['newPass'];

                        $changeUser->password = $newPass;

                        $changeUser->save();
                        
                        $this->redirect(Yii::app()->createUrl('cruge/ui/login',array()));
                    }     

                    $this->render('update',array('model'=>$model));

                }else{
                    $this->redirect(Yii::app()->createUrl('cruge/ui/login',array()));
                }
            }
        }else{
            $this->redirect(Yii::app()->createUrl('cruge/ui/login',array()));
        }
    }

    public function actionLicense()
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

                    $this->pageTitle = 'Mis Licencias';   

                    if(isset($_POST['fchini']) && isset($_POST['fchfin'])){

                        $getIni = str_replace('/', '-', $_POST['fchini']);

                        $getFin = str_replace('/', '-', $_POST['fchfin']);

                        $fchini = date("Y-m-d", strtotime($getIni));

                        $fchfin = date("Y-m-d", strtotime($getFin));
                    }else{

                        $fchfin = date('Y-m-d');

                        $fchini = date('Y-01-01');                                                               
                    }  

                    $api = new IntraProfile;

                    $model = $api->GetInfo($usuario);  

                    $vacations = $api->GetVacations($usuario); 

                    $pending = $api->GetLicensesPending($usuario); 

                    $licenses = $api->GetLicenseEmployee($usuario, $fchini, $fchfin); 

                    $criteriaIntra = new CDbCriteria(); 

                    $criteriaIntra->addCondition('employee_id ='.$model['id']);

                    $criteriaIntra->addCondition('status_auth = 0');

                    $criteriaIntra->addCondition('status = 1');

                    $pendingIntra = License::model()->findAll($criteriaIntra);

                    $criteria = new CDbCriteria(); 

                    $criteria->addCondition('status=1');

                    $criteria->order = 'name ASC';

                    $supervisor = Supervisor::model()->findAll($criteria); 

                    $this->render('license',array('model'=>$model,'vacations'=>$vacations,'licenses'=>$licenses, 'pending'=>$pending, 'fchini' => $fchini, 'fchfin' => $fchfin,'supervisor'=>$supervisor,'pendingIntra'=>$pendingIntra));

                }else{
                    $this->redirect(Yii::app()->createUrl('cruge/ui/login',array()));
                }
            }
        }else{
            $this->redirect(Yii::app()->createUrl('cruge/ui/login',array()));
        }
    }

    public function actionPayment()
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

                    $api = new IntraProfile;

                    $model = $api->GetInfo($usuario);         

                    $this->pageTitle = 'Mis Pagos';       

                    $this->render('payment',array('model'=>$model));

                }else{
                    $this->redirect(Yii::app()->createUrl('cruge/ui/login',array()));
                }
            }
        }else{
            $this->redirect(Yii::app()->createUrl('cruge/ui/login',array()));
        }
    }



    public function actionAuthorization()
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

                    $api = new IntraProfile;

                    $model = $api->GetInfo($usuario);         

                    $this->pageTitle = 'Autorizaciones'; 

                    $item = Yii::app()->user->um->getFieldValue($usuario,'item');   

                    $supervisor = Supervisor::model()->findByAttributes(array('item'=>$item)); 

                    $criteria = new CDbCriteria(); 

                    $criteria->addCondition("type NOT IN ('PORTAL_TI_PROG')");

                    $criteria->addCondition('supervisor_id='.$supervisor->id);

                    $criteria->addCondition('status=1');

                    $license = License::model()->findAll($criteria);

                    $criteriaPr = new CDbCriteria(); 

                    $criteriaPr->addCondition("type IN ('PORTAL_TI_PROG')");

                    $criteriaPr->addCondition('supervisor_id='.$supervisor->id);

                    $criteriaPr->addCondition('status=1');

                    $licensePr = License::model()->findAll($criteriaPr);

                    $this->render('authorization',array('model'=>$model,'license'=>$license,'licensePr'=>$licensePr));

                }else{
                    $this->redirect(Yii::app()->createUrl('cruge/ui/login',array()));
                }
            }
        }else{
            $this->redirect(Yii::app()->createUrl('cruge/ui/login',array()));
        }
    }

    public function actionSaved()
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

                    $api = new IntraProfile;

                    $model = $api->GetInfo($usuario);         

                    $this->pageTitle = 'Guardado';    

                    $publications = $api->GetPublicationsSaves($usuario);   

                    $this->render('saved',array('model'=>$model,'publications'=>$publications));

                }else{
                    $this->redirect(Yii::app()->createUrl('cruge/ui/login',array()));
                }
            }
        }else{
            $this->redirect(Yii::app()->createUrl('cruge/ui/login',array()));
        }
    }

    public function actionUnsave()
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
                    if(isset($_GET['cddPb'])){

                        $id = $_GET['cddPb'];

                        if($id != null){

                            $api = new IntraProfile;    

                            $model = $api->PublicationUnSave($usuario, $id);   

                            if($model['error'] == 0){
                                $this->redirect(Yii::app()->createUrl('profile/saved',array('ert'=>'100')));
                            }else{
                                $this->redirect(Yii::app()->createUrl('profile/saved',array('ert'=>'-100')));
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

    public function actionPhoto()
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
                    if(isset($_POST['photoUpload'])){

                        if(!empty($_FILES['photoUp']["name"])){ 

                            $item = Yii::app()->user->um->getFieldValue($usuario,'item');

                            $user_id = Yii::app()->user->um->getFieldValue($usuario,'identificator');   

                            $photo = $_FILES['photoUp']["tmp_name"];

                            $getFile = file_get_contents($photo);

                            $nameFile = 'new_'.$item.'.jpg';

                            $pathFile = "./protected/images/employee/".$nameFile;

                            if(file_put_contents($pathFile , $getFile)){

                                $find = User::model()->findByPk($user_id);

                                $find->photo = $nameFile;

                                $find->save();
                                $this->redirect(Yii::app()->createUrl('profile/profile',array('phE'=>'100')));
                            }else{
                                $this->redirect(Yii::app()->createUrl('profile/profile',array('phE'=>'-100')));
                            }

                            
                        }else{
                            $this->redirect(Yii::app()->createUrl('profile/profile',array('phE'=>'-101')));
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

    public function actionRegisterLicense(){
        if(isset($_POST['regInfo'])){

            $uno = str_replace('/', '-', $_POST['lic_fch_ini']);

            $dos = str_replace('/', '-', $_POST['lic_fch_fin']);

            $tres = str_replace('/', '-', $_POST['lic_fch_ret']);


            $lic_fch_ini = date('Y-m-d H:i',strtotime($uno));

            $lic_fch_fin = date('Y-m-d H:i',strtotime($dos));

            $lic_fch_ret = date('Y-m-d H:i',strtotime($tres));

            if($_POST['lic_day'] != null){
                $lic_day = $_POST['lic_day'];
            }else{
                $lic_day = 0;
            }   

            if($_POST['lic_hour'] != null){
                $lic_hour = $_POST['lic_hour'];
            }else{
                $lic_hour = 0;
            } 

            if($_POST['lic_minutes'] != null){
                $lic_minutes = $_POST['lic_minutes'];
            }else{
                $lic_minutes = 0;
            }

            $lic_obs = $_POST['lic_obs'];

            $lic_auth = $_POST['lic_auth'];

            $lic_emp = $_POST['lic_emp'];

            if($_POST['lic_type'] == 'LIC_ESPECIAL1' || $_POST['lic_type'] == 'LIC_ESPECIAL2' || $_POST['lic_type'] == 'LIC_ESPECIAL3' || $_POST['lic_type'] == 'LIC_ESPECIAL4' || $_POST['lic_type'] == 'LIC_ESPECIAL5' || $_POST['lic_type'] == 'LIC_ESPECIAL6'){
                $lic_type = 'LIC_PERMISO';
            }else{
                $lic_type = $_POST['lic_type'];
            }
            
            $employee = Employee::model()->findByPk($lic_emp);

            $model = new License;

            $model->supervisor_id = $lic_auth;

            $model->employee_id = $lic_emp;

            $model->type = $lic_type;

            $model->code = 0;

            $model->name = $employee->name;

            $model->item = $employee->item;

            $model->date_register = date('Y-m-d H:i:s');

            $model->date = date('Y-m-d');

            $model->date_start = $lic_fch_ini;

            $model->date_end = $lic_fch_fin;

            $model->date_return = $lic_fch_ret;

            $model->days = $lic_day;

            $model->hours = $lic_hour;

            $model->minutes = $lic_minutes;

            $model->observation_sol = $lic_obs;

            $model->status_auth = 0;

            $model->status = 1;

            $model->save();

            $apiSend = new ApiSend;

            if($lic_type == 'PORTAL_TI_PROG'){
                $apiSend->SendLicenseProg($model->id);

                $api = new IntraAuth;

                $api->RegisterProgramacion($model->id);
            }else{
                $apiSend->SendLicense($model->id);
            }

            $this->redirect(Yii::app()->createUrl('profile/license',array()));
        }else{
            $this->redirect(Yii::app()->createUrl('profile/license',array()));
        }
    }

    public function actionAuthLicense(){
        if(isset($_POST['authInfo'])){

            $auth_obs = $_POST['auth_obs'];

            $auth_status = $_POST['auth_status'];

            $auth_id = $_POST['auth_id'];

            $uno = str_replace('/', '-', $_POST['lic_fch_ini']);

            $dos = str_replace('/', '-', $_POST['lic_fch_fin']);

            $tres = str_replace('/', '-', $_POST['lic_fch_ret']);


            $lic_fch_ini = date('Y-m-d H:i',strtotime($uno));

            $lic_fch_fin = date('Y-m-d H:i',strtotime($dos));

            $lic_fch_ret = date('Y-m-d H:i',strtotime($tres));

            if($_POST['lic_day'] != null){
                $lic_day = $_POST['lic_day'];
            }else{
                $lic_day = 0;
            }   

            if($_POST['lic_hour'] != null){
                $lic_hour = $_POST['lic_hour'];
            }else{
                $lic_hour = 0;
            } 

            if($_POST['lic_minutes'] != null){
                $lic_minutes = $_POST['lic_minutes'];
            }else{
                $lic_minutes = 0;
            }

            $license = License::model()->findByPk($auth_id);

            if(!empty($license)){

                $id = $license->id;

                $result = array('sts'=>$auth_status,'obs'=>$auth_obs,'lic_fch_ini'=>$lic_fch_ini,'lic_fch_fin'=>$lic_fch_fin,'lic_fch_ret'=>$lic_fch_ret,'lic_day'=>$lic_day,'lic_hour'=>$lic_hour,'lic_minutes'=>$lic_minutes);

                $api = new IntraAuth;

                $model = $api->AuthorizatedLicense($id, $result);

                //print_r($model);
                if($model['error'] == 0){

		    ////////// modificar esta parte /////////// 
                    $apiSend = new ApiSend;

                    if($license->type == 'PORTAL_TI_PROG'){
                        $apiSend->SendLicenseConfirmProg($license->id);
                    }else{
                        $apiSend->SendLicenseConfirm($license->id);
                    }
                    ////////// modificar esta parte ///////////
                    $this->redirect(Yii::app()->createUrl('profile/authorization',array('esv'=>200)));
                }else{
                    $this->redirect(Yii::app()->createUrl('profile/authorization',array('esv'=>'-100','mss'=>$model['message'])));
                }
            }else{
                $this->redirect(Yii::app()->createUrl('profile/authorization'));
            }
        }else{
            $this->redirect(Yii::app()->createUrl('profile/authorization'));
        }
    }
}