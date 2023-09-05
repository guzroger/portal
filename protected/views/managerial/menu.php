<?php 
$controller = Yii::app()->getController();

if($controller->getAction()->getId() === 'commercial'){ 
    $commercial = 'active';
}else{
    $commercial = '';
}
if($controller->getAction()->getId() === 'finance'){ 
    $finance = 'active';
}else{
    $finance = '';
}
if($controller->getAction()->getId() === 'technical'){ 
    $technical = 'active';
}else{
    $technical = '';
}
if($controller->getAction()->getId() === 'indicator'){ 
    $indicator = 'active';
}else{
    $indicator = '';
}
?>
<li class="nav-item">
    <a href="<?php echo Yii::app()->createAbsoluteUrl('managerial/commercial'); ?>" class="nav-link <?php echo $commercial; ?>">
        &Aacute;mbito Comercial
    </a>
</li>
<li class="nav-item">
    <a href="<?php echo Yii::app()->createAbsoluteUrl('managerial/finance'); ?>" class="nav-link <?php echo $finance; ?>">
        &Aacute;mbito Financiero
    </a>
</li>
<li class="nav-item">
    <a href="<?php echo Yii::app()->createAbsoluteUrl('managerial/technical'); ?>" class="nav-link <?php echo $technical; ?>">
        &Aacute;mbito T&eacute;cnico
    </a>
</li>
<li class="nav-item">
    <a href="<?php echo Yii::app()->createAbsoluteUrl('managerial/indicator'); ?>" class="nav-link <?php echo $indicator; ?>">
        Indicadores de Rendimiento
    </a>
</li>