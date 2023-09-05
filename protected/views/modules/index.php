<?php if(!empty($model['modules'])){ ?>
<div class="row">
    <div class="col-md-12">
        <div class="card-box">
            <?php if(Yii::app()->user->checkAccess('admin_modulos')){ ?>
                <a href="<?php echo Yii::app()->createUrl('modules/create',array('modC'=>$_GET['modC'])); ?>" class="btn btn-success">Crear Nuevo</a>
            <?php } ?>
            <ul class="nav nav-tabs tabs-bordered nav-justified">
                <?php 
                $cNav = 1;
                foreach($model['modules'] as $module){ 
                    if($cNav == 1){
                        $clNav = 'active show';
                    }else{
                        $clNav = '';
                    }

                    ?>
                    <li class="nav-item">
                        <a href="#module<?php echo $cNav;?>" data-toggle="tab" aria-expanded="false" class="nav-link <?php echo $clNav;?>">
                            <?php echo $module['name']; ?>
                        </a>
                    </li>
                    <?php $cNav = $cNav + 1;?>
                <?php } ?>
            </ul>                      
            
            <div class="tab-content">
                <?php 
                $cTab = 1;
                foreach($model['modules'] as $module){ 
                    if($cTab == 1){
                        $clTab = 'active show';
                    }else{
                        $clTab = '';
                    }

                    ?>
                    <div class="tab-pane <?php echo $clTab;?>" id="module<?php echo $cTab;?>">
                        <div id="collmodule<?php echo $cTab;?>" role="tablist" aria-multiselectable="true" class="m-b-20">
                        <?php if(!empty($module['submodules'])){ ?>
                            <?php foreach($module['submodules'] as $submodule){ 
	                    if($submodule['name'] != 'X - DIVISION COBRANZAS')
                            {
			    ?>
                            <div class="card">
                                <div class="card-header" role="tab" id="headingOne">
                                    <h5 class="mb-0 mt-0 font-16">
                                        <a class="text-danger" data-toggle="collapse" data-parent="#collmodule<?php echo $cTab;?>" href="#submodule<?php echo $module['id'];?>_<?php echo $submodule['id'];?>" aria-expanded="false" aria-controls="submodule<?php echo $module['id'];?>_<?php echo $submodule['id'];?>">
                                            <?php echo $submodule['name']; ?>
                                        </a>
                                    </h5>
                                </div>

                                <div id="submodule<?php echo $module['id'];?>_<?php echo $submodule['id'];?>" class="collapse" role="tabpanel" aria-labelledby="headingOne">
                                    <div class="card-body">
                                        <?php if(!empty($submodule['data'])){ ?>
                                                <div class="row">
                                                    <div class="table-responsive">
                                                        <table class="table table-striped table-bordered">
                                                            <thead>
                                                                <tr>
                                                                    <th>C&oacute;digo</th>
                                                                    <th>T&iacute;tulo</th>
                                                                    <th>Descripci&oacute;n</th>
                                                                    <th>Fecha Aprobado</th>
                                                                    <th>Aprobado Por</th>
                                                                    <th>Version</th>
                                                                    <th>Acciones</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                            <?php foreach ($submodule['data'] as $data) { 
                                                                if($data['date_update'] == null){
                                                                    $fecha = date('d/m/Y',strtotime($data['date_register']));
                                                                }else{
                                                                    $fecha = date('d/m/Y',strtotime($data['date_update']));
                                                                }

                                                                ?>
                                                                <tr>
                                                                    <td><?php echo $data['code_module']; ?></td>
                                                                    <td><?php echo $data['title']; ?></td>
                                                                    <td><?php echo $data['description']; ?></td>
                                                                    <td><?php echo date('d/m/Y',strtotime($data['date_approved'])); ?></td>
                                                                    <td><?php echo $data['approved']; ?></td>
                                                                    <td><?php echo $data['version']; ?></td>
                                                                    <td align="center">
                                                                        <?php if(Yii::app()->user->checkAccess('admin_modulos')){ ?>
                                                                            <a href="<?php echo Yii::app()->createUrl('modules/update',array('modC'=>$_GET['modC'],'modI'=>$data['id'])); ?>" class="btn btn-icon waves-effect waves-light btn-danger m-b-5" data-toggle="tooltip" data-placement="bottom" title="Modificar"><i class="fa fa-edit"></i></a>
                                                                        <?php } ?>
                                                                        <?php if($data['information'] != null){ ?>
                                                                            <a class="btn btn-icon waves-effect waves-light btn-success m-b-5 text-light" onclick="$('#modalView<?php echo $data['id']; ?>').modal('show');" data-toggle="tooltip" data-placement="bottom" title="Ver"><i class="fa fa-eye"></i></a>
                                                                        <?php } ?>
                                                                        <?php if($data['file'] != null){ ?>
                                                                            <a href="<?php echo Yii::app()->createUrl('api/showModulesFiles',array('filename'=>$data['file'],'code'=>$_GET['modC'])); ?>" class="btn btn-icon waves-effect waves-light btn-dark m-b-5" data-toggle="tooltip" data-placement="bottom" title="Descargar Archivo"><i class="fa fa-cloud-download"></i></a>
                                                                        <?php } ?>
                                                                        <?php if($data['files'] == 1){ ?>
                                                                            <a class="btn btn-icon waves-effect waves-light btn-warning m-b-5" onclick="$('#modalFiles<?php echo $data['id']; ?>').modal('show');" data-toggle="tooltip" data-placement="bottom" title="Archivos"><i class="fa fa-file-zip-o"></i></a>
                                                                        <?php } ?>
                                                                    </td>
                                                                </tr>
                                                                <?php if($data['information'] != null){ ?>
                                                                <!--MODALS -->
                                                                <div id="modalView<?php echo $data['id']; ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modalViewLabel" aria-hidden="true" style="display: none;">
                                                                    <div class="modal-dialog  modal-lg">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                                                <h4 class="modal-title" id="full-width-modalLabel">Informaci&oacute;n</h4>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                <div class="col-md-12">
                                                                                    <?php echo $data['information']; ?>
                                                                                </div>
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <button type="button" class="btn btn-primary waves-effect waves-light" data-dismiss="modal" aria-hidden="true">Cerrar</button>
                                                                            </div>
                                                                        </div><!-- /.modal-content -->
                                                                    </div><!-- /.modal-dialog  modal-lg -->
                                                                </div><!-- /.modal -->
                                                                <?php } ?>
                                                                <?php if($data['files'] == 1){ ?>
                                                                <!--MODALS -->
                                                                <div id="modalFiles<?php echo $data['id']; ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modalFilesLabel" aria-hidden="true" style="display: none;">
                                                                    <div class="modal-dialog  modal-lg">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                                                <h4 class="modal-title" id="full-width-modalLabel">Archivos</h4>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                <div class="col-md-12">
                                                                                    <?php if(!empty($data['uploads'])){ ?>
                                                                                        <div class="row">
                                                                                            <?php foreach($data['uploads'] as $file){ ?>
                                                                                                <div class="col-md-6">
                                                                                                    <h4>Nombre: <?php echo urldecode($file['name']); ?></h4>
                                                                                                    <h4>Fecha Registro: <?php echo date('d/m/Y',strtotime($file['date_register'])); ?></h4>
                                                                                                </div>
                                                                                                <div class="col-md-6">
                                                                                                    <a href="<?php echo Yii::app()->createUrl('api/showModulesFiles',array('filename'=>$file['file'],'code'=>$_GET['modC'])); ?>" class="btn btn-icon waves-effect waves-light btn-dark m-b-5" data-toggle="tooltip" data-placement="bottom" title="Descargar Archivo"><i class="fa fa-cloud-download"></i> Descargar</a>
                                                                                                </div>
                                                                                                <div class="col-md-12">
                                                                                                    <hr>
                                                                                                </div>
                                                                                            <?php } ?>
                                                                                        </div>
                                                                                    <?php }else{ ?>
                                                                                        <h3>NO EXISTEN ARCHIVO REGISTRADOS.</h3>  
                                                                                    <?php } ?>
                                                                                </div>                                                                            
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <button type="button" class="btn btn-primary waves-effect waves-light" data-dismiss="modal" aria-hidden="true">Cerrar</button>
                                                                            </div>
                                                                        </div><!-- /.modal-content -->
                                                                    </div><!-- /.modal-dialog  modal-lg -->
                                                                </div><!-- /.modal -->
                                                                <?php } ?>
                                                            <?php } ?>
                                                                
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                        <?php }else{ ?>
                                        <div class="col-md-12"  align="center">
                                            <h3>NO EXISTEN DATOS REGISTRADOS.</h3>                                                    
                                        </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
			    <?php } ?>
                            <?php } ?>
                        <?php } ?>
                        </div>
                    <?php $cTab = $cTab + 1;?>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
<?php } ?>