
<div class="row">
    <div class="col-xl-3 col-lg-4">
        <div class="text-center card-box">
            <div class="member-card">
                <?php $this->renderPartial('profile',array('group'=>$group)); ?>
            </div>
        </div> <!-- end card-box -->
    </div> <!-- end col -->
    <div class="col-lg-8 col-xl-9">
        <div class="">
            <div class="card-box">
                <ul class="nav nav-tabs tabs-bordered">
                    <?php $this->renderPartial('menu',array('manager'=>$manager,'member'=>$member)); ?>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active">
                        <?php if(!empty($members['members'])){ ?>
                        <div class="col-md-12 form-group row">
                            <label class="col-2 col-form-label">Buscar</label>
                            <div class="col-10">
                                <input type="text" class="form-control" placeholder="Introduzca el Nombre, Item &oacute; Area" id="searchBox" onkeyup="directoryFind('<?php echo count($members['members']) + 1;?>')">
                            </div>
                        </div>
                        <?php } ?>
                        <div id="wrapper">
                            <div class="row scrollbar"  id="style-2">
                                <?php if(!empty($members['members'])){ ?>
                                    <?php if($group->public == 1){ ?>
                                        <?php $cantidad = 1; ?>
                                        <?php foreach($members['members'] as $personal){ ?>
                                            <?php 
                                            if($personal['photoUp'] == null){
                                                $photo = $personal['photo'];
                                            }else{
                                                $photo = $personal['photoUp'];
                                            }
                                            ?>
                                                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12" id="personal<?php echo $cantidad;?>">
                                                    <div class="card-box widget-user">
                                                        <div>
                                                            <img src="<?php echo Yii::app()->createUrl('api/showPersonal',array('filename'=>$photo)); ?>" class="rounded-circle" alt="user" data-toggle="tooltip" data-placement="right" title="<?php echo $personal['name'];?>">
                                                            <div class="wid-u-info">
                                                                <h5 class="mt-0 m-b-5 font-16"><?php echo $personal['name'];?></h5>
                                                                <p class="text-muted m-b-5 font-13">ITEM: <?php echo $personal['item'];?></p>
                                                                <p class="text-muted m-b-5 font-10">AREA: <?php echo $personal['area'];?></p>
                                                                <p class="text-muted m-b-5 font-10">PERMISO: <?php echo $personal['license'];?></p>
                                                                <button type="button" class="btn btn-danger btn-custom m-b-5" data-toggle="modal" data-target="#<?php echo $personal['item'];?>">
                                                                    Informaci&oacute;n
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal fade" id="<?php echo $personal['item'];?>" tabindex="-1" role="dialog" aria-labelledby="profileModal" style="display: none;" aria-hidden="true">
                                                        <div class="modal-dialog modal-lg">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                                    <h4 class="modal-title" id="profileModal"><i class="fa fa-user"></i> Informaci&oacute;n</h4>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="text-center card-box">
                                                                        <div class="member-card">
                                                                            <div class="thumb-lg member-thumb m-b-10 center-page">
                                                                                <img src="<?php echo Yii::app()->createUrl('api/showPersonal',array('filename'=>$photo)); ?>" class="rounded-circle img-thumbnail" alt="profile-image">
                                                                            </div>

                                                                            <div class="">
                                                                                <h4 class="m-b-5 mt-2"><?php echo $personal['name'];?></h4>
                                                                                <p class="text-muted">ITEM: <?php echo $personal['item'];?></p>
                                                                            </div>

                                                                            <div class="text-left m-t-40 row">
                                                                                <p class="text-muted font-16 col-lg-12"><strong>Area :</strong> <span class="m-l-15"><?php echo $personal['area'];?></span></p>

                                                                                <p class="text-muted font-16 col-lg-12"><strong>Cargo :</strong><span class="m-l-15"><?php echo $personal['charge'];?></span></p>

                                                                                <p class="text-muted font-16 col-lg-12"><strong>Email :</strong> <span class="m-l-15"><?php echo $personal['email'];?></span></p>

                                                                                <p class="text-muted font-16 col-lg-4"><strong>Corporativo :</strong> <span class="m-l-15"><?php echo $personal['phone_corp'];?></span></p>

                                                                                <p class="text-muted font-16 col-lg-4"><strong>Directo :</strong> <span class="m-l-15"><?php echo $personal['phone_direct'];?></span></p>

                                                                                <p class="text-muted font-16 col-lg-4"><strong>Interno :</strong> <span class="m-l-15"><?php echo $personal['phone_int'];?></span></p>

                                                                                <p class="text-muted font-16 col-lg-12"><strong>Edificio :</strong> <span class="m-l-15"><?php echo $personal['building'];?> <?php echo $personal['building_flat'];?></span></p>

                                                                                <p class="text-muted font-16 col-lg-12"><strong>Permiso :</strong> <span class="m-l-15"><?php echo $personal['license'];?></span></p>
                                                                                <?php if(!empty($personal['schedules'])){ ?>
                                                                                    <?php foreach($personal['schedules'] as $schedules){ ?>
                                                                                        <p class="text-muted font-16 col-lg-12"><strong>Horario Turno "<?php echo $schedules['turn'];?>":</strong></p>
                                                                                        <p class="text-muted font-16 col-lg-6"><strong>Ingreso :</strong> <span class="m-l-15"><?php echo $schedules['entry'];?></span></p>
                                                                                        <p class="text-muted font-16 col-lg-6"><strong>Salida :</strong> <span class="m-l-15"><?php echo $schedules['output'];?></span></p>
                                                                                    <?php } ?>
                                                                                <?php }else{ ?>
                                                                                    <p class="text-muted font-16 col-lg-4"><strong>Horario :</strong> <span class="m-l-15">NO DISPONIBLE</span></p>
                                                                                <?php } ?>
                                                                            </div>                                        
                                                                        </div>
                                                                    </div> <!-- end card-box -->
                                                                </div>
                                                            </div><!-- /.modal-content -->
                                                        </div><!-- /.modal-dialog -->
                                                    </div>
                                                    <input type="hidden" id="searchName<?php echo $cantidad;?>" value="<?php echo $personal['name'];?>">
                                                    <input type="hidden" id="searchItem<?php echo $cantidad;?>" value="<?php echo $personal['item'];?>">
                                                    <input type="hidden" id="searchArea<?php echo $cantidad;?>" value="<?php echo $personal['area'];?>">
                                                </div>
                                                <?php $cantidad = $cantidad + 1; ?>
                                        <?php } ?>
                                    <?php }else{ ?>
                                        <?php $cantidad = 1; ?>
                                        <?php foreach($members['members'] as $personal){ ?>
                                            <?php 
                                            if($personal['photoUp'] == null){
                                                $photo = $personal['photo'];
                                            }else{
                                                $photo = $personal['photoUp'];
                                            }
                                            ?>
                                            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12" id="personal<?php echo $cantidad;?>">
                                            <div class="card-box widget-user">
                                                <div>
                                                    <img src="<?php echo Yii::app()->createUrl('api/showPersonal',array('filename'=>$photo)); ?>" class="rounded-circle" alt="user" data-toggle="tooltip" data-placement="right" title="<?php echo $personal['name'];?>">
                                                    <div class="wid-u-info">
                                                        <h5 class="mt-0 m-b-5 font-16"><?php echo $personal['name'];?></h5>
                                                        <p class="text-muted m-b-5 font-13">ITEM: <?php echo $personal['item'];?></p>
                                                        <p class="text-muted m-b-5 font-10">AREA: <?php echo $personal['area'];?></p>
                                                        <p class="text-muted m-b-5 font-10">PERMISO: <?php echo $personal['license'];?></p>
                                                        <button type="button" class="btn btn-danger btn-custom m-b-5" data-toggle="modal" data-target="#<?php echo $personal['item'];?>">
                                                            Informaci&oacute;n
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal fade" id="<?php echo $personal['item'];?>" tabindex="-1" role="dialog" aria-labelledby="profileModal" style="display: none;" aria-hidden="true">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                            <h4 class="modal-title" id="profileModal"><i class="fa fa-user"></i> Informaci&oacute;n</h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="text-center card-box">
                                                                <div class="member-card">
                                                                    <div class="thumb-lg member-thumb m-b-10 center-page">
                                                                        <img src="<?php echo Yii::app()->createUrl('api/showPersonal',array('filename'=>$photo)); ?>" class="rounded-circle img-thumbnail" alt="profile-image">
                                                                    </div>

                                                                    <div class="">
                                                                        <h4 class="m-b-5 mt-2"><?php echo $personal['name'];?></h4>
                                                                        <p class="text-muted">ITEM: <?php echo $personal['item'];?></p>
                                                                    </div>

                                                                    <div class="text-left m-t-40 row">
                                                                        <p class="text-muted font-16 col-lg-12"><strong>Area :</strong> <span class="m-l-15"><?php echo $personal['area'];?></span></p>

                                                                        <p class="text-muted font-16 col-lg-12"><strong>Cargo :</strong><span class="m-l-15"><?php echo $personal['charge'];?></span></p>

                                                                        <p class="text-muted font-16 col-lg-12"><strong>Email :</strong> <span class="m-l-15"><?php echo $personal['email'];?></span></p>

                                                                        <p class="text-muted font-16 col-lg-4"><strong>Corporativo :</strong> <span class="m-l-15"><?php echo $personal['phone_corp'];?></span></p>

                                                                        <p class="text-muted font-16 col-lg-4"><strong>Directo :</strong> <span class="m-l-15"><?php echo $personal['phone_direct'];?></span></p>

                                                                        <p class="text-muted font-16 col-lg-4"><strong>Interno :</strong> <span class="m-l-15"><?php echo $personal['phone_int'];?></span></p>

                                                                        <p class="text-muted font-16 col-lg-12"><strong>Edificio :</strong> <span class="m-l-15"><?php echo $personal['building'];?> <?php echo $personal['building_flat'];?></span></p>

                                                                        <p class="text-muted font-16 col-lg-12"><strong>Permiso :</strong> <span class="m-l-15"><?php echo $personal['license'];?></span></p>
                                                                        <?php if(!empty($personal['schedules'])){ ?>
                                                                            <?php foreach($personal['schedules'] as $schedules){ ?>
                                                                                <p class="text-muted font-16 col-lg-12"><strong>Horario Turno "<?php echo $schedules['turn'];?>":</strong></p>
                                                                                <p class="text-muted font-16 col-lg-6"><strong>Ingreso :</strong> <span class="m-l-15"><?php echo $schedules['entry'];?></span></p>
                                                                                <p class="text-muted font-16 col-lg-6"><strong>Salida :</strong> <span class="m-l-15"><?php echo $schedules['output'];?></span></p>
                                                                            <?php } ?>
                                                                        <?php }else{ ?>
                                                                            <p class="text-muted font-16 col-lg-4"><strong>Horario :</strong> <span class="m-l-15">NO DISPONIBLE</span></p>
                                                                        <?php } ?>
                                                                    </div>                                        
                                                                </div>
                                                            </div> <!-- end card-box -->
                                                        </div>
                                                    </div><!-- /.modal-content -->
                                                </div><!-- /.modal-dialog -->
                                            </div>
                                            </div>
                                            <input type="hidden" id="searchName<?php echo $cantidad;?>" value="<?php echo $personal['name'];?>">
                                            <input type="hidden" id="searchItem<?php echo $cantidad;?>" value="<?php echo $personal['item'];?>">
                                            <input type="hidden" id="searchArea<?php echo $cantidad;?>" value="<?php echo $personal['area'];?>">
                                            <?php $cantidad = $cantidad + 1; ?>
                                        <?php } ?>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div> <!-- end col -->
</div>
<script type="text/javascript">
setTimeout(function(){
    jQuery('.loader_div').hide();
}, 2000);    
</script>