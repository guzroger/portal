<?php
$criteria = new CDbCriteria(); 

$criteria->addCondition('status=1');

$calidad = ModuleType::model()->findAll($criteria);

$criteriaTool = new CDbCriteria(); 

$criteriaTool->addCondition('status=1');

$tools = ApiSoftware::model()->findAll($criteriaTool);

$usuario = Yii::app()->user->um->loadUserById(Yii::app()->user->id);

$item = Yii::app()->user->um->getFieldValue($usuario,'item');

$supervisor = Supervisor::model()->findByAttributes(array('item'=>$item));


$apo = new ApiApo;

$teletrabajo = $apo->TeleTrabajo($item);
?>
<div class="navbar-custom">
    <div class="container-fluid">
        <div id="navigation">
            <!-- Navigation Menu-->
            <ul class="navigation-menu">

                <li class="has-submenu">
                    <a href="<?php echo Yii::app()->createAbsoluteUrl('site/index'); ?>"><i class="ti-home"></i>Inicio</a>
                </li>  

                <li class="has-submenu">
                    <a href="#"><i class="fa fa-volume-control-phone"></i>Mi Empresa</a>
                    <ul class="submenu">
                        <li><a href="<?php echo Yii::app()->createAbsoluteUrl('company/index'); ?>">Nuestra Empresa</a></li>
                        <li><a href="<?php echo Yii::app()->createAbsoluteUrl('company/vision'); ?>">Misi&oacute;n / Visi&oacute;n</a></li>
                        <li><a href="<?php echo Yii::app()->createAbsoluteUrl('company/diagram'); ?>">Estructura Organica</a></li>
                        <li><a href="<?php echo Yii::app()->createAbsoluteUrl('company/benefit'); ?>">Mis Beneficios</a></li>
                    </ul>
                </li> 

                <li class="has-submenu">
                    <a href="#"><i class="fa fa-sitemap"></i>Red Social</a>
                    <ul class="submenu">
                        <li><a href="<?php echo Yii::app()->createAbsoluteUrl('groups/groups'); ?>">Grupos</a></li>
                        <li><a href="<?php echo Yii::app()->createAbsoluteUrl('groups/directory'); ?>" onclick="jQuery('.loader_div').show();">Directorio</a></li>
                    </ul>
                </li>  

                <li class="has-submenu">
                    <a href="#"><i class="fa fa-cubes"></i>Gestion de Calidad</a>
                    <ul class="submenu">
                        <?php foreach ($calidad as $cal) { ?>
                            <li><a href="<?php echo Yii::app()->createAbsoluteUrl('modules/index',array('modC'=>$cal->code)); ?>"><?php echo $cal->name; ?></a></li>
                        <?php } ?>
                        
                    </ul>
                </li>  
                <?php if(Yii::app()->user->checkAccess('covid')){ ?>
                <li class="has-submenu">
                    <a href="<?php echo Yii::app()->createAbsoluteUrl('medical/covid'); ?>"><i class="fa fa-user-md"></i>Vacunas COVID-19</a>
                </li>  
                <?php } ?>
                <?php /* 
                <li class="has-submenu">
                    <a href="#"><i class="fa fa-paperclip"></i>Herramientas</a>
                    <ul class="submenu">
                        <li><a href="<?php echo Yii::app()->createAbsoluteUrl('medical/personal'); ?>">Consulta M&eacute;dica</a></li>
                        <?php if(!empty($supervisor)){ ?>
                            <li><a href="<?php echo Yii::app()->createAbsoluteUrl('tools/authorization'); ?>">Autorizaciones</a></li>
                        <?php } ?>
                        <?php foreach ($tools as $tool) { ?>
                            <li><a href="<?php echo Yii::app()->createAbsoluteUrl('tools/software',array('tCd'=>$tool->code)); ?>"><?php echo $tool->software; ?></a></li>
                        <?php } ?>
                        
                    </ul>
                </li>    
                */ ?>  
                <?php if(Yii::app()->user->checkAccess('gerencial')){ ?>
                <li class="has-submenu">
                    <a href="#"><i class="fa fa-institution"></i>Gerencial</a>
                    <ul class="submenu">
                        <?php if(Yii::app()->user->checkAccess('gerencial_tableros')){ ?>
                            <li><a href="<?php echo Yii::app()->createAbsoluteUrl('managerial/commercial'); ?>">Tableros</a></li>
                        <?php } ?>
                    </ul>
                </li>  
                <?php } ?>
                <?php if(Yii::app()->user->checkAccess('gerencial_poa')){ ?>
                <li class="has-submenu">
                    <a href="#"><i class="fa fa-institution"></i>P.O.A</a>
                    <ul class="submenu">
                        <?php if(Yii::app()->user->checkAccess('gerencial_poa')){ ?>
                            <li><a href="<?php echo Yii::app()->createAbsoluteUrl('poa/report'); ?>">Reportar KPI</a></li>
                        <?php } ?>
                    </ul>
                </li>  
                <?php } ?>

                <?php if(!empty($teletrabajo)){ ?>
                    <li class="has-submenu">
                        <a href="#" data-toggle="modal" data-target="#teletrabajoModal"><i class="fa fa-laptop"></i>Salas Teletrabajo</a>
                    </li> 
                <?php } ?>
		<?php 
                /////ingreso a PAGOS                              
                $hoy = base64_encode(date('Y-m-d H:i:s'));                
                $md5 = base64_encode($usuario['username']);                
                $code0 = base64_encode($hoy.'#'.$md5);   
                $code = base64_encode($code0);   
                ?>                
                <?php //if(Yii::app()->user->checkAccess('pagos')){ ?>
		<?php 
                if(strtolower($usuario['username']) != 'ltoroya' and strtolower($usuario['username']) != 'gsainz' and strtolower($usuario['username']) != 'hguzman' and strtolower($usuario['username']) != 'manzoleaga' and strtolower($usuario['username']) != 'mjaldin' and strtolower($usuario['username']) != 'jhrodriguez' and strtolower($usuario['username']) != 'csoria')
                { ?>
                    <li class="has-submenu">
                        <a href="<?php echo Yii::app()->createUrl('redirect/send',array('data'=>$code,'username'=>$usuario['username']));?>" target="_blank" ><i class="fa fa-credit-card"></i>Portal Pagos</a>                    
                    </li>
                <?php } ?>

                <?php if(Yii::app()->user->checkAccess('administrador')){ ?>
                <li class="has-submenu">
                    <a href="#"><i class="fa fa-cog"></i>Administrador</a>
                    <ul class="submenu">
                        <li class="has-submenu">
                            <a href="#">Seguridad</a>
                            <ul class="submenu">
                                <li><a href="<?php echo Yii::app()->createAbsoluteUrl('cruge/ui/usermanagementadmin');?>">Usuarios</a></li>
                                <li><a href="<?php echo Yii::app()->createAbsoluteUrl('cruge/ui/rbaclistroles');?>">Roles</a></li>
                                <li><a href="<?php echo Yii::app()->createAbsoluteUrl('cruge/ui/fieldsadminlist');?>">Listar Campos</a></li>
                                <li><a href="<?php echo Yii::app()->createAbsoluteUrl('cruge/ui/sessionadmin');?>">Sesiones</a></li>
                                <li><a href="<?php echo Yii::app()->createAbsoluteUrl('cruge/ui/systemupdate');?>">Variables</a></li>
                            </ul>
                        </li>

                        <li class="has-submenu">
                            <a href="#">Apis</a>
                            <ul class="submenu">
                                <li><a target="_blank" href="<?php echo Yii::app()->createAbsoluteUrl('api/users'); ?>">Usuarios</a></li>
                                <li><a target="_blank" href="<?php echo Yii::app()->createAbsoluteUrl('api/employees'); ?>">Empleados</a></li>
                                <li><a target="_blank" href="<?php echo Yii::app()->createAbsoluteUrl('api/employeesSchedule'); ?>">Empleados Licencias</a></li>                                
                                <li><a target="_blank" href="<?php echo Yii::app()->createAbsoluteUrl('api/registerSchedule'); ?>">Horarios</a></li>                             
                                <li><a target="_blank" href="<?php echo Yii::app()->createAbsoluteUrl('api/employeesInactive'); ?>">Empleados Inactivos</a></li>               
                                <li><a target="_blank" href="<?php echo Yii::app()->createAbsoluteUrl('api/employeesSupervisor'); ?>">Empleados Supervisores</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <?php } ?>
            </ul>
            <!-- End navigation menu -->
        </div> <!-- end #navigation -->
    </div> <!-- end container -->
</div> <!-- end navbar-custom -->