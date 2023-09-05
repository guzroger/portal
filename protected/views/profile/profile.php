<?php
if($personal['birthdate'] != null){
    $birthday = date('d/m/Y', strtotime($personal['birthdate']));
}else{
    $birthday = 'NO REGISTRADO';
}

?>
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
                            <?php if(!empty($tributa)){ ?>             
                                <div class="col-md-12">
                                    <h3>Informaci&oacute;n Tributaria</h3>
                                </div>    
                                <div class="col-md-4">
                                    <br>
                                    Periodo: <?php echo $tributa['PERIODO']; ?>
                                </div>
                                <div class="col-md-4">
                                    <br>
                                    Saldo RC-IVA: <?php echo $tributa['SALDO']; ?>
                                </div>
                            <?php } ?>                         
                            <div class="col-md-12">
                                <br>
                                <h3>Datos Personales</h3>
                            </div>                           
                            <div class="col-md-4">
                                <br>
                                C&oacute;digo Dependiente: <?php echo $personal['code_dependent']; ?>
                            </div>                       
                            <div class="col-md-4">
                                <br>
                                Nacionalidad: <?php echo $personal['nationality']; ?>
                            </div>                           
                            <div class="col-md-4">
                                <br>
                                Estado Civil: <?php echo $personal['civil_status']; ?>
                            </div>                            
                            <div class="col-md-4">
                                <br>
                                G&eacute;nero: <?php if($personal['gender'] == 'M'){ echo 'MASCULINO'; }elseif($personal['gender'] == 'F'){ echo 'FEMENINO'; }else{ echo 'SIN REGISTRO'; }  ?>
                            </div>                       
                            <div class="col-md-4">
                                <br>
                                Fecha Nacimiento: <?php echo $birthday; ?>
                            </div>                           
                            <div class="col-md-4">
                                <br>
                                Celular: <?php echo $personal['cellphone']; ?>
                            </div>                            
                            <div class="col-md-4">
                                <br>
                                Tel&eacute;fono: <?php echo $personal['phone']; ?>
                            </div>                           
                            <div class="col-md-4">
                                <br>
                                Email: <?php echo $personal['email']; ?>
                            </div>                            
                            <div class="col-md-12">
                                <br>
                                Direcci&oacute;n: <?php echo $personal['address']; ?>
                            </div>                          
                            <div class="col-md-4">
                                <br>
                                Documento <?php echo $personal['document_type']; ?>: <?php echo $personal['document']; ?> <?php echo $personal['document_emi']; ?>
                                <button class="btn btn-icon waves-effect waves-light btn-danger m-b-5"  data-toggle="modal" data-target="#modalDocument"> <i class="fa fa-image"></i> </button>
                            </div>                          
                            <div class="col-md-4">
                                <br>
                                Pasaporte: <?php echo $personal['passport']; ?>
                                <button class="btn btn-icon waves-effect waves-light btn-info m-b-5"  data-toggle="modal" data-target="#modalPassport"> <i class="fa fa-image"></i> </button>
                            </div>                          
                            <div class="col-md-4">
                                <br>
                                Licencia de Conducir: <?php echo $personal['driver_license']; ?>
                                <button class="btn btn-icon waves-effect waves-light btn-success m-b-5"  data-toggle="modal" data-target="#modalLicense"> <i class="fa fa-image"></i> </button>
                            </div> 
                            <div class="col-md-12">
                                <hr>
                                <h3>Asistencia</h3>
                            </div> 
                            <div class="col-md-12">
                            <form action="<?php echo $this->createUrl('profile'); ?>" method="POST">
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
                                <?php if(!empty($personal['marks'])){ ?>

                                <?php 

                                $quantity = 0;
                                foreach($personal['marks'] as $marks){  
                                    $total = count($marks);
                                    if($quantity < $total){
                                        $quantity = $total;
                                    }                                    
                                } 

                                ?>

                                <div class="table-responsive">
                                    <table id="datatable-buttons" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th></th>
                                                <th>Fecha</th>
                                                <?php for ($a = 1; $a <= $quantity ; $a++) { ?>
                                                    <th>Marca <?php echo $a; ?></th>
                                                <?php } ?>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach($personal['marks'] as $key => $marks){ ?>
                                            <tr>
                                                <td>
                                                    <label><?php echo $key; ?></label>
                                                </td>
                                                <td>
                                                    <label><?php echo date('d/m/Y',strtotime($key)); ?></label>
                                                </td>
                                                <?php 
                                                $count = 0;
                                                foreach($marks as $mark){ ?>
                                                    <td><?php echo date('H:i',strtotime($mark['hora_marca'])); ?></td>
                                                    <?php $count = $count + 1; ?>
                                                <?php } ?>
                                                <?php 
                                                if($count < $quantity){ 
                                                    $i = $count;
                                                    for ($i; $i < $quantity ; $i++) { 
                                                        echo '<td><i class="fa fa-times"></i></td>';
                                                    }
                                                } 
                                                ?>
                                            </tr>  
                                            <?php } ?>                              
                                        </tbody>
                                    </table>                            
                                </div>

                                <?php }else{ ?>
                                    <h4 align="center">NO TIENE MARCAS REGISTRADAS, SELECCIONE OTRAS FECHAS DE INICIO Y FIN.</h4>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div> <!-- end col -->
</div>

<div class="modal fade" id="modalDocument" tabindex="-1" role="dialog" aria-labelledby="profileModal" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="profileModal"><i class="fa fa-user"></i> Documento de Identidad</h4>
            </div>
            <div class="modal-body">
                <div class="text-center card-box">
                    <?php if($personal['document_photo'] == null){ ?>
                        <i class="fa fa-image fa-5x"></i>
                    <?php }else{ ?>
                        <?php echo $personal['document_photo']; ?>
                    <?php } ?>
                </div> <!-- end card-box -->
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>

<div class="modal fade" id="modalPassport" tabindex="-1" role="dialog" aria-labelledby="profileModal" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="profileModal"><i class="fa fa-user"></i> Pasaporte</h4>
            </div>
            <div class="modal-body">
                <div class="text-center card-box">
                    <?php if($personal['passport_photo'] == null){ ?>
                        <i class="fa fa-image fa-5x"></i>
                    <?php }else{ ?>
                        <?php echo $personal['passport_photo']; ?>
                    <?php } ?>
                </div> <!-- end card-box -->
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>


<div class="modal fade" id="modalLicense" tabindex="-1" role="dialog" aria-labelledby="profileModal" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="profileModal"><i class="fa fa-user"></i> Licencia de Conducir</h4>
            </div>
            <div class="modal-body">
                <div class="text-center card-box">
                    <?php if($personal['driver_license_photo'] == null){ ?>
                        <i class="fa fa-image fa-5x"></i>
                    <?php }else{ ?>
                        <?php echo $personal['driver_license_photo']; ?>
                    <?php } ?>
                </div> <!-- end card-box -->
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
