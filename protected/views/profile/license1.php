<link href="<?php echo Yii::app()->theme->baseUrl;?>/assets/datetimepicker/jquery.datetimepicker.css" rel="stylesheet" type="text/css" />
<style type="text/css">
.error {
  position: relative;
  animation: shake .1s linear;
  animation-iteration-count: 3;
  border: 1px solid red;
  outline: none;
}
@keyframes shake {
  0% {
    left: -5px;
  }
  100% {
    right: -5px;
  }
}

</style>
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
                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modalLicense"><i class="fa fa-plane"></i> Solicitar Permiso</button>
                                                        
                                <hr>
                                <div id="modalLicense" class="modal fade" role="dialog" aria-labelledby="modalImageLabel" aria-hidden="true" style="display: none;">
                                    <div class="modal-dialog  modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                <h4 class="modal-title" id="full-width-modalLabel">Solicitar Permiso</h4>
                                                <?php /*
                                                <h3 style="color:red;">MODULO EN AMBIENTE DE PRUEBAS</h3>
                                                */ ?>
                                            </div>
                                            <form method="POST" id="formlicenses" action="<?php echo Yii::app()->createUrl('profile/registerLicense'); ?>" onsubmit="return validateForm();">
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <label class="control-label">Tipo de Permiso</label>
                                                            <div class="input-group">
                                                                <select class="form-control select2" name="lic_type" id="lic_type" onchange="selectLicense()" required>
                                                                    <option value="">--SELECCIONAR--</option>
                                                                    <optgroup label="PERMISOS">
                                                                        <option value="SOL_VACACION">VACACI&Oacute;N</option>
                                                                        <option value="LIC_CUMPLEANIOS">LICENCIA POR CUMPLEA&Ntilde;OS</option>
                                                                        <option value="LIC_MATRIMONIO">LICENCIA POR MATRIMONIO</option>                                                                
                                                                        <option value="LIC_DUELO">LICENCIA POR DUELO</option>
                                                                        <option value="LIC_NACIMIENTO_HIJO">LICENCIA POR NACIMIENTO HIJO(A)</option>
                                                                        <!--<option value="LIC_SIN_GOCE_HABER">LICENCIA SIN GOCE DE HABERES</option> -->
                                                                    </optgroup>
                                                                    <optgroup label="ESPECIALES">
                                                                        <option value="LIC_ESPECIAL1">DIA DE LA MUJER INTERNACIONAL</option>
                                                                        <option value="LIC_ESPECIAL2">DIA DE LA MADRE</option>
                                                                        <option value="LIC_ESPECIAL3">DIA DE LA MUJER NACIONAL</option>
                                                                        <option value="LIC_ESPECIAL4">DIA DEL PADRE</option>
                                                                        <option value="LIC_ESPECIAL5">DIA DEL HOMBRE</option>
                                                                    </optgroup>
                                                                    
                                                                   <!-- <optgroup label="PLANIFICACI&Oacute;N">
                                                                        <option value="PORTAL_TI_PROG">PROGRAMAR VACACI&Oacute;N</option>
                                                                    </optgroup>-->
                                                                </select>
                                                            </div><!-- input-group -->
                                                        </div>
                                                    </div>
                                                    <div class="row" id="seleccionar" style="display: none">
                                                    <br>
                                                        <div class="col-md-12">
                                                            <div id="iniciodias" style="display: none"> <!-- DIAS PRE DEFINIDOS -->
                                                                <div class="row">
                                                                    <div class="col-md-4">
                                                                        <label class="control-label">Fecha Inicio</label>
                                                                        <div class="input-group">
                                                                            <input type="text" class="form-control" id="lic_fch_ini_iniciodias" name="lic_fch" value="<?php echo date('d/m/Y 08:00');?>" onchange="calculardias(this.value,<?php echo $model['item']; ?>);" required>
                                                                        </div><!-- input-group -->
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <label class="control-label">Fecha Fin</label>
                                                                        <div class="input-group">
                                                                            <input type="text" class="form-control" id="lic_fch_fin_iniciodias"  name="lic_fch" value="" readonly="readonly" required>
                                                                        </div><!-- input-group -->
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <label class="control-label">Fecha de Retorno</label>
                                                                        <div class="input-group">
                                                                            <input type="text" class="form-control" id="lic_fch_ret_iniciodias" name="lic_fch" value="" readonly="readonly" required>
                                                                        </div><!-- input-group -->
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-4">
                                                                        <label class="control-label">D&iacute;as</label>
                                                                        <div class="input-group">
                                                                            <input type="text" maxlength="3" class="form-control" id="lic_day_iniciodias" name="lic_d" placeholder="0" >
                                                                        </div><!-- input-group -->
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <label class="control-label">Horas</label>
                                                                        <div class="input-group">
                                                                            <input type="text" maxlength="2" class="form-control" id="lic_hour_iniciodias" name="lic_h" placeholder="0" >
                                                                        </div><!-- input-group -->
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <label class="control-label">Minutos</label>
                                                                        <div class="input-group">
                                                                            <input type="text" maxlength="2" class="form-control" id="lic_minutes_iniciodias" name="lic_m" placeholder="0" readonly="readonly">
                                                                        </div><!-- input-group -->
                                                                        <span style="font-size:9pt;">Se acepta solo 0 &oacute; 30 minutos</span>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <b style="font-size: 10pt; color:red;">Nota: Solamente debe de ingresar la casilla Fecha de Inicio.</b>
                                                                </div>
                                                            </div>   <!-- DIAS PRE DEFINIDOS -->

                                                            <div id="vacaciones" style="display: none">  <!-- seleccionar DIAS / HORAS   -->
                                                                <div class="col-md-12">
                                                                    <label class="control-label">Permiso Dias / Horas</label>
                                                                    <div class="input-group">
                                                                        <select class="form-control select2" id="selectvacaciones" name="selectvacaciones" onchange="selectdh(this.value)" >
                                                                            <option value="">--SELECCIONAR--</option>
                                                                            <option value="DIAS">PERMISO POR D&Iacute;AS</option>
                                                                            <option value="HORAS">PERMISO POR HORAS</option>
                                                                        </select>
                                                                    </div><!-- input-group -->
                                                                </div>
                                                                <div id="vacacionesdias" style="display: none"> <!-- DIAS VACACION -->
                                                                    <div class="row">
                                                                        <div class="col-md-4">
                                                                            <label class="control-label">Fecha Inicio</label>
                                                                            <div class="input-group">
                                                                                <input type="text" class="form-control" id="lic_fch_ini_vacacionesdias" name="lic_fch" value="<?php echo date('d/m/Y 08:00');?>" onchange="resetform()" required>
                                                                            </div><!-- input-group -->
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <label class="control-label">Fecha Fin</label>
                                                                            <div class="input-group">
                                                                                <input type="text" class="form-control" id="lic_fch_fin_vacacionesdias"  name="lic_fch" value="<?php echo date('d/m/Y 18:00');?>" readonly="readonly" required>
                                                                            </div><!-- input-group -->
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <label class="control-label">Fecha de Retorno</label>
                                                                            <div class="input-group">
                                                                                <input type="text" class="form-control" id="lic_fch_ret_vacacionesdias" name="lic_fch" value="<?php echo date('d/m/Y 08:00', strtotime(date('Y-m-d 08:00'). ' +1 day'));?>" readonly="readonly" required>
                                                                            </div><!-- input-group -->
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-md-4">
                                                                            <label class="control-label">D&iacute;as</label>
                                                                            <div class="input-group">
                                                                                <input type="text" maxlength="3" class="form-control" id="lic_day_vacacionesdias" name="lic_d" placeholder="0" onkeyup="calculardiasvacacion(this.value,<?php echo $model['item']; ?>);" onchange="ValidarSolicitud();" onkeyup="ValidarSolicitud();" onkeypress='validate(event);'>
                                                                            </div><!-- input-group -->
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <label class="control-label">Horas</label>
                                                                            <div class="input-group">
                                                                                <input type="text" maxlength="2" class="form-control" id="lic_hour_vacacionesdias" name="lic_h" placeholder="0" value="0" readonly="readonly">
                                                                            </div><!-- input-group -->
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <label class="control-label">Minutos</label>
                                                                            <div class="input-group">
                                                                                <input type="text" maxlength="2" class="form-control" id="lic_minutes_vacacionesdias" name="lic_m" placeholder="0" value="0" readonly="readonly">
                                                                            </div><!-- input-group -->
                                                                            <span style="font-size:9pt;">Se acepta solo 0 &oacute; 30 minutos</span>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-12">
                                                                        <b style="font-size: 10pt; color:red;">Nota: Solamente debe de ingresar la casilla Fecha de Inicio.</b>
                                                                    </div>
                                                                </div>
                                                                <div id="vacacioneshoras" style="display: none"> <!-- HORAS - MINUTOS VACACION -->
                                                                    <div class="row">
                                                                        <div class="col-md-4">
                                                                            <label class="control-label">Fecha Inicio</label>
                                                                            <div class="input-group">
                                                                                <input type="text" class="form-control" id="lic_fch_ini_vacacioneshoras" name="lic_fch" value="<?php echo date('d/m/Y 08:00');?>" onchange="resetform()" required>
                                                                            </div><!-- input-group -->
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <label class="control-label">Fecha Fin</label>
                                                                            <div class="input-group">
                                                                                <input type="text" class="form-control" id="lic_fch_fin_vacacioneshoras"  name="lic_fch" value="<?php echo date('d/m/Y 18:00');?>" readonly="readonly" required>
                                                                            </div><!-- input-group -->
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <label class="control-label">Fecha de Retorno</label>
                                                                            <div class="input-group">
                                                                                <input type="text" class="form-control" id="lic_fch_ret_vacacioneshoras" name="lic_fch" value="<?php echo date('d/m/Y 08:00', strtotime(date('Y-m-d 08:00'). ' +1 day'));?>" readonly="readonly" required>
                                                                            </div><!-- input-group -->
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-md-4">
                                                                            <label class="control-label">D&iacute;as</label>
                                                                            <div class="input-group">
                                                                                <input type="text" maxlength="3" class="form-control" id="lic_day_vacacioneshoras" name="lic_d" placeholder="0" readonly="readonly">
                                                                            </div><!-- input-group -->
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <label class="control-label">Horas</label>
                                                                            <div class="input-group">
                                                                                <input type="text" maxlength="2" class="form-control" id="lic_hour_vacacioneshoras" name="lic_h" placeholder="0" onchange="ValidarSolicitud();" onkeyup="sumahoras(this.value);" onkeypress='validate(event)'>
                                                                            </div><!-- input-group -->
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <label class="control-label">Minutos</label>
                                                                            <div class="input-group">
                                                                                <input type="text" maxlength="2" class="form-control" id="lic_minutes_vacacioneshoras" name="lic_m" placeholder="0" onchange="ValidarSolicitud();ValidarMinutos();" onkeyup="ValidarSolicitud();" onkeypress='validate(event)' readonly="readonly">
                                                                            </div><!-- input-group -->
                                                                            <span style="font-size:9pt;">Se acepta solo 0 &oacute; 30 minutos</span>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-12">
                                                                        <b style="font-size: 10pt; color:red;">Nota: Seleccione la Fecha de Inicio, a continuaci&oacute;n rellene las casillas Horas y Minutos que va solicitar permiso.</b>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>

                                                        <div class="col-md-12">
                                                            <span id="message"></span>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <label class="control-label">Observaci&oacute;n</label>
                                                            <div class="input-group">
                                                                <input type="text" name="lic_obs" maxlength="250" id="lic_obs" class="form-control" onkeyup="this.value = this.value.toUpperCase();" required>
                                                            </div><!-- input-group -->
                                                        </div>
                                                        <div class="col-md-12">
                                                            <label class="control-label">Jefe Inmediato</label>
                                                            <div class="input-group">
                                                                <select class="form-control select2" name="lic_auth" required>
                                                                    <option value="">--SELECCIONAR--</option>
                                                                    <?php foreach($supervisor as $sup){ ?>
                                                                        <option value="<?php echo $sup->id; ?>"><?php echo $sup->name; ?></option>
                                                                    <?php } ?>
                                                                </select>
                                                            </div><!-- input-group -->
                                                            <input type="hidden" value="<?php echo $model['id']; ?>" name="lic_emp">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" id="btnRegister" name="regInfo" class="btn btn-primary waves-effect waves-light">Guardar</button>
                                                    <button type="button" class="btn btn-secondary waves-effect waves-light" data-dismiss="modal" aria-hidden="true">Cerrar</button>
                                                </div>
                                            </form>
                                        </div><!-- /.modal-content -->
                                    </div><!-- /.modal-dialog -->
                                </div><!-- /.modal -->
                            </div>   
                            <div class="col-md-12">
                                <h4>Mis Vacaciones</h4>
                            </div>   
                            <div class="col-md-12">                         
                                <?php if(!empty($vacations['vacations'])){ ?>
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Gesti&oacute;n</th>
                                                <th>D&iacute;as Vacaci&oacute;n</th>
                                                <th>D&iacute;as a Cuenta</th>
                                                <th>Saldo D&iacute;as</th>
                                                <th>Saldo Acumulado</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php foreach ($vacations['vacations'] as $vacation) { ?>
                                        <tr>
                                            <td><?php echo $vacation['GESTION']; ?></td>
                                            <td><?php echo $vacation['DIASVACACION']; ?></td>
                                            <td><?php echo $vacation['DIASCUENTA']; ?></td>
                                            <td><?php echo $vacation['SALDODIAS']; ?></td>
                                            <td><?php echo $vacation['SALDOTOTAL']; ?></td>
                                        </tr>
                                        <?php } ?>
                                            
                                        </tbody>
                                    </table>
                                </div>
                                <?php }else{ ?>
                                    <h4 align="center">NO TIENE D&Iacute;AS DE VACACIONES DISPONIBLES</h4>
                                <?php } ?>
                            </div>
                            <div class="col-md-12">
                                <hr>
                                <h4>Mis Solicitudes</h4>
                            </div> 
                            <div class="col-md-12">
                            <form action="<?php echo $this->createUrl('license'); ?>" method="POST">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <label class="control-label">Fecha Inicio</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="fchini" value="<?php echo date('d/m/Y',strtotime($fchini)); ?>" placeholder="dd/mm/yyyy" id="datepicker-autoclose-ini" readonly="">
                                            <div class="input-group-append">
                                                <span class="input-group-text"><i class="ion-calendar"></i></span>
                                            </div>
                                        </div><!-- input-group -->
                                    </div>
                                    <div class="col-sm-6">
                                        <label class="control-label">Fecha Fin</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="fchfin" value="<?php echo date('d/m/Y',strtotime($fchfin)); ?>" placeholder="dd/mm/yyyy" id="datepicker-autoclose-fin" readonly="">
                                            <div class="input-group-append">
                                                <span class="input-group-text"><i class="ion-calendar"></i></span>
                                            </div>
                                        </div><!-- input-group -->
                                    </div>
                                    <div class="col-sm-12">
                                        <br>
                                        <button type="submit" class="btn btn-block btn-danger">Buscar</button>
                                        <br>
                                    </div>
                                </div>                                      
                            </form>     
                            </div>  
                            <div class="col-md-12">                         
                                <?php if(!empty($licenses['licenses'])){ ?>
                                    <div class="table-responsive">
                                        <table id="datatable-buttons" class="table table-striped table-bordered" style="font-size: 12px;" cellspacing="0" width="100%">
                                            <thead>
                                                <th></th>
                                                <th>Tipo Solicitud</th>
                                                <th>Fecha Solicitud</th>
                                                <th>Fecha Retorno Solicitud</th>
                                                <th>Solicitud</th>
                                                <th>Fechas Autorizadas</th>
                                                <th>Fecha Retorno Autorizado</th>
                                                <th>Autorizado</th>
                                                <th>Observaciones</th>
                                                <th>Estado</th>
                                            </thead>
                                            <tbody>
                                                <?php foreach($licenses['licenses'] as $license) { ?> 
                                                <tr>
                                                    <td><?php echo $license['OUT_FCH_DESDE_SOL']; ?></td>
                                                    <td><?php echo str_replace('_', ' ', $license['OUT_TIPO_SOL']); ?></td>
                                                    <td>
                                                    Desde: <?php echo date('d/m/Y H:i',strtotime($license['OUT_FCH_DESDE_SOL']));?><br>
                                                    Hasta: <?php echo date('d/m/Y H:i',strtotime($license['OUT_FCH_HASTA_SOL']));?>
                                                    </td>
                                                    <td>
                                                    <?php echo date('d/m/Y H:i',strtotime($license['OUT_FCH_RETORNO_SOL']));?>
                                                    </td>
                                                    <td>
                                                    D&iacute;a(s): <?php echo $license['OUT_DIAS_SOL']; ?><br>
                                                    Hora(s): <?php echo $license['OUT_HORAS_SOL']; ?><br>
                                                    Min.: <?php echo $license['OUT_MINUTOS_SOL']; ?>
                                                    </td>
                                                    <td>
                                                    Desde: <?php echo date('d/m/Y H:i',strtotime($license['OUT_FCH_DESDE_AUT']));?><br>
                                                    Hasta: <?php echo date('d/m/Y H:i',strtotime($license['OUT_FCH_HASTA_AUT']));?>
                                                    </td>
                                                    <td>
                                                    <?php echo date('d/m/Y H:i',strtotime($license['OUT_FCH_RETORNO_AUTORIZ']));?>
                                                    </td>
                                                    <td>
                                                    D&iacute;a(s): <?php echo $license['OUT_DIAS_AUT']; ?><br>
                                                    Hora(s): <?php echo $license['OUT_HORAS_AUT']; ?><br>
                                                    Min.: <?php echo $license['OUT_MINUTOS_AUT']; ?>
                                                    </td>
                                                    <td><?php echo $license['OUT_OBSERVACION']; ?></td>
                                                    <td><?php echo $license['OUT_ESTADO']; ?></td>
                                                </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                <?php }else{ ?>
                                    <h4 align="center">NO EXISTEN PERMISOS SOLICITADAS, SELECCIONE OTRAS FECHAS DE INICIO Y FIN.</h4>
                                <?php } ?>
                            </div>
                            <div class="col-md-12">
                                <hr>
                                <h4>Mis Solicitudes Pendientes</h4>
                            </div> 
                            <div class="col-md-12">                         
                                <?php if(!empty($pending['pending'])){ ?>
                                    
                                        <table id="datatable-buttons-second" class="table table-striped table-bordered" style="font-size: 12px;" cellspacing="0" width="100%">
                                            <thead>
                                                <th></th>
                                                <th>Fecha Registrado</th>
                                                <th>Fecha Solicitud</th>
                                                <th>Tipo Solicitud</th>
                                                <th>D&iacute;a(s)</th>
                                                <th>Hora(s)</th>
                                                <th>Min.</th>
                                                <th>Observaciones</th>
                                                <th>Informaci&oacute;n</th>
                                            </thead>
                                            <tbody>
                                                <?php foreach($pending['pending'] as $pendiente) { ?> 
                                                <tr>
                                                    <td><?php echo date('Y-m-d',strtotime($pendiente['FCH_INICIO_REGSOL'])); ?></td>
                                                    <td><?php echo date('d/m/Y',strtotime($pendiente['FCH_INICIO_REGSOL']));?></td>
                                                    <td>
                                                        Desde: <?php echo $pendiente['FECHA_INI'].' '.$pendiente['HORAS_INI'];?><br>
                                                        Hasta: <?php echo $pendiente['FECHA_FIN'].' '.$pendiente['HORAS_FIN'];?><br>
                                                        Retorno: <?php echo $pendiente['FECHA_RET'].' '.$pendiente['HORAS_RET'];?>
                                                    </td>
                                                    <td><?php echo $pendiente['TRAMITE']; ?></td>
                                                    <td><?php echo $pendiente['DIAS']; ?></td>
                                                    <td><?php echo $pendiente['HORAS']; ?></td>
                                                    <td><?php echo $pendiente['MINUTOS']; ?></td>
                                                    <td><?php echo $pendiente['OBSERVACIONES']; ?></td>
                                                    <td>    
                                                        Fecha: <?php echo date('d/m/Y',strtotime($pendiente['FCH_ASIGN_TAREA']));?>
                                                        <br>
                                                        Ubicaci&oacute;n: <?php echo $pendiente['TRAMITE_CON'];?>
                                                        <br>
                                                        Responsable: <?php echo $pendiente['REPONSABLE_TAREA'];?>
                                                    </td>
                                                </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    
                                <?php }
				                if(!empty($pendingIntra)){ ?>
                                        <table id="datatable-buttons-second" class="table table-striped table-bordered" style="font-size: 12px;" cellspacing="0" width="100%">
                                            <thead>
                                                <tr>
                                                    <th></th>
                                                    <th>Jefe Inmediato</th>
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

                                                foreach ($pendingIntra as $value) { 

                                                    $boss = Supervisor::model()->findByPk($value->supervisor_id);

                                                    ?>
                                                    <tr>
                                                        <td><?php echo $value->date; ?></td>
                                                        <td><?php echo $boss->name; ?></td>
                                                        <td><?php 
                                                        if($value->type == 'PORTAL_TI_PROG'){
                                                            echo 'PROGRAMACION DE VACACION';
                                                        }else{
                                                            echo $value->type;
                                                        }
                                                        ?></td>
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
                                                            <a class="btn btn-icon waves-effect waves-light btn-warning m-b-5" onclick="$('#modalView<?php echo $value->id; ?>').modal('show');" data-toggle="tooltip" data-placement="bottom" title="Ver">
                                                                <i class="fa fa-eye"></i>
                                                            </a>  
                                                        </td>
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
                                                                                Desde: <?php echo date('d/m/Y H:i',strtotime($value->date_start)); ?>
                                                                            </div>
                                                                            <div class="col-lg-4">
                                                                                Hasta: <?php echo date('d/m/Y H:i',strtotime($value->date_end)); ?>
                                                                            </div>
                                                                            <div class="col-lg-4">
                                                                                Retorno: <?php echo date('d/m/Y H:i',strtotime($value->date_return)); ?>
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
                                <?php }else{ ?>
                                    <h4 align="center">NO EXISTEN PERMISOS PENDIENTES DE APROBACI&Oacute;N.</h4>
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
    // Handle key press
    } else {
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

jQuery(document).ready(function () {
    'use strict';

    jQuery('#lic_fch_ini_iniciodias,#lic_fch_ini_vacacionesdias,#lic_fch_ini_vacacioneshoras').datetimepicker({
        ownerDocument: document,
        contentWindow: window,

        value: '',
        rtl: false,

        format: 'd/m/Y H:i',
        formatTime: 'H:i',
        formatDate: 'Y-m-d',
        step: 30,
        hours12:false,
        yearStart: '<?php echo date("Y");?>',
        yearEnd: 2060

    });
});

function validateForm(){

    var hor = document.getElementsByName("lic_hour")[0].value;

    var day = document.getElementsByName("lic_day")[0].value;

    if(hor.length == 0 && day.length == 0 ){

        document.getElementById("message").innerHTML = '<div class="alert alert-danger"><strong>Aviso: </strong> Indique la cantidad de d&iacute;as u horas.</div>';

        return false;

    }else if(hor == 0 && day == 0){

        document.getElementById("message").innerHTML = '<div class="alert alert-danger"><strong>Aviso: </strong> Indique la cantidad de d&iacute;as u horas.</div>';

        return false;

    }else if(hor.length != 0 || day.length != 0 ){

        var inicio = document.getElementsByName("lic_fch_ini")[0].value;

        var fin = document.getElementsByName("lic_fch_fin")[0].value;

        var inicioDia = inicio.split(" ")[0];

        var finDia = fin.split(" ")[0];

        var tratamientoIni = inicioDia.split("/")[2] + '-' + inicioDia.split("/")[1] + '-' + inicioDia.split("/")[0];

        var tratamientoFin = finDia.split("/")[2] + '-' + finDia.split("/")[1] + '-' + finDia.split("/")[0];

        var inicioHoras = inicio.split(" ")[1];

        var finHoras = fin.split(" ")[1];

        var date1 = new Date(tratamientoIni + 'T' + inicioHoras + ':00Z' );

        var date2 = new Date(tratamientoFin + 'T' + finHoras + ':00Z');

        if(date2 >= date1){

            if(day.length != 0 ){            


                //var diffDays = date2.getDate() - date1.getDate() + 1; 

                var fechaInicio = new Date(tratamientoIni).getTime();
                
                var fechaFin    = new Date(tratamientoFin).getTime();

                var diff = fechaFin - fechaInicio;

                var diffDays = diff/(1000*60*60*24) + 1;


                console.log(diffDays);
                if(day <= diffDays){
                    jQuery('.loader_div').show();
                    $('#modalLicense').modal('hide');
                    document.getElementById("message").innerHTML = '';
                    return true;
                }else{
                    document.getElementById("message").innerHTML = '<div class="alert alert-danger"><strong>Aviso: </strong> Fechas Inicio y Fin mal definidas, por favor corrija las fechas o la cantidad de d&iacute;as.</div>';
                    return false;
                }
            }else{
                jQuery('.loader_div').show();
                $('#modalLicense').modal('hide');
                document.getElementById("message").innerHTML = '';
                return true;                
            }
            /*
            if(hor.length != 0 ){

                var diffHours = date2.getHours() - date1.getHours(); 
                console.log(diffHours);
                if(hor == diffHours){
                    jQuery('.loader_div').show();
                    $('#modalLicense').modal('hide');
                    document.getElementById("message").innerHTML = '';
                    return true;

                }else{
                    document.getElementById("message").innerHTML = '<div class="alert alert-danger"><strong>Aviso: </strong> Fechas Inicio y Fin mal definidas, por favor corrija las fechas o la cantidad de horas.</div>';
                    return false;

                }

            }else if(day.length != 0 ){            

                var diffDays = date2.getDate() - date1.getDate() + 1; 

                console.log(diffDays);

                if(day <= diffDays){
                    jQuery('.loader_div').show();
                    $('#modalLicense').modal('hide');
                    document.getElementById("message").innerHTML = '';
                    return true;
                }else{
                    document.getElementById("message").innerHTML = '<div class="alert alert-danger"><strong>Aviso: </strong> Fechas Inicio y Fin mal definidas, por favor corrija las fechas o la cantidad de d&iacute;as.</div>';
                    return false;
                }
            }
            */
        }else{
            document.getElementById("message").innerHTML = '<div class="alert alert-danger"><strong>Aviso: </strong> La fecha fin no puede ser menor a la fecha de inicio.</div>';
            return false;
        }
    }
    /*else{
        jQuery('.loader_div').show();
        $('#modalLicense').modal('hide');
        return true;
    }*/
}

function ValidarSolicitud(){
    var dias = document.getElementsByName("lic_day")[0].value;
    var horas = document.getElementsByName("lic_hour")[0].value;
    var minutos = document.getElementsByName("lic_minutes")[0].value;

    if(dias > 120){
        document.getElementById("btnRegister").disabled = true;
        document.getElementById("message").innerHTML = '<div class="alert alert-danger"><strong>Aviso: </strong> Solamente se puede sacar vacaci&oacute;n maximo por 120 d&iacute;as.</div>';

    }else if(horas > 8){
        document.getElementById("btnRegister").disabled = true;
        document.getElementById("message").innerHTML = '<div class="alert alert-danger"><strong>Aviso: </strong> Solamente se puede sacar permiso maximo por 8 horas en un dia.</div>';

    }else if(dias == 0 && horas > 0){
        document.getElementById("lic_minutes_vacacioneshoras").readOnly = false;
        document.getElementById("btnRegister").disabled = false;
        document.getElementById("message").innerHTML = '';

    }else if(dias < 120){
        document.getElementById("btnRegister").disabled = false;
        document.getElementById("message").innerHTML = '';

    }else {
        document.getElementById("btnRegister").disabled = false;
        document.getElementById("message").innerHTML = '';
    }

}


/*function ValidarSolicitud(){
    var dias = document.getElementById("lic_day").value;


    if(dias > 120){
        document.getElementById("lic_hour").value  = '';
        document.getElementById("lic_minutes").value = '';
        document.getElementById("lic_hour").readOnly = true;
        document.getElementById("lic_minutes").readOnly = true;
        document.getElementById("btnRegister").disabled = true;
        document.getElementById("message").innerHTML = '<div class="alert alert-danger"><strong>Aviso: </strong> Solamente se puede sacar vacaci&oacute;n maximo por 120 d&iacute;as.</div>';
    }else{

        var horas = document.getElementById("lic_hour").value;

        document.getElementById("btnRegister").disabled = false;

        document.getElementById("message").innerHTML = '';

        if(dias == 0 && horas == 0){
            document.getElementById("lic_minutes").value = '';
            document.getElementById("lic_hour").readOnly = false;
            document.getElementById("lic_minutes").readOnly = true;
        }else if(dias > 0 && dias < 120){
            document.getElementById("lic_hour").readOnly = false;
            document.getElementById("lic_minutes").readOnly = false;

        }else{
            document.getElementById("lic_hour").readOnly = false;
            document.getElementById("lic_minutes").readOnly = false;

        }
    }


}*/

function ValidarMinutos(){
    var minutos = document.getElementById("lic_minutes_vacacioneshoras").value;


    if(minutos == 0){
        document.getElementById("lic_minutes_vacacioneshoras").value = 0;


    }else if(minutos > 30){
        document.getElementById("lic_minutes_vacacioneshoras").value = 30;
    }else if(minutos < 30){
        document.getElementById("lic_minutes_vacacioneshoras").value = 0;
    }

    ////////////////
    var fecha_ini_ant = document.getElementById("lic_fch_ini_vacacioneshoras").value;
    var hora_ant = document.getElementById("lic_hour_vacacioneshoras").value;
    var minuto = parseInt(document.getElementById("lic_minutes_vacacioneshoras").value);

    var datePieces_ant = fecha_ini_ant.split(" ");
    var tiempo_ant = datePieces_ant[1].split(":");
    var horas_ant = tiempo_ant[0];
    var minutos_ant = tiempo_ant[1];

    var totalhoras_ant = parseInt(horas_ant)+parseInt(hora_ant);
    var minutos_mod = parseInt(minutos_ant);

    if(minuto > 1){
        if(minutos_mod == 0){
           //debe terminar en 30
           if(totalhoras_ant < 10){
                // con cero en horas
                var fecha_hora = datePieces_ant[0]+' 0'+totalhoras_ant+':30';
           }else{
                // sin cero en horas
                var fecha_hora = datePieces_ant[0]+' '+totalhoras_ant+':30';
           }

        }else{
           //debe de sumar a la siguiente hora
           var neo_horas = parseInt(totalhoras_ant)+1;
           if(neo_horas < 10){
                // con cero en horas
                var fecha_hora = datePieces_ant[0]+' 0'+neo_horas+':00';
           }else{
                // sin cero en horas
                var fecha_hora = datePieces_ant[0]+' '+neo_horas+':00';
           }
        }

    }else{
        //debe de calcular la fecha inicio mas la hora sin cambiar minutos

        if(totalhoras_ant < 10){
           // con cero en horas
           var fecha_hora = datePieces_ant[0]+' 0'+totalhoras_ant+':'+minutos_ant;

        }else{
           //sin cero en horas
           var fecha_hora = datePieces_ant[0]+' '+totalhoras_ant+':'+minutos_ant;

        }

    }

    document.getElementById("lic_fch_fin_vacacioneshoras").value = fecha_hora;
    document.getElementById("lic_fch_ret_vacacioneshoras").value = fecha_hora;

    ////////////////
}

function todayDate(value){

    var dateParts = value.split('/');

    var dateAnio = dateParts[2].split(' ');

    value =  dateAnio[0] + '-' + dateParts[1] + '-' + dateParts[0];

    var date = new Date(value);

    date.setDate(date.getDate());

    var x = date.toISOString().slice(0,10);

    var edit = x.split('-');

    fchFin =  edit[2] + '/' + edit[1] + '/' + edit[0] + " 18:00";

    console.log(fchFin);

    document.getElementById("lic_fch_fin").value = fchFin; 

    nextDate(fchFin);

}

function nextDate(value){

    var dateParts = value.split('/');

    var dateAnio = dateParts[2].split(' ');

    value =  dateAnio[0] + '-' + dateParts[1] + '-' + dateParts[0];

    var date = new Date(value);

    date.setDate(date.getDate() + 1);

    var x = date.toISOString().slice(0,10);

    var edit = x.split('-');

    fchFin =  edit[2] + '/' + edit[1] + '/' + edit[0] + " 08:00";

    console.log(fchFin);

    document.getElementById("lic_fch_ret").value = fchFin; 

}

function resetform(){

    document.getElementById("lic_day_vacacionesdias").value = 0;
    document.getElementById("lic_hour_vacacioneshoras").value = 0;
    document.getElementById("lic_minutes_vacacioneshoras").value = 0;

}

function selectLicense(){
    d = document.getElementById("lic_type").value;

    if(d == 'LIC_CUMPLEANIOS'){
        ///// HELL ////
        document.getElementById("seleccionar").style.display = 'block';
        document.getElementById("iniciodias").style.display = 'block';
        document.getElementById("vacaciones").style.display = 'none';

        document.getElementById("lic_day_iniciodias").value = 1;
        document.getElementById("lic_day_iniciodias").readOnly = true;
        document.getElementById("lic_hour_iniciodias").readOnly = true;
        document.getElementById("lic_minutes_iniciodias").readOnly = true;
        document.getElementById("lic_hour_iniciodias").value = 0;
        document.getElementById("lic_minutes_iniciodias").value = 0;

        document.getElementById('lic_fch_ini_iniciodias').setAttribute('name', 'lic_fch_ini');
        document.getElementById('lic_fch_fin_iniciodias').setAttribute('name', 'lic_fch_fin');
        document.getElementById('lic_fch_ret_iniciodias').setAttribute('name', 'lic_fch_ret');
        document.getElementById('lic_day_iniciodias').setAttribute('name', 'lic_day');
        document.getElementById('lic_hour_iniciodias').setAttribute('name', 'lic_hour');
        document.getElementById('lic_minutes_iniciodias').setAttribute('name', 'lic_minutes');

        document.getElementById('lic_fch_ini_vacacionesdias').setAttribute('name', 'lic_fch');
        document.getElementById('lic_fch_fin_vacacionesdias').setAttribute('name', 'lic_fch');
        document.getElementById('lic_fch_ret_vacacionesdias').setAttribute('name', 'lic_fch');
        document.getElementById('lic_day_vacacionesdias').setAttribute('name', 'lic_d');
        document.getElementById('lic_hour_vacacionesdias').setAttribute('name', 'lic_h');
        document.getElementById('lic_minutes_vacacionesdias').setAttribute('name', 'lic_m');
        document.getElementById('lic_fch_ini_vacacioneshoras').setAttribute('name', 'lic_fch');
        document.getElementById('lic_fch_fin_vacacioneshoras').setAttribute('name', 'lic_fch');
        document.getElementById('lic_fch_ret_vacacioneshoras').setAttribute('name', 'lic_fch');
        document.getElementById('lic_day_vacacioneshoras').setAttribute('name', 'lic_d');
        document.getElementById('lic_hour_vacacioneshoras').setAttribute('name', 'lic_h');
        document.getElementById('lic_minutes_vacacioneshoras').setAttribute('name', 'lic_m');


        document.getElementById("lic_obs").value = 'LICENCIA POR CUMPLEAÑOS';
        document.getElementById("lic_obs").readOnly = true;
    }else if(d == 'LIC_MATRIMONIO'){
        ///// HELL ////
        document.getElementById("seleccionar").style.display = 'block';
        document.getElementById("iniciodias").style.display = 'block';
        document.getElementById("vacaciones").style.display = 'none';

        document.getElementById("lic_day_iniciodias").value = 10;
        document.getElementById("lic_day_iniciodias").readOnly = true;
        document.getElementById("lic_hour_iniciodias").readOnly = true;
        document.getElementById("lic_hour_iniciodias").value = 0;
        document.getElementById("lic_minutes_iniciodias").value = 0;
        document.getElementById("lic_minutes_iniciodias").readOnly = true;

        document.getElementById('lic_fch_ini_iniciodias').setAttribute('name', 'lic_fch_ini');
        document.getElementById('lic_fch_fin_iniciodias').setAttribute('name', 'lic_fch_fin');
        document.getElementById('lic_fch_ret_iniciodias').setAttribute('name', 'lic_fch_ret');
        document.getElementById('lic_day_iniciodias').setAttribute('name', 'lic_day');
        document.getElementById('lic_hour_iniciodias').setAttribute('name', 'lic_hour');
        document.getElementById('lic_minutes_iniciodias').setAttribute('name', 'lic_minutes');

        document.getElementById('lic_fch_ini_vacacionesdias').setAttribute('name', 'lic_fch');
        document.getElementById('lic_fch_fin_vacacionesdias').setAttribute('name', 'lic_fch');
        document.getElementById('lic_fch_ret_vacacionesdias').setAttribute('name', 'lic_fch');
        document.getElementById('lic_day_vacacionesdias').setAttribute('name', 'lic_d');
        document.getElementById('lic_hour_vacacionesdias').setAttribute('name', 'lic_h');
        document.getElementById('lic_minutes_vacacionesdias').setAttribute('name', 'lic_m');
        document.getElementById('lic_fch_ini_vacacioneshoras').setAttribute('name', 'lic_fch');
        document.getElementById('lic_fch_fin_vacacioneshoras').setAttribute('name', 'lic_fch');
        document.getElementById('lic_fch_ret_vacacioneshoras').setAttribute('name', 'lic_fch');
        document.getElementById('lic_day_vacacioneshoras').setAttribute('name', 'lic_d');
        document.getElementById('lic_hour_vacacioneshoras').setAttribute('name', 'lic_h');
        document.getElementById('lic_minutes_vacacioneshoras').setAttribute('name', 'lic_m');

        document.getElementById("lic_obs").value = '';
        document.getElementById("lic_obs").readOnly = false;
    }else if(d == 'LIC_DUELO'){
        ///// HELL ////
        document.getElementById("seleccionar").style.display = 'block';
        document.getElementById("iniciodias").style.display = 'block';
        document.getElementById("vacaciones").style.display = 'none';

        document.getElementById("lic_day_iniciodias").value = 3;
        document.getElementById("lic_day_iniciodias").readOnly = true;
        document.getElementById("lic_hour_iniciodias").readOnly = true;
        document.getElementById("lic_minutes_iniciodias").readOnly = true;
        document.getElementById("lic_hour_iniciodias").value = 0;
        document.getElementById("lic_minutes_iniciodias").value = 0;

        document.getElementById('lic_fch_ini_iniciodias').setAttribute('name', 'lic_fch_ini');
        document.getElementById('lic_fch_fin_iniciodias').setAttribute('name', 'lic_fch_fin');
        document.getElementById('lic_fch_ret_iniciodias').setAttribute('name', 'lic_fch_ret');
        document.getElementById('lic_day_iniciodias').setAttribute('name', 'lic_day');
        document.getElementById('lic_hour_iniciodias').setAttribute('name', 'lic_hour');
        document.getElementById('lic_minutes_iniciodias').setAttribute('name', 'lic_minutes');

        document.getElementById('lic_fch_ini_vacacionesdias').setAttribute('name', 'lic_fch');
        document.getElementById('lic_fch_fin_vacacionesdias').setAttribute('name', 'lic_fch');
        document.getElementById('lic_fch_ret_vacacionesdias').setAttribute('name', 'lic_fch');
        document.getElementById('lic_day_vacacionesdias').setAttribute('name', 'lic_d');
        document.getElementById('lic_hour_vacacionesdias').setAttribute('name', 'lic_h');
        document.getElementById('lic_minutes_vacacionesdias').setAttribute('name', 'lic_m');
        document.getElementById('lic_fch_ini_vacacioneshoras').setAttribute('name', 'lic_fch');
        document.getElementById('lic_fch_fin_vacacioneshoras').setAttribute('name', 'lic_fch');
        document.getElementById('lic_fch_ret_vacacioneshoras').setAttribute('name', 'lic_fch');
        document.getElementById('lic_day_vacacioneshoras').setAttribute('name', 'lic_d');
        document.getElementById('lic_hour_vacacioneshoras').setAttribute('name', 'lic_h');
        document.getElementById('lic_minutes_vacacioneshoras').setAttribute('name', 'lic_m');

        document.getElementById("lic_obs").value = '';
        document.getElementById("lic_obs").readOnly = false;
    }else if(d == 'LIC_NACIMIENTO_HIJO'){
        ///// HELL ////
        document.getElementById("seleccionar").style.display = 'block';
        document.getElementById("iniciodias").style.display = 'block';
        document.getElementById("vacaciones").style.display = 'none';

        document.getElementById("lic_day_iniciodias").value = 3;
        document.getElementById("lic_day_iniciodias").readOnly = true;
        document.getElementById("lic_hour_iniciodias").readOnly = true;
        document.getElementById("lic_minutes_iniciodias").readOnly = true;
        document.getElementById("lic_hour_iniciodias").value = 0;
        document.getElementById("lic_minutes_iniciodias").value = 0;

        document.getElementById('lic_fch_ini_iniciodias').setAttribute('name', 'lic_fch_ini');
        document.getElementById('lic_fch_fin_iniciodias').setAttribute('name', 'lic_fch_fin');
        document.getElementById('lic_fch_ret_iniciodias').setAttribute('name', 'lic_fch_ret');
        document.getElementById('lic_day_iniciodias').setAttribute('name', 'lic_day');
        document.getElementById('lic_hour_iniciodias').setAttribute('name', 'lic_hour');
        document.getElementById('lic_minutes_iniciodias').setAttribute('name', 'lic_minutes');

        document.getElementById('lic_fch_ini_vacacionesdias').setAttribute('name', 'lic_fch');
        document.getElementById('lic_fch_fin_vacacionesdias').setAttribute('name', 'lic_fch');
        document.getElementById('lic_fch_ret_vacacionesdias').setAttribute('name', 'lic_fch');
        document.getElementById('lic_day_vacacionesdias').setAttribute('name', 'lic_d');
        document.getElementById('lic_hour_vacacionesdias').setAttribute('name', 'lic_h');
        document.getElementById('lic_minutes_vacacionesdias').setAttribute('name', 'lic_m');
        document.getElementById('lic_fch_ini_vacacioneshoras').setAttribute('name', 'lic_fch');
        document.getElementById('lic_fch_fin_vacacioneshoras').setAttribute('name', 'lic_fch');
        document.getElementById('lic_fch_ret_vacacioneshoras').setAttribute('name', 'lic_fch');
        document.getElementById('lic_day_vacacioneshoras').setAttribute('name', 'lic_d');
        document.getElementById('lic_hour_vacacioneshoras').setAttribute('name', 'lic_h');
        document.getElementById('lic_minutes_vacacioneshoras').setAttribute('name', 'lic_m');

        document.getElementById("lic_obs").value = '';
        document.getElementById("lic_obs").readOnly = false;

    }else if(d == 'LIC_ESPECIAL1'){
        ///// HELL ////
        document.getElementById("seleccionar").style.display = 'block';
        document.getElementById("iniciodias").style.display = 'none';
        document.getElementById("vacaciones").style.display = 'block';

        const input = document.getElementById('selectvacaciones');
        input.setAttribute('required', '');

        document.getElementById("lic_obs").value = 'DIA DE LA MUJER INTERNACIONAL';
        document.getElementById("lic_obs").readOnly = true;
    }else if(d == 'LIC_ESPECIAL2'){
        ///// HELL ////
        document.getElementById("seleccionar").style.display = 'block';
        document.getElementById("iniciodias").style.display = 'none';
        document.getElementById("vacaciones").style.display = 'block';

        const input = document.getElementById('selectvacaciones');
        input.setAttribute('required', '');

        document.getElementById("lic_obs").value = 'DIA DE LA MADRE';
        document.getElementById("lic_obs").readOnly = true;
    }else if(d == 'LIC_ESPECIAL3'){
        ///// HELL ////
        document.getElementById("seleccionar").style.display = 'block';
        document.getElementById("iniciodias").style.display = 'none';
        document.getElementById("vacaciones").style.display = 'block';

        const input = document.getElementById('selectvacaciones');
        input.setAttribute('required', '');

        document.getElementById("lic_obs").value = 'DIA DE LA MUJER NACIONAL';
        document.getElementById("lic_obs").readOnly = true;
    }else if(d == 'LIC_ESPECIAL4'){
        ///// HELL ////
        document.getElementById("seleccionar").style.display = 'block';
        document.getElementById("iniciodias").style.display = 'none';
        document.getElementById("vacaciones").style.display = 'block';

        const input = document.getElementById('selectvacaciones');
        input.setAttribute('required', '');

        document.getElementById("lic_obs").value = 'DIA DEL PADRE';
        document.getElementById("lic_obs").readOnly = true;
    }else if(d == 'LIC_ESPECIAL5'){
        ///// HELL ////
        document.getElementById("seleccionar").style.display = 'block';
        document.getElementById("iniciodias").style.display = 'none';
        document.getElementById("vacaciones").style.display = 'block';

        const input = document.getElementById('selectvacaciones');
        input.setAttribute('required', '');

        document.getElementById("lic_obs").value = 'DIA DEL HOMBRE';
        document.getElementById("lic_obs").readOnly = true;
    }else if(d == 'SOL_VACACION'){
        ///// HELL ////
        document.getElementById("seleccionar").style.display = 'block';
        document.getElementById("iniciodias").style.display = 'none';
        document.getElementById("vacaciones").style.display = 'block';

        const input = document.getElementById('selectvacaciones');
        input.setAttribute('required', '');

        document.getElementById("lic_obs").value = '';
        document.getElementById("lic_obs").readOnly = false;
    }else{
        document.getElementById("seleccionar").style.display = 'none';
        document.getElementById("formlicenses").reset();

    }
}

function selectdh(tipo){

    if(tipo == ''){

        document.getElementById("vacacionesdias").style.display = 'none';
        document.getElementById("vacacioneshoras").style.display = 'none';

    }else if(tipo == 'DIAS'){

        document.getElementById("vacacionesdias").style.display = 'block';
        document.getElementById("vacacioneshoras").style.display = 'none';

        document.getElementById('lic_fch_ini_vacacionesdias').setAttribute('name', 'lic_fch_ini');
        document.getElementById('lic_fch_fin_vacacionesdias').setAttribute('name', 'lic_fch_fin');
        document.getElementById('lic_fch_ret_vacacionesdias').setAttribute('name', 'lic_fch_ret');
        document.getElementById('lic_day_vacacionesdias').setAttribute('name', 'lic_day');
        document.getElementById('lic_hour_vacacionesdias').setAttribute('name', 'lic_hour');
        document.getElementById('lic_minutes_vacacionesdias').setAttribute('name', 'lic_minutes');

        document.getElementById('lic_fch_ini_iniciodias').setAttribute('name', 'lic_fch');
        document.getElementById('lic_fch_fin_iniciodias').setAttribute('name', 'lic_fch');
        document.getElementById('lic_fch_ret_iniciodias').setAttribute('name', 'lic_fch');
        document.getElementById('lic_day_iniciodias').setAttribute('name', 'lic_d');
        document.getElementById('lic_hour_iniciodias').setAttribute('name', 'lic_h');
        document.getElementById('lic_minutes_iniciodias').setAttribute('name', 'lic_m');
        document.getElementById('lic_fch_ini_vacacioneshoras').setAttribute('name', 'lic_fch');
        document.getElementById('lic_fch_fin_vacacioneshoras').setAttribute('name', 'lic_fch');
        document.getElementById('lic_fch_ret_vacacioneshoras').setAttribute('name', 'lic_fch');
        document.getElementById('lic_day_vacacioneshoras').setAttribute('name', 'lic_d');
        document.getElementById('lic_hour_vacacioneshoras').setAttribute('name', 'lic_h');
        document.getElementById('lic_minutes_vacacioneshoras').setAttribute('name', 'lic_m');


    }else if(tipo == 'HORAS'){

        document.getElementById("vacacionesdias").style.display = 'none';
        document.getElementById("vacacioneshoras").style.display = 'block';

        document.getElementById('lic_fch_ini_vacacioneshoras').setAttribute('name', 'lic_fch_ini');
        document.getElementById('lic_fch_fin_vacacioneshoras').setAttribute('name', 'lic_fch_fin');
        document.getElementById('lic_fch_ret_vacacioneshoras').setAttribute('name', 'lic_fch_ret');
        document.getElementById('lic_day_vacacioneshoras').setAttribute('name', 'lic_day');
        document.getElementById('lic_hour_vacacioneshoras').setAttribute('name', 'lic_hour');
        document.getElementById('lic_minutes_vacacioneshoras').setAttribute('name', 'lic_minutes');

        document.getElementById('lic_fch_ini_iniciodias').setAttribute('name', 'lic_fch');
        document.getElementById('lic_fch_fin_iniciodias').setAttribute('name', 'lic_fch');
        document.getElementById('lic_fch_ret_iniciodias').setAttribute('name', 'lic_fch');
        document.getElementById('lic_day_iniciodias').setAttribute('name', 'lic_d');
        document.getElementById('lic_hour_iniciodias').setAttribute('name', 'lic_h');
        document.getElementById('lic_minutes_iniciodias').setAttribute('name', 'lic_m');
        document.getElementById('lic_fch_ini_vacacionesdias').setAttribute('name', 'lic_fch');
        document.getElementById('lic_fch_fin_vacacionesdias').setAttribute('name', 'lic_fch');
        document.getElementById('lic_fch_ret_vacacionesdias').setAttribute('name', 'lic_fch');
        document.getElementById('lic_day_vacacionesdias').setAttribute('name', 'lic_d');
        document.getElementById('lic_hour_vacacionesdias').setAttribute('name', 'lic_h');
        document.getElementById('lic_minutes_vacacionesdias').setAttribute('name', 'lic_m');

    }
}

function calculardias(fe,item){

    var fechainput_mod = fe;
    var datePieces_mod = fechainput_mod.split(" ");
    var datePieces = datePieces_mod[0].split("/");
    var preFinalDate = [datePieces[2] , datePieces[1] , datePieces[0]];
    var fechainicio=preFinalDate.join("-");

    var dias = parseInt(document.getElementById("lic_day_iniciodias").value);

    //// llamar a funcion que retorna fecha fin y fecha retorno

    $.ajax({
                type: 'post',
                url: 'images/vacaciones.php',
                dataType: 'json',
                data: { 'fechainicio' : fechainicio, 'dias' : dias, 'item' : item},
                success: function(response) {

                    var fin=response['fecha_fin'];
                    var retorno=response['fecha_ret'];

                    document.getElementById("lic_fch_fin_iniciodias").value=fin;
                    document.getElementById("lic_fch_ret_iniciodias").value=retorno;
                    //document.getElementById("btnRegister").disabled = false;
                }
            });
}

function calculardiasvacacion(day,item){

    var dias = parseInt(day);
    var fechainput_mod = document.getElementById("lic_fch_ini_vacacionesdias").value;

    var fechainput = fechainput_mod.split(" ");

    var datePieces = fechainput[0].split("/");
    var preFinalDate = [datePieces[2] , datePieces[1] , datePieces[0]];
    var fechainicio=preFinalDate.join("-");

    //// llamar a funcion que retorna fecha fin y fecha retorno

    $.ajax({
                type: 'post',
                url: 'images/vacaciones.php',
                dataType: 'json',
                data: { 'fechainicio' : fechainicio, 'dias' : dias, 'item' : item},
                success: function(response) {

                    var fin=response['fecha_fin'];
                    var retorno=response['fecha_ret'];

                    document.getElementById("lic_fch_fin_vacacionesdias").value=fin;
                    document.getElementById("lic_fch_ret_vacacionesdias").value=retorno;
                }
            });
}

function sumahoras(hora){

    var fecha_ini = document.getElementById("lic_fch_ini_vacacioneshoras").value;
    var min = document.getElementById("lic_minutes_vacacioneshoras").value;

    var datePieces = fecha_ini.split(" ");
    var tiempo = datePieces[1].split(":");
    var horas = parseInt(tiempo[0]);
    var minutos = tiempo[1];

    var totalhoras = parseInt(horas)+parseInt(hora);
    if(totalhoras < 10){
        var neo_horas = '0'+totalhoras;
    }else{
        var neo_horas = totalhoras;
    }

    if(min == 0){
       var neo_minutos = minutos;
    }else{
       var neo_minutos = min;
    }

    var fecha_hora = datePieces[0]+' '+neo_horas+':'+neo_minutos;

    document.getElementById("lic_fch_fin_vacacioneshoras").value = fecha_hora;
    document.getElementById("lic_fch_ret_vacacioneshoras").value = fecha_hora;
}

function calculateBetDays(){

    var licencia = document.getElementById("lic_type").value;

    if(licencia  == 'LIC_ESPECIAL1' || licencia == 'LIC_ESPECIAL2'  || licencia == 'LIC_ESPECIAL3'  || licencia == 'LIC_ESPECIAL4'  || licencia == 'LIC_ESPECIAL5'  || licencia == 'SOL_VACACION'   || licencia == 'LIC_SIN_GOCE_HABER' || licencia == ''){

        var inicio = document.getElementById("lic_fch_ini").value;

        var fin = document.getElementById("lic_fch_fin").value;

        var inicioDia = inicio.split(" ")[0];

        var finDia = fin.split(" ")[0];

        var tratamientoIni = inicioDia.split("/")[2] + '-' + inicioDia.split("/")[1] + '-' + inicioDia.split("/")[0];

        var tratamientoFin = finDia.split("/")[2] + '-' + finDia.split("/")[1] + '-' + finDia.split("/")[0];

        var inicioHoras = inicio.split(" ")[1];

        var finHoras = fin.split(" ")[1];

        var dt1 = new Date(tratamientoIni + 'T' + inicioHoras + ':00Z' );

        var dt2 = new Date(tratamientoFin + 'T' + finHoras + ':00Z');

        /*dt1 = new Date(ini);

        dt2 = new Date(fin);*/

        var minutos = diff_minutes_only(dt1, dt2);

        var horas = diff_hours(dt1, dt2);

        var dias = diff_days(dt1, dt2);

        if(dias > 0 || horas > 0){
            if(minutos < 59){
                document.getElementById("lic_minutes").value = minutos;
            }else{
                document.getElementById("lic_minutes").value = 0;
            }

            //CALCULO HORARIO NORMAL
            //if(horas < 8){

            //CALCULO TEMPORADA COVID
            if(horas < 7){

                document.getElementById("lic_day").value = dias;

                document.getElementById("lic_hour").value = horas;
            }else{

                document.getElementById("lic_hour").value = 0;
                
                //CALCULO HORARIO NORMAL
                //var contar = horas / 8;

                //CALCULO TEMPORADA COVID
                var contar = horas / 7;

                var aumentar = Math.abs(Math.round(contar)); 

                if(dias >= aumentar){
                    document.getElementById("lic_day").value = dias  + 1;
                }else{
                    document.getElementById("lic_day").value = aumentar;
                }        
            }
        }else{
            document.getElementById("lic_minutes").value = 0;
            document.getElementById("lic_hour").value = 0;
            document.getElementById("lic_day").value = 0;
        }

        
    }
    
}

function diff_minutes_only(dt2, dt1){

    var diff =(dt2.getMinutes() - dt1.getMinutes());

    return Math.abs(Math.round(diff));  
}


function diff_hours(dt2, dt1){

    var diff = Math.abs(dt1.getHours() - dt2.getHours());

    return Math.abs(Math.round(diff)); 
}

function diff_days(startDate, endDate) {
    let count = 0;
    const curDate = new Date(startDate.getTime());
    while (curDate <= endDate) {
        const dayOfWeek = curDate.getDay();
        if(!(dayOfWeek in [0, 6])) count++;
        curDate.setDate(curDate.getDate() + 1);
    }
    //alert(count);
    return count - 1;

    /*var diff = Math.abs(dt1.getTime() - dt2.getTime()) / (1000 * 3600 * 24); 

    return Math.abs(Math.round(diff)); */
}

</script>




