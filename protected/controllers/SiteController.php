<?php

class SiteController extends Controller
{
	
    private function _publicActionsList()
    {
        return array(
            'error','ajaxStarOnline'
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

					$this->pageTitle = 'Bienvenido a mi Portal COMTECO';

					$data = new IntraHome;

					$birthdays = $data->GetBithdays();

					$publications = $data->GetPublications($usuario);

					$model = ApiData::BasicInfo();

					$company = Company::model()->findByPk(1);

					if($model['pass'] == 1){
						if($model['password'] == 'comteco2020.'){

							$this->redirect(array('profile/update'));
							
						}else{
							$this->render('index',array('publications'=>$publications,'birthdays'=>$birthdays,'model'=>$model, 'company'=>$company));
						}
					}else{
						$this->render('index',array('publications'=>$publications,'birthdays'=>$birthdays,'model'=>$model, 'company'=>$company));
					}					

				}else{
                    $this->redirect(Yii::app()->createUrl('cruge/ui/login',array()));
                }
            }
        }else{
            $this->redirect(Yii::app()->createUrl('cruge/ui/login',array()));
        }
	}

	public function actionPublicationView()
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

							$this->pageTitle = 'Publicaciones COMTECO';

							$data = new IntraHome;

							$publication = $data->GetPublication($usuario, $id);

							if(isset($publication['error'])){
								$this->redirect(Yii::app()->createUrl('site/index',array()));
							}else{
								$this->render('publication/view',array('publi'=>$publication));
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


	public function actionPublicationSave()
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

							$this->pageTitle = 'Publicaciones COMTECO';

							$data = new IntraHome;

							$publication = $data->SavePublication($usuario, $id);

							if(isset($publication['error'])){
								$this->redirect(Yii::app()->createUrl('site/index',array('ert'=>'-100')));
							}else{
								$this->redirect(Yii::app()->createUrl('site/index',array('ert'=>'100')));
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

	public function actionPublicatePost(){

		if(isset($_POST['btnPublication'])){

			$usuario = Yii::app()->user->um->loadUserById(Yii::app()->user->id);

			$user_id = Yii::app()->user->um->getFieldValue($usuario,'identificator');

			$postTitle = $_POST['postTitle'];

			$postDescription = $_POST['postDescription'];

			$postDocument = $_POST['postDocument'];

			$postGroup = $_POST['postGroup'];

			if(isset($_POST['pubPriority'])){
				$pubPriority = 1;
			}else{
				$pubPriority = 0;
			}

			if(isset($_POST['pubEmail'])){
				$pubEmail = 1;
			}else{
				$pubEmail = 0;
			}

			if(isset($_POST['pubWhatsapp'])){
				$pubWhatsapp = 1;
			}else{
				$pubWhatsapp = 0;
			}

			if(!empty($_FILES['pubFiles']["name"][0])){
				$pubFiles = 1;
				$files = $_FILES['pubFiles']["tmp_name"];
			}else{
				$pubFiles = 0;
				$files = null;
			}

			if(!empty($_FILES['pubImages']["name"][0])){
				$pubImages = 1;
				$images = $_FILES['pubImages']["tmp_name"];
			}else{
				$pubImages = 0;
				$images = null;
			}

			/*if(!empty($_FILES['pubVideo']["name"])){
				$video = $_FILES['pubVideo']["tmp_name"];
				$pubVideo = 1;
			}else{
				$video = null;
				$pubVideo = 0;
			}*/

			if(!empty($_POST['pubYoutube'])){
				$video = $_POST['pubYoutube'];
				$pubVideo = 1;
			}else{
				$video = null;
				$pubVideo = 0;
			}

			$findGroup = Group::model()->findByAttributes(array('code'=>$postGroup,'status'=>1));

			if(!empty($findGroup)){
				$fecha = date('Y-m-d H:i:s');

				$model = new Publication;

				$model->user_id = $user_id;

				$model->date_register = $fecha;

				$model->title = $postTitle;

				$model->description = $postDescription;

				$model->document = $postDocument;

				$model->image = $pubImages;

				$model->files = $pubFiles;

				$model->send_email = $pubEmail;

				$model->send_whatsapp = $pubWhatsapp;

				$model->priority = $pubPriority;

				$model->status = 1;

				if($model->save()){

					$id = $model->id;

					if($pubVideo == 1){

						$find = Publication::model()->findByPk($id);

						/*$videoName = 'video_public_'.$find->id;

						$videoExe = strtolower(pathinfo($_FILES['pubVideo']["name"], PATHINFO_EXTENSION));

						$getVideoFiles = file_get_contents($video);

						$videoFileName = $videoName.'.'.$videoExe;

						$pathVideoFile = "./protected/images/publications/videos/".$videoFileName;

						if(file_put_contents($pathVideoFile , $getVideoFiles)){

							$find->video = $videoFileName;

							$find->save();

						}*/

						$find->video = $video;

						$find->save();	
					}

					if($pubFiles == 1){

						$contadorFile = 0;

						foreach($files as $uploadFile){

							$fileName = 'file_public_'.$id.'_number_'.$contadorFile;

							$fileExe = strtolower(pathinfo($_FILES['pubFiles']["name"][$contadorFile], PATHINFO_EXTENSION));

							$nameFile = $fileName.'.'.$fileExe;

							$archivos = new PublicationFile;

							$archivos->publication_id = $id;

							$archivos->date_register = $fecha;

							$archivos->name = urlencode($_FILES['pubFiles']["name"][$contadorFile]);

							$archivos->file = $nameFile;

							$archivos->status = 1 ;

							$getFileFiles = file_get_contents($uploadFile);

							$pathFileFiles = "./protected/images/publications/files/".$nameFile;

							if(file_put_contents($pathFileFiles , $getFileFiles)){
								$archivos->save();
							}

							$contadorFile = $contadorFile + 1;
						}				
					}

					if($pubImages == 1){

						$contadorImages = 0;
						foreach($images as $uploadImage){

							$imageName = 'image_public_'.$id.'_number_'.$contadorImages;

							$imageExe = strtolower(pathinfo($_FILES['pubImages']["name"][$contadorImages], PATHINFO_EXTENSION));

							$nameImageFile = $imageName.'.'.$imageExe;

							$imagenes = new PublicationImage;

							$imagenes->publication_id = $id;

							$imagenes->date_register = $fecha;

							$imagenes->thumbnail = $nameImageFile;

							$imagenes->image = $nameImageFile;

							$imagenes->status = 1;

							$imagenes->save();		

							$getImageFiles = file_get_contents($uploadImage);

							$pathImageFile = "./protected/images/publications/images/".$nameImageFile;

							if(file_put_contents($pathImageFile , $getImageFiles)){

								/*

								$pathToImages = "./protected/images/publications/images/";

								$pathToThumbs = "./protected/images/publications/images/thumbnails/";

								$thumbWidth = 150;

								$thumbHeigth = 150;

								$fname = $nameImageFile;

								$createThumb = ApiImages::createThumbs( $pathToImages, $pathToThumbs, $thumbWidth, $thumbHeigth, $fname );

								$thumbFile = "./protected/images/publications/images/thumbnails/".$nameImageFile;	
								*/

								$imagenes->save();	

							}

							$contadorImages = $contadorImages + 1;
						}				
					}

					$grupo = new PublicationGroup;

					$grupo->publication_id = $id;

					$grupo->group_id = $findGroup->id;

					$grupo->date_register = $fecha;

					$grupo->status = 1;

					$grupo->save();

					$this->redirect(Yii::app()->createUrl('site/index',array('ert'=>'1000')));
				}else{
					$this->redirect(Yii::app()->createUrl('site/index',array('ert'=>'-1000')));
				}	
			}else{
				$this->redirect(Yii::app()->createUrl('site/index',array('ert'=>'-1001')));
			}				

		}else{
			$this->redirect(Yii::app()->createUrl('site/index'));
		}

	}



	public function actionPublicationUpdate()
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

							$this->pageTitle = 'Modificar Publicación';

							$data = new IntraHome;

							$publication = $data->GetPublicationEdit($usuario, $id);

							if(isset($publication['error'])){
								$this->redirect(Yii::app()->createUrl('site/index',array()));
							}else{
								$this->render('publication/update',array('publi'=>$publication));
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

	public function actionPublicatePostUpdate(){

		if(isset($_POST['btnPublication'])){

			$postPub = $_POST['postPub'];

			$model = Publication::model()->findByPk($postPub);

			if(!empty($model)){	

				$postGroup = $_POST['postGroup'];

				$usuario = Yii::app()->user->um->loadUserById(Yii::app()->user->id);

				$user_id = Yii::app()->user->um->getFieldValue($usuario,'identificator');

				$check = GroupUser::model()->findByAttributes(array('group_id'=>$postGroup,'user_id'=>$user_id,'manager'=>1,'status'=>1));

				if(!empty($check)){

					$postTitle = $_POST['postTitle'];

					$postDescription = $_POST['postDescription'];

					$postDocument = $_POST['postDocument'];

					$postStatus = $_POST['postStatus'];

					if(isset($_POST['pubPriority'])){
						$pubPriority = 1;
					}else{
						$pubPriority = 0;
					}

					if(isset($_POST['pubEmail'])){
						$pubEmail = 1;
					}else{
						$pubEmail = 0;
					}

					if(isset($_POST['pubWhatsapp'])){
						$pubWhatsapp = 1;
					}else{
						$pubWhatsapp = 0;
					}

					if(!empty($_FILES['pubFiles']["name"][0])){
						$pubFiles = 1;
						$files = $_FILES['pubFiles']["tmp_name"];
					}else{
						$pubFiles = 0;
						$files = null;
					}

					if(!empty($_FILES['pubImages']["name"][0])){
						$pubImages = 1;
						$images = $_FILES['pubImages']["tmp_name"];
					}else{
						$pubImages = 0;
						$images = null;
					}

					/*if(!empty($_FILES['pubVideo']["name"])){
						$video = $_FILES['pubVideo']["tmp_name"];
						$pubVideo = 1;
					}else{
						$video = null;
						$pubVideo = 0;
					}*/

					if(!empty($_POST['pubYoutube'])){
						$video = $_POST['pubYoutube'];
						$pubVideo = 1;
					}else{
						$video = null;
						$pubVideo = 0;
					}
					
					$fecha = date('Y-m-d H:i:s');	

	                $criteriaImage = new CDbCriteria(); 

	                $criteriaImage->addCondition('publication_id='.$model->id);

	                $criteriaImage->addCondition('status = 1');

	                $veriImages = PublicationImage::model()->findAll($criteriaImage);

	                $criteriaFiles = new CDbCriteria(); 

	                $criteriaFiles->addCondition('publication_id='.$model->id);

	                $criteriaFiles->addCondition('status = 1');

	                $veriFiles = PublicationFile::model()->findAll($criteriaFiles);	

	                if(empty($veriImages)){
	                	$mostrarImg = 0;
	                }else{
	                	$mostrarImg = 1;
	                }

	                if(empty($veriFiles)){
	                	$mostrarFile = 0;
	                }else{
	                	$mostrarFile = 1;
	                }

					$model->user_id = $user_id;

					$model->date_update = $fecha;

					$model->title = $postTitle;

					$model->description = $postDescription;

					$model->document = $postDocument;

					$model->image = $mostrarImg;

					$model->files = $mostrarFile;

					$model->send_email = $pubEmail;

					$model->send_whatsapp = $pubWhatsapp;

					$model->priority = $pubPriority;

					$model->status = $postStatus;

					if($model->save()){

						$id = $model->id;

						$find = Publication::model()->findByPk($id);

						if($pubVideo == 1){

							$find = Publication::model()->findByPk($id);

							/*$videoName = 'video_public_'.$find->id;

							$videoExe = strtolower(pathinfo($_FILES['pubVideo']["name"], PATHINFO_EXTENSION));

							$getVideoFiles = file_get_contents($video);

							$videoFileName = $videoName.'.'.$videoExe;

							$pathVideoFile = "./protected/images/publications/videos/".$videoFileName;

							if(file_put_contents($pathVideoFile , $getVideoFiles)){

								$find->video = $videoFileName;

								$find->save();

							}*/

							$find->video = $video;

							$find->save();	
						}

						if($pubFiles == 1){

							$contadorFile = 0;

							foreach($files as $uploadFile){

								$fileName = 'file_public_'.$id.'_update_number_'.$contadorFile;

								$fileExe = strtolower(pathinfo($_FILES['pubFiles']["name"][$contadorFile], PATHINFO_EXTENSION));

								$nameFile = $fileName.'.'.$fileExe;

								$archivos = new PublicationFile;

								$archivos->publication_id = $id;

								$archivos->date_register = $fecha;

								$archivos->name = urlencode($_FILES['pubFiles']["name"][$contadorFile]);

								$archivos->file = $nameFile;

								$archivos->status = 1 ;

								$getFileFiles = file_get_contents($uploadFile);

								$pathFileFiles = "./protected/images/publications/files/".$nameFile;

								if(file_put_contents($pathFileFiles , $getFileFiles)){
									$archivos->save();

									$find->files = 1;

									$find->save();
								}

								$contadorFile = $contadorFile + 1;
							}				
						}

						if($pubImages == 1){

							$contadorImages = 0;
							foreach($images as $uploadImage){

								$imageName = 'image_public_'.$id.'_update_number_'.date('YmdHis');

								$imageExe = strtolower(pathinfo($_FILES['pubImages']["name"][$contadorImages], PATHINFO_EXTENSION));

								$nameImageFile = $imageName.'.'.$imageExe;

								$imagenes = new PublicationImage;

								$imagenes->publication_id = $id;

								$imagenes->date_register = $fecha;

								$imagenes->thumbnail = $nameImageFile;

								$imagenes->image = $nameImageFile;

								$imagenes->status = 1;

								$imagenes->save();		

								$getImageFiles = file_get_contents($uploadImage);

								$pathImageFile = "./protected/images/publications/images/".$nameImageFile;

								if(file_put_contents($pathImageFile , $getImageFiles)){

									$imagenes->save();	

									$find->image = 1;

									$find->save();

								}

								$contadorImages = $contadorImages + 1;
							}				
						}

						$this->redirect(Yii::app()->createUrl('site/index',array('ert'=>'1010')));
					}else{
						$this->redirect(Yii::app()->createUrl('site/index',array('ert'=>'-1011')));
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

	}


	public function actionError()
	{
		$this->renderPartial('error');
	}

    public function actionDeleteFiles(){
        if(isset($_POST['codId'])&& isset($_POST['codFl'])){
            
            $id = $_POST['codId'];

            $pub = $_POST['codFl'];

            $find = PublicationFile::model()->findByAttributes(array('id'=>$id,'publication_id'=>$pub,'status'=>1));

            if(!empty($find)){

                $nameFile = $find->file;

                $path = "./protected/images/publications/files/".$nameFile;
   
                if (!unlink($path)) {  
                    $deleted = 0; 
                }  
                else {  
                    $deleted = 1;
                }

                $find->status = 3;

                $find->save();

                $send = array('error'=>1,'token'=>$pub);
            }else{
                $send = array('error'=>0);
            }
        }else{
            $send = array('error'=>0);
        }

        echo json_encode($send);
    }

    public function actionDeleteImages(){
        if(isset($_POST['codId'])&& isset($_POST['codFl'])){
            
            $id = $_POST['codId'];

            $pub = $_POST['codFl'];

            $find = PublicationImage::model()->findByAttributes(array('id'=>$id,'publication_id'=>$pub,'status'=>1));

            if(!empty($find)){

                $nameFile = $find->image;

                $path = "./protected/images/publications/images/".$nameFile;
   
                if (!unlink($path)) {  
                    $deleted = 0; 
                }  
                else {  
                    $deleted = 1;
                }

                $find->status = 3;

                $find->save();

                $send = array('error'=>1,'token'=>$pub);
            }else{
                $send = array('error'=>0);
            }
        }else{
            $send = array('error'=>0);
        }

        echo json_encode($send);
    }

    public function actionDeleteVideo(){
        if(isset($_POST['codId'])){
            
            $id = $_POST['codId'];

            $find = Publication::model()->findByAttributes(array('id'=>$id,'status'=>1));

            if(!empty($find)){

                /*$nameFile = $find->video;

                $path = "./protected/images/publications/videos/".$nameFile;
   
                if (!unlink($path)) {  
                    $deleted = 0; 
                }  
                else {  
                    $deleted = 1;
                }*/

                $find->video = null;

                $find->save();

                $send = array('error'=>1,'token'=>$id);
            }else{
                $send = array('error'=>0);
            }
        }else{
            $send = array('error'=>0);
        }

        echo json_encode($send);
    }

    public function actionAjaxStarOnline(){

    	$userid= Yii::app()->user->id;

    	$usuario = Yii::app()->user->um->loadUserById($userid);

    	$sala = $_POST['sala'];

    	$apo = new ApiApo;

		$team = $apo->Team($sala);

		$info = new IntraProfile;

		$user = $info->GetInfo($usuario);

		$register = $apo->RegisterWork($team,$user,$userid);

		echo json_encode($register);

    }
}