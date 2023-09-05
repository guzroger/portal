<?php
class ApiData{

	public function BasicInfo(){

		$usuario = Yii::app()->user->um->loadUserById(Yii::app()->user->id);

        if($usuario != null){

            if($usuario->username == 'invitado'){
	            echo "<script>top.window.location = 'index.php?r=cruge/ui/login'</script>";
	            die;
            }else{

                $login = $usuario->username;

                $usuariologin = Yii::app()->user->um->loadUser($login);

                $buscarSesion = Yii::app()->user->um->findSession($usuariologin);

                if($buscarSesion == null){ 
		            echo "<script>top.window.location = 'index.php?r=cruge/ui/login'</script>";
		            die;
                }else{
                    $user_id = Yii::app()->user->um->getFieldValue($usuario,'identificator');

					$user_item = Yii::app()->user->um->getFieldValue($usuario,'item');

                    $find = User::model()->findByAttributes(array('id'=>$user_id, 'item'=>$user_item));

                    if(!empty($find)){

                        $model = Employee::model()->findByAttributes(array('item'=>$find->item));

                        if($find->password == null){
                            $pass['pass'] = 0;
                            $password['password'] = "";
                        }else{
                            $pass['pass'] = 1;
                            $password['password'] = $find->password;
                        }

                        $nombre['nombre'] = $model->name;

                        $item['item'] = $model->item;

                        $userId['idInt'] = $user_id;

                        if($find->photo != null){
                            $foto['foto'] = $find->photo;
                        }else{
                            $foto['foto'] = $model->photo;
                        }                        

                        $send = $userId + $nombre + $item + $foto + $pass + $password;

                        return $send;

                    }else{
                        echo "<script>top.window.location = 'index.php?r=cruge/ui/login'</script>";
                        die;
                    }
                }
            }
        }else{
            echo "<script>top.window.location = 'index.php?r=cruge/ui/login'</script>";
            die;
        }
    }
}	
?>