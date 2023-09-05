<?php

class ToolsController extends Controller
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
		$this->render('index');
	}
    public function actionAuthorization()
    {
        $this->pageTitle = 'Autorizaciones';

        $usuario = Yii::app()->user->um->loadUserById(Yii::app()->user->id);

        $item = Yii::app()->user->um->getFieldValue($usuario,'item');   

        $supervisor = Supervisor::model()->findByAttributes(array('item'=>$item));

        if(!empty($supervisor)){

            $criteria = new CDbCriteria(); 

            $criteria->addCondition('supervisor_id='.$supervisor->id);

            $license = License::model()->findAll($criteria);

            $this->render('authorization',array('license'=>$license));
        }else{
            $this->redirect(Yii::app()->createUrl('site/index'));
        }
    }

    public function actionAuthLicense(){
        if(isset($_POST['authInfo'])){

            $auth_obs = $_POST['auth_obs'];

            $auth_status = $_POST['auth_status'];

            $auth_id = $_POST['auth_id'];

            $license = License::model()->findByPk($auth_id);

            if(!empty($license)){

                $id = $license->id;

                $result = array('sts'=>$auth_status,'obs'=>$auth_obs);

                $api = new IntraAuth;

                $model = $api->AuthorizatedLicense($id, $result);

                if($model['error'] == 0){
                    $this->redirect(Yii::app()->createUrl('tools/authorization',array('esv'=>200)));
                }else{
                    $this->redirect(Yii::app()->createUrl('tools/authorization',array('esv'=>'-100')));
                }
            }else{
                $this->redirect(Yii::app()->createUrl('tools/authorization'));
            }
        }else{
            $this->redirect(Yii::app()->createUrl('tools/authorization'));
        }
    }

	public function actionSoftware()
	{
		$usuario = Yii::app()->user->um->loadUserById(Yii::app()->user->id);

        if($usuario != null){

            if($usuario->username == 'invitado'){
                $this->redirect(Yii::app()->createUrl('cruge/ui/login'));
            }else{

                $login = $usuario->username;

                $usuariologin = Yii::app()->user->um->loadUser($login);

                $buscarSesion = Yii::app()->user->um->findSession($usuariologin);

                if($buscarSesion != null){ 

                	if(isset($_GET['tCd'])){

                		$code = $_GET['tCd'];

                		if($code != null){

                			$find = ApiSoftware::model()->findByAttributes(array('code'=>$code,'status'=>1));

                			if(!empty($find)){

								$user_id = Yii::app()->user->um->getFieldValue($usuario,'identificator');	

								$user = User::model()->findByPk($user_id);	

                                $verifcate = UserAccess::model()->findByAttributes(array('user_id'=>$user->id,'api_software_id'=>$find->id,'status'=>1));

                                if(empty($verifcate)){

                                    $cadena = array('username'=>$user->username,'item'=>$user->item,'date'=>date('YmdHis'));

                                    $string = json_encode($cadena);

                                    $secret_key = $find->key;

                                    $secure = $this->encryptSecure( $string, $secret_key, 'e' );

                                    $register = new UserAccess;

                                    $register->user_id = $user->id;

                                    $register->api_software_id = $find->id;

                                    $register->secure = $secure;

                                    $register->date_register = date('Y-m-d H:i:s');

                                    $register->status = 1;

                                    $register->save();

                                    $params =  "ccu=".$user->code."&scr=".$secure;

                                    $url = $find->url.$params;

                                    $this->redirect($url);

                                }else{

                                    $secure = $verifcate->secure;

                                    $params =  "ccu=".$user->code."&scr=".$secure;

                                    $url = $find->url.$params;

                                    $this->redirect($url);

                                }

                			}else{
                				$this->redirect(Yii::app()->createUrl('site/index'));
                			}

                		}else{
                			$this->redirect(Yii::app()->createUrl('site/index'));
                		}
                	}else{
                		$this->redirect(Yii::app()->createUrl('site/index'));
                	}
                    
                }else{
                    $this->redirect(Yii::app()->createUrl('cruge/ui/login'));
                }
            }
        }else{
            $this->redirect(Yii::app()->createUrl('cruge/ui/login'));
        }
	}

	function encryptSecure( $string, $secret_key, $action = 'e' ) {
	    // you may change these values to your own
	    $secret_iv = ';PuC.T%q&EHLpt+=u(?2ZH&8$hxfmD';
	 
	    $output = false;
	    $encrypt_method = "AES-256-CBC";
	    $key = hash( 'sha256', $secret_key );
	    $iv = substr( hash( 'sha256', $secret_iv ), 0, 16 );
 
        if( $action == 'e' ) {
            $output = base64_encode( openssl_encrypt( $string, $encrypt_method, $key, 0, $iv ) );
        }
        else if( $action == 'd' ){
            $output = openssl_decrypt( base64_decode( $string ), $encrypt_method, $key, 0, $iv );
        }
     
        return $output;
    }

}