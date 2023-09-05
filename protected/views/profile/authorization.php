<link href="<?php echo Yii::app()->theme->baseUrl;?>/assets/datetimepicker/jquery.datetimepicker.css" rel="stylesheet" type="text/css" />
<div class="row">
    <div class="col-xl-3 col-xs-12  order-2">
        <div class="text-center card-box">
            <div class="member-card">
                <?php $this->renderPartial('info',array('model'=>$model)); ?>
            </div>
        </div> <!-- end card-box -->
    </div> <!-- end col -->
    <div class="col-xl-9 col-xs-12  order-1 order-xl-9">
        <div class="">
            <div class="card-box">
                <ul class="nav nav-tabs tabs-bordered">
                    <?php $this->renderPartial('menu'); ?>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active">
                        <div class="row">  
                            <div class="col-md-12">
                                <?php 
                                if(isset($_GET['esv'])){
                                    $error = $_GET['esv'];

                                    if($error == '-100'){
                                        echo '<div class="alert alert-danger"><strong>Aviso: </strong> '.$_GET['mss'].'.</div>';
                                    }else{
                                        echo '<div class="alert alert-success"><strong>Informe: </strong> Se autorizo exitosamente.</div>';
                                    }
                                }
                                ?>
                            </div>
                            <div class="col-md-12">
                                <h4>Solicitudes de Permiso</h4>
                                <br>
                            </div>
                            <div class="col-md-12">
                                <?php if(!empty($license)){ ?>
                                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" id="pendientes-tab" data-toggle="tab" href="#pendientes" role="tab" aria-controls="pendientes" aria-selected="true">Pendientes</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="aprobadas-tab" data-toggle="tab" href="#aprobadas" role="tab" aria-controls="aprobadas" aria-selected="false">Aprobadas</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="rechazadas-tab" data-toggle="tab" href="#rechazadas" role="tab" aria-controls="rechazadas" aria-selected="false">Rechazadas</a>
                                        </li>
                                    </ul>
                                    <div class="tab-content" id="myTabContent">
                                        <div class="tab-pane fade show active" id="pendientes" role="tabpanel" aria-labelledby="pendientes-tab">
                                            
                                                <table id="datatable-buttons" class="table table-striped table-bordered" style="font-size: 12px;" cellspacing="0" width="100%">
                                                    <thead>
                                                        <tr>
                                                            <th></th>
                                                            <th>Nombre</th>
                                                            <th>Item</th>
                                                            <th>Tipo Solicitud</th>
                                                            <th>Fecha Registro</th>
                                                            <th>Fechas</th>
                                                            <th>Solicitud</th>
                                                            <th>Fecha Autorizaci&oacute;n</th>
                                                            <th>Estado</th>
                                                            <th>Acciones</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php 
                                                        $count = 1;

                                                        foreach ($license as $value) { 
                                                            $api = new IntraAuth;

                                                            $vvv = $api->GetVacations($value->item);

                                                            if(empty($value->status_auth)){
                                                            ?>
                                                            <tr>
                                                                <td><?php echo $value->date_register; ?></td>
                                                                <td><?php echo $value->name; ?></td>
                                                                <td><?php echo $value->item; ?></td>
                                                                <td><?php echo $value->type; ?></td>
                                                                <td><?php echo date('d/m/Y',strtotime($value->date)); ?></td>
                                                                <td>
                                                                    Desde: <?php echo date('d/m/Y H:i',strtotime($value->date_start)); ?><br>
                                                                    Hasta: <?php echo date('d/m/Y H:i',strtotime($value->date_end)); ?><br>
                                                                    Retorno: <?php echo date('d/m/Y H:i',strtotime($value->date_return)); ?>
                                                                </td>
                                                                <td>
                                                                    D&iacute;as: <?php echo $value->days; ?><br>
                                                                    Horas: <?php echo $value->hours; ?><br>
                                                                    Minutos: <?php echo $value->minutes; ?>
                                                                </td>
                                                                <td>
                                                                    <?php 
                                                                    if($value->date_auth != null){
                                                                        echo 'Desde: '.date('d/m/Y H:i',strtotime($value->date_start_auth)).'<br>';
                                                                        echo 'Hasta: '.date('d/m/Y H:i',strtotime($value->date_end_auth)).'<br>';
                                                                        echo 'Retorno: '.date('d/m/Y H:i',strtotime($value->date_return_auth));
                                                                    }else{
                                                                        echo 'PENDIENTE'; 
                                                                    }
                                                                    ?>
                                                                </td>

                                                                <td>
                                                                <?php 
                                                                if($value->status_auth == 0){
                                                                    echo 'PENDIENTE';
                                                                }elseif($value->status_auth == 1){
                                                                    echo 'APROBADO';
                                                                }elseif($value->status_auth == 2){
                                                                    echo 'RECHAZADO';
                                                                }
                                                                ?>
                                                                </td>
                                                                <td>
                                                                    <?php if($value->status_auth == 0){ ?>
                                                                        <a class="btn btn-icon waves-effect waves-light btn-danger m-b-5" onclick="$('#modalRegister<?php echo $value->id; ?>').modal('show');" data-toggle="tooltip" data-placement="bottom" title="Registrar">
                                                                            <i class="fa fa-edit"></i>
                                                                        </a>  
                                                                    <?php } ?>
                                                                    <a class="btn btn-icon waves-effect waves-light btn-warning m-b-5" onclick="$('#modalView<?php echo $value->id; ?>').modal('show');" data-toggle="tooltip" data-placement="bottom" title="Ver">
                                                                        <i class="fa fa-eye"></i>
                                                                    </a>  
                                                                </td>
                                                                <div id="modalRegister<?php echo $value->id; ?>" class="modal fade" role="dialog" aria-labelledby="modalViewLabel" aria-hidden="true" style="display: none;">
                                                                    <div class="modal-dialog  modal-lg">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                                                <h4 class="modal-title" id="full-width-modalLabel">Registrar</h4>
                                                                            </div>
                                                                            <form method="POST" action="<?php echo Yii::app()->createUrl('profile/authLicense'); ?>" onsubmit="jQuery('.loader_div').show();$('#modalRegister<?php echo $value->id; ?>').modal('hide');">
                                                                                <div class="modal-body">
                                                                                    <div class="row">
                                                                                        <div class="col-md-12" align="center">
                                                                                            <h4><?php echo $value->name; ?></h4>
                                                                                            <h4>Item: <?php echo $value->item; ?></h4>
                                                                                        </div>
                                                                                        <div class="col-md-4">
                                                                                            <label class="control-label">Fecha Inicio</label>
                                                                                            <div class="input-group">
                                                                                                <input type="text" class="form-control" name="lic_fch_ini" id="lic_fch_ini<?php echo $value->id; ?>" onclick="validarLicenciaFecha('<?php echo $value->id; ?>')" value="<?php echo date('d/m/Y H:i',strtotime($value->date_start)); ?>" readonly required>
                                                                                            </div><!-- input-group -->
                                                                                        </div>
                                                                                        <div class="col-md-4">
                                                                                            <label class="control-label">Fecha Fin</label>
                                                                                            <div class="input-group">
                                                                                                <input type="text" class="form-control" name="lic_fch_fin" id="lic_fch_fin<?php echo $value->id; ?>" onclick="validarLicenciaFecha('<?php echo $value->id; ?>')" value="<?php echo date('d/m/Y H:i',strtotime($value->date_end)); ?>" readonly required>
                                                                                            </div><!-- input-group -->
                                                                                        </div>
                                                                                        <div class="col-md-4">
                                                                                            <label class="control-label">Fecha de Retorno</label>
                                                                                            <div class="input-group">
                                                                                                <input type="text" class="form-control" name="lic_fch_ret" id="lic_fch_ret<?php echo $value->id; ?>" onclick="validarLicenciaFecha('<?php echo $value->id; ?>')" value="<?php echo date('d/m/Y H:i',strtotime($value->date_return)); ?>" readonly required>
                                                                                            </div><!-- input-group -->
                                                                                        </div>
                                                                                        <div class="col-md-4">
                                                                                            <label class="control-label">D&iacute;as</label>
                                                                                            <div class="input-group">
                                                                                                <input type="text" class="form-control" name="lic_day" id="lic_day<?php echo $value->id; ?>" onchange="ValidarSolicitud('<?php echo $value->id; ?>');" onkeyup="ValidarSolicitud('<?php echo $value->id; ?>');" placeholder="0" value="<?php echo $value->days; ?>" onkeypress='validate(event)'>
                                                                                            </div><!-- input-group -->
                                                                                        </div>
                                                                                        <div class="col-md-4">
                                                                                            <label class="control-label">Horas</label>
                                                                                            <div class="input-group">
                                                                                                <input type="text" class="form-control" name="lic_hour" id="lic_hour<?php echo $value->id; ?>" onchange="ValidarSolicitud('<?php echo $value->id; ?>');" onkeyup="ValidarSolicitud('<?php echo $value->id; ?>');" placeholder="0" value="<?php echo $value->hours; ?>" onkeypress='validate(event)'>
                                                                                            </div><!-- input-group -->
                                                                                        </div>
                                                                                        <div class="col-md-4">
                                                                                            <label class="control-label">Minutos</label>
                                                                                            <div class="input-group">
                                                                                                <input type="text" class="form-control" name="lic_minutes" id="lic_minutes<?php echo $value->id; ?>" onchange="ValidarSolicitud('<?php echo $value->id; ?>');ValidarMinutos('<?php echo $value->id; ?>');" onkeyup="ValidarSolicitud('<?php echo $value->id; ?>');" placeholder="0" value="<?php echo $value->minutes; ?>" onkeypress='validate(event)'>
                                                                                            </div><!-- input-group -->
                                                                                        </div>
                                                                                        <div class="col-md-12">
                                                                                            <span id="message<?php echo $value->id; ?>"></span>
                                                                                        </div>
                                                                                        <div class="col-md-12">
                                                                                        <label class="control-label">Estado</label>
                                                                                            <div class="input-group">
                                                                                                <select class="form-control" name="auth_status" id="auth_status<?php echo $value->id; ?>" onchange="validarLicencia('<?php echo $value->id; ?>')" required>
                                                                                                    <option value="">--SELECCIONAR--</option>
                                                                                                    <option value="1">APROBADO</option>
                                                                                                    <option value="2">RECHAZADO</option>
                                                                                                </select>
                                                                                            </div><!-- input-group -->
                                                                                        </div>
                                                                                        <div class="col-md-12" style="display:none;" id="divObs<?php echo $value->id; ?>">
                                                                                            <label class="control-label">Observaci&oacute;n</label>
                                                                                            <div class="input-group">
                                                                                                <input type="text" maxlength="250" id="auth_obs<?php echo $value->id; ?>" name="auth_obs" onkeyup="this.value = this.value.toUpperCase();" class="form-control" required>
                                                                                            </div><!-- input-group -->
                                                                                        </div>
                                                                                        <input type="hidden" value="<?php echo $value->id; ?>" name="auth_id">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="modal-footer">
                                                                                    <button type="submit" id="btnRegister<?php echo $value->id; ?>" name="authInfo" class="btn btn-primary waves-effect waves-light">Guardar</button>
                                                                                    <button type="button" class="btn btn-secondary waves-effect waves-light" data-dismiss="modal" aria-hidden="true">Cerrar</button>
                                                                                </div>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div id="modalView<?php echo $value->id; ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modalViewLabel" aria-hidden="true" style="display: none;">
                                                                    <div class="modal-dialog  modal-lg">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                                                <h4 class="modal-title" id="full-width-modalLabel">Informaci&oacute;n</h4>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                <div class="row">
                                                                                
                                                                                    <div class="col-lg-12">
                                                                                        <h4>Vacaci&oacute;n Acumulada:</h4>
                                                                                        <?php if(!empty($vvv)){ ?>
                                                                                            <?php foreach($vvv as $vaca){ ?>
                                                                                                <h5>Desde: <?php echo $vaca['GI']; ?> - Hasta: <?php echo $vaca['GF']; ?>. Candidad de d&iacute;as Acumulados: <?php echo $vaca['SS']; ?></h5>
                                                                                            <?php } ?>
                                                                                        <?php }else{ ?>
                                                                                            <h5>No tiene saldo de d&iacute;as acumulados.</h5>
                                                                                        <?php } ?>
                                                                                        <hr>
                                                                                    </div>

                                                                                    <div class="col-lg-12">
                                                                                        Nombre: <?php echo $value->name; ?>
                                                                                    </div>
                                                                                    <div class="col-lg-12">
                                                                                        Item: <?php echo $value->item; ?>
                                                                                    </div>
                                                                                    <div class="col-lg-12">
                                                                                        Fecha Registro: <?php echo date('d/m/Y',strtotime($value->date)); ?>
                                                                                    </div>
                                                                                    <div class="col-lg-12">
                                                                                        Fecha Solicitud:
                                                                                    </div>
                                                                                    <div class="col-lg-4">
                                                                                        Desde: <?php echo date('d/m/Y',strtotime($value->date_start)); ?>
                                                                                    </div>
                                                                                    <div class="col-lg-4">
                                                                                        Hasta: <?php echo date('d/m/Y',strtotime($value->date_end)); ?>
                                                                                    </div>
                                                                                    <div class="col-lg-4">
                                                                                        Retorno: <?php echo date('d/m/Y',strtotime($value->date_return)); ?>
                                                                                    </div>
                                                                                    <div class="col-lg-12">
                                                                                        Solicitud: 
                                                                                    </div>
                                                                                    <div class="col-lg-4">
                                                                                        D&iacute;as: <?php echo $value->days; ?>
                                                                                    </div>
                                                                                    <div class="col-lg-4">
                                                                                        Horas: <?php echo $value->hours; ?>
                                                                                    </div>
                                                                                    <div class="col-lg-4">
                                                                                        Minutos: <?php echo $value->minutes; ?>
                                                                                    </div>
                                                                                    <div class="col-lg-12">
                                                                                        Observaci&oacute;n: <?php echo $value->observation_sol; ?>
                                                                                    </div>
                                                                                    <div class="col-lg-12">
                                                                                        Estado: 
                                                                                        <?php 
                                                                                        if($value->status_auth == 0){
                                                                                            echo 'PENDIENTE';
                                                                                        }elseif($value->status_auth == 1){
                                                                                            echo 'APROBADO';
                                                                                        }elseif($value->status_auth == 2){
                                                                                            echo 'RECHAZADO';
                                                                                        }
                                                                                        ?>
                                                                                    </div>

                                                                                    <?php if($value->status_auth == 1){ ?>
                                                                                    <div class="col-lg-12">
                                                                                        Fecha Autorizaci&oacute;n: 
                                                                                        <?php 
                                                                                        if($value->date_auth != null){
                                                                                            echo date('d/m/Y',strtotime($value->date_auth)); 
                                                                                        }else{
                                                                                            echo 'PENDIENTE'; 
                                                                                        }
                                                                                        ?>
                                                                                    </div>
                                                                                    <div class="col-lg-12">
                                                                                        Observaci&oacute;n Autorizaci&oacute;n: <?php echo $value->observation_auth; ?>
                                                                                    </div>
                                                                                    <?php } ?>
                                                                                </div>
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <button type="button" class="btn btn-primary waves-effect waves-light" data-dismiss="modal" aria-hidden="true">Cerrar</button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </tr>
                                                            <?php $count = $count + 1; ?>
                                                        <?php } ?>
                                                        <?php } ?>
                                                    </tbody>
                                                </table>
                                            
                                        </div>
                                        <div class="tab-pane fade" id="aprobadas" role="tabpanel" aria-labelledby="aprobadas-tab">
                                            
                                                <table id="datatable-buttons-second" class="table table-striped table-bordered" style="font-size: 12px;" cellspacing="0" width="100%">
                                                    <thead>
                                                        <tr>
                                                            <th></th>
                                                            <th>Nombre</th>
                                                            <th>Item</th>
                                                            <th>Tipo Solicitud</th>
                                                            <th>Fecha Registro</th>
                                                            <th>Fechas</th>
                                                            <th>Solicitud</th>
                                                            <th>Fecha Autorizaci&oacute;n</th>
                                                            <th>Estado</th>
                                                            <th>Acciones</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php 
                                                        $count = 1;

                                                        foreach ($license as $value) { 
                                                            $api = new IntraAuth;

                                                            $vvv = $api->GetVacations($value->item);
                                                            if($value->status_auth == 1){?>
                                                            <tr>
                                                                <td><?php echo $value->date_register; ?></td>
                                                                <td><?php echo $value->name; ?></td>
                                                                <td><?php echo $value->item; ?></td>
                                                                <td><?php echo $value->type; ?></td>
                                                                <td><?php echo date('d/m/Y',strtotime($value->date)); ?></td>
                                                                <td>
                                                                    Desde: <?php echo date('d/m/Y H:i',strtotime($value->date_start)); ?><br>
                                                                    Hasta: <?php echo date('d/m/Y H:i',strtotime($value->date_end)); ?><br>
                                                                    Retorno: <?php echo date('d/m/Y H:i',strtotime($value->date_return)); ?>
                                                                </td>
                                                                <td>
                                                                    D&iacute;as: <?php echo $value->days_auth; ?><br>
                                                                    Horas: <?php echo $value->hours_auth; ?><br>
                                                                    Minutos: <?php echo $value->minutes_auth; ?>
                                                                </td>
                                                                <td>
                                                                    <?php 
                                                                    if($value->date_auth != null){
                                                                        echo 'Desde: '.date('d/m/Y H:i',strtotime($value->date_start_auth)).'<br>';
                                                                        echo 'Hasta: '.date('d/m/Y H:i',strtotime($value->date_end_auth)).'<br>';
                                                                        echo 'Retorno: '.date('d/m/Y H:i',strtotime($value->date_return_auth));
                                                                    }else{
                                                                        echo 'PENDIENTE'; 
                                                                    }
                                                                    ?>
                                                                </td>

                                                                <td>
                                                                <?php 
                                                                if($value->status_auth == 0){
                                                                    echo 'PENDIENTE';
                                                                }elseif($value->status_auth == 1){
                                                                    echo 'APROBADO';
                                                                }elseif($value->status_auth == 2){
                                                                    echo 'RECHAZADO';
                                                                }
                                                                ?>
                                                                </td>
                                                                <td>
                                                                    <?php if($value->status_auth == 0){ ?>
                                                                        <a class="btn btn-icon waves-effect waves-light btn-danger m-b-5" onclick="$('#modalRegister<?php echo $value->id; ?>').modal('show');" data-toggle="tooltip" data-placement="bottom" title="Registrar">
                                                                            <i class="fa fa-edit"></i>
                                                                        </a>  
                                                                    <?php } ?>
                                                                    <a class="btn btn-icon waves-effect waves-light btn-warning m-b-5" onclick="$('#modalView<?php echo $value->id; ?>').modal('show');" data-toggle="tooltip" data-placement="bottom" title="Ver">
                                                                        <i class="fa fa-eye"></i>
                                                                    </a>  
                                                                </td>
                                                                <div id="modalRegister<?php echo $value->id; ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modalViewLabel" aria-hidden="true" style="display: none;">
                                                                    <div class="modal-dialog  modal-lg">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                                                <h4 class="modal-title" id="full-width-modalLabel">Registrar</h4>
                                                                            </div>
                                                                            <form method="POST" action="<?php echo Yii::app()->createUrl('profile/authLicense'); ?>" onsubmit="jQuery('.loader_div').show();$('#modalImage').modal('hide');">
                                                                                <div class="modal-body">
                                                                                    <div class="row">
                                                                                        <div class="col-md-12" align="center">
                                                                                            <h4><?php echo $value->name; ?></h4>
                                                                                            <h4>Item: <?php echo $value->item; ?></h4>
                                                                                        </div>
                                                                                        <div class="col-md-4">
                                                                                            <label class="control-label">Fecha Inicio</label>
                                                                                            <div class="input-group">
                                                                                                <input type="text" class="form-control" name="lic_fch_ini" id="lic_fch_ini<?php echo $value->id; ?>" onclick="validarLicenciaFecha('<?php echo $value->id; ?>')" value="<?php echo date('d/m/Y H:i',strtotime($value->date_start)); ?>" readonly required>
                                                                                            </div><!-- input-group -->
                                                                                        </div>
                                                                                        <div class="col-md-4">
                                                                                            <label class="control-label">Fecha Fin</label>
                                                                                            <div class="input-group">
                                                                                                <input type="text" class="form-control" name="lic_fch_fin" id="lic_fch_fin<?php echo $value->id; ?>" onclick="validarLicenciaFecha('<?php echo $value->id; ?>')" value="<?php echo date('d/m/Y H:i',strtotime($value->date_end)); ?>" readonly required>
                                                                                            </div><!-- input-group -->
                                                                                        </div>
                                                                                        <div class="col-md-4">
                                                                                            <label class="control-label">Fecha de Retorno</label>
                                                                                            <div class="input-group">
                                                                                                <input type="text" class="form-control" name="lic_fch_ret" id="lic_fch_ret<?php echo $value->id; ?>" onclick="validarLicenciaFecha('<?php echo $value->id; ?>')" value="<?php echo date('d/m/Y H:i',strtotime($value->date_return)); ?>" readonly required>
                                                                                            </div><!-- input-group -->
                                                                                        </div>
                                                                                        <div class="col-md-4">
                                                                                            <label class="control-label">D&iacute;as</label>
                                                                                            <div class="input-group">
                                                                                                <input type="text" class="form-control" name="lic_day" id="lic_day<?php echo $value->id; ?>" onchange="ValidarSolicitud('<?php echo $value->id; ?>');" onkeyup="ValidarSolicitud('<?php echo $value->id; ?>');" placeholder="0" value="<?php echo $value->days; ?>" onkeypress='validate(event)'>
                                                                                            </div><!-- input-group -->
                                                                                        </div>
                                                                                        <div class="col-md-4">
                                                                                            <label class="control-label">Horas</label>
                                                                                            <div class="input-group">
                                                                                                <input type="text" class="form-control" name="lic_hour" id="lic_hour<?php echo $value->id; ?>" onchange="ValidarSolicitud('<?php echo $value->id; ?>');" onkeyup="ValidarSolicitud('<?php echo $value->id; ?>');" placeholder="0" value="<?php echo $value->hours; ?>" onkeypress='validate(event)'>
                                                                                            </div><!-- input-group -->
                                                                                        </div>
                                                                                        <div class="col-md-4">
                                                                                            <label class="control-label">Minutos</label>
                                                                                            <div class="input-group">
                                                                                                <input type="text" class="form-control" name="lic_minutes" id="lic_minutes<?php echo $value->id; ?>" onchange="ValidarSolicitud('<?php echo $value->id; ?>');ValidarMinutos('<?php echo $value->id; ?>');" onkeyup="ValidarSolicitud('<?php echo $value->id; ?>');" placeholder="0" value="<?php echo $value->minutes; ?>" onkeypress='validate(event)'>
                                                                                            </div><!-- input-group -->
                                                                                        </div>
                                                                                        <div class="col-md-12">
                                                                                            <span id="message<?php echo $value->id; ?>"></span>
                                                                                        </div>
                                                                                        <div class="col-md-12">
                                                                                        <label class="control-label">Estado</label>
                                                                                            <div class="input-group">
                                                                                                <select class="form-control" name="auth_status" id="auth_status<?php echo $value->id; ?>" onchange="validarLicencia('<?php echo $value->id; ?>')" required>
                                                                                                    <option value="">--SELECCIONAR--</option>
                                                                                                    <option value="1">APROBADO</option>
                                                                                                    <option value="2">RECHAZADO</option>
                                                                                                </select>
                                                                                            </div><!-- input-group -->
                                                                                        </div>
                                                                                        <div class="col-md-12" style="display:none;" id="divObs<?php echo $value->id; ?>">
                                                                                            <label class="control-label">Observaci&oacute;n</label>
                                                                                            <div class="input-group">
                                                                                                <input type="text" maxlength="50" id="auth_obs<?php echo $value->id; ?>" name="auth_obs" onkeyup="this.value = this.value.toUpperCase();" class="form-control" required>
                                                                                            </div><!-- input-group -->
                                                                                        </div>
                                                                                        <input type="hidden" value="<?php echo $value->id; ?>" name="auth_id">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="modal-footer">
                                                                                    <button type="submit" id="btnRegister<?php echo $value->id; ?>" name="authInfo" class="btn btn-primary waves-effect waves-light">Guardar</button>
                                                                                    <button type="button" class="btn btn-secondary waves-effect waves-light" data-dismiss="modal" aria-hidden="true">Cerrar</button>
                                                                                </div>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div id="modalView<?php echo $value->id; ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modalViewLabel" aria-hidden="true" style="display: none;">
                                                                    <div class="modal-dialog  modal-lg">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                                                <h4 class="modal-title" id="full-width-modalLabel">Informaci&oacute;n</h4>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                <div class="row">
                                                                                
                                                                                    <div class="col-lg-12">
                                                                                        <h4>Vacaci&oacute;n Acumulada:</h4>
                                                                                        <?php if(!empty($vvv)){ ?>
                                                                                            <?php foreach($vvv as $vaca){ ?>
                                                                                                <h5>Desde: <?php echo $vaca['GI']; ?> - Hasta: <?php echo $vaca['GF']; ?>. Candidad de d&iacute;as Acumulados: <?php echo $vaca['SS']; ?></h5>
                                                                                            <?php } ?>
                                                                                        <?php }else{ ?>
                                                                                            <h5>No tiene saldo de d&iacute;as acumulados.</h5>
                                                                                        <?php } ?>
                                                                                        <hr>
                                                                                    </div>
                                                                                    <div class="col-lg-12">
                                                                                        Nombre: <?php echo $value->name; ?>
                                                                                    </div>
                                                                                    <div class="col-lg-12">
                                                                                        Item: <?php echo $value->item; ?>
                                                                                    </div>
                                                                                    <div class="col-lg-12">
                                                                                        Fecha Registro: <?php echo date('d/m/Y',strtotime($value->date)); ?>
                                                                                    </div>
                                                                                    <div class="col-lg-12">
                                                                                        Fecha Solicitud:
                                                                                    </div>
                                                                                    <div class="col-lg-4">
                                                                                        Desde: <?php echo date('d/m/Y',strtotime($value->date_start)); ?>
                                                                                    </div>
                                                                                    <div class="col-lg-4">
                                                                                        Hasta: <?php echo date('d/m/Y',strtotime($value->date_end)); ?>
                                                                                    </div>
                                                                                    <div class="col-lg-4">
                                                                                        Retorno: <?php echo date('d/m/Y',strtotime($value->date_return)); ?>
                                                                                    </div>
                                                                                    <div class="col-lg-12">
                                                                                        Solicitud: 
                                                                                    </div>
                                                                                    <div class="col-lg-4">
                                                                                        D&iacute;as: <?php echo $value->days; ?>
                                                                                    </div>
                                                                                    <div class="col-lg-4">
                                                                                        Horas: <?php echo $value->hours; ?>
                                                                                    </div>
                                                                                    <div class="col-lg-4">
                                                                                        Minutos: <?php echo $value->minutes; ?>
                                                                                    </div>
                                                                                    <div class="col-lg-12">
                                                                                        Observaci&oacute;n: <?php echo $value->observation_sol; ?>
                                                                                    </div>
                                                                                    <div class="col-lg-12">
                                                                                        Estado: 
                                                                                        <?php 
                                                                                        if($value->status_auth == 0){
                                                                                            echo 'PENDIENTE';
                                                                                        }elseif($value->status_auth == 1){
                                                                                            echo 'APROBADO';
                                                                                        }elseif($value->status_auth == 2){
                                                                                            echo 'RECHAZADO';
                                                                                        }
                                                                                        ?>
                                                                                    </div>

                                                                                    <?php if($value->status_auth == 1){ ?>
                                                                                    <div class="col-lg-12">
                                                                                        Fecha Autorizaci&oacute;n: 
                                                                                        <?php 
                                                                                        if($value->date_auth != null){
                                                                                            echo date('d/m/Y',strtotime($value->date_auth)); 
                                                                                        }else{
                                                                                            echo 'PENDIENTE'; 
                                                                                        }
                                                                                        ?>
                                                                                    </div>
                                                                                    <div class="col-lg-12">
                                                                                        Observaci&oacute;n Autorizaci&oacute;n: <?php echo $value->observation_auth; ?>
                                                                                    </div>
                                                                                    <?php } ?>
                                                                                </div>
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <button type="button" class="btn btn-primary waves-effect waves-light" data-dismiss="modal" aria-hidden="true">Cerrar</button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </tr>
                                                            <?php $count = $count + 1; ?>
                                                        <?php } ?>
                                                        <?php } ?>
                                                    </tbody>
                                                </table>
                                            
                                        </div>
                                        <div class="tab-pane fade" id="rechazadas" role="tabpanel" aria-labelledby="rechazadas-tab">
                                            
                                                <table id="datatable-buttons-thrid" class="table table-striped table-bordered" style="font-size: 12px;" cellspacing="0" width="100%">
                                                    <thead>
                                                        <tr>
                                                            <th></th>
                                                            <th>Nombre</th>
                                                            <th>Item</th>
                                                            <th>Tipo Solicitud</th>
                                                            <th>Fecha Registro</th>
                                                            <th>Fechas</th>
                                                            <th>Solicitud</th>
                                                            <th>Fecha Autorizaci&oacute;n</th>
                                                            <th>Estado</th>
                                                            <th>Acciones</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php 
                                                        $count = 1;

                                                        foreach ($license as $value) { 
                                                            $api = new IntraAuth;

                                                            $vvv = $api->GetVacations($value->item);
                                                            if($value->status_auth == 2){?>
                                                            <tr>
                                                                <td><?php echo $value->date_register; ?></td>
                                                                <td><?php echo $value->name; ?></td>
                                                                <td><?php echo $value->item; ?></td>
                                                                <td><?php echo $value->type; ?></td>
                                                                <td><?php echo date('d/m/Y',strtotime($value->date)); ?></td>
                                                                <td>
                                                                    Desde: <?php echo date('d/m/Y H:i',strtotime($value->date_start)); ?><br>
                                                                    Hasta: <?php echo date('d/m/Y H:i',strtotime($value->date_end)); ?><br>
                                                                    Retorno: <?php echo date('d/m/Y H:i',strtotime($value->date_return)); ?>
                                                                </td>
                                                                <td>
                                                                    D&iacute;as: <?php echo $value->days; ?><br>
                                                                    Horas: <?php echo $value->hours; ?><br>
                                                                    Minutos: <?php echo $value->minutes; ?>
                                                                </td>
                                                                <td>
                                                                    <?php 
                                                                    if($value->date_auth != null){
                                                                        echo 'Desde: '.date('d/m/Y H:i',strtotime($value->date_start_auth)).'<br>';
                                                                        echo 'Hasta: '.date('d/m/Y H:i',strtotime($value->date_end_auth)).'<br>';
                                                                        echo 'Retorno: '.date('d/m/Y H:i',strtotime($value->date_return_auth));
                                                                    }else{
                                                                        echo 'PENDIENTE'; 
                                                                    }
                                                                    ?>
                                                                </td>

                                                                <td>
                                                                <?php 
                                                                if($value->status_auth == 0){
                                                                    echo 'PENDIENTE';
                                                                }elseif($value->status_auth == 1){
                                                                    echo 'APROBADO';
                                                                }elseif($value->status_auth == 2){
                                                                    echo 'RECHAZADO';
                                                                }
                                                                ?>
                                                                </td>
                                                                <td>
                                                                    <?php if($value->status_auth == 0){ ?>
                                                                        <a class="btn btn-icon waves-effect waves-light btn-danger m-b-5" onclick="$('#modalRegister<?php echo $value->id; ?>').modal('show');" data-toggle="tooltip" data-placement="bottom" title="Registrar">
                                                                            <i class="fa fa-edit"></i>
                                                                        </a>  
                                                                    <?php } ?>
                                                                    <a class="btn btn-icon waves-effect waves-light btn-warning m-b-5" onclick="$('#modalView<?php echo $value->id; ?>').modal('show');" data-toggle="tooltip" data-placement="bottom" title="Ver">
                                                                        <i class="fa fa-eye"></i>
                                                                    </a>  
                                                                </td>
                                                                <div id="modalRegister<?php echo $value->id; ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modalViewLabel" aria-hidden="true" style="display: none;">
                                                                    <div class="modal-dialog  modal-lg">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                                                <h4 class="modal-title" id="full-width-modalLabel">Registrar</h4>
                                                                            </div>
                                                                            <form method="POST" action="<?php echo Yii::app()->createUrl('profile/authLicense'); ?>" onsubmit="jQuery('.loader_div').show();$('#modalImage').modal('hide');">
                                                                                <div class="modal-body">
                                                                                    <div class="row">
                                                                                        <div class="col-md-12" align="center">
                                                                                            <h4><?php echo $value->name; ?></h4>
                                                                                            <h4>Item: <?php echo $value->item; ?></h4>
                                                                                        </div>
                                                                                        <div class="col-md-4">
                                                                                            <label class="control-label">Fecha Inicio</label>
                                                                                            <div class="input-group">
                                                                                                <input type="text" class="form-control" name="lic_fch_ini" id="lic_fch_ini<?php echo $value->id; ?>" onclick="validarLicenciaFecha('<?php echo $value->id; ?>')" value="<?php echo date('d/m/Y H:i',strtotime($value->date_start)); ?>" readonly required>
                                                                                            </div><!-- input-group -->
                                                                                        </div>
                                                                                        <div class="col-md-4">
                                                                                            <label class="control-label">Fecha Fin</label>
                                                                                            <div class="input-group">
                                                                                                <input type="text" class="form-control" name="lic_fch_fin" id="lic_fch_fin<?php echo $value->id; ?>" onclick="validarLicenciaFecha('<?php echo $value->id; ?>')" value="<?php echo date('d/m/Y H:i',strtotime($value->date_end)); ?>" readonly required>
                                                                                            </div><!-- input-group -->
                                                                                        </div>
                                                                                        <div class="col-md-4">
                                                                                            <label class="control-label">Fecha de Retorno</label>
                                                                                            <div class="input-group">
                                                                                                <input type="text" class="form-control" name="lic_fch_ret" id="lic_fch_ret<?php echo $value->id; ?>" onclick="validarLicenciaFecha('<?php echo $value->id; ?>')" value="<?php echo date('d/m/Y H:i',strtotime($value->date_return)); ?>" readonly required>
                                                                                            </div><!-- input-group -->
                                                                                        </div>
                                                                                        <div class="col-md-4">
                                                                                            <label class="control-label">D&iacute;as</label>
                                                                                            <div class="input-group">
                                                                                                <input type="text" class="form-control" name="lic_day" id="lic_day<?php echo $value->id; ?>" onchange="ValidarSolicitud('<?php echo $value->id; ?>');" onkeyup="ValidarSolicitud('<?php echo $value->id; ?>');" placeholder="0" value="<?php echo $value->days; ?>" onkeypress='validate(event)'>
                                                                                            </div><!-- input-group -->
                                                                                        </div>
                                                                                        <div class="col-md-4">
                                                                                            <label class="control-label">Horas</label>
                                                                                            <div class="input-group">
                                                                                                <input type="text" class="form-control" name="lic_hour" id="lic_hour<?php echo $value->id; ?>" onchange="ValidarSolicitud('<?php echo $value->id; ?>');" onkeyup="ValidarSolicitud('<?php echo $value->id; ?>');" placeholder="0" value="<?php echo $value->hours; ?>" onkeypress='validate(event)'>
                                                                                            </div><!-- input-group -->
                                                                                        </div>
                                                                                        <div class="col-md-4">
                                                                                            <label class="control-label">Minutos</label>
                                                                                            <div class="input-group">
                                                                                                <input type="text" class="form-control" name="lic_minutes" id="lic_minutes<?php echo $value->id; ?>" onchange="ValidarSolicitud('<?php echo $value->id; ?>');ValidarMinutos('<?php echo $value->id; ?>');" onkeyup="ValidarSolicitud('<?php echo $value->id; ?>');" placeholder="0" value="<?php echo $value->minutes; ?>" onkeypress='validate(event)'>
                                                                                            </div><!-- input-group -->
                                                                                        </div>
                                                                                        <div class="col-md-12">
                                                                                            <span id="message<?php echo $value->id; ?>"></span>
                                                                                        </div>
                                                                                        <div class="col-md-12">
                                                                                        <label class="control-label">Estado</label>
                                                                                            <div class="input-group">
                                                                                                <select class="form-control" name="auth_status" id="auth_status<?php echo $value->id; ?>" onchange="validarLicencia('<?php echo $value->id; ?>')" required>
                                                                                                    <option value="">--SELECCIONAR--</option>
                                                                                                    <option value="1">APROBADO</option>
                                                                                                    <option value="2">RECHAZADO</option>
                                                                                                </select>
                                                                                            </div><!-- input-group -->
                                                                                        </div>
                                                                                        <div class="col-md-12" style="display:none;" id="divObs<?php echo $value->id; ?>">
                                                                                            <label class="control-label">Observaci&oacute;n</label>
                                                                                            <div class="input-group">
                                                                                                <input type="text" maxlength="50" id="auth_obs<?php echo $value->id; ?>" name="auth_obs" onkeyup="this.value = this.value.toUpperCase();" class="form-control" required>
                                                                                            </div><!-- input-group -->
                                                                                        </div>
                                                                                        <input type="hidden" value="<?php echo $value->id; ?>" name="auth_id">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="modal-footer">
                                                                                    <button type="submit" id="btnRegister<?php echo $value->id; ?>" name="authInfo" class="btn btn-primary waves-effect waves-light">Guardar</button>
                                                                                    <button type="button" class="btn btn-secondary waves-effect waves-light" data-dismiss="modal" aria-hidden="true">Cerrar</button>
                                                                                </div>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div id="modalView<?php echo $value->id; ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modalViewLabel" aria-hidden="true" style="display: none;">
                                                                    <div class="modal-dialog  modal-lg">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                                                <h4 class="modal-title" id="full-width-modalLabel">Informaci&oacute;n</h4>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                <div class="row">
                                                                                
                                                                                    <div class="col-lg-12">
                                                                                        <h4>Vacaci&oacute;n Acumulada:</h4>
                                                                                        <?php if(!empty($vvv)){ ?>
                                                                                            <?php foreach($vvv as $vaca){ ?>
                                                                                                <h5>Desde: <?php echo $vaca['GI']; ?> - Hasta: <?php echo $vaca['GF']; ?>. Candidad de d&iacute;as Acumulados: <?php echo $vaca['SS']; ?></h5>
                                                                                            <?php } ?>
                                                                                        <?php }else{ ?>
                                                                                            <h5>No tiene saldo de d&iacute;as acumulados.</h5>
                                                                                        <?php } ?>
                                                                                        <hr>
                                                                                    </div>
                                                                                    <div class="col-lg-12">
                                                                                        Nombre: <?php echo $value->name; ?>
                                                                                    </div>
                                                                                    <div class="col-lg-12">
                                                                                        Item: <?php echo $value->item; ?>
                                                                                    </div>
                                                                                    <div class="col-lg-12">
                                                                                        Fecha Registro: <?php echo date('d/m/Y',strtotime($value->date)); ?>
                                                                                    </div>
                                                                                    <div class="col-lg-12">
                                                                                        Fecha Solicitud:
                                                                                    </div>
                                                                                    <div class="col-lg-4">
                                                                                        Desde: <?php echo date('d/m/Y',strtotime($value->date_start)); ?>
                                                                                    </div>
                                                                                    <div class="col-lg-4">
                                                                                        Hasta: <?php echo date('d/m/Y',strtotime($value->date_end)); ?>
                                                                                    </div>
                                                                                    <div class="col-lg-4">
                                                                                        Retorno: <?php echo date('d/m/Y',strtotime($value->date_return)); ?>
                                                                                    </div>
                                                                                    <div class="col-lg-12">
                                                                                        Solicitud: 
                                                                                    </div>
                                                                                    <div class="col-lg-4">
                                                                                        D&iacute;as: <?php echo $value->days; ?>
                                                                                    </div>
                                                                                    <div class="col-lg-4">
                                                                                        Horas: <?php echo $value->hours; ?>
                                                                                    </div>
                                                                                    <div class="col-lg-4">
                                                                                        Minutos: <?php echo $value->minutes; ?>
                                                                                    </div>
                                                                                    <div class="col-lg-12">
                                                                                        Observaci&oacute;n: <?php echo $value->observation_sol; ?>
                                                                                    </div>
                                                                                    <div class="col-lg-12">
                                                                                        Estado: 
                                                                                        <?php 
                                                                                        if($value->status_auth == 0){
                                                                                            echo 'PENDIENTE';
                                                                                        }elseif($value->status_auth == 1){
                                                                                            echo 'APROBADO';
                                                                                        }elseif($value->status_auth == 2){
                                                                                            echo 'RECHAZADO';
                                                                                        }
                                                                                        ?>
                                                                                    </div>

                                                                                    <?php if($value->status_auth == 1){ ?>
                                                                                    <div class="col-lg-12">
                                                                                        Fecha Autorizaci&oacute;n: 
                                                                                        <?php 
                                                                                        if($value->date_auth != null){
                                                                                            echo date('d/m/Y',strtotime($value->date_auth)); 
                                                                                        }else{
                                                                                            echo 'PENDIENTE'; 
                                                                                        }
                                                                                        ?>
                                                                                    </div>
                                                                                    <div class="col-lg-12">
                                                                                        Observaci&oacute;n Autorizaci&oacute;n: <?php echo $value->observation_auth; ?>
                                                                                    </div>
                                                                                    <?php } ?>
                                                                                </div>
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <button type="button" class="btn btn-primary waves-effect waves-light" data-dismiss="modal" aria-hidden="true">Cerrar</button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </tr>
                                                            <?php $count = $count + 1; ?>
                                                        <?php } ?>
                                                        <?php } ?>
                                                    </tbody>
                                                </table>
                                             
                                        </div>
                                    </div>
                                <?php }else{ ?>
                                    <h3>NO EXISTEN AUTORIZACIONES REGISTRADAS.</h3>
                                <?php } ?>
                            </div>
                            <div class="col-md-12">
                                <hr>
                                <h4>Solicitudes de Programaci&oacute;n de Vacaciones</h4>
                                <br>
                            </div>   
                            <div class="col-md-12">
                                <?php if(!empty($licensePr)){ ?>
                                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" id="pendientespr-tab" data-toggle="tab" href="#pendientespr" role="tab" aria-controls="pendientespr" aria-selected="true">Pendientes</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="aprobadaspr-tab" data-toggle="tab" href="#aprobadaspr" role="tab" aria-controls="aprobadaspr" aria-selected="false">Aprobadas</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="rechazadaspr-tab" data-toggle="tab" href="#rechazadaspr" role="tab" aria-controls="rechazadaspr" aria-selected="false">Rechazadas</a>
                                        </li>
                                    </ul>
                                    <div class="tab-content" id="myTabContent">
                                        <div class="tab-pane fade show active" id="pendientespr" role="tabpanel" aria-labelledby="pendientespr-tab">
                                            
                                                <table id="datatable-buttonspr" class="table table-striped table-bordered" style="font-size: 12px;" cellspacing="0" width="100%">
                                                    <thead>
                                                        <tr>
                                                            <th></th>
                                                            <th>Nombre</th>
                                                            <th>Item</th>
                                                            <th>Tipo Solicitud</th>
                                                            <th>Fecha Registro</th>
                                                            <th>Fechas</th>
                                                            <th>Solicitud</th>
                                                            <th>Fecha Autorizaci&oacute;n</th>
                                                            <th>Estado</th>
                                                            <th>Acciones</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php 
                                                        $count = 1;

                                                        foreach ($licensePr as $value) { 
                                                            $api = new IntraAuth;

                                                            $vvv = $api->GetVacations($value->item);
                                                            if(empty($value->status_auth)){
                                                            ?>
                                                            <tr>
                                                                <td><?php echo $value->date_register; ?></td>
                                                                <td><?php echo $value->name; ?></td>
                                                                <td><?php echo $value->item; ?></td>
                                                                <td><?php echo $value->type; ?></td>
                                                                <td><?php echo date('d/m/Y',strtotime($value->date)); ?></td>
                                                                <td>
                                                                    Desde: <?php echo date('d/m/Y H:i',strtotime($value->date_start)); ?><br>
                                                                    Hasta: <?php echo date('d/m/Y H:i',strtotime($value->date_end)); ?><br>
                                                                    Retorno: <?php echo date('d/m/Y H:i',strtotime($value->date_return)); ?>
                                                                </td>
                                                                <td>
                                                                    D&iacute;as: <?php echo $value->days; ?><br>
                                                                    Horas: <?php echo $value->hours; ?><br>
                                                                    Minutos: <?php echo $value->minutes; ?>
                                                                </td>
                                                                <td>
                                                                    <?php 
                                                                    if($value->date_auth != null){
                                                                        echo 'Desde: '.date('d/m/Y H:i',strtotime($value->date_start_auth)).'<br>';
                                                                        echo 'Hasta: '.date('d/m/Y H:i',strtotime($value->date_end_auth)).'<br>';
                                                                        echo 'Retorno: '.date('d/m/Y H:i',strtotime($value->date_return_auth));
                                                                    }else{
                                                                        echo 'PENDIENTE'; 
                                                                    }
                                                                    ?>
                                                                </td>

                                                                <td>
                                                                <?php 
                                                                if($value->status_auth == 0){
                                                                    echo 'PENDIENTE';
                                                                }elseif($value->status_auth == 1){
                                                                    echo 'APROBADO';
                                                                }elseif($value->status_auth == 2){
                                                                    echo 'RECHAZADO';
                                                                }
                                                                ?>
                                                                </td>
                                                                <td>
                                                                    <?php if($value->status_auth == 0){ ?>
                                                                        <a class="btn btn-icon waves-effect waves-light btn-danger m-b-5" onclick="$('#modalRegister<?php echo $value->id; ?>').modal('show');" data-toggle="tooltip" data-placement="bottom" title="Registrar">
                                                                            <i class="fa fa-edit"></i>
                                                                        </a>  
                                                                    <?php } ?>
                                                                    <a class="btn btn-icon waves-effect waves-light btn-warning m-b-5" onclick="$('#modalView<?php echo $value->id; ?>').modal('show');" data-toggle="tooltip" data-placement="bottom" title="Ver">
                                                                        <i class="fa fa-eye"></i>
                                                                    </a>  
                                                                </td>
                                                                <div id="modalRegister<?php echo $value->id; ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modalViewLabel" aria-hidden="true" style="display: none;">
                                                                    <div class="modal-dialog  modal-lg">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                                                <h4 class="modal-title" id="full-width-modalLabel">Registrar</h4>
                                                                            </div>
                                                                            <form method="POST" action="<?php echo Yii::app()->createUrl('profile/authLicense'); ?>" onsubmit="jQuery('.loader_div').show();$('#modalRegister<?php echo $value->id; ?>').modal('hide');">
                                                                                <div class="modal-body">
                                                                                    <div class="row">
                                                                                        <div class="col-md-12" align="center">
                                                                                            <h4><?php echo $value->name; ?></h4>
                                                                                            <h4>Item: <?php echo $value->item; ?></h4>
                                                                                        </div>
                                                                                        <div class="col-md-4">
                                                                                            <label class="control-label">Fecha Inicio</label>
                                                                                            <div class="input-group">
                                                                                                <input type="text" class="form-control" name="lic_fch_ini" id="lic_fch_ini<?php echo $value->id; ?>" onclick="validarLicenciaFecha('<?php echo $value->id; ?>')" value="<?php echo date('d/m/Y H:i',strtotime($value->date_start)); ?>" readonly required>
                                                                                            </div><!-- input-group -->
                                                                                        </div>
                                                                                        <div class="col-md-4">
                                                                                            <label class="control-label">Fecha Fin</label>
                                                                                            <div class="input-group">
                                                                                                <input type="text" class="form-control" name="lic_fch_fin" id="lic_fch_fin<?php echo $value->id; ?>" onclick="validarLicenciaFecha('<?php echo $value->id; ?>')" value="<?php echo date('d/m/Y H:i',strtotime($value->date_end)); ?>" readonly required>
                                                                                            </div><!-- input-group -->
                                                                                        </div>
                                                                                        <div class="col-md-4">
                                                                                            <label class="control-label">Fecha de Retorno</label>
                                                                                            <div class="input-group">
                                                                                                <input type="text" class="form-control" name="lic_fch_ret" id="lic_fch_ret<?php echo $value->id; ?>" onclick="validarLicenciaFecha('<?php echo $value->id; ?>')" value="<?php echo date('d/m/Y H:i',strtotime($value->date_return)); ?>" readonly required>
                                                                                            </div><!-- input-group -->
                                                                                        </div>
                                                                                        <div class="col-md-4">
                                                                                            <label class="control-label">D&iacute;as</label>
                                                                                            <div class="input-group">
                                                                                                <input type="text" class="form-control" name="lic_day" id="lic_day<?php echo $value->id; ?>" onchange="ValidarSolicitud('<?php echo $value->id; ?>');" onkeyup="ValidarSolicitud('<?php echo $value->id; ?>');" placeholder="0" value="<?php echo $value->days; ?>" onkeypress='validate(event)'>
                                                                                            </div><!-- input-group -->
                                                                                        </div>
                                                                                        <div class="col-md-4">
                                                                                            <label class="control-label">Horas</label>
                                                                                            <div class="input-group">
                                                                                                <input type="text" class="form-control" name="lic_hour" id="lic_hour<?php echo $value->id; ?>" onchange="ValidarSolicitud('<?php echo $value->id; ?>');" onkeyup="ValidarSolicitud('<?php echo $value->id; ?>');" placeholder="0" value="<?php echo $value->hours; ?>" onkeypress='validate(event)'>
                                                                                            </div><!-- input-group -->
                                                                                        </div>
                                                                                        <div class="col-md-4">
                                                                                            <label class="control-label">Minutos</label>
                                                                                            <div class="input-group">
                                                                                                <input type="text" class="form-control" name="lic_minutes" id="lic_minutes<?php echo $value->id; ?>" onchange="ValidarSolicitud('<?php echo $value->id; ?>');ValidarMinutos('<?php echo $value->id; ?>');" onkeyup="ValidarSolicitud('<?php echo $value->id; ?>');" placeholder="0" value="<?php echo $value->minutes; ?>" onkeypress='validate(event)'>
                                                                                            </div><!-- input-group -->
                                                                                        </div>
                                                                                        <div class="col-md-12">
                                                                                            <span id="message<?php echo $value->id; ?>"></span>
                                                                                        </div>
                                                                                        <div class="col-md-12">
                                                                                        <label class="control-label">Estado</label>
                                                                                            <div class="input-group">
                                                                                                <select class="form-control" name="auth_status" id="auth_status<?php echo $value->id; ?>" onchange="validarLicencia('<?php echo $value->id; ?>')" required>
                                                                                                    <option value="">--SELECCIONAR--</option>
                                                                                                    <option value="1">APROBADO</option>
                                                                                                    <option value="2">RECHAZADO</option>
                                                                                                </select>
                                                                                            </div><!-- input-group -->
                                                                                        </div>
                                                                                        <div class="col-md-12" style="display:none;" id="divObs<?php echo $value->id; ?>">
                                                                                            <label class="control-label">Observaci&oacute;n</label>
                                                                                            <div class="input-group">
                                                                                                <input type="text" maxlength="50" id="auth_obs<?php echo $value->id; ?>" name="auth_obs" onkeyup="this.value = this.value.toUpperCase();" class="form-control" required>
                                                                                            </div><!-- input-group -->
                                                                                        </div>
                                                                                        <input type="hidden" value="<?php echo $value->id; ?>" name="auth_id">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="modal-footer">
                                                                                    <button type="submit" id="btnRegister<?php echo $value->id; ?>" name="authInfo" class="btn btn-primary waves-effect waves-light">Guardar</button>
                                                                                    <button type="button" class="btn btn-secondary waves-effect waves-light" data-dismiss="modal" aria-hidden="true">Cerrar</button>
                                                                                </div>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div id="modalView<?php echo $value->id; ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modalViewLabel" aria-hidden="true" style="display: none;">
                                                                    <div class="modal-dialog  modal-lg">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                                                <h4 class="modal-title" id="full-width-modalLabel">Informaci&oacute;n</h4>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                <div class="row">
                                                                                
                                                                                    <div class="col-lg-12">
                                                                                        <h4>Vacaci&oacute;n Acumulada:</h4>
                                                                                        <?php if(!empty($vvv)){ ?>
                                                                                            <?php foreach($vvv as $vaca){ ?>
                                                                                                <h5>Desde: <?php echo $vaca['GI']; ?> - Hasta: <?php echo $vaca['GF']; ?>. Candidad de d&iacute;as Acumulados: <?php echo $vaca['SS']; ?></h5>
                                                                                            <?php } ?>
                                                                                        <?php }else{ ?>
                                                                                            <h5>No tiene saldo de d&iacute;as acumulados.</h5>
                                                                                        <?php } ?>
                                                                                        <hr>
                                                                                    </div>
                                                                                    <div class="col-lg-12">
                                                                                        Nombre: <?php echo $value->name; ?>
                                                                                    </div>
                                                                                    <div class="col-lg-12">
                                                                                        Item: <?php echo $value->item; ?>
                                                                                    </div>
                                                                                    <div class="col-lg-12">
                                                                                        Fecha Registro: <?php echo date('d/m/Y',strtotime($value->date)); ?>
                                                                                    </div>
                                                                                    <div class="col-lg-12">
                                                                                        Fecha Solicitud:
                                                                                    </div>
                                                                                    <div class="col-lg-4">
                                                                                        Desde: <?php echo date('d/m/Y',strtotime($value->date_start)); ?>
                                                                                    </div>
                                                                                    <div class="col-lg-4">
                                                                                        Hasta: <?php echo date('d/m/Y',strtotime($value->date_end)); ?>
                                                                                    </div>
                                                                                    <div class="col-lg-4">
                                                                                        Retorno: <?php echo date('d/m/Y',strtotime($value->date_return)); ?>
                                                                                    </div>
                                                                                    <div class="col-lg-12">
                                                                                        Solicitud: 
                                                                                    </div>
                                                                                    <div class="col-lg-4">
                                                                                        D&iacute;as: <?php echo $value->days; ?>
                                                                                    </div>
                                                                                    <div class="col-lg-4">
                                                                                        Horas: <?php echo $value->hours; ?>
                                                                                    </div>
                                                                                    <div class="col-lg-4">
                                                                                        Minutos: <?php echo $value->minutes; ?>
                                                                                    </div>
                                                                                    <div class="col-lg-12">
                                                                                        Observaci&oacute;n: <?php echo $value->observation_sol; ?>
                                                                                    </div>
                                                                                    <div class="col-lg-12">
                                                                                        Estado: 
                                                                                        <?php 
                                                                                        if($value->status_auth == 0){
                                                                                            echo 'PENDIENTE';
                                                                                        }elseif($value->status_auth == 1){
                                                                                            echo 'APROBADO';
                                                                                        }elseif($value->status_auth == 2){
                                                                                            echo 'RECHAZADO';
                                                                                        }
                                                                                        ?>
                                                                                    </div>

                                                                                    <?php if($value->status_auth == 1){ ?>
                                                                                    <div class="col-lg-12">
                                                                                        Fecha Autorizaci&oacute;n: 
                                                                                        <?php 
                                                                                        if($value->date_auth != null){
                                                                                            echo date('d/m/Y',strtotime($value->date_auth)); 
                                                                                        }else{
                                                                                            echo 'PENDIENTE'; 
                                                                                        }
                                                                                        ?>
                                                                                    </div>
                                                                                    <div class="col-lg-12">
                                                                                        Observaci&oacute;n Autorizaci&oacute;n: <?php echo $value->observation_auth; ?>
                                                                                    </div>
                                                                                    <?php } ?>
                                                                                </div>
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <button type="button" class="btn btn-primary waves-effect waves-light" data-dismiss="modal" aria-hidden="true">Cerrar</button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </tr>
                                                            <?php $count = $count + 1; ?>
                                                        <?php } ?>
                                                        <?php } ?>
                                                    </tbody>
                                                </table>
                                            
                                        </div>
                                        <div class="tab-pane fade" id="aprobadaspr" role="tabpanel" aria-labelledby="aprobadaspr-tab">
                                            
                                                <table id="datatable-buttonspr-second" class="table table-striped table-bordered" style="font-size: 12px;" cellspacing="0" width="100%">
                                                    <thead>
                                                        <tr>
                                                            <th></th>
                                                            <th>Nombre</th>
                                                            <th>Item</th>
                                                            <th>Tipo Solicitud</th>
                                                            <th>Fecha Registro</th>
                                                            <th>Fechas</th>
                                                            <th>Solicitud</th>
                                                            <th>Fecha Autorizaci&oacute;n</th>
                                                            <th>Estado</th>
                                                            <th>Acciones</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php 
                                                        $count = 1;

                                                        foreach ($licensePr as $value) { 
                                                            $api = new IntraAuth;

                                                            $vvv = $api->GetVacations($value->item);
                                                            if($value->status_auth == 1){?>
                                                            <tr>
                                                                <td><?php echo $value->date_register; ?></td>
                                                                <td><?php echo $value->name; ?></td>
                                                                <td><?php echo $value->item; ?></td>
                                                                <td><?php echo $value->type; ?></td>
                                                                <td><?php echo date('d/m/Y',strtotime($value->date)); ?></td>
                                                                <td>
                                                                    Desde: <?php echo date('d/m/Y H:i',strtotime($value->date_start)); ?><br>
                                                                    Hasta: <?php echo date('d/m/Y H:i',strtotime($value->date_end)); ?><br>
                                                                    Retorno: <?php echo date('d/m/Y H:i',strtotime($value->date_return)); ?>
                                                                </td>
                                                                <td>
                                                                    D&iacute;as: <?php echo $value->days_auth; ?><br>
                                                                    Horas: <?php echo $value->hours_auth; ?><br>
                                                                    Minutos: <?php echo $value->minutes_auth; ?>
                                                                </td>
                                                                <td>
                                                                    <?php 
                                                                    if($value->date_auth != null){
                                                                        echo 'Desde: '.date('d/m/Y H:i',strtotime($value->date_start_auth)).'<br>';
                                                                        echo 'Hasta: '.date('d/m/Y H:i',strtotime($value->date_end_auth)).'<br>';
                                                                        echo 'Retorno: '.date('d/m/Y H:i',strtotime($value->date_return_auth));
                                                                    }else{
                                                                        echo 'PENDIENTE'; 
                                                                    }
                                                                    ?>
                                                                </td>

                                                                <td>
                                                                <?php 
                                                                if($value->status_auth == 0){
                                                                    echo 'PENDIENTE';
                                                                }elseif($value->status_auth == 1){
                                                                    echo 'APROBADO';
                                                                }elseif($value->status_auth == 2){
                                                                    echo 'RECHAZADO';
                                                                }
                                                                ?>
                                                                </td>
                                                                <td>
                                                                    <?php if($value->status_auth == 0){ ?>
                                                                        <a class="btn btn-icon waves-effect waves-light btn-danger m-b-5" onclick="$('#modalRegister<?php echo $value->id; ?>').modal('show');" data-toggle="tooltip" data-placement="bottom" title="Registrar">
                                                                            <i class="fa fa-edit"></i>
                                                                        </a>  
                                                                    <?php } ?>
                                                                    <a class="btn btn-icon waves-effect waves-light btn-warning m-b-5" onclick="$('#modalView<?php echo $value->id; ?>').modal('show');" data-toggle="tooltip" data-placement="bottom" title="Ver">
                                                                        <i class="fa fa-eye"></i>
                                                                    </a>  
                                                                </td>
                                                                <div id="modalRegister<?php echo $value->id; ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modalViewLabel" aria-hidden="true" style="display: none;">
                                                                    <div class="modal-dialog  modal-lg">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                                                <h4 class="modal-title" id="full-width-modalLabel">Registrar</h4>
                                                                            </div>
                                                                            <form method="POST" action="<?php echo Yii::app()->createUrl('profile/authLicense'); ?>" onsubmit="jQuery('.loader_div').show();$('#modalImage').modal('hide');">
                                                                                <div class="modal-body">
                                                                                    <div class="row">
                                                                                        <div class="col-md-12" align="center">
                                                                                            <h4><?php echo $value->name; ?></h4>
                                                                                            <h4>Item: <?php echo $value->item; ?></h4>
                                                                                        </div>
                                                                                        <div class="col-md-4">
                                                                                            <label class="control-label">Fecha Inicio</label>
                                                                                            <div class="input-group">
                                                                                                <input type="text" class="form-control" name="lic_fch_ini" id="lic_fch_ini<?php echo $value->id; ?>" onclick="validarLicenciaFecha('<?php echo $value->id; ?>')" value="<?php echo date('d/m/Y H:i',strtotime($value->date_start)); ?>" readonly required>
                                                                                            </div><!-- input-group -->
                                                                                        </div>
                                                                                        <div class="col-md-4">
                                                                                            <label class="control-label">Fecha Fin</label>
                                                                                            <div class="input-group">
                                                                                                <input type="text" class="form-control" name="lic_fch_fin" id="lic_fch_fin<?php echo $value->id; ?>" onclick="validarLicenciaFecha('<?php echo $value->id; ?>')" value="<?php echo date('d/m/Y H:i',strtotime($value->date_end)); ?>" readonly required>
                                                                                            </div><!-- input-group -->
                                                                                        </div>
                                                                                        <div class="col-md-4">
                                                                                            <label class="control-label">Fecha de Retorno</label>
                                                                                            <div class="input-group">
                                                                                                <input type="text" class="form-control" name="lic_fch_ret" id="lic_fch_ret<?php echo $value->id; ?>" onclick="validarLicenciaFecha('<?php echo $value->id; ?>')" value="<?php echo date('d/m/Y H:i',strtotime($value->date_return)); ?>" readonly required>
                                                                                            </div><!-- input-group -->
                                                                                        </div>
                                                                                        <div class="col-md-4">
                                                                                            <label class="control-label">D&iacute;as</label>
                                                                                            <div class="input-group">
                                                                                                <input type="text" class="form-control" name="lic_day" id="lic_day<?php echo $value->id; ?>" onchange="ValidarSolicitud('<?php echo $value->id; ?>');" onkeyup="ValidarSolicitud('<?php echo $value->id; ?>');" placeholder="0" value="<?php echo $value->days; ?>" onkeypress='validate(event)'>
                                                                                            </div><!-- input-group -->
                                                                                        </div>
                                                                                        <div class="col-md-4">
                                                                                            <label class="control-label">Horas</label>
                                                                                            <div class="input-group">
                                                                                                <input type="text" class="form-control" name="lic_hour" id="lic_hour<?php echo $value->id; ?>" onchange="ValidarSolicitud('<?php echo $value->id; ?>');" onkeyup="ValidarSolicitud('<?php echo $value->id; ?>');" placeholder="0" value="<?php echo $value->hours; ?>" onkeypress='validate(event)'>
                                                                                            </div><!-- input-group -->
                                                                                        </div>
                                                                                        <div class="col-md-4">
                                                                                            <label class="control-label">Minutos</label>
                                                                                            <div class="input-group">
                                                                                                <input type="text" class="form-control" name="lic_minutes" id="lic_minutes<?php echo $value->id; ?>" onchange="ValidarSolicitud('<?php echo $value->id; ?>');ValidarMinutos('<?php echo $value->id; ?>');" onkeyup="ValidarSolicitud('<?php echo $value->id; ?>');" placeholder="0" value="<?php echo $value->minutes; ?>" onkeypress='validate(event)'>
                                                                                            </div><!-- input-group -->
                                                                                        </div>
                                                                                        <div class="col-md-12">
                                                                                            <span id="message<?php echo $value->id; ?>"></span>
                                                                                        </div>
                                                                                        <div class="col-md-12">
                                                                                        <label class="control-label">Estado</label>
                                                                                            <div class="input-group">
                                                                                                <select class="form-control" name="auth_status" id="auth_status<?php echo $value->id; ?>" onchange="validarLicencia('<?php echo $value->id; ?>')" required>
                                                                                                    <option value="">--SELECCIONAR--</option>
                                                                                                    <option value="1">APROBADO</option>
                                                                                                    <option value="2">RECHAZADO</option>
                                                                                                </select>
                                                                                            </div><!-- input-group -->
                                                                                        </div>
                                                                                        <div class="col-md-12" style="display:none;" id="divObs<?php echo $value->id; ?>">
                                                                                            <label class="control-label">Observaci&oacute;n</label>
                                                                                            <div class="input-group">
                                                                                                <input type="text" maxlength="50" id="auth_obs<?php echo $value->id; ?>" name="auth_obs" onkeyup="this.value = this.value.toUpperCase();" class="form-control" required>
                                                                                            </div><!-- input-group -->
                                                                                        </div>
                                                                                        <input type="hidden" value="<?php echo $value->id; ?>" name="auth_id">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="modal-footer">
                                                                                    <button type="submit" id="btnRegister<?php echo $value->id; ?>" name="authInfo" class="btn btn-primary waves-effect waves-light">Guardar</button>
                                                                                    <button type="button" class="btn btn-secondary waves-effect waves-light" data-dismiss="modal" aria-hidden="true">Cerrar</button>
                                                                                </div>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div id="modalView<?php echo $value->id; ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modalViewLabel" aria-hidden="true" style="display: none;">
                                                                    <div class="modal-dialog  modal-lg">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                                                <h4 class="modal-title" id="full-width-modalLabel">Informaci&oacute;n</h4>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                <div class="row">
                                                                                
                                                                                    <div class="col-lg-12">
                                                                                        <h4>Vacaci&oacute;n Acumulada:</h4>
                                                                                        <?php if(!empty($vvv)){ ?>
                                                                                            <?php foreach($vvv as $vaca){ ?>
                                                                                                <h5>Desde: <?php echo $vaca['GI']; ?> - Hasta: <?php echo $vaca['GF']; ?>. Candidad de d&iacute;as Acumulados: <?php echo $vaca['SS']; ?></h5>
                                                                                            <?php } ?>
                                                                                        <?php }else{ ?>
                                                                                            <h5>No tiene saldo de d&iacute;as acumulados.</h5>
                                                                                        <?php } ?>
                                                                                        <hr>
                                                                                    </div>
                                                                                    <div class="col-lg-12">
                                                                                        Nombre: <?php echo $value->name; ?>
                                                                                    </div>
                                                                                    <div class="col-lg-12">
                                                                                        Item: <?php echo $value->item; ?>
                                                                                    </div>
                                                                                    <div class="col-lg-12">
                                                                                        Fecha Registro: <?php echo date('d/m/Y',strtotime($value->date)); ?>
                                                                                    </div>
                                                                                    <div class="col-lg-12">
                                                                                        Fecha Solicitud:
                                                                                    </div>
                                                                                    <div class="col-lg-4">
                                                                                        Desde: <?php echo date('d/m/Y',strtotime($value->date_start)); ?>
                                                                                    </div>
                                                                                    <div class="col-lg-4">
                                                                                        Hasta: <?php echo date('d/m/Y',strtotime($value->date_end)); ?>
                                                                                    </div>
                                                                                    <div class="col-lg-4">
                                                                                        Retorno: <?php echo date('d/m/Y',strtotime($value->date_return)); ?>
                                                                                    </div>
                                                                                    <div class="col-lg-12">
                                                                                        Solicitud: 
                                                                                    </div>
                                                                                    <div class="col-lg-4">
                                                                                        D&iacute;as: <?php echo $value->days; ?>
                                                                                    </div>
                                                                                    <div class="col-lg-4">
                                                                                        Horas: <?php echo $value->hours; ?>
                                                                                    </div>
                                                                                    <div class="col-lg-4">
                                                                                        Minutos: <?php echo $value->minutes; ?>
                                                                                    </div>
                                                                                    <div class="col-lg-12">
                                                                                        Observaci&oacute;n: <?php echo $value->observation_sol; ?>
                                                                                    </div>
                                                                                    <div class="col-lg-12">
                                                                                        Estado: 
                                                                                        <?php 
                                                                                        if($value->status_auth == 0){
                                                                                            echo 'PENDIENTE';
                                                                                        }elseif($value->status_auth == 1){
                                                                                            echo 'APROBADO';
                                                                                        }elseif($value->status_auth == 2){
                                                                                            echo 'RECHAZADO';
                                                                                        }
                                                                                        ?>
                                                                                    </div>

                                                                                    <?php if($value->status_auth == 1){ ?>
                                                                                    <div class="col-lg-12">
                                                                                        Fecha Autorizaci&oacute;n: 
                                                                                        <?php 
                                                                                        if($value->date_auth != null){
                                                                                            echo date('d/m/Y',strtotime($value->date_auth)); 
                                                                                        }else{
                                                                                            echo 'PENDIENTE'; 
                                                                                        }
                                                                                        ?>
                                                                                    </div>
                                                                                    <div class="col-lg-12">
                                                                                        Observaci&oacute;n Autorizaci&oacute;n: <?php echo $value->observation_auth; ?>
                                                                                    </div>
                                                                                    <?php } ?>
                                                                                </div>
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <button type="button" class="btn btn-primary waves-effect waves-light" data-dismiss="modal" aria-hidden="true">Cerrar</button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </tr>
                                                            <?php $count = $count + 1; ?>
                                                        <?php } ?>
                                                        <?php } ?>
                                                    </tbody>
                                                </table>
                                            
                                        </div>
                                        <div class="tab-pane fade" id="rechazadaspr" role="tabpanel" aria-labelledby="rechazadaspr-tab">
                                            
                                                <table id="datatable-buttonspr-thrid" class="table table-striped table-bordered" style="font-size: 12px;" cellspacing="0" width="100%">
                                                    <thead>
                                                        <tr>
                                                            <th></th>
                                                            <th>Nombre</th>
                                                            <th>Item</th>
                                                            <th>Tipo Solicitud</th>
                                                            <th>Fecha Registro</th>
                                                            <th>Fechas</th>
                                                            <th>Solicitud</th>
                                                            <th>Fecha Autorizaci&oacute;n</th>
                                                            <th>Estado</th>
                                                            <th>Acciones</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php 
                                                        $count = 1;

                                                        foreach ($licensePr as $value) { 
                                                            $api = new IntraAuth;

                                                            $vvv = $api->GetVacations($value->item);
                                                            if($value->status_auth == 2){?>
                                                            <tr>
                                                                <td><?php echo $value->date_register; ?></td>
                                                                <td><?php echo $value->name; ?></td>
                                                                <td><?php echo $value->item; ?></td>
                                                                <td><?php echo $value->type; ?></td>
                                                                <td><?php echo date('d/m/Y',strtotime($value->date)); ?></td>
                                                                <td>
                                                                    Desde: <?php echo date('d/m/Y H:i',strtotime($value->date_start)); ?><br>
                                                                    Hasta: <?php echo date('d/m/Y H:i',strtotime($value->date_end)); ?><br>
                                                                    Retorno: <?php echo date('d/m/Y H:i',strtotime($value->date_return)); ?>
                                                                </td>
                                                                <td>
                                                                    D&iacute;as: <?php echo $value->days; ?><br>
                                                                    Horas: <?php echo $value->hours; ?><br>
                                                                    Minutos: <?php echo $value->minutes; ?>
                                                                </td>
                                                                <td>
                                                                    <?php 
                                                                    if($value->date_auth != null){
                                                                        echo 'Desde: '.date('d/m/Y H:i',strtotime($value->date_start_auth)).'<br>';
                                                                        echo 'Hasta: '.date('d/m/Y H:i',strtotime($value->date_end_auth)).'<br>';
                                                                        echo 'Retorno: '.date('d/m/Y H:i',strtotime($value->date_return_auth));
                                                                    }else{
                                                                        echo 'PENDIENTE'; 
                                                                    }
                                                                    ?>
                                                                </td>

                                                                <td>
                                                                <?php 
                                                                if($value->status_auth == 0){
                                                                    echo 'PENDIENTE';
                                                                }elseif($value->status_auth == 1){
                                                                    echo 'APROBADO';
                                                                }elseif($value->status_auth == 2){
                                                                    echo 'RECHAZADO';
                                                                }
                                                                ?>
                                                                </td>
                                                                <td>
                                                                    <?php if($value->status_auth == 0){ ?>
                                                                        <a class="btn btn-icon waves-effect waves-light btn-danger m-b-5" onclick="$('#modalRegister<?php echo $value->id; ?>').modal('show');" data-toggle="tooltip" data-placement="bottom" title="Registrar">
                                                                            <i class="fa fa-edit"></i>
                                                                        </a>  
                                                                    <?php } ?>
                                                                    <a class="btn btn-icon waves-effect waves-light btn-warning m-b-5" onclick="$('#modalView<?php echo $value->id; ?>').modal('show');" data-toggle="tooltip" data-placement="bottom" title="Ver">
                                                                        <i class="fa fa-eye"></i>
                                                                    </a>  
                                                                </td>
                                                                <div id="modalRegister<?php echo $value->id; ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modalViewLabel" aria-hidden="true" style="display: none;">
                                                                    <div class="modal-dialog  modal-lg">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                                                <h4 class="modal-title" id="full-width-modalLabel">Registrar</h4>
                                                                            </div>
                                                                            <form method="POST" action="<?php echo Yii::app()->createUrl('profile/authLicense'); ?>" onsubmit="jQuery('.loader_div').show();$('#modalImage').modal('hide');">
                                                                                <div class="modal-body">
                                                                                    <div class="row">
                                                                                        <div class="col-md-12" align="center">
                                                                                            <h4><?php echo $value->name; ?></h4>
                                                                                            <h4>Item: <?php echo $value->item; ?></h4>
                                                                                        </div>
                                                                                        <div class="col-md-4">
                                                                                            <label class="control-label">Fecha Inicio</label>
                                                                                            <div class="input-group">
                                                                                                <input type="text" class="form-control" name="lic_fch_ini" id="lic_fch_ini<?php echo $value->id; ?>" onclick="validarLicenciaFecha('<?php echo $value->id; ?>')" value="<?php echo date('d/m/Y H:i',strtotime($value->date_start)); ?>" readonly required>
                                                                                            </div><!-- input-group -->
                                                                                        </div>
                                                                                        <div class="col-md-4">
                                                                                            <label class="control-label">Fecha Fin</label>
                                                                                            <div class="input-group">
                                                                                                <input type="text" class="form-control" name="lic_fch_fin" id="lic_fch_fin<?php echo $value->id; ?>" onclick="validarLicenciaFecha('<?php echo $value->id; ?>')" value="<?php echo date('d/m/Y H:i',strtotime($value->date_end)); ?>" readonly required>
                                                                                            </div><!-- input-group -->
                                                                                        </div>
                                                                                        <div class="col-md-4">
                                                                                            <label class="control-label">Fecha de Retorno</label>
                                                                                            <div class="input-group">
                                                                                                <input type="text" class="form-control" name="lic_fch_ret" id="lic_fch_ret<?php echo $value->id; ?>" onclick="validarLicenciaFecha('<?php echo $value->id; ?>')" value="<?php echo date('d/m/Y H:i',strtotime($value->date_return)); ?>" readonly required>
                                                                                            </div><!-- input-group -->
                                                                                        </div>
                                                                                        <div class="col-md-4">
                                                                                            <label class="control-label">D&iacute;as</label>
                                                                                            <div class="input-group">
                                                                                                <input type="text" class="form-control" name="lic_day" id="lic_day<?php echo $value->id; ?>" onchange="ValidarSolicitud('<?php echo $value->id; ?>');" onkeyup="ValidarSolicitud('<?php echo $value->id; ?>');" placeholder="0" value="<?php echo $value->days; ?>" onkeypress='validate(event)'>
                                                                                            </div><!-- input-group -->
                                                                                        </div>
                                                                                        <div class="col-md-4">
                                                                                            <label class="control-label">Horas</label>
                                                                                            <div class="input-group">
                                                                                                <input type="text" class="form-control" name="lic_hour" id="lic_hour<?php echo $value->id; ?>" onchange="ValidarSolicitud('<?php echo $value->id; ?>');" onkeyup="ValidarSolicitud('<?php echo $value->id; ?>');" placeholder="0" value="<?php echo $value->hours; ?>" onkeypress='validate(event)'>
                                                                                            </div><!-- input-group -->
                                                                                        </div>
                                                                                        <div class="col-md-4">
                                                                                            <label class="control-label">Minutos</label>
                                                                                            <div class="input-group">
                                                                                                <input type="text" class="form-control" name="lic_minutes" id="lic_minutes<?php echo $value->id; ?>" onchange="ValidarSolicitud('<?php echo $value->id; ?>');ValidarMinutos('<?php echo $value->id; ?>');" onkeyup="ValidarSolicitud('<?php echo $value->id; ?>');" placeholder="0" value="<?php echo $value->minutes; ?>" onkeypress='validate(event)'>
                                                                                            </div><!-- input-group -->
                                                                                        </div>
                                                                                        <div class="col-md-12">
                                                                                            <span id="message<?php echo $value->id; ?>"></span>
                                                                                        </div>
                                                                                        <div class="col-md-12">
                                                                                        <label class="control-label">Estado</label>
                                                                                            <div class="input-group">
                                                                                                <select class="form-control" name="auth_status" id="auth_status<?php echo $value->id; ?>" onchange="validarLicencia('<?php echo $value->id; ?>')" required>
                                                                                                    <option value="">--SELECCIONAR--</option>
                                                                                                    <option value="1">APROBADO</option>
                                                                                                    <option value="2">RECHAZADO</option>
                                                                                                </select>
                                                                                            </div><!-- input-group -->
                                                                                        </div>
                                                                                        <div class="col-md-12" style="display:none;" id="divObs<?php echo $value->id; ?>">
                                                                                            <label class="control-label">Observaci&oacute;n</label>
                                                                                            <div class="input-group">
                                                                                                <input type="text" maxlength="50" id="auth_obs<?php echo $value->id; ?>" name="auth_obs" onkeyup="this.value = this.value.toUpperCase();" class="form-control" required>
                                                                                            </div><!-- input-group -->
                                                                                        </div>
                                                                                        <input type="hidden" value="<?php echo $value->id; ?>" name="auth_id">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="modal-footer">
                                                                                    <button type="submit" id="btnRegister<?php echo $value->id; ?>" name="authInfo" class="btn btn-primary waves-effect waves-light">Guardar</button>
                                                                                    <button type="button" class="btn btn-secondary waves-effect waves-light" data-dismiss="modal" aria-hidden="true">Cerrar</button>
                                                                                </div>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div id="modalView<?php echo $value->id; ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modalViewLabel" aria-hidden="true" style="display: none;">
                                                                    <div class="modal-dialog  modal-lg">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                                                <h4 class="modal-title" id="full-width-modalLabel">Informaci&oacute;n</h4>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                <div class="row">
                                                                                
                                                                                    <div class="col-lg-12">
                                                                                        <h4>Vacaci&oacute;n Acumulada:</h4>
                                                                                        <?php if(!empty($vvv)){ ?>
                                                                                            <?php foreach($vvv as $vaca){ ?>
                                                                                                <h5>Desde: <?php echo $vaca['GI']; ?> - Hasta: <?php echo $vaca['GF']; ?>. Candidad de d&iacute;as Acumulados: <?php echo $vaca['SS']; ?></h5>
                                                                                            <?php } ?>
                                                                                        <?php }else{ ?>
                                                                                            <h5>No tiene saldo de d&iacute;as acumulados.</h5>
                                                                                        <?php } ?>
                                                                                        <hr>
                                                                                    </div>
                                                                                    <div class="col-lg-12">
                                                                                        Nombre: <?php echo $value->name; ?>
                                                                                    </div>
                                                                                    <div class="col-lg-12">
                                                                                        Item: <?php echo $value->item; ?>
                                                                                    </div>
                                                                                    <div class="col-lg-12">
                                                                                        Fecha Registro: <?php echo date('d/m/Y',strtotime($value->date)); ?>
                                                                                    </div>
                                                                                    <div class="col-lg-12">
                                                                                        Fecha Solicitud:
                                                                                    </div>
                                                                                    <div class="col-lg-4">
                                                                                        Desde: <?php echo date('d/m/Y',strtotime($value->date_start)); ?>
                                                                                    </div>
                                                                                    <div class="col-lg-4">
                                                                                        Hasta: <?php echo date('d/m/Y',strtotime($value->date_end)); ?>
                                                                                    </div>
                                                                                    <div class="col-lg-4">
                                                                                        Retorno: <?php echo date('d/m/Y',strtotime($value->date_return)); ?>
                                                                                    </div>
                                                                                    <div class="col-lg-12">
                                                                                        Solicitud: 
                                                                                    </div>
                                                                                    <div class="col-lg-4">
                                                                                        D&iacute;as: <?php echo $value->days; ?>
                                                                                    </div>
                                                                                    <div class="col-lg-4">
                                                                                        Horas: <?php echo $value->hours; ?>
                                                                                    </div>
                                                                                    <div class="col-lg-4">
                                                                                        Minutos: <?php echo $value->minutes; ?>
                                                                                    </div>
                                                                                    <div class="col-lg-12">
                                                                                        Observaci&oacute;n: <?php echo $value->observation_sol; ?>
                                                                                    </div>
                                                                                    <div class="col-lg-12">
                                                                                        Estado: 
                                                                                        <?php 
                                                                                        if($value->status_auth == 0){
                                                                                            echo 'PENDIENTE';
                                                                                        }elseif($value->status_auth == 1){
                                                                                            echo 'APROBADO';
                                                                                        }elseif($value->status_auth == 2){
                                                                                            echo 'RECHAZADO';
                                                                                        }
                                                                                        ?>
                                                                                    </div>

                                                                                    <?php if($value->status_auth == 1){ ?>
                                                                                    <div class="col-lg-12">
                                                                                        Fecha Autorizaci&oacute;n: 
                                                                                        <?php 
                                                                                        if($value->date_auth != null){
                                                                                            echo date('d/m/Y',strtotime($value->date_auth)); 
                                                                                        }else{
                                                                                            echo 'PENDIENTE'; 
                                                                                        }
                                                                                        ?>
                                                                                    </div>
                                                                                    <div class="col-lg-12">
                                                                                        Observaci&oacute;n Autorizaci&oacute;n: <?php echo $value->observation_auth; ?>
                                                                                    </div>
                                                                                    <?php } ?>
                                                                                </div>
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <button type="button" class="btn btn-primary waves-effect waves-light" data-dismiss="modal" aria-hidden="true">Cerrar</button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </tr>
                                                            <?php $count = $count + 1; ?>
                                                        <?php } ?>
                                                        <?php } ?>
                                                    </tbody>
                                                </table>
                                             
                                        </div>
                                    </div>
                                <?php }else{ ?>
                                    <h3>NO EXISTEN PROGRAMACIONES REGISTRADAS.</h3>
                                <?php } ?>
                            </div>   
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
function validate(evt) {
  var theEvent = evt || window.event;

  // Handle paste
  if (theEvent.type === 'paste') {
      key = event.clipboardData.getData('text/plain');
  } else {
  // Handle key press
      var key = theEvent.keyCode || theEvent.which;
      key = String.fromCharCode(key);
  }
  var regex = /^\d+$/;
  if( !regex.test(key) ) {
    theEvent.returnValue = false;
    if(theEvent.preventDefault) theEvent.preventDefault();
  }
}
</script>

<script src="<?php echo Yii::app()->theme->baseUrl;?>/assets/datetimepicker/jquery.js"></script>
<script src='<?php echo Yii::app()->theme->baseUrl;?>/assets/datetimepicker/build/jquery.datetimepicker.full.js'></script>
<script>

function validarLicenciaFecha(valor){
    'use strict';

    jQuery('#lic_fch_ini'+ valor + ', #lic_fch_fin'+ valor + ', #lic_fch_ret'+ valor + '').datetimepicker({
        ownerDocument: document,
        contentWindow: window,

        value: '',
        rtl: false,

        format: 'd/m/Y H:i',
        formatTime: 'H:i',
        formatDate: 'Y-m-d',
        step: 30,
        hours12:false,
        yearStart: '<?php echo date('Y');?>',
        yearEnd: 2060

    });
}

function validarLicencia(valor1){

    var x = document.getElementById("auth_status" + valor1).value;

    if(x == 1){
        document.getElementById("auth_obs" + valor1).value = "APROBADO";
        document.getElementById("divObs" + valor1).style.display = "block";
    }else{
        document.getElementById("auth_obs" + valor1).value = "";
        document.getElementById("divObs" + valor1).style.display = "block";
    }
}

function ValidarSolicitud(valor2){
    var dias = document.getElementById("lic_day" + valor2).value;


    if(dias > 120){
        document.getElementById("lic_hour" + valor2).value  = '';
        document.getElementById("lic_minutes" + valor2).value = '';
        document.getElementById("lic_hour" + valor2).readOnly = true;
        document.getElementById("lic_minutes" + valor2).readOnly = true;
        document.getElementById("btnRegister" + valor2).disabled = true;
        document.getElementById("message" + valor2).innerHTML = '<div class="alert alert-danger"><strong>Aviso: </strong> Solamente se puede sacar vacaci&oacute;n maximo por 120 d&iacute;as.</div>';
    }else{

        var horas = document.getElementById("lic_hour" + valor2).value;

        document.getElementById("btnRegister" + valor2).disabled = false;

        document.getElementById("message" + valor2).innerHTML = '';

        if(dias == 0 && horas == 0){
            document.getElementById("lic_minutes" + valor2).value = '';
            document.getElementById("lic_hour" + valor2).readOnly = false;
            document.getElementById("lic_minutes" + valor2).readOnly = true;
        }else if(dias > 0 && dias < 120){
            document.getElementById("lic_hour" + valor2).readOnly = false;
            document.getElementById("lic_minutes" + valor2).readOnly = false;

        }else{
            document.getElementById("lic_hour" + valor2).readOnly = false;
            document.getElementById("lic_minutes" + valor2).readOnly = false;

        }
    }
}

function ValidarMinutos(valor3){
    var minutos = document.getElementById("lic_minutes" + valor3).value;

    if(minutos == 0){
        document.getElementById("lic_minutes" + valor3).value = 0;
    }else if(minutos > 30){
        document.getElementById("lic_minutes" + valor3).value = 30;
    }else if(minutos < 30){
        document.getElementById("lic_minutes" + valor3).value = 0;
    }
}
</script>
        <script type="text/javascript">
            $(document).ready(function() {

                // Default Datatable
                $('#datatable').DataTable();

                //Buttons examples
                var table = $('#datatable-buttonspr').DataTable({
                    lengthMenu: [[5, 10, 25, 50, -1], [5, 10, 25, 50, 'Todos']],
                    lengthChange: true,
                    responsive: true,
                    buttons: [
                        { extend: 'copy', text: 'Copiar',exportOptions: {columns: ":visible"} }, 
                        { extend: 'excel', text: 'Excel',exportOptions: {columns: ":visible"} }, 
                        { extend: 'pdf', text: 'PDF',exportOptions: {columns: ":visible"} }
                    ],
                    order: [[ 0, "desc" ]],
                    columnDefs: [
                        {
                            "targets": [ 0 ],
                            "visible": false,
                            "searchable": false
                        }
                    ],                                
                    language: {
                        "sLengthMenu": "Mostrar _MENU_ Resultados",
                        "zeroRecords": "No se encontraron resultados",
                        "info": "_START_ al _END_ de _TOTAL_ registros",
                        "infoEmpty": "Mostrando registros del 0 - 0 de 0",
                        "infoFiltered": "(Filtrado de un total de _MAX_ registros)",
                        "sSearch": "Buscar:",
                        "oPaginate": {
                            "sFirst": "<button class='btn btn-info btn-circle btn-sm'><i class='fa fa-arrow-circle-left'></i></button>",
                            "sLast": "<button class='btn btn-info btn-circle btn-sm'><i class='fa fa-arrow-circle-right'></i></button>",
                            "sNext": "<button class='btn btn-info btn-circle btn-sm'><i class='fa fa-arrow-circle-right'></i></button>",
                            "sPrevious": "<button class='btn btn-info btn-circle btn-sm'><i class='fa fa-arrow-circle-left'></i></button>",
                        },
                        "sProcessing": "Procesando...",
                    }
                });

                var tableSecond = $('#datatable-buttonspr-second').DataTable({
                    lengthMenu: [[5, 10, 25, 50, -1], [5, 10, 25, 50, 'Todos']],
                    lengthChange: true,
                    responsive: true,
                    buttons: [
                        { extend: 'copy', text: 'Copiar',exportOptions: {columns: ":visible"} }, 
                        { extend: 'excel', text: 'Excel',exportOptions: {columns: ":visible"} }, 
                        { extend: 'pdf', text: 'PDF',exportOptions: {columns: ":visible"} }
                    ],
                    order: [[ 0, "desc" ]],
                    columnDefs: [
                        {
                            "targets": [ 0 ],
                            "visible": false,
                            "searchable": false
                        }
                    ],                                
                    language: {
                        "sLengthMenu": "Mostrar _MENU_ Resultados",
                        "zeroRecords": "No se encontraron resultados",
                        "info": "_START_ al _END_ de _TOTAL_ registros",
                        "infoEmpty": "Mostrando registros del 0 - 0 de 0",
                        "infoFiltered": "(Filtrado de un total de _MAX_ registros)",
                        "sSearch": "Buscar:",
                        "oPaginate": {
                            "sFirst": "<button class='btn btn-info btn-circle btn-sm'><i class='fa fa-arrow-circle-left'></i></button>",
                            "sLast": "<button class='btn btn-info btn-circle btn-sm'><i class='fa fa-arrow-circle-right'></i></button>",
                            "sNext": "<button class='btn btn-info btn-circle btn-sm'><i class='fa fa-arrow-circle-right'></i></button>",
                            "sPrevious": "<button class='btn btn-info btn-circle btn-sm'><i class='fa fa-arrow-circle-left'></i></button>",
                        },
                        "sProcessing": "Procesando...",
                    }
                });

                var tableTres = $('#datatable-buttonspr-thrid').DataTable({
                    lengthMenu: [[5, 10, 25, 50, -1], [5, 10, 25, 50, 'Todos']],
                    lengthChange: true,
                    responsive: true,
                    buttons: [
                        { extend: 'copy', text: 'Copiar',exportOptions: {columns: ":visible"} }, 
                        { extend: 'excel', text: 'Excel',exportOptions: {columns: ":visible"} }, 
                        { extend: 'pdf', text: 'PDF',exportOptions: {columns: ":visible"} }
                    ],
                    order: [[ 0, "desc" ]],
                    columnDefs: [
                        {
                            "targets": [ 0 ],
                            "visible": false,
                            "searchable": false
                        }
                    ],                                
                    language: {
                        "sLengthMenu": "Mostrar _MENU_ Resultados",
                        "zeroRecords": "No se encontraron resultados",
                        "info": "_START_ al _END_ de _TOTAL_ registros",
                        "infoEmpty": "Mostrando registros del 0 - 0 de 0",
                        "infoFiltered": "(Filtrado de un total de _MAX_ registros)",
                        "sSearch": "Buscar:",
                        "oPaginate": {
                            "sFirst": "<button class='btn btn-info btn-circle btn-sm'><i class='fa fa-arrow-circle-left'></i></button>",
                            "sLast": "<button class='btn btn-info btn-circle btn-sm'><i class='fa fa-arrow-circle-right'></i></button>",
                            "sNext": "<button class='btn btn-info btn-circle btn-sm'><i class='fa fa-arrow-circle-right'></i></button>",
                            "sPrevious": "<button class='btn btn-info btn-circle btn-sm'><i class='fa fa-arrow-circle-left'></i></button>",
                        },
                        "sProcessing": "Procesando...",
                    }
                });

                // Key Tables

                $('#key-table').DataTable({
                    keys: true
                });

                // Responsive Datatable
                $('#responsive-datatable').DataTable();

                // Multi Selection Datatable
                $('#selection-datatable').DataTable({
                    select: {
                        style: 'multi'
                    }
                });

                table.buttons().container().appendTo('#datatable-buttonspr_wrapper .col-md-6:eq(0)');

                tableSecond.buttons().container().appendTo('#datatable-buttonspr-second_wrapper .col-md-6:eq(0)');

                tableTres.buttons().container().appendTo('#datatable-buttonspr-thrid_wrapper .col-md-6:eq(0)');

            } );

        </script>