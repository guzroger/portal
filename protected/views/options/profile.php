<?php 
$model = ApiData::BasicInfo();

$nombre = $model['nombre'];

$foto = $model['foto'];

$item = $model['item'];

$supervisor = Supervisor::model()->findByAttributes(array('item'=>$item));
?>
<a class="nav-link dropdown-toggle waves-effect nav-user" data-toggle="dropdown" href="#" role="button"
   aria-haspopup="false" aria-expanded="false">
    <img src="<?php echo Yii::app()->createAbsoluteUrl('api/showPersonal',array('filename'=>$foto)); ?>" alt="user" class="rounded-circle">
</a>
<div class="dropdown-menu dropdown-menu-right profile-dropdown " aria-labelledby="Preview">
    <!-- item-->
    <div class="dropdown-item noti-title" >
        <h5 class="text-overflow"><small class="text-white"><?php echo substr($nombre,0,33); ?></small> </h5>
    </div>

    <!-- item-->
    <a href="<?php echo Yii::app()->createAbsoluteUrl('profile/profile'); ?>" class="dropdown-item notify-item">
        <i class="mdi mdi-account"></i> <span>Mi Perfil</span>
    </a>

    <!-- item-->
    <a href="<?php echo Yii::app()->createAbsoluteUrl('profile/license'); ?>" class="dropdown-item notify-item">
        <i class="fa fa-plane"></i> <span>Permisos</span>
    </a>
    <?php /*
    <!-- item-->
    <a href="<?php echo Yii::app()->createAbsoluteUrl('profile/memos'); ?>" class="dropdown-item notify-item">
        <i class="fa fa-folder-open"></i> <span>Memorandums</span>
    </a>

    <!-- item-->
    <a href="<?php echo Yii::app()->createAbsoluteUrl('profile/payment'); ?>" class="dropdown-item notify-item">
        <i class="fa fa-money"></i> <span>Pagos</span>
    </a>
    */ ?>

    <?php if(!empty($supervisor)){ ?>
        <a href="<?php echo Yii::app()->createAbsoluteUrl('profile/authorization'); ?>" onclick="jQuery('.loader_div').show();" class="dropdown-item notify-item">
            <i class="fa fa-check"></i> <span>Autorizaciones</span>            
        </a>
    <?php } ?>

    <?php   if($model['pass'] == 1){?>
        <a href="<?php echo Yii::app()->createAbsoluteUrl('profile/update'); ?>" onclick="jQuery('.loader_div').show();" class="dropdown-item notify-item">
            <i class="fa fa-warning"></i> <span>Cambiar Contrase&ntilde;a</span>            
        </a>
    <?php } ?>


    <!-- item-->
    <a href="<?php echo Yii::app()->createAbsoluteUrl('profile/saved'); ?>" class="dropdown-item notify-item">
        <i class="fa fa-save"></i> <span>Guardado</span>
    </a>

    <!-- item-->
    <a href="<?php echo Yii::app()->createAbsoluteUrl('cruge/ui/logout');?>" class="dropdown-item notify-item">
        <i class="mdi mdi-logout"></i> <span>Cerrar Sesi&oacute;n</span>
    </a>
</div>