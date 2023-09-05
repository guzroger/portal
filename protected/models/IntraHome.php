<?php
class IntraHome{
	public function GetBithdays(){

		$dia = date('d');

		$mes = date('m');

		//$dia = 17;

		//$mes = 12;

		$post = Yii::app()->db->createCommand("SELECT
			emp.name as name,
			emp_per.birthdate as birthdate
		FROM
			employee_personal emp_per,
			employee emp
		WHERE
			MONTH (birthdate) = $mes
		AND DAY (birthdate) = $dia
		AND emp_per.employee_id = emp.id
		AND emp.status = 1
		ORDER BY
			emp.name ASC")->queryAll();

		$send = $post;

		return $send;
	}


	public function GetPublications($usuario){

		$user_id = Yii::app()->user->um->getFieldValue($usuario,'identificator');

		$modelVerficate = Yii::app()->db->createCommand("SELECT
				COUNT(id) AS verificate
			FROM
				group_user
			WHERE
				user_id = $user_id
			AND
				manager = 1
			AND status = 1")->queryRow();

		if(!empty($modelVerficate)){
			if($modelVerficate['verificate'] == 0){
				$verificate = 0;
				$quantity = 0;
			}else{
				$verificate = 1;
				$quantity = $modelVerficate['verificate'];
			}
			
		}else{
			$verificate = 0;
			$quantity = 0;
		}

		$groups = Yii::app()->db->createCommand("SELECT
				gr.*,
				gr_us.manager as manager,
				 (
					SELECT
						COUNT(grcon.group_id)
					FROM
						group_user grcon
					WHERE
						grcon.group_id = gr.id
					GROUP BY
						grcon.group_id
				) AS quantity		
			FROM
				`group` gr,
				group_user gr_us
			WHERE
				gr.id = gr_us.group_id
			AND gr_us.user_id = $user_id
			AND gr_us.status = 1
			ORDER BY
				gr.id ASC")->queryAll();

		$cantidad = count($groups);

		$suma = 1;

		$groupIn = '';

		foreach($groups as $event){
			if($suma == $cantidad){
				$groupIn .= $event['id'];
			}else{
				$groupIn .= $event['id'].',';
			}
			$suma = $suma + 1;
		}

		$data = Yii::app()->db->createCommand("SELECT
				pub.*,
				emp.name as postby,
				emp.area as postuni,
				gr.name as groupName,
				gr.id as grupoId
			FROM
				publication pub,
				publication_group pub_gr,
				`group` gr,
				`user` usr,
				employee emp
			WHERE
				pub.id = pub_gr.publication_id
			AND pub_gr.group_id IN ($groupIn)
			AND gr.id = pub_gr.group_id
			AND pub.status = 1
			AND pub.user_id = usr.id
			AND usr.item = emp.item
			ORDER BY
				pub.priority DESC, pub.date_register DESC
			LIMIT
				10")->queryAll();

		$publications = array();

		foreach ($data as $value) {

			$id = $value['id'];

			$checkSave = PublicationSave::model()->findByAttributes(array('publication_id'=>$id,'user_id'=>$user_id,'status'=>1));

			if(empty($checkSave)){
				$save['saved'] = 0;
			}else{
				$save['saved'] = 1;
			}

			$images['images'] = $this->PublicationImages($id);

			$files['folder'] = $this->PublicationFiles($id);

			$publications[] = $value + $save + $images + $files;
		}

		

		$send = array('manager'=>$verificate,'quantity'=>$quantity,'groups'=>$groups,'publications'=>$publications);

		return $send;
	}

	public function GetPublication($usuario, $pubid){

		$user_id = Yii::app()->user->um->getFieldValue($usuario,'identificator');

		$grupo = PublicationGroup::model()->findByAttributes(array('publication_id'=>$pubid,'status'=>1));

		if(!empty($grupo)){

			$grupoId = $grupo->group_id;

			$check = GroupUser::model()->findByAttributes(array('group_id'=>$grupoId,'user_id'=>$user_id,'status'=>1));

			if(!empty($check)){
				$data = Yii::app()->db->createCommand("SELECT
						pub.*,
						emp.name as postby,
						emp.area as postuni,
						gr.name as groupName
					FROM
						publication pub,
						publication_group pub_gr,
						`group` gr,
						`user` usr,
						employee emp
					WHERE
						pub.id = pub_gr.publication_id
					AND gr.id = pub_gr.group_id
					AND pub.status = 1
					AND pub.user_id = usr.id
					AND usr.item = emp.item
					AND pub.id = $pubid
					ORDER BY
						pub.priority DESC, pub.date_register DESC
					LIMIT
						10")->queryRow();

				if(!empty($data)){
					$id = $data['id'];

					$checkSave = PublicationSave::model()->findByAttributes(array('publication_id'=>$id,'user_id'=>$user_id,'status'=>1));

					if(empty($checkSave)){
						$save['saved'] = 0;
					}else{
						$save['saved'] = 1;
					}

					$images['images'] = $this->PublicationImages($id);

					$files['folder'] = $this->PublicationFiles($id);

					$publications = $data + $save + $images + $files;

					$send = $publications;
				}else{
					$send = array('error'=>3, 'message'=>'No Existe publicacion');
				}		
				
			}else{
				$send = array('error'=>2, 'message'=>'No Habilitado');
			}
		}else{
			$send = array('error'=>1, 'message'=>'No Encontrado');
		}

		
		return $send;
	}

	public function GetPublicationEdit($usuario, $pubid){

		$user_id = Yii::app()->user->um->getFieldValue($usuario,'identificator');

		$grupo = PublicationGroup::model()->findByAttributes(array('publication_id'=>$pubid,'status'=>1));

		if(!empty($grupo)){

			$grupoId = $grupo->group_id;

			$check = GroupUser::model()->findByAttributes(array('group_id'=>$grupoId,'user_id'=>$user_id,'manager'=>1,'status'=>1));

			if(!empty($check)){
				$data = Yii::app()->db->createCommand("SELECT
						pub.*,
						emp.name as postby,
						emp.area as postuni,
						gr.id as groupId,
						gr.name as groupName
					FROM
						publication pub,
						publication_group pub_gr,
						`group` gr,
						`user` usr,
						employee emp
					WHERE
						pub.id = pub_gr.publication_id
					AND gr.id = pub_gr.group_id
					AND pub.status = 1
					AND pub.user_id = usr.id
					AND usr.item = emp.item
					AND pub.id = $pubid
					ORDER BY
						pub.priority DESC, pub.date_register DESC
					LIMIT
						10")->queryRow();

				if(!empty($data)){
					$id = $data['id'];

					$checkSave = PublicationSave::model()->findByAttributes(array('publication_id'=>$id,'user_id'=>$user_id,'status'=>1));

					if(empty($checkSave)){
						$save['saved'] = 0;
					}else{
						$save['saved'] = 1;
					}

					$images['images'] = $this->PublicationImages($id);

					$files['folder'] = $this->PublicationFiles($id);

					$publications = $data + $save + $images + $files;

					$send = $publications;
				}else{
					$send = array('error'=>3, 'message'=>'No Existe publicacion');
				}		
				
			}else{
				$send = array('error'=>2, 'message'=>'No Habilitado');
			}
		}else{
			$send = array('error'=>1, 'message'=>'No Encontrado');
		}

		
		return $send;
	}

	public function SavePublication($usuario, $pubid){

		$user_id = Yii::app()->user->um->getFieldValue($usuario,'identificator');

		$grupo = PublicationGroup::model()->findByAttributes(array('publication_id'=>$pubid,'status'=>1));

		if(!empty($grupo)){

			$grupoId = $grupo->group_id;

			$check = GroupUser::model()->findByAttributes(array('group_id'=>$grupoId,'user_id'=>$user_id,'status'=>1));

			if(!empty($check)){

				$checkSave = PublicationSave::model()->findByAttributes(array('publication_id'=>$pubid,'user_id'=>$user_id));

				if(empty($checkSave)){
				
					$model = new PublicationSave;

					$model->publication_id = $pubid;

					$model->user_id = $user_id;

					$model->date_register = date('Y-m-d H:i:s');

					$model->status = 1;

					if($model->save()){
						$send = array('message'=>'ok');
					}else{
						$send = array('error'=>3, 'message'=>'No Guardado');
					}

				}else{
					if($checkSave->status == 1){
						$send = array('error'=>3, 'message'=>'Ya Guardado');
					}else{
						$checkSave->status = 1;
						
						$checkSave->save();

						$send = array('message'=>'ok');
					}
					
				}
				
			}else{
				$send = array('error'=>2, 'message'=>'No Habilitado');
			}
		}else{
			$send = array('error'=>1, 'message'=>'No Encontrado');
		}

		
		return $send;
	}

	public function PublicationImages($id){
		$data = Yii::app()->db->createCommand("SELECT
				*
			FROM
				publication_image
			WHERE
				publication_id = $id
			AND status = 1
			ORDER BY
				id ASC")->queryAll();

		if(!empty($data)){
			$send = $data;
		}else{
			$send = array();
		}

		return $send;
	}

	public function PublicationFiles($id){
		$data = Yii::app()->db->createCommand("SELECT
				*
			FROM
				publication_file
			WHERE
				publication_id = $id
			AND status = 1
			ORDER BY
				id ASC")->queryAll();

		if(!empty($data)){
			$send = $data;
		}else{
			$send = array();
		}

		return $send;
		
	}

}