<?php

class MedicalController extends Controller
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

	public function actionCovid()
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

                	$this->pageTitle = 'Vacunas COVID - 19';

                	if(isset($_POST['search_item'])){
                		$item = $_POST['search_item'];
                	}else{
                		if(isset($_GET['item'])){
                			$item = $_GET['item'];
                		}else{
            				$item = Yii::app()->user->um->getFieldValue($usuario,'item');
                		}
                	}

                	$api = new IntraMedical();

                	$check = $api->InfoMedicalCovid($item);

                	$sick = $api->SicksCovid();

                	if(!empty($check)){
                		$model = $check;
                	}else{
                		$model = $api->InfoMedical($item);
                	}

                	if(isset($_POST['btnReg'])){

						$result = $_POST;

            			$register = $api->RegisterCovid($result);

            			$this->redirect(array('covid','er'=>$register['status'],'msg'=>$register['message'],'item'=>$_POST['search_item']));

            			//print_r($result);

                	}else{

						$this->render('covid',array('model'=>$model,'sick'=>$sick));
                	}
					

            	}else{
                    $this->redirect(Yii::app()->createUrl('cruge/ui/login',array()));
                }
            }
        }else{
            $this->redirect(Yii::app()->createUrl('cruge/ui/login',array()));
        }
		
	}

	public function actionPersonal()
	{
		$this->pageTitle = 'Personal Médico';

		$criteria = new CDbCriteria(); 

        $criteria->addCondition('doctor = 1');

        $criteria->addCondition('visible = 1');

        $criteria->addCondition('status = 1');

        $model = MedPersonal::model()->findAll($criteria); 

		$this->render('personal',array('model'=>$model));
	}

	public function actionCalendar()
	{
		if(isset($_GET['med'])){
			$med = $_GET['med'];

			if($med != null){

				$personal = MedPersonal::model()->findByPk($med);

				if(!empty($personal)){

					if($personal->doctor == 1 && $personal->visible == 1 && $personal->status == 1 ){

						$this->pageTitle = 'Agenda '.$personal->name;

						$calendar = MedPersonalCalendar::model()->findByAttributes(array('personal_id'=>$personal->id));

						$api = new MedicalConsultation;

						$schedule = $api->Calendar($calendar->id);

						$status = new CDbCriteria(); 

				        $status->addCondition('status=1');

				        $scheduleStatus = MedScheduleStatus::model()->findAll($status); 

				        $type = new CDbCriteria(); 

				        $type->addCondition('status=1');

				        if($calendar->online == 0){
				        	$type->addCondition('id != 3');
				        }

				        $scheduleType = MedScheduleType::model()->findAll($type); 

						$this->render('calendar',array('calendar'=>$calendar,'scheduleType'=>$scheduleType,'scheduleStatus'=>$scheduleStatus,'schedule'=>$schedule));
					}else{
						$this->redirect(array('personal'));
					}
				}else{
					$this->redirect(array('personal'));
				}
			}else{
				$this->redirect(array('personal'));
			}
		}else{
			$this->redirect(array('personal'));
		}
	}

	public function actionRegisterConsultation(){
		if(isset($_GET['med'])){

			$med = $_GET['med'];

			if($med != null){

				$personal = MedPersonal::model()->findByPk($med);

				if(isset($_POST['btnReg'])){

					$calendar = MedPersonalCalendar::model()->findByAttributes(array('personal_id'=>$personal->id));

					$status = MedScheduleStatus::model()->findByPk(1);

					$reg_title = $_POST['reg_title'];

					$reg_dt = $_POST['reg_dt'];

					$reg_start = $_POST['reg_start'];

					$reg_end = $_POST['reg_end'];

					$reg_id = $_POST['reg_id'];

					$reg_name = $_POST['reg_name'];

					$reg_item = $_POST['reg_item'];

					if($reg_consul == 3){
						$reg_url = 'CMT_MED_'.$reg_id.'_REG_'.date('YmdHis');
					}else{
						$reg_url = '';
					}

					$model = new Schedule;

					$model->personal_calendar_id = $calendar->id;

					$model->patient_id = $reg_id;

					$model->schedule_type_id = $reg_consul;

					$model->date_consultation = $reg_dt;

					$model->title = $reg_title;

					$model->start = $reg_start;

					$model->end = $reg_end;

					$model->url = $reg_url;

					$model->patient_name = $reg_name;

					$model->patient_item = $reg_item;

					$model->patient_type = $reg_type;

					$model->date_register = date('Y-m-d H:i:s');

					$model->patient_status = $reg_status;

					$model->patient_relation = $reg_relation;

					$model->schedule_status_id = 1;

					$model->color = $status->color;

					$model->status = 1;

					if($model->save()){

						$this->redirect(array('calendar','erp'=>'100', 'med'=>$med));

					}else{

						$this->redirect(array('calendar','erp'=>'-100', 'med'=>$med));

					}
				}else{
					$this->redirect(array('calendar', 'med'=>$med));
				}
			}else{
				$this->redirect(array('admin'));
			}
		}else{
			$this->redirect(array('admin'));
		}
	}

}