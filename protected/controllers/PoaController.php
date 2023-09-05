<?php

class PoaController extends Controller
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

	public function actionReport(){

        $usuario = Yii::app()->user->um->loadUserById(Yii::app()->user->id);

        if($usuario != null){

            if($usuario->username == 'invitado'){
                $this->redirect(Yii::app()->createUrl('cruge/ui/login',array()));
            }else{

                $login = $usuario->username;

                $usuariologin = Yii::app()->user->um->loadUser($login);

                $buscarSesion = Yii::app()->user->um->findSession($usuariologin);

                if($buscarSesion != null){ 

                    $item = Yii::app()->user->um->getFieldValue($usuario,'item');

                    $this->pageTitle = 'POA';

                    $api = new ApiPoa;

                    if(isset($_GET['kpi'])){

                        $kpi = $_GET['kpi'];

                        if($kpi != null){
                            $model['detail'] = $api->GetReportKpi($item,$kpi);
                        }else{
                            $model['detail'] = array();                            
                        }

                    }else{
                        $model['detail'] = array();
                    }

                    $model['indicators'] = $api->GetIndicators($item);

            		$this->render('report',array('model'=>$model));
                }else{
                    $this->redirect(Yii::app()->createUrl('cruge/ui/login',array()));
                }
            }
        }else{
            $this->redirect(Yii::app()->createUrl('cruge/ui/login',array()));
        }
	}

    public function actionAjaxKpiReport(){

        $kpi = $_POST['indicator_kpi'];

        $this->redirect(array('report','kpi'=>$kpi));
    }

    public function actionAjaxUpKpiReport(){

        $usuario = Yii::app()->user->um->loadUserById(Yii::app()->user->id);

        $result['item'] = Yii::app()->user->um->getFieldValue($usuario,'item');

        $result['resultado'] = $_POST['resultado'];

        $result['identificador'] = $_POST['identificador'];

        $api = new ApiPoa;

        $model = $api->UpdateKpiReport($result);

        $send = array('sts'=>$model['status'],'msg'=>$model['message']);

        echo json_encode($send);
           
    }
}