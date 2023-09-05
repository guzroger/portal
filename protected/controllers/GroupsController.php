<?php

class GroupsController extends Controller
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
	public function actionGroups()
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

                	$criteria = new CDbCriteria(); 

					$criteria->addCondition('public=1');

                    $criteria->addCondition('status=1');

					$model = Group::model()->findAll($criteria);

                	$this->render('groups',array('model'=>$model));

            	}else{
                    $this->redirect(Yii::app()->createUrl('cruge/ui/login',array()));
                }
            }
        }else{
            $this->redirect(Yii::app()->createUrl('cruge/ui/login',array()));
        }
	}

	public function actionDirectory()
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

					$data = new IntraGroup;

					$model = $data->GetPersonal();

					$this->pageTitle = 'Directorio de Funcionarios';

					$this->render('directory',array('model'=>$model));

            	}else{
                    $this->redirect(Yii::app()->createUrl('cruge/ui/login',array()));
                }
            }
        }else{
            $this->redirect(Yii::app()->createUrl('cruge/ui/login',array()));
        }
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

                	if(isset($_GET['cddGr'])){
                		$code = $_GET['cddGr'];

                		if($code != null){

							$group = Group::model()->findByAttributes(array('code'=>$code,'status'=>1));

							if(!empty($group)){

								$user_id = Yii::app()->user->um->getFieldValue($usuario,'identificator');

								$groupId = $group->id;

								$validate = GroupUser::model()->findByAttributes(array('user_id'=>$user_id,'group_id'=>$groupId,'status'=>1));

								if(!empty($validate)){

									$manager = $validate->manager;

									$member = 1;

									$data = new IntraGroup;

									$publications = $data->GetPublications($usuario, $groupId);

									$this->pageTitle = $group->name;

									$this->render('index',array('group'=>$group,'publications'=>$publications,'manager'=>$manager,'member'=>$member));

								}else{
									$this->redirect(Yii::app()->createUrl('groups/members',array('cddGr'=>$code)));
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

	public function actionMembers()
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

                	if(isset($_GET['cddGr'])){
                		$code = $_GET['cddGr'];

                		if($code != null){

							$group = Group::model()->findByAttributes(array('code'=>$code,'status'=>1));

							if(!empty($group)){

								$user_id = Yii::app()->user->um->getFieldValue($usuario,'identificator');

								$groupId = $group->id;

								$validate = GroupUser::model()->findByAttributes(array('user_id'=>$user_id,'group_id'=>$groupId,'status'=>1));

								if(!empty($validate)){

									$manager = $validate->manager;

									$member = 1;									

								}else{

									$manager = 0;

									$member = 0;
									
								}

								$data = new IntraGroup;

								$members = $data->GetMembers($groupId);

								$this->pageTitle = $group->name;

								$this->render('members',array('group'=>$group,'members'=>$members,'manager'=>$manager,'member'=>$member));

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

	public function actionCalendar()
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

                	if(isset($_GET['cddGr'])){
                		$code = $_GET['cddGr'];

                		if($code != null){

							$group = Group::model()->findByAttributes(array('code'=>$code,'status'=>1));

							if(!empty($group)){

								$user_id = Yii::app()->user->um->getFieldValue($usuario,'identificator');

								$groupId = $group->id;

								$validate = GroupUser::model()->findByAttributes(array('user_id'=>$user_id,'group_id'=>$groupId,'status'=>1));

								if(!empty($validate)){

									$manager = $validate->manager;

									$member = 1;									

								}else{

									$manager = 0;

									$member = 0;
									
								}

								$data = new IntraGroup;

								//$members = $data->Getmembers($groupId);

								$this->pageTitle = $group->name;

								$this->render('calendar',array('group'=>$group,'manager'=>$manager,'member'=>$member));

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

                	if(isset($_GET['cddGr'])){
                		$code = $_GET['cddGr'];

                		if($code != null){

							$group = Group::model()->findByAttributes(array('code'=>$code,'status'=>1));

							if(!empty($group)){

								$user_id = Yii::app()->user->um->getFieldValue($usuario,'identificator');

								$groupId = $group->id;

								$validate = GroupUser::model()->findByAttributes(array('user_id'=>$user_id,'group_id'=>$groupId,'status'=>1));

								if(!empty($validate)){

									$manager = $validate->manager;

									$member = 1;

									$this->pageTitle = $group->name;

									$model = Group::model()->findByPk($groupId);

									if(isset($_POST['Group']))
									{
										$model->attributes=$_POST['Group'];

										$uploadedFile=CUploadedFile::getInstance($model,'photo');
							            
							            $uploadTemporal = "{$uploadedFile}";

							            $fileName = $group->photo;
							            
							            if(strlen($uploadTemporal) != 0)      
							            {
							        		$uploadedFile->saveAs('./protected/images/groups/'.$fileName); 

							        		/*$api = new ApiImages;

							        		$pathToImages = './protected/images/groups/';

							        		$resize = $api->ResizeImagePng($pathToImages,  400, 400, $fileName);*/
							            }

							            $model->photo = $fileName;

										if($model->validate()){
											
											$model->save();

											$this->redirect(Yii::app()->createUrl('groups/index',array('cddGr'=>$code)));
										}

									}

									$this->render('update',array('group'=>$group,'manager'=>$manager,'member'=>$member,'model'=>$model));

								}else{
									$this->redirect(Yii::app()->createUrl('groups/members',array('cddGr'=>$code)));
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
}