<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title><?php echo CHtml::encode(Yii::app()->name); ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
        <meta content="Coderthemes" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />

        <link rel="shortcut icon" href="<?php echo Yii::app()->baseUrl;?>/images/com.ico">

        <!-- App css -->
        <link href="<?php echo Yii::app()->theme->baseUrl;?>/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo Yii::app()->theme->baseUrl;?>/assets/css/icons.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo Yii::app()->theme->baseUrl;?>/assets/css/style.css" rel="stylesheet" type="text/css" />

        <script src="<?php echo Yii::app()->theme->baseUrl;?>/assets/js/modernizr.min.js"></script>

    </head>
    <body>
        <?php $form=$this->beginWidget('CActiveForm', array(
            'id'=>'logon-form',
            'enableClientValidation'=>false,
            'clientOptions'=>array(
              'validateOnSubmit'=>true,
            ),
        )); ?>
        <div class="wrapper-page">

            <div class="text-center">
                <img src="<?php echo Yii::app()->baseUrl;?>/images/cmt_logo_1.png" width="200" />

                <br>
                <br>
            </div>

            <form class="form-horizontal m-t-20" action="index.html">

                <div class="form-group row">
                <?php 
                    if(isset($_GET['error'])){
                        $error = $_GET['error'];
                        if($error == null){
                            $message = 'Error Desconocido "NN".';                
                        }else{
                            if($error == '-10001'){
                                $message = 'No Existe Conexión con la Base de Datos.';
                            }elseif($error == '-10020'){
                                $message = 'Nombre de Usuario o Contraseña Incorrecta.';
                            }elseif($error == '-10031'){
                                $message = 'Cuenta Usuario Suspendida contactese con el Administrador.';
                            }elseif($error == '-10030'){
                                $message = 'Cuenta Usuario No Activada contactese con el Administrador.';
                            }elseif($error == '-2000'){
                                $message = 'Datos de Usuario incorrectos.';
                            }elseif($error == '-2001'){
                                $message = 'Usuario Inactivo comuniquese con su Supervisor.';
                            }elseif($error == '-2010'){
                                $message = 'Codigo de Acceso Incorrecto.';
                            }elseif($error == '-2011'){
                                $message = 'Código de acceso Inactivo. Por favor genere otro Código con la aplicación CRMovil.';
                            }elseif($error == '-2010'){
                                $message = 'Codigo de Acceso Incorrecto.';
                            }elseif($error == '-2300'){
                                $message = 'Usuario no Registrado.';
                            }elseif($error == '-2400'){
                                $message = 'Usted ya tiene una sesión abierta.';
                            }else{
                                $message = 'Error Desconocido "NR".';
                            }
                        }
                        if(isset($_GET['itc'])){

                          $token = $_GET['itc'];

                          if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
                              $ip = $_SERVER['HTTP_CLIENT_IP'];
                          } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
                              $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
                          } else {
                              $ip = $_SERVER['REMOTE_ADDR'];
                          }

                          $validate = LogAuthenticate::model()->findByAttributes(array('token'=>$token,'ip_address'=>$ip));

                          if(!empty($validate)){

                              $validate->error_code = $error;

                              $validate->error_message = $message;       

                              $validate->save();

                          }

                        }

                        echo '<div class="col-12 alert alert-danger"><strong><i class="fa fa-warning"></i></strong> '.$message.'</div>';

                    }

                    ?>
                </div>

                <div class="form-group ">
                    <div class="col-12">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="mdi mdi-account"></i></span>
                            </div>
                            <?php echo $form->textField($model,'username',array('class'=>"form-control",'placeholder'=>"Nombre de Usuario","autofocus"=>'autofocus','required'=>'required')); ?>
                        </div>
                    </div>
                </div>

                <div class="form-group ">
                    <div class="col-12">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="mdi mdi-radar"></i></span>
                            </div>
                            <?php echo $form->passwordField($model,'password',array('class'=>"form-control",'placeholder'=>"Contraseña",'maxlength'=>250,'required'=>'required')); ?>  
                        </div>
                    </div>
                </div>

                <div class="form-group ">
                    <div class="col-12">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="mdi mdi-counter"></i></span>
                            </div>
                            <input type="text"  id="code" name="code"  class="form-control" placeholder="Número Item" required>  
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-12">
                        <button class="btn btn-primary btn-custom btn-block w-md waves-effect waves-light" type="submit">Ingresar
                        </button>
                    </div>
                </div>
            </form>
        </div>
        <?php $this->endWidget(); ?>

        <!-- jQuery  -->
        <script src="<?php echo Yii::app()->theme->baseUrl;?>/assets/js/jquery.min.js"></script>
        <script src="<?php echo Yii::app()->theme->baseUrl;?>/assets/js/popper.min.js"></script><!-- Popper for Bootstrap --><!-- Tether for Bootstrap -->
        <script src="<?php echo Yii::app()->theme->baseUrl;?>/assets/js/bootstrap.min.js"></script>
        <script src="<?php echo Yii::app()->theme->baseUrl;?>/assets/js/waves.js"></script>
        <script src="<?php echo Yii::app()->theme->baseUrl;?>/assets/js/jquery.slimscroll.js"></script>
        <script src="<?php echo Yii::app()->theme->baseUrl;?>/assets/js/jquery.scrollTo.min.js"></script>

        <!-- App js -->
        <script src="<?php echo Yii::app()->theme->baseUrl;?>/assets/js/jquery.core.js"></script>
        <script src="<?php echo Yii::app()->theme->baseUrl;?>/assets/js/jquery.app.js"></script>
        <script type="text/javascript">
            $(function () {
                $('[data-toggle="tooltip"]').tooltip()
            })
        </script>
  </body>
</html>