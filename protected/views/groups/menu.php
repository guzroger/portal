<?php 
$controller = Yii::app()->getController();

if($controller->getAction()->getId() === 'index'){ 
    $publication = 'active';
}else{
    $publication = '';
}
if($controller->getAction()->getId() === 'members'){ 
    $members = 'active';
}else{
    $members = '';
}
if($controller->getAction()->getId() === 'calendar'){ 
    $calendar = 'active';
}else{
    $calendar = '';
}
if($controller->getAction()->getId() === 'update'){ 
    $update = 'active';
}else{
    $update = '';
}
?>
<?php if($member == 1){ ?>
<li class="nav-item">
    <a href="<?php echo Yii::app()->createAbsoluteUrl('groups/index',array('cddGr'=>$_GET['cddGr'])); ?>" class="nav-link <?php echo $publication; ?>">
        Publicaciones
    </a>
</li>
<?php } ?>
<li class="nav-item">
    <a href="<?php echo Yii::app()->createAbsoluteUrl('groups/members',array('cddGr'=>$_GET['cddGr'])); ?>" class="nav-link <?php echo $members; ?>">
        Miembros
    </a>
</li>
<?php /*
<li class="nav-item">
    <a href="<?php echo Yii::app()->createAbsoluteUrl('groups/calendar',array('cddGr'=>$_GET['cddGr'])); ?>" class="nav-link <?php echo $calendar; ?>">
        Calendario
    </a>
</li>
*/ ?>
<?php if($manager == 1){ ?>
<li class="nav-item">
    <a href="<?php echo Yii::app()->createAbsoluteUrl('groups/update',array('cddGr'=>$_GET['cddGr'])); ?>" class="nav-link <?php echo $update; ?>">
        Actualizar
    </a>
</li>
<?php } ?>