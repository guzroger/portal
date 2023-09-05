<?php 
$controller = Yii::app()->getController();

if($controller->getAction()->getId() === 'index'){ 
    $about = 'active';
}else{
    $about = '';
}
if($controller->getAction()->getId() === 'vision'){ 
    $vision = 'active';
}else{
    $vision = '';
}
if($controller->getAction()->getId() === 'diagram'){ 
    $diagram = 'active';
}else{
    $diagram = '';
}
if($controller->getAction()->getId() === 'benefit'){ 
    $benefit = 'active';
}else{
    $benefit = '';
}
if($controller->getAction()->getId() === 'update'){ 
    $update = 'active';
}else{
    $update = '';
}
?>
<li class="nav-item">
    <a href="<?php echo Yii::app()->createAbsoluteUrl('company/index'); ?>" class="nav-link <?php echo $about; ?>">
        Nuestra Empresa
    </a>
</li>
<li class="nav-item">
    <a href="<?php echo Yii::app()->createAbsoluteUrl('company/vision'); ?>" class="nav-link <?php echo $vision; ?>">
        Misi&oacute;n / Visi&oacute;n
    </a>
</li>
<li class="nav-item">
    <a href="<?php echo Yii::app()->createAbsoluteUrl('company/diagram'); ?>" class="nav-link <?php echo $diagram; ?>">
        Estructura Organica
    </a>
</li>
<li class="nav-item">
    <a href="<?php echo Yii::app()->createAbsoluteUrl('company/benefit'); ?>" class="nav-link <?php echo $benefit; ?>">
        Beneficios
    </a>
</li>
<?php if(Yii::app()->user->checkAccess('admin_company')){ ?>
<li class="nav-item">
    <a href="<?php echo Yii::app()->createAbsoluteUrl('company/update'); ?>" class="nav-link <?php echo $update; ?>">
        Actualizar
    </a>
</li>
<?php } ?>