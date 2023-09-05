<?php 
$controller = Yii::app()->getController();

if($controller->getAction()->getId() === 'profile'){ 
    $profile = 'active';
}else{
    $profile = '';
}

if($controller->getAction()->getId() === 'memos'){ 
    $memos = 'active';
}else{
    $memos = '';
}

if($controller->getAction()->getId() === 'license'){ 
    $license = 'active';
}else{
    $license = '';
}
if($controller->getAction()->getId() === 'payment'){ 
    $payment = 'active';
}else{
    $payment = '';
}
if($controller->getAction()->getId() === 'saved'){ 
    $saved = 'active';
}else{
    $saved = '';
}

if($controller->getAction()->getId() === 'authorization'){ 
    $authorization = 'active';
}else{
    $authorization = '';
}

if($controller->getAction()->getId() === 'update'){ 
    $update = 'active';
}else{
    $update = '';
}

$usuario = Yii::app()->user->um->loadUserById(Yii::app()->user->id);

$item = Yii::app()->user->um->getFieldValue($usuario,'item');

$supervisor = Supervisor::model()->findByAttributes(array('item'=>$item));

$validar = ApiData::BasicInfo();

?>
<li class="nav-item">
    <a href="<?php echo Yii::app()->createAbsoluteUrl('profile/profile'); ?>" onclick="jQuery('.loader_div').show();" class="nav-link <?php echo $profile; ?>">
        Mi Perfil
    </a>
</li>
<li class="nav-item">
    <a href="<?php echo Yii::app()->createAbsoluteUrl('profile/license'); ?>" onclick="jQuery('.loader_div').show();" class="nav-link <?php echo $license; ?>">
        Permisos
    </a>
</li>
<?php /*
<li class="nav-item">
    <a href="<?php echo Yii::app()->createAbsoluteUrl('profile/memos'); ?>" onclick="jQuery('.loader_div').show();" class="nav-link <?php echo $memos; ?>">
        Memorandums
    </a>
</li>
<li class="nav-item">
    <a href="<?php echo Yii::app()->createAbsoluteUrl('profile/payment'); ?>" onclick="jQuery('.loader_div').show();" class="nav-link <?php echo $payment; ?>">
        Pagos
    </a>
</li>
*/ ?>
<?php if(!empty($supervisor)){ ?>
<li class="nav-item">
    <a href="<?php echo Yii::app()->createAbsoluteUrl('profile/authorization'); ?>" onclick="jQuery('.loader_div').show();" class="nav-link <?php echo $authorization; ?>">
        Autorizaciones
    </a>
</li>
<?php } ?>
<?php if($validar['pass'] == 1){ ?>
<li class="nav-item">
    <a href="<?php echo Yii::app()->createAbsoluteUrl('profile/update'); ?>" onclick="jQuery('.loader_div').show();" class="nav-link <?php echo $update; ?>">
        Cambiar Contrase&ntilde;a
    </a>
</li>
<?php } ?>
<li class="nav-item">
    <a href="<?php echo Yii::app()->createAbsoluteUrl('profile/saved'); ?>" onclick="jQuery('.loader_div').show();" class="nav-link <?php echo $saved; ?>">
        Guardado
    </a>
</li>