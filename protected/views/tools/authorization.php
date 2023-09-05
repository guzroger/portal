<div class="row">
    <div class="col-xl-12 col-xs-12">
        <div class="card-box">
            <?php if(!empty($license)){ ?>
            	<div class="table-responsive">
                    <table id="datatable-buttons" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Nombre</th>
                                <th>Item</th>
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

                            foreach ($license as $value) { ?>
                                <tr>
                                    <td><?php echo $value->date; ?></td>
                                    <td><?php echo $value->name; ?></td>
                                    <td><?php echo $value->item; ?></td>
                                    <td><?php echo date('d/m/Y',strtotime($value->date)); ?></td>
                                    <td>
                                        Desde: <?php echo date('d/m/Y',strtotime($value->date_start)); ?><br>
                                        Hasta: <?php echo date('d/m/Y',strtotime($value->date_end)); ?><br>
                                        Retorno: <?php echo date('d/m/Y',strtotime($value->date_return)); ?>
                                    </td>
                                    <td>
                                        D&iacute;as: <?php echo $value->days; ?><br>
                                        Horas: <?php echo $value->hours; ?><br>
                                        Minutos: <?php echo $value->minutes; ?>
                                    </td>
                                    <td>
                                        <?php 
                                        if($value->date_auth != null){
                                            echo date('d/m/Y',strtotime($value->date_auth)); 
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
                                                <form method="POST" action="<?php echo Yii::app()->createUrl('tools/authLicense'); ?>" onsubmit="jQuery('.loader_div').show();$('#modalImage').modal('hide');">
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col-md-12" align="center">
                                                                <h4><?php echo $value->name; ?></h4>
                                                                <h4>Item: <?php echo $value->item; ?></h4>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <label class="control-label">Observaci&oacute;n</label>
                                                                <div class="input-group">
                                                                    <textarea name="auth_obs" class="form-control" required></textarea>
                                                                </div><!-- input-group -->
                                                            </div>
                                                            <div class="col-md-12">
                                                            <label class="control-label">Estado</label>
                                                                <div class="input-group">
                                                                    <select class="form-control select2" name="auth_status" required>
                                                                        <option value="">--SELECCIONAR--</option>
                                                                        <option value="1">APROBADO</option>
                                                                        <option value="2">RECHAZADO</option>
                                                                    </select>
                                                                </div><!-- input-group -->
                                                            </div>
                                                            <input type="hidden" value="<?php echo $value->id; ?>" name="auth_id">
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" name="authInfo" class="btn btn-primary waves-effect waves-light">Guardar</button>
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
                        </tbody>
                    </table>
                </div>
            <?php }else{ ?>
                <h3>NO EXISTEN AUTORIZACIONES REGISTRADAS.</h3>
            <?php } ?>
        </div>
    </div>
</div>